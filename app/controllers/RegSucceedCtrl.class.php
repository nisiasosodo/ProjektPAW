<?php
namespace app\controllers;

use core\App;
use core\Message;

class RegSucceedCtrl {

    public function action_regSucceed() {
        $this->generateView();
    }

    public function generateView() {
        App::getSmarty()->display("RegSucceedView.tpl");
    }
}
