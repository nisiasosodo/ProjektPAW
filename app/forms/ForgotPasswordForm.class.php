<?php
namespace app\forms;

class ForgotPasswordForm {
    public $user_id;
    public $login_or_email;
    public $new_pass;
    public $confirm_pass;
}