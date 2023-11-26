<?php
require_once './app/controllers/auth.controller.php';
require_once './app/controllers/owner.controller.php';
require_once './app/controllers/pet.controller.php';
require_once './app/models/owner.model.php';
require_once './app/models/pet.model.php';
require_once './app/views/owner.view.php';
require_once './app/views/pet.view.php';
require_once './app/views/view.php';

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

$action = 'list-pets'; // accion por defecto
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}


$params = explode('/', $action);

switch ($params[0]) {
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
        $controller = new PetController();
        $controller->getPetsByOwner($params[1]);
        break;
    case 'owner':
        $controller = new OwnerController();
        $controller->getOwnerById($params[1]);
        break;
    case 'pet':
        $controller = new PetController();
        $controller->getPetById($params[1]);
        break;
    case 'add-pet':
        $controller = new PetController();
        $controller->showCreatePet();
        break;
    case 'create-pet':
        $controller = new PetController();
        $controller->createPet();
        break;
    case 'pet-edit':
        $controller = new PetController();
        $controller->showEditPet($params[1]);
        break;
    case 'update-pet':
        $controller = new PetController();
        $controller->editPet($params[1]);
        break;
    case 'pet-delete':
        $controller = new PetController();
        $controller->deletePet($params[1]);
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
        $controller = new OwnerController();
        $controller->showEditOwner($params[1]);
        break;
    case 'update-owner':
        $controller = new OwnerController();
        $controller->editOwner($params[1]);
        break;
    case 'owner-delete':
        $controller = new OwnerController();
        $controller->deleteOwner($params[1]);
        break;
    default:
        $view = new View();
        $view->showError404();
        break;
}
