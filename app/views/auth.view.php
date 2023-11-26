<?php
require_once 'app/views/view.php';
class AuthView extends View{
    public function showLogin($alert = null) {
        require './templates/login.phtml';
    }

    public function showLoginError($alert = null) {
        require './templates/login.phtml';
    }
}
