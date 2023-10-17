<?php
require_once './app/controllers/controller.php';
require_once './app/controllers/auth.controller.php';
// require_once './app/controllers/owner.controller.php';
// require_once './app/controllers/pet.controller.php';

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$action = 'options'; // accion por defecto
if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
}


// listar    ->         taskController->showOptions();
// agregar   ->         taskController->addTask();
// eliminar/:ID  ->     taskController->removeTask($id); 
// finalizar/:ID  ->    taskController->finishTask($id);
// login ->             authController->showLogin();
// logout ->            authController->logout();
// auth                 authController->auth(); // toma los datos del post y autentica al usuario


// parsea la accion para separar accion real de parametros
$params = explode('/', $action);

switch ($params[0]) {
    case 'options':
        $controller = new Controller();
        $controller->showOptions();
        break;
    case 'login':
        $controller = new AuthController();
        $controller->showLogin();
        break;
    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;
    case 'auth':
        $controller = new AuthController();
        $controller->auth();
        break;
    case 'list-items':
        $controller = new Controller();
        $controller->listItems();
        break;
    case 'list-categories':
        $controller = new Controller();
        $controller->listCategories();
        break;
    case 'list-owners':
        $controller = new Controller();
        $controller->listOwners();
        break;
    case 'list-pets':
        $controller = new Controller();
        $controller->listPets();
        break;
    case 'owner':
        if ($params[1] != null) {
            $controller = new Controller();
            $controller->specificOwner($params[1]);
        }
        else{
            echo 'Especifique la id del dueño';
        }
        break;
    case 'pet':
        if ($params[1] != null) {
            $controller = new Controller();
            $controller->specificPet($params[1]);
        }
        else{
            echo 'Especifique la id de la mascota';
        }
        break;
    default: 
        echo "404 Page Not Found";
        break;
}