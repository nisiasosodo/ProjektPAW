<?php

use core\App;
use core\Utils;

App::getRouter()->setDefaultRoute('login'); 
App::getRouter()->setLoginRoute('login'); 

Utils::addRoute('login', 'LoginCtrl');
Utils::addRoute('logout', 'LoginCtrl');
Utils::addRoute('register', 'RegisterCtrl');
Utils::addRoute('forgotPassword', 'ForgotPasswordCtrl');
Utils::addRoute('resetPassword', 'ForgotPasswordCtrl');



Utils::addRoute('loginShow', 'LoginCtrl');
Utils::addRoute('registerShow', 'RegisterCtrl');
Utils::addRoute('regSucceed', 'RegSucceedCtrl');



Utils::addRoute('mainPage', 'MainPageCtrl'); 
Utils::addRoute('noteNew', 'NotesCtrl'); 
Utils::addRoute('noteSave', 'NotesCtrl');
Utils::addRoute('noteEdit', 'NotesCtrl'); 
Utils::addRoute('noteDelete', 'NotesCtrl'); 
Utils::addRoute('searchNotes', 'NoteSearchCtrl'); 

