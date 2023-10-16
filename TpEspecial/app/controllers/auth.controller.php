<?php
require_once './app/models/user.model.php';
require_once './app/views/auth.view.php';
require_once './app/helpers/auth.helper.php';

class AuthController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new UserModel();
        $this->view = new AuthView();
    }

    public function showLogin() {
        $this->view->showLogin();
    }

    
    public function auth() {
        $user = $_POST['user'];
        $password = $_POST['password'];

        echo $user,$password;

        if (empty($user) || empty($password)) {
            $this->view->showLogin('Faltan completar datos');
            return;
        }

        $user = $this->model->getByUser($user);
        if ($user && password_verify($password, $user->PASSWORD)) {
            // ACA LO AUTENTIQUE
            
            AuthHelper::login($user);

            header('Location: ver');
            
        } else {
            $this->view->showLogin('Inicio de sesión incorrecto!');
        }
    }
/*
    public function logout() {
        AuthHelper::logout();
        header('Location: ' . BASE_URL);    
    }
*/
}