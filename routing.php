<?php

use core\App;
use core\Utils;

App::getRouter()->setDefaultRoute('login'); // <- lub 'hello'
App::getRouter()->setLoginRoute('login'); #action to forward if no permissions

Utils::addRoute('login', 'LoginCtrl');
Utils::addRoute('logout', 'LoginCtrl');
Utils::addRoute('register', 'RegisterCtrl');
Utils::addRoute('forgotPassword', 'ForgotPasswordCtrl');
Utils::addRoute('resetPassword', 'ForgotPasswordCtrl');
//Utils::addRoute('action_name', 'controller_class_name');

Utils::addRoute('hello', 'HelloCtrl');


Utils::addRoute('loginShow', 'LoginCtrl');
Utils::addRoute('registerShow', 'RegisterCtrl');
Utils::addRoute('regSucceed', 'RegSucceedCtrl');
