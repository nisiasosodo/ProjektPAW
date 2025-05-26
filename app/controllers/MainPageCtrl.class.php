<?php
namespace app\controllers;

use core\App;
use core\Utils;
use core\ParamUtils;
use core\SessionUtils;
use core\Message;

class MainPageCtrl {

    private $notes; 

    public function __construct() {
        $this->notes = []; 
    }

    public function action_mainPage() {
        if (!SessionUtils::isLogged()) {
            App::getMessages()->addMessage(new Message("Musisz się zalogować, aby zobaczyć notatki.",Message::WARNING));
            App::getRouter()->redirectTo('loginShow');
            return;
        }

        $this->processNotesRetrieval();
        $this->generateView();
    }

    private function processNotesRetrieval() {
        $searchQuery = ParamUtils::getFromRequest('query', true, '');

        $user_id = SessionUtils::load('user_id', true);
        $where = ["NOTATKA.UŻYTKOWNIK_id_użytkownika" => $user_id]; 
        if (!empty($searchQuery)) {

            $where["OR"] = [ 
                "NOTATKA.nazwa[~]" => "%" . $searchQuery . "%",
                "NOTATKA.tresc[~]" => "%" . $searchQuery . "%",
                "KATEGORIA.nazwa[~]" => $searchQuery
            ];
            Utils::addInfoMessage("Wyświetlono notatki pasujące do frazy: '{$searchQuery}'");
        }

        try {

        $this->notes = App::getDB()->select("NOTATKA", ["[><]KATEGORIA" => ["KATEGORIA_id_kategorii" => "ID_kategorii"]], [
            "NOTATKA.ID_notatki",
            "NOTATKA.nazwa",
            "NOTATKA.tresc",
            "NOTATKA.data_utworzenia",
            "NOTATKA.data_modyfikacji",
            "KATEGORIA.nazwa",
            "KATEGORIA.typ_kategorii" 
        ], $where);

        }   catch (\PDOException $e) {
        App::getMessages()->addMessage(new Message("Błąd bazy danych podczas pobierania notatek.", Message::ERROR));
        if (App::getConf()->debug) {
            App::getMessages()->addMessage(new Message($e->getMessage(), Message::ERROR));
        }
        $this->notes = [];
      }
    }

    private function generateView() {
        
        App::getSmarty()->assign('page_title', 'Twoje Notatki');
        
        App::getSmarty()->assign('notes', $this->notes);
        
        $userLogin = SessionUtils::load('user_login', true);
        App::getSmarty()->assign('user_login', $userLogin ?? 'Gość');
        App::getSmarty()->assign('msgs', App::getMessages()->getMessages());

        
        App::getSmarty()->display('MainPageView.tpl'); 
    }
}