<?php
require_once './app/models/owner.model.php';
require_once './app/views/owner.view.php';
class OwnerController
{
    private $model;
    private $view;

    public function __construct()
    {
        $this->model = new OwnerModel();
        $this->view = new OwnerView();
    }

    public function getAllOwners()
    {
        $owners = $this->model->getOwners();
        $this->view->showOwners($owners);
    }

    public function getOwnerById($idowner)
    {
        $owner = $this->model->getOwnerByID($idowner);
        $this->view->showSpecificOwner($owner);
    }
    

    //------ ABM OWNERS ------ //

    //funcion para mostrar la vista de creación de owner
    public function showCreateOwner()
    {
        $this->view->showCreateOwner();
    }

    //funcion para crear un owner
    public function createOwner()
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $this->model->insertOwner($name, $email, $phone);
        header("Location: " . BASE_URL . "/list-owners");
    }

    //funcion para mostrar la edición de un owner
    public function showEditOwner($idowner)
    {
        $owner = $this->model->getOwnerByID($idowner);
        $this->view->showEditOwner($owner);
    }
    
    //funcion para editar un owner
    public function editOwner($idowner)
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $this->model->editOwner($idowner, $name, $email, $phone);
        header("Location: " . BASE_URL . "/list-owners");
    }

    //funcion para eliminar un owner
    public function deleteOwner($idowner)
    {
        $this->model->deleteOwner($idowner);
        header("Location: " . BASE_URL . "/list-owners");
    }
}
