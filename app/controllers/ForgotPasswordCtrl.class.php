<?php
namespace app\controllers;

use core\App;
use core\Utils; 
use core\ParamUtils;
use app\forms\ForgotPasswordForm;   

class ForgotPasswordCtrl {

    private $form;

    public function __construct(){
        $this->form = new ForgotPasswordForm();
    }
    public function getParams(){
	$this->form->new_pass = ParamUtils::getFromRequest('new_pass');
        $this->form->confirm_pass = ParamUtils::getFromRequest('confirm_pass');
	}
        
    public function action_forgotPasswordShow() {
        App::getSmarty()->assign('form', $this->form); 
        App::getSmarty()->assign('page_title', 'Reset hasła');
        App::getSmarty()->display('ForgotPasswordView.tpl');
    }

    public function action_forgotPassword() {
        $this->form->login_or_email = trim(ParamUtils::getFromRequest('login_or_email'));

        if (empty($this->form->login_or_email)) {
            Utils::addErrorMessage("Wprowadź login lub email.");
        } 
        
        if (App::getMessages()->isError()) {
            $this->action_forgotPasswordShow();
            return;
        }

        try {
            $user = App::getDB()->get("użytkownik", "*", [
                "OR" => [
                    "login" => $this->form->login_or_email,
                    "email" => $this->form->login_or_email
                ]
            ]);

            if ($user) {
                App::getSmarty()->assign('user_found', true);
                App::getSmarty()->assign('user_id', $user['ID_użytkownika']);
                App::getSmarty()->assign('page_title', 'Nowe Hasło');
                App::getSmarty()->assign('form', $this->form); 
                App::getSmarty()->display('ResetPasswordView.tpl'); 
            } else {
                Utils::addErrorMessage("Nie znaleziono użytkownika o podanym loginie lub adresie e-mail.");
                $this->action_forgotPasswordShow(); 
            }
        } catch (\PDOException $e) {
            Utils::addErrorMessage("Wystąpił błąd podczas wyszukiwania użytkownika.");
            if (App::getConf()->debug) { 
                Utils::addErrorMessage($e->getMessage());
            }
            $this->action_forgotPasswordShow(); 
        }
    }

    public function action_resetPasswordShow() {
        $userId = ParamUtils::getFromGet('user_id', true, 'Brak ID użytkownika.'); 


        App::getSmarty()->assign('user_found', true);
        App::getSmarty()->assign('user_id', $userId);
        App::getSmarty()->assign('form', $this->form);
        App::getSmarty()->assign('page_title', 'Ustaw nowe hasło');
        App::getSmarty()->assign('msgs', App::getMessages()->getMessages());
        App::getSmarty()->display('ForgotPasswordView.tpl');
    }



    public function action_resetPassword() {
        $userId = ParamUtils::getFromRequest('user_id'); 
        $this->form->new_pass = ParamUtils::getFromRequest('new_pass');
        $this->form->confirm_pass = ParamUtils::getFromRequest('confirm_pass');

        if (empty($this->form->new_pass) || empty($this->form->confirm_pass)) {
            Utils::addErrorMessage("Uzupełnij wszystkie pola hasła.");
        } elseif ($this->form->new_pass !== $this->form->confirm_pass) {
            Utils::addErrorMessage("Hasła powinny być takie same.");
        } elseif (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,30}$/', $this->form->new_pass)) {
            Utils::addErrorMessage("Hasło musi mieć 8-30 znaków, zawierać cyfrę oraz małą i wielką literę.");
        }

        if (!App::getMessages()->isError()) {
            try {
                App::getDB()->update("użytkownik", [
                    "hasło" => password_hash($this->form->new_pass, PASSWORD_DEFAULT)
                ], [
                    "ID_użytkownika" => $userId
                ]);
                Utils::addInfoMessage("Hasło zostało zmienione. Możesz się zalogować.");
                App::getRouter()->redirectTo('loginShow');
            } catch (\PDOException $e) {
                Utils::addErrorMessage("Błąd bazy danych podczas zmiany hasła.");
                if (App::getConf()->debug) {
                    Utils::addErrorMessage($e->getMessage());
                }
                App::getRouter()->redirectTo('loginShow');
                exit();
            }
        } else {

            App::getSmarty()->assign('user_found', true); 
            App::getSmarty()->assign('user_id', $userId);
            App::getSmarty()->assign('form', $this->form); 
            App::getSmarty()->assign('page_title', 'Reset hasła');
            App::getSmarty()->assign('msgs', App::getMessages()->getMessages());
            App::getSmarty()->display('ForgotPasswordView.tpl');
        }
    }
}