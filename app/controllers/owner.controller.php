<?php
require_once './app/models/owner.model.php';
require_once './app/views/owner.view.php';
require_once './app/helpers/auth.helper.php';
require_once './app/models/pet.model.php';
class OwnerController
{
    private $model;
    private $view;

    private $auth;

    private $petModel;

    public function __construct()
    {
        $this->model = new OwnerModel();
        $this->view = new OwnerView();
        $this->auth = new AuthHelper();
        $this->petModel = new PetModel();
    }

    public function getAllOwners()
    {
        $owners = $this->model->getOwners();
        $this->view->showOwners($owners);
    }

    public function getOwnerById($idowner)
    {
        try {
            if (empty($idowner)) {
                $this->view->showError404();
                exit;
            }
            $owner = $this->model->getOwnerByID($idowner);

            if (empty($owner)) {
                $this->view->showError404();
                exit;
            }

            $pets = $this->petModel->getPetsByOwner($idowner);
            $this->view->showSpecificOwner($owner, $pets);
        } catch (\Throwable $th) {
            $this->view->showError500();
        }
    }


    //------ ABM OWNERS ------ //

    //funcion para mostrar la vista de creación de owner
    public function showCreateOwner()
    {
        $this->auth->verify();
        $this->view->showCreateOwner();
    }

    //funcion para crear un owner
    public function createOwner()
    {
        $this->auth->verify();
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $this->model->insertOwner($name, $email, $phone);
        header("Location: " . BASE_URL . "list-owners");
    }

    //funcion para mostrar la edición de un owner
    public function showEditOwner($idowner)
    {
        $this->auth->verify();
        $owner = $this->model->getOwnerByID($idowner);
        $this->view->showEditOwner($owner);
    }

    //funcion para editar un owner
    public function editOwner($idowner)
    {
        $this->auth->verify();
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $this->model->editOwner($idowner, $name, $email, $phone);
        header("Location: " . BASE_URL . "list-owners");
    }

    //funcion para eliminar un owner
    public function deleteOwner($idowner)
    {
        $this->auth->verify();
        $this->model->deleteOwner($idowner);
        // header("Location: " . BASE_URL . "list-owners");
    }
}
