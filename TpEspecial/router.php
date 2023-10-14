<?php
require_once './app/controllers/controller.php';

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$action = 'options'; // accion por defecto
if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
}


// listar    ->         taskController->showTasks();
// agregar   ->         taskController->addTask();
// eliminar/:ID  ->     taskController->removeTask($id); 
// finalizar/:ID  ->    taskController->finishTask($id);
// about ->             aboutController->showAbout();
// login ->             authContoller->showLogin();
// logout ->            authContoller->logout();
// auth                 authContoller->auth(); // toma los datos del post y autentica al usuario


// parsea la accion para separar accion real de parametros
$params = explode('/', $action);

switch ($params[0]) {
    case 'options':
        $controller = new Controller();
        $controller->showOptions();
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
        /*
    case 'agregar':
        $controller = new TaskController();
        $controller->addTask();
        break;
    case 'eliminar':
        $controller = new TaskController();
        $controller->removeTask($params[1]);
        break;
    case 'finalizar':
        $controller = new TaskController();
        $controller->finishTask($params[1]);
        break;
    case 'about':
        $controller = new AboutController();
        $controller->showAbout();
        break;
    case 'login':
        $controller = new AuthController();
        $controller->showLogin(); 
        break;
    case 'auth':
        $controller = new AuthController();
        $controller->auth();
        break;
    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;*/
    default: 
        echo "404 Page Not Found";
        break;
}
