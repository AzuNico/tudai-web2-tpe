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

    public function showRegister()
    {
        $this->view->showRegister();
    }

    public function register()
    {
        try {
            $user = $_POST['user'];
            $password = $_POST['password'];
            $password2 = $_POST['password2'];
            

            if (empty($user) || empty($password) || empty($password2)) {
                $alert = $this->notification->setError('Faltan completar datos');
                $this->view->showRegister($alert);
                exit;
            }

            if (!filter_var($user, FILTER_VALIDATE_EMAIL)) {
                $alert = $this->notification->setError('El usuario debe ser un email válido');
                $this->view->showRegister($alert);
                exit;
            }

            if (strlen($password) < 4) {
                $alert = $this->notification->setError('La contraseña debe tener al menos 4 caracteres');
                $this->view->showRegister($alert);
                exit;
            }

            if ($password != $password2) {
                $alert = $this->notification->setError('Las contraseñas no coinciden');
                $this->view->showRegister($alert);
                exit;
            }

            $validateUser = $this->model->getByUser($user);
            if ($validateUser) {
                $alert = $this->notification->setError('El usuario ya se encuentra registrado');
                $this->view->showRegister($alert);
                exit;
            }

            $userCreated = $this->model->registerUser($user, $password);

            if (!$userCreated) {
                $alert = $this->notification->setError('Error al crear el usuario');
                $this->view->showRegister($alert);
                exit;
            }

            $alert = $this->notification->setSuccess('Usuario creado con éxito');
            $this->view->showLogin($alert);
        } catch (\Throwable $th) {
            //throw $th;
            $alert = $this->notification->setError('Error inesperado');
            $this->view->showRegister($alert);
        }
    }
}
