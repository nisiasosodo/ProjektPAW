<?php

namespace app\controllers;

use app\forms\RegisterForm;
use app\transfer\User;
use core\ParamUtils;
use core\App;
use core\Utils;
use core\Message;

class RegisterCtrl {
    private $form;

    public function __construct() {
        $this->form = new RegisterForm();
    }

    public function getParams() {
        $this->form->login = ParamUtils::getFromRequest('login');
        $this->form->pass = ParamUtils::getFromRequest('pass');
        $this->form->email = ParamUtils::getFromRequest('email');
    }

    public function validate() {
        if (!isset($this->form->login) || !isset($this->form->pass) || !isset($this->form->email)) {
            return false;
        }
  
        if (strlen($this->form->login) > 20) {
            App::getMessages()->addMessage(new Message("Login nie może przekraczać 20 znaków",Message::WARNING));
        return false;}
        
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $this->form->login)) {
            App::getMessages()->addMessage(new Message("Login może zawierać tylko litery, cyfry i podkreślenia",Message::WARNING));
        return false;}
        
   
        if (strlen($this->form->pass) > 30) {
            App::getMessages()->addMessage(new Message("Hasło nie może przekraczać 30 znaków",Message::WARNING));
        return false;}

        if (strlen($this->form->pass) < 8) {
            App::getMessages()->addMessage(new Message("Hasło musi mieć co najmniej 8 znaków",Message::WARNING));
        return false;}

        if (!preg_match('/[a-z]/', $this->form->pass)) {
            App::getMessages()->addMessage(new Message("Hasło musi zawierać małą literę",Message::WARNING));
        return false;}

        if (!preg_match('/[A-Z]/', $this->form->pass)) {
            App::getMessages()->addMessage(new Message("Hasło musi zawierać wielką literę",Message::WARNING));
        return false;}

        if (!preg_match('/[0-9]/', $this->form->pass)) {
            App::getMessages()->addMessage(new Message("Hasło musi zawierać cyfrę",Message::WARNING));
        return false;}

        if (!filter_var($this->form->email, FILTER_VALIDATE_EMAIL)) {
            App::getMessages()->addMessage(new Message("Nieprawidłowy email",Message::WARNING));
        return false;}
        

        if (App::getMessages()->isError()) return false;

        
        try {
            $countLogin = App::getDB()->count("użytkownik", [
                "login" => $this->form->login,
            ]);
            $countEmail = App::getDB()->count("użytkownik", [
                "email" => $this->form->email,
            ]);

            if ($countLogin > 0) {
                App::getMessages()->addMessage(new Message("Istnieje użytkownik o takim loginie",Message::WARNING));
                return false;
            }
            if ($countEmail > 0) {
                App::getMessages()->addMessage(new Message("Istnieje konto o tym adresie e-mail.",Message::WARNING));
                return false;
            }
            

        } catch (\PDOException $e) {
            App::getMessages()->addMessage(new Message("Błąd bazy danych: " . $e->getMessage(),Message::ERROR));
            return false;
        }

        return true;
    }
    public function action_registerShow(){
    $this->generateView();
    }

    public function action_register() {
        $this->getParams();

        if ($this->validate()) {
            try {
                App::getDB()->insert("użytkownik", [
                    "login" => $this->form->login,
                    "hasło" => password_hash($this->form->pass, PASSWORD_DEFAULT),
                    "email" => $this->form->email,
                    "data_utworzenia_konta" => date("Y-m-d"),
                    "ROLA_ID_roli" => 2  
                ]);
                
                header("Location: " . App::getConf()->action_root. "regSucceed");
                exit();

            } catch (\PDOException $e) {
                App::getMessages()->addMessage(new Message("Błąd zapisu do bazy danych: " . $e->getMessage(),Message::ERROR));
            }
        }

        $this->generateView();
    }

    public function generateView() {
        App::getSmarty()->assign('page_title', 'Rejestracja');
        App::getSmarty()->assign('form', $this->form);
        App::getSmarty()->assign('msgs', App::getMessages()->getMessages());    

        App::getSmarty()->display('RegisterView.tpl');
    }

}
