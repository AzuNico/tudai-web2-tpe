<?php
require_once './app/models/user.model.php';
require_once './app/views/auth.view.php';
require_once './app/helpers/auth.helper.php';

class AuthController
{
    private $model;
    private $view;

    private $notification;

    public function __construct()
    {
        $this->model = new UsersModel();
        $this->view = new AuthView();
        $this->notification = new NotificationController();
    }

    public function showLogin()
    {
        $this->view->showLogin();
    }


    public function auth()
    {
        $user = $_POST['user'];
        $password = $_POST['password'];


        if (empty($user) || empty($password)) {
            $alert = $this->notification->setError('Faltan completar datos');
            $this->view->showLogin($alert);
            return;
        }

        $user = $this->model->getByUser($user);
        if ($user && password_verify($password, $user->PASSWORD)) {
            // ACA LO AUTENTIQUE

            AuthHelper::login($user);

            header('Location:' . BASE_URL);
        } else {
            $alert = $this->notification->setError('Usuario o contraseña incorrectos');
            $this->view->showLogin($alert);
        }
    }


    public function logout()
    {
        AuthHelper::logout();
        header('Location: ' . BASE_URL . 'login');
    }
}
