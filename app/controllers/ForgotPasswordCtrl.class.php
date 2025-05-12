<?php
namespace app\controllers;
use core\App;
use core\Message;
use core\ParamUtils;

class ForgotPasswordCtrl {
    public function action_forgotPassword() {
        $identifier = trim(ParamUtils::getFromRequest('identifier'));

        if (empty($identifier)) {
            App::getMessages()->addMessage(new Message("Wprowadź login lub email",Message::WARNING));
        } else {
            $db = App::getDB();
            $user = $db->get("użytkownik", "*", [
                "OR" => [
                    "login" => $identifier,
                    "email" => $identifier
                ]
            ]);

            if ($user) {
                App::getSmarty()->assign('user_found', true);
                App::getSmarty()->assign('user_id', $user['ID_użytkownika']);
            } else {
                App::getMessages()->addMessage(new Message("Nie znaleziono użytkownika",Message::ERROR));
            }
        }

        App::getSmarty()->assign('identifier', $identifier);
        App::getSmarty()->assign('page_title', 'Reset hasła');
        App::getSmarty()->display('ForgotPasswordView.tpl');
    }

    public function action_resetPassword() {
        $userId = ParamUtils::getFromRequest('user_id');
        $newPass = ParamUtils::getFromRequest('new_pass');
        $confirmPass = ParamUtils::getFromRequest('confirm_pass');

        if (empty($newPass) || empty($confirmPass)) {
            App::getMessages()->addMessage(new Message("Uzupełnij wszystkie pola",Message::WARNING));
        } elseif ($newPass !== $confirmPass) {
            App::getMessages()->addMessage(new Message("Hasła powinny być takie same",Message::WARNING));
        } elseif (!preg_match('/^(?=.*[A-Za-z])(?=.*\d).{8,30}$/', $newPass)) {
            App::getMessages()->addMessage(new Message("Hasło musi mieć 8-30 znaków, zawierać cyfrę, małą i wielką literę oraz znak specjalny",Message::WARNING));
        }

        if (!App::getMessages()->isError()) {
            App::getDB()->update("użytkownik", [
                "hasło" => password_hash($newPass, PASSWORD_DEFAULT)
            ], [
                "ID_użytkownika" => $userId
            ]);

            App::getMessages()->addMessage(new Message("Hasło zostało zmienione. Możesz się zalogować.",Message::INFO));
            header("Location: " . App::getConf()->action_root . "login");
            exit();
        }

        // W razie błędu – pokaż ponownie formularz
        App::getSmarty()->assign('user_found', true);
        App::getSmarty()->assign('user_id', $userId);
        App::getSmarty()->assign('page_title', 'Reset hasła');
        App::getSmarty()->display('ForgotPasswordView.tpl');
    }
}
