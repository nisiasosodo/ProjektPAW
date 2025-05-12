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
			return false;
		}
			
		if (! App::getMessages()->isError ()) {

			if ($this->form->login == "") {
				App::getMessages()->addMessage(new Message("Nie podano loginu", Message::WARNING));
			}
			if ($this->form->pass == "") {
				App::getMessages()->addMessage(new Message("Nie podano hasła", Message::WARNING));
			}
		}

		if (!App::getMessages()->isError() ) {
		
                        $user = App::getDB()->get("użytkownik", "*", ["login" => $this->form->login]);
                        /*echo "Hasło wpisane: " . $this->form->pass . "<br>";
                        echo "Hash z bazy: " . $user["hasło"] . "<br>";
                        var_dump(password_verify($this->form->pass, $user["hasło"]));
                        exit;*/

                        if ($user && password_verify($this->form->pass, $user["hasło"])) {
                            $role = ($user["ROLA_ID_roli"] == 1) ? "admin" : "user";
                            $userObj = new User($user["login"], $role);
                            //$_SESSION["user"] = serialize($user);
                            SessionUtils::storeObject("user",$userObj);
                        } else {
                            App::getMessages()->addMessage(new Message("Niepoprawny login lub hasło", Message::ERROR));
                        }
		}
		
		return ! App::getMessages()->isError();
	}
	
	public function action_login(){

		$this->getParams();
		
		if ($this->validate()){
                    //testowo
			header("Location: " . App::getConf()->action_root. "regSucceed");
		} else {
			$this->generateView(); 
		}
		
	}
	
	public function action_logout(){
		session_destroy();
		App::getMessages()->addMessage(new Message("Poprawnie wylogowano z systemu", Message::INFO));

                header("Location: " . App::getConf()->action_root. "login");
	}
	
	public function generateView(){
		
		App::getSmarty()->assign('page_title','Strona logowania');
		App::getSmarty()->assign('form',$this->form);
                App::getSmarty()->assign('msgs',App::getMessages());

		App::getSmarty()->display('LoginView.tpl');		
	}
}