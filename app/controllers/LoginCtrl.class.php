<?php

namespace app\controllers;

use app\transfer\User;
use app\forms\LoginForm; 
use core\ParamUtils;
use core\App;
use core\Utils;
use core\SessionUtils;
use core\Message;

class LoginCtrl{
    private $form;

    public function __construct(){
        $this->form = new LoginForm();
    }

    public function getParams(){
        $this->form->login = ParamUtils::getFromRequest('login');
        $this->form->pass = ParamUtils::getFromRequest('pass');
    }

    public function validate() {
        if (! (isset ( $this->form->login ) && isset ( $this->form->pass ))) {
            if (App::getRouter()->getAction() == 'login') {
                if (empty($this->form->login)) {
                    App::getMessages()->addMessage(new Message("Nie podano loginu", Message::WARNING));
                }
                if (empty($this->form->pass)) {
                    App::getMessages()->addMessage(new Message("Nie podano hasła", Message::WARNING));
                }
            }
            return false;
        }
            
        if (! App::getMessages()->isError ()) {
            try {
                $user = App::getDB()->get("użytkownik", [
                    "ID_użytkownika", 
                    "login",
                    "hasło",
                    "ROLA_ID_roli"
                ], ["login" => $this->form->login]);

                if (!$user || !password_verify($this->form->pass, $user["hasło"])) {
                    App::getMessages()->addMessage(new Message("Niepoprawny login lub hasło", Message::ERROR));
                    return false; // Walidacja nieudana
                }

                SessionUtils::store('user_id', $user['ID_użytkownika']);
                SessionUtils::store('user_login', $user['login']);
                SessionUtils::store('user_role', $user["ROLA_ID_roli"]);

            } catch (\PDOException $e) {
                App::getMessages()->addMessage(new Message("Błąd bazy danych podczas logowania.", Message::ERROR));
                if (App::getConf()->debug) {
                    App::getMessages()->addMessage(new Message($e->getMessage(), Message::ERROR));
                }
                return false; 
            }
        }
        
        return ! App::getMessages()->isError();
    }
    
    public function action_loginShow(){
        $this->generateView();
    }
        
    public function action_login(){
        $this->getParams(); 
        
        if ($this->validate()){ 
            App::getMessages()->addMessage(new Message("Zalogowano pomyślnie!", Message::INFO));
            App::getRouter()->redirectTo('mainPage');
            exit();
        } else {
            $this->generateView(); 
        }
    }
    
    public function action_logout(){
        session_destroy(); 
        App::getMessages()->addMessage(new Message("Poprawnie wylogowano z systemu", Message::INFO));
        App::getRouter()->redirectTo('loginShow'); 
    }
    
    public function generateView(){
        App::getSmarty()->assign('page_title','Strona logowania');
        App::getSmarty()->assign('form',$this->form);
        App::getSmarty()->assign('msgs', App::getMessages()->getMessages()); 
        App::getSmarty()->display('LoginView.tpl');        
    }
}