<?php
require_once './app/controllers/controller.php';
require_once './app/controllers/auth.controller.php';
require_once './app/controllers/owner.controller.php';
require_once './app/controllers/pet.controller.php';

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

$action = 'home'; // accion por defecto
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}


$params = explode('/', $action);

switch ($params[0]) {
    case 'home':
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
    case 'list-owners':
        $controller = new OwnerController();
        $controller->getAllOwners();
        break;
    case 'list-pets':
        $controller = new PetController();
        $controller->getAllPets();
        break;
    case 'pets-by-owner':
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Verifica si se ha enviado el formulario
            $idowner = $_POST['idowner'];
            $currentUrl = $_SERVER['REQUEST_URI'];
            header("Location: " . $_SERVER['REQUEST_URI'] . "$idowner");
            exit;
        }
        else
            if ($params[1] != null) {
                $controller = new PetController();
                $controller->getPetsByOwner($params[1]);
            } else {
                echo 'Especifique la id del dueño';
            }
        break;
    case 'owner':
        if ($params[1] != null) {
            $controller = new OwnerController();
            $controller->getOwnerById($params[1]);
        } else {
            echo 'Especifique la id del dueño';
        }
        break;
    case 'pet':
        if ($params[1] != null) {
            $controller = new PetController();
            $controller->getPetById($params[1]);
        } else {
            echo 'Especifique la id de la mascota';
        }
        break;
    case 'add-pet':
        $controller = new PetController();
        $controller->showCreatePet();
        break;
    case 'create-pet':
        // echo "create-pet";
        $controller = new PetController();
        $controller->createPet();
        break;
    case 'pet-edit':
        if ($params[1] != null) {
            $controller = new PetController();
            $controller->showEditPet($params[1]);
        } else {
            echo 'Especifique la id de la mascota';
        }
        break;
    case 'update-pet':
        if ($params[1] != null) {
            $controller = new PetController();
            $controller->editPet($params[1]);
        } else {
            echo 'Especifique la id de la mascota';
        }
        break;
    case 'pet-delete':
        if ($params[1] != null) {
            $controller = new PetController();
            $controller->deletePet($params[1]);
        } else {
            echo 'Especifique la id de la mascota';
        }
        break;
    case 'add-owner':
        $controller = new OwnerController();
        $controller->showCreateOwner();
        break;
    case 'create-owner':
        $controller = new OwnerController();
        $controller->createOwner();
        break;
    case 'owner-edit':
        if ($params[1] != null) {
            $controller = new OwnerController();
            $controller->showEditOwner($params[1]);
        } else {
            echo 'Especifique la id del dueño';
        }
        break;
    case 'update-owner':
        if ($params[1] != null) {
            $controller = new OwnerController();
            $controller->editOwner($params[1]);
        } else {
            echo 'Especifique la id del dueño';
        }
        break;
    case 'owner-delete':
        if ($params[1] != null) {
            $controller = new OwnerController();
            $controller->deleteOwner($params[1]);
        } else {
            echo 'Especifique la id del dueño';
        }
        break;



    default:
        echo "404 Page Not Found";
        break;
}
