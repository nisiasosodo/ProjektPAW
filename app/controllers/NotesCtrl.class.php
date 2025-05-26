<?php

namespace app\controllers;

use app\forms\NoteForm;
use app\forms\TextNoteForm;
use app\forms\ListNoteForm;
use app\forms\ImageNoteForm;
use core\App;
use core\ParamUtils;
use core\Utils;
use core\SessionUtils;
use core\Message;

class NotesCtrl {

    private $form;       
    private $categories; 
    private $note_types_map; 

    public function __construct() {
        
        $this->note_types_map = [
            'text'  => ['form_class' => TextNoteForm::class, 'view_template' => 'TextNoteView.tpl'],
            'list'  => ['form_class' => ListNoteForm::class, 'view_template' => 'ListNoteView.tpl'],
            'image' => ['form_class' => ImageNoteForm::class, 'view_template' => 'ImageNoteView.tpl']
        ];
    }
    
    private function initializeFormWithType($type) {
        if (!isset($this->note_types_map[$type])) {
            App::getMessages()->addMessage(new Message("Nieznany typ notatki: " . htmlspecialchars($type), Message::ERROR));
            $this->form = new TextNoteForm(); 
            $this->form->type = 'text'; 
            return false;
        }
        $formClass = $this->note_types_map[$type]['form_class'];
        $this->form = new $formClass();
        $this->form->type = $type;
        
        if ($type === 'list' && !isset($this->form->list_items)) {
        $this->form->list_items = [];
        }

        return true;
    }

    public function loadParamsIntoForm() {
        
        $this->form->id = ParamUtils::getFromRequest('id', true, null);
        $this->form->title = ParamUtils::getFromRequest('title', true, '');
        $this->form->category_id = ParamUtils::getFromRequest('category_id', true, null);

        
        switch ($this->form->type) {
            case 'text':
                $this->form->content = ParamUtils::getFromRequest('content', true, '');
                break;
            case 'list':
                $listItemsRaw = ParamUtils::getFromRequest('list_items_json', true, '[]');
                $this->form->list_items = json_decode($listItemsRaw, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    $this->form->list_items = [];
                }
                
                
                if (empty($this->form->list_items) && !empty($this->form->content)) {
                    $this->form->list_items = json_decode($this->form->content, true);
                }
                
                $this->form->content = json_encode($this->form->list_items);
                break;
            case 'image':
                $this->form->image_description = ParamUtils::getFromRequest('image_description', true, '');
                
                if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] == UPLOAD_ERR_OK) {
                    $this->form->image_file = $_FILES['image_file'];
                } else {
                    $this->form->image_file = null;
                }
                
                $this->form->content = ParamUtils::getFromRequest('image_url', true, ''); 
                break;
        }
    }

    public function validateSave() {
        if (!SessionUtils::isLogged()) {
            App::getMessages()->addMessage(new Message("Musisz być zalogowany, aby dodać/edytować notatkę.", Message::ERROR));
            return false;
        }
        if (empty($this->form->title)) {
            App::getMessages()->addMessage(new Message("Tytuł notatki jest wymagany.", Message::ERROR));
        }
        if (empty($this->form->category_id)) {
            App::getMessages()->addMessage(new Message("Kategoria jest wymagana.", Message::ERROR));
            
        } elseif (!is_numeric($this->form->category_id) || $this->form->category_id <= 0) {
            App::getMessages()->addMessage(new Message("Nieprawidłowa kategoria.", Message::ERROR));

        }

        
        //$selectedCategoryType = null;
        try {
            $selectedCategoryType = App::getDB()->get("KATEGORIA", "typ_kategorii", ["ID_kategorii" => $this->form->category_id]);
        } catch (\PDOException $e) {
            App::getMessages()->addMessage(new Message("Błąd bazy danych podczas pobierania typu kategorii.", Message::ERROR));
            if (App::getConf()->debug) {
                App::getMessages()->addMessage(new Message($e->getMessage(), Message::ERROR));
            }
            return false;
        }

        if (!$selectedCategoryType) {
            App::getMessages()->addMessage(new Message("Wybrana kategoria nie istnieje lub nie ma przypisanego typu.", Message::ERROR));
            return false;
        }

        $currentFormType = isset($this->form->type) ? $this->form->type : null;
        if ($currentFormType !== $selectedCategoryType) {
    
            $tempFormId = $this->form->id; 
            $tempFormTitle = $this->form->title; 
            $tempFormCategoryId = $this->form->category_id; 
 
            if (!$this->initializeFormWithType($selectedCategoryType)) {
                return false;
            } 
            $this->form->id = $tempFormId;
            $this->form->title = $tempFormTitle;
            $this->form->category_id = $tempFormCategoryId;     
            
        }

        
        switch ($this->form->type) {
            case 'text':
                if (empty($this->form->content)) {
                    App::getMessages()->addMessage(new Message("Treść notatki tekstowej jest wymagana.", Message::ERROR));
                }
                break;
            case 'list':
                if (empty($this->form->list_items) || !is_array($this->form->list_items) || count(array_filter($this->form->list_items, 'trim')) == 0) {
                    App::getMessages()->addMessage(new Message("Lista zadań nie może być pusta. Dodaj przynajmniej jeden element.", Message::ERROR));
                }
                break;
            case 'image':
                
                if ($this->form->id === null && ($this->form->image_file === null || $this->form->image_file['size'] == 0)) {
                    App::getMessages()->addMessage(new Message("Plik obrazu jest wymagany dla nowej notatki obrazkowej.", Message::ERROR));
                }
                
                
                
                if ($this->form->id !== null && $this->form->image_file === null && empty($this->form->content)) {
                    App::getMessages()->addMessage(new Message("W przypadku edycji notatki obrazkowej, musisz przesłać nowy obraz lub mieć istniejący URL.", Message::ERROR));
                }

                if ($this->form->image_file) {
                    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/jfif'];
                    $maxSize = 5 * 1024 * 1024; 
                    if (!in_array($this->form->image_file['type'], $allowedTypes)) {
                        App::getMessages()->addMessage(new Message("Dozwolone formaty obrazów: JPG, PNG, GIF.", Message::ERROR));
                    }
                    if ($this->form->image_file['size'] > $maxSize) {
                        App::getMessages()->addMessage(new Message("Obraz jest za duży (max 5MB).", Message::ERROR));
                    }
                }
                break;
        }

        if (App::getMessages()->isError()) {
            return false;
        }

        
        if (isset($this->form->id) && $this->form->id !== null) {
            $user_id = SessionUtils::load('user_id', true);
            try {
                
                $note = App::getDB()->get("NOTATKA", ["KATEGORIA_id_kategorii", "UŻYTKOWNIK_id_użytkownika"], ["ID_notatki" => $this->form->id]);
                
                if (!$note) {
                    App::getMessages()->addMessage(new Message("Notatka nie istnieje.", Message::ERROR));
                    return false;
                }
    
                if ($note["UŻYTKOWNIK_id_użytkownika"] != $user_id) {
                    App::getMessages()->addMessage(new Message("Brak dostępu do edycji tej notatki.", Message::ERROR));
                    return false;
                }
              
                $originalCategoryType = App::getDB()->get("KATEGORIA", "typ_kategorii", ["ID_kategorii" => $note["KATEGORIA_id_kategorii"]]);
                if ($originalCategoryType !== $this->form->type) {
                    App::getMessages()->addMessage(new Message("Nie można zmienić typu notatki przez zmianę kategorii podczas edycji. Utwórz nową notatkę, jeśli potrzebujesz innego typu.", Message::ERROR));
                    return false;
                }
            } catch (\PDOException $e) {
                App::getMessages()->addMessage(new Message("Błąd bazy danych podczas weryfikacji notatki.", Message::ERROR));
                if (App::getConf()->debug) {
                    App::getMessages()->addMessage(new Message($e->getMessage(), Message::ERROR));
                }
                return false;
            }
        }
        return !App::getMessages()->isError();
    }

    public function validateDelete() {
        if (!SessionUtils::isLogged()) {
            App::getMessages()->addMessage(new Message("Musisz być zalogowany, aby usunąć notatkę.", Message::ERROR));
            return false;
        }
        $this->form = new NoteForm(); 
        $this->form->id = ParamUtils::getFromCleanURL(1, true, null);

        if (!isset($this->form->id) || $this->form->id === null) {
            App::getMessages()->addMessage(new Message("Brak ID notatki do usunięcia.", Message::ERROR));
            return false;
        }
        $user_id = SessionUtils::load('user_id', true);
        try {
            $noteOwnerId = App::getDB()->get("NOTATKA", "UŻYTKOWNIK_id_użytkownika", ["ID_notatki" => $this->form->id]);
            if (!$noteOwnerId || $noteOwnerId != $user_id) {
                App::getMessages()->addMessage(new Message("Brak dostępu lub notatka nie istnieje.", Message::ERROR));
                return false;
            }
        } catch (\PDOException $e) {
            App::getMessages()->addMessage(new Message("Błąd bazy danych podczas weryfikacji notatki do usunięcia.", Message::ERROR));
            if (App::getConf()->debug) {
                App::getMessages()->addMessage(new Message($e->getMessage(), Message::ERROR));
            }
            return false;
        }
        return !App::getMessages()->isError();
    }

    private function loadCategories() {
        try {
            $this->categories = App::getDB()->select("KATEGORIA", [
                "ID_kategorii",
                "nazwa",
                "typ_kategorii"
            ]);
        } catch (\PDOException $e) {
            App::getMessages()->addMessage(new Message("Błąd bazy danych podczas ładowania kategorii.", Message::ERROR));
            if (App::getConf()->debug) {
                App::getMessages()->addMessage(new Message($e->getMessage(), Message::ERROR));
            }
            $this->categories = [];
        }
    }

    public function action_noteNew() {
        if (!SessionUtils::isLogged()) {
            App::getMessages()->addMessage(new Message("Musisz się zalogować, aby dodać notatkę.", Message::WARNING));
            App::getRouter()->redirectTo('loginShow');
            exit();
        }

        $category_id = ParamUtils::getFromRequest('category_id', true, null);
        $selectedType = 'text'; 

        if ($category_id) {
            try {
                $categoryType = App::getDB()->get("KATEGORIA", "typ_kategorii", ["ID_kategorii" => $category_id]);
                if ($categoryType) {
                    $selectedType = $categoryType;
                }
            } catch (\PDOException $e) {
                App::getMessages()->addMessage(new Message("Błąd podczas pobierania typu dla wybranej kategorii.", Message::ERROR));
                if (App::getConf()->debug) {
                    App::getMessages()->addMessage(new Message($e->getMessage(), Message::ERROR));
                }
            }
        }

        
        $this->initializeFormWithType($selectedType);
        $this->loadParamsIntoForm(); 

        $this->loadCategories(); 
        $this->generateView();
    }

    public function action_noteEdit() {
        if (!SessionUtils::isLogged()) {
            App::getMessages()->addMessage(new Message("Musisz się zalogować, aby edytować notatkę.", Message::WARNING));
            App::getRouter()->redirectTo('loginShow');
            exit();
        }

        $note_id = ParamUtils::getFromCleanURL(1, true, null);

        if (isset($note_id) && $note_id !== null) {
            $user_id = SessionUtils::load('user_id', true);
            try {
                
                $note = App::getDB()->get("NOTATKA", ["[><]KATEGORIA" => ["KATEGORIA_id_kategorii" => "ID_kategorii"]], [
                    "NOTATKA.ID_notatki", "NOTATKA.nazwa", "NOTATKA.tresc", "NOTATKA.KATEGORIA_id_kategorii",
                    "NOTATKA.UŻYTKOWNIK_id_użytkownika", "KATEGORIA.typ_kategorii" 
                ], ["NOTATKA.ID_notatki" => $note_id]);

                if ($note && $note["UŻYTKOWNIK_id_użytkownika"] == $user_id) {
                    
                    if (!$this->initializeFormWithType($note["typ_kategorii"])) {
                        App::getRouter()->redirectTo('mainPage');
                        exit();
                    }

                    
                    $this->form->id = $note["ID_notatki"];
                    $this->form->title = $note["nazwa"];
                    $this->form->category_id = $note["KATEGORIA_id_kategorii"];

                    
                    switch ($this->form->type) {
                        case 'text':
                            $this->form->content = $note["tresc"];
                            break;
                        case 'list':
                            $this->form->list_items = json_decode($note["tresc"], true);
                            if (json_last_error() !== JSON_ERROR_NONE) {
                                $this->form->list_items = [];
                            }
                            $this->form->content = $note["tresc"]; 
                            break;
                        case 'image':
                            $this->form->content = $note["tresc"]; 
                            
                            
                            break;
                    }

                } else {
                    App::getMessages()->addMessage(new Message("Notatka nie znaleziona lub brak uprawnień do edycji.", Message::ERROR));
                    App::getRouter()->redirectTo('mainPage');
                    exit();
                }
            } catch (\PDOException $e) {
                App::getMessages()->addMessage(new Message("Błąd bazy danych podczas pobierania notatki.", Message::ERROR));
                if (App::getConf()->debug) {
                    App::getMessages()->addMessage(new Message($e->getMessage(), Message::ERROR));
                }
                App::getRouter()->redirectTo('mainPage');
                exit();
            }
        } else {
            App::getMessages()->addMessage(new Message("Nie podano ID notatki do edycji.", Message::WARNING));
            App::getRouter()->redirectTo('mainPage');
            exit();
        }
        $this->loadCategories(); 
        $this->generateView();
    }

    public function action_noteSave() {
        error_log("--- DEBUG: Rozpoczęto action_noteSave() ---"); // Ta linia jest już w Twoim kodzie

        // KROK 1: DODAJ TE LINIE!
        $formId = ParamUtils::getFromRequest('id', true, null);
        $categoryId = ParamUtils::getFromRequest('category_id', true, null);
        error_log("--- DEBUG: action_noteSave - Form ID: " . ($formId ?? 'NULL') . ", Category ID: " . ($categoryId ?? 'NULL') . " ---"); // DODAJ

        $selectedType = 'text';
        if ($categoryId) {
            try {
                $categoryType = App::getDB()->get("KATEGORIA", "typ_kategorii", ["ID_kategorii" => $categoryId]);
                if ($categoryType) {
                    $selectedType = $categoryType;
                    error_log("--- DEBUG: action_noteSave - Typ kategorii z DB: " . $selectedType . " ---"); // DODAJ
                } else {
                    error_log("--- DEBUG: action_noteSave - Nie znaleziono typu dla kategorii ID: " . $categoryId . " ---"); // DODAJ
                }
            } catch (\PDOException $e) {
                App::getMessages()->addMessage(new Message("Błąd podczas pobierania typu dla wybranej kategorii.", Message::ERROR));
                error_log("--- DEBUG: action_noteSave - Błąd PDO podczas pobierania typu kategorii: " . $e->getMessage() . " ---"); // DODAJ
                if (App::getConf()->debug) {
                    App::getMessages()->addMessage(new Message($e->getMessage(), Message::ERROR));
                }
            }
        }

        // KROK 2: DODAJ TE LINIE
        if (!$this->initializeFormWithType($selectedType)) {
            error_log("--- DEBUG: action_noteSave - initializeFormWithType zwróciło false. ---"); // DODAJ
            $this->loadCategories();
            $this->generateView();
            return;
        }
        error_log("--- DEBUG: action_noteSave - Formularz zainicjalizowany jako: " . get_class($this->form) . " ---"); // DODAJ

        $this->loadParamsIntoForm();
        error_log("--- DEBUG: action_noteSave - Params załadowane do formularza. Tytuł: " . ($this->form->title ?? 'NULL') . ", Kategoria: " . ($this->form->category_id ?? 'NULL') . " ---"); // DODAJ


        if ($this->validateSave()) {
            error_log("--- DEBUG: Walidacja przeszła pomyślnie. Przygotowanie do zapisu do DB. ---"); // DODAJ
            $user_id = SessionUtils::load('user_id', true);
            error_log("--- DEBUG: Zalogowany User ID: " . ($user_id ?? 'NULL') . " ---"); // DODAJ

            // ... reszta kodu action_noteSave, w tym sekcja try-catch dla zapisu do DB ...

            try {
                $dataToSave = [
                    "nazwa" => $this->form->title,
                    "KATEGORIA_id_kategorii" => $this->form->category_id,
                    "tresc" => ($this->form->type === 'image') ? $image_url_to_save : $this->form->content,
                ];
                error_log("--- DEBUG: Dane do zapisu do DB: " . print_r($dataToSave, true) . " ---"); // DODAJ

                if ($this->form->id !== null && $this->form->id > 0) {
                    error_log("--- DEBUG: Wykonywanie UPDATE istniejącej notatki ID: " . $this->form->id . " ---"); // DODAJ
                    $dataToSave["data_modyfikacji"] = date("Y-m-d H:i:s");
                    App::getDB()->update("NOTATKA", $dataToSave, [
                        "ID_notatki" => $this->form->id,
                        "UŻYTKOWNIK_id_użytkownika" => $user_id
                    ]);
                    $affectedRows = App::getDB()->info()['row_count']; 
                    error_log("--- DEBUG: Notatka ID " . $this->form->id . " ZAKTUALIZOWANA. Zmienione wiersze: " . $affectedRows . " ---"); // DODAJ
                    App::getMessages()->addMessage(new Message("Notatka została zaktualizowana.", Message::INFO));
                } else {
                    error_log("--- DEBUG: Wykonywanie INSERT nowej notatki. ---"); // DODAJ
                    $dataToSave["data_utworzenia"] = date("Y-m-d H:i:s");
                    $dataToSave["UŻYTKOWNIK_id_użytkownika"] = $user_id;
                    App::getDB()->insert("NOTATKA", $dataToSave);
                    $newNoteId = App::getDB()->id(); // DODAJ
                    error_log("--- DEBUG: Nowa notatka DODANA. ID: " . $newNoteId . " ---"); // DODAJ
                    App::getMessages()->addMessage(new Message("Notatka została dodana.", Message::INFO));

                    // Obsługa list_items dla ListNoteForm (już masz ten blok, ale warto dodać logi w środku pętli)
                    if ($this->form->type === 'list' && isset($this->form->list_items) && is_array($this->form->list_items)) {
                        error_log("--- DEBUG: Zapisywanie elementów listy dla notatki ID: " . ($newNoteId ?? 'N/A') . " ---"); // DODAJ
                        foreach ($this->form->list_items as $item) {
                            if (!empty($item['tresc'])) {
                                App::getDB()->insert("ELEMENT_LISTY", [
                                    "tresc_elementu" => $item['tresc'],
                                    "zrobione" => ($item['zrobione'] ? 1 : 0),
                                    "NOTATKA_ID_notatki" => $newNoteId
                                ]);
                                error_log("--- DEBUG: Dodano element listy: " . $item['tresc'] . " ---"); // DODAJ
                            }
                        }
                    }
                }

                App::getRouter()->redirectTo('mainPage');
                exit();
            } catch (\PDOException $e) {
                App::getMessages()->addMessage(new Message("Błąd bazy danych podczas zapisywania notatki.", Message::ERROR));
                error_log("--- DEBUG: KRYTYCZNY BŁĄD PDOException podczas zapisu do DB: " . $e->getMessage() . " ---"); // DODAJ
                error_log("--- DEBUG: Ostatnie zapytanie Medoo: " . print_r(App::getDB()->log(), true) . " ---"); // DODAJ
                error_log("--- DEBUG: Błąd Medoo (szczegóły): " . App::getDB()->error()[2] . " ---"); // DODAJ

                if (App::getConf()->debug) {
                    App::getMessages()->addMessage(new Message($e->getMessage(), Message::ERROR));
                }
            }
        } else {
            error_log("--- DEBUG: Walidacja NIE powiodła się. Notatka NIE zapisana. ---"); // DODAJ
        }
        
        $this->loadCategories();
        $this->generateView();
    }

    public function action_noteDelete() {
        if ($this->validateDelete()) {
            try {
                $noteType = App::getDB()->get("NOTATKA", ["[><]KATEGORIA" => ["KATEGORIA_id_kategorii" => "ID_kategorii"]], ["NOTATKA.tresc", "KATEGORIA.typ_kategorii"], ["NOTATKA.ID_notatki" => $this->form->id]);

                if ($noteType && $noteType['typ_kategorii'] === 'image' && !empty($noteType['tresc'])) {
                    $imagePath = str_replace(App::getConf()->app_url . '/public/uploads/', App::getConf()->root_path . '/public/uploads/', $noteType['tresc']);
                    if (file_exists($imagePath) && is_file($imagePath)) {
                        unlink($imagePath); 
                        App::getMessages()->addMessage(new Message("Plik obrazu został również usunięty.", Message::INFO));
                    }
                }
                App::getDB()->delete("NOTATKA", ["ID_notatki" => $this->form->id]);
                App::getMessages()->addMessage(new Message("Notatka została usunięta.", Message::INFO));
            } catch (\PDOException $e) {
                App::getMessages()->addMessage(new Message("Błąd bazy danych podczas usuwania notatki.", Message::ERROR));
                if (App::getConf()->debug) {
                    App::getMessages()->addMessage(new Message($e->getMessage(), Message::ERROR));
                }
            }
        }
        App::getRouter()->redirectTo('mainPage');
        exit();
    }

    public function generateView() {
        App::getSmarty()->assign('page_title', 'Notatka');
        App::getSmarty()->assign('form', $this->form);
        App::getSmarty()->assign('msgs', App::getMessages()->getMessages());
        App::getSmarty()->assign('categories', $this->categories);

        $userLogin = SessionUtils::load('user_login', true);
        App::getSmarty()->assign('user_login', $userLogin ?? 'Gość');
        
        $template = 'TextNoteView.tpl'; 
        if (isset($this->form->type) && isset($this->note_types_map[$this->form->type]['view_template'])) {
            $template = $this->note_types_map[$this->form->type]['view_template'];
        }
        App::getSmarty()->display($template);
    }
}