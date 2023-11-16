<?php
require_once './app/models/pet.model.php';
require_once './app/models/owner.model.php';
require_once './app/views/pet.view.php';
class PetController {
    private $petModel;
    private $ownerModel;
    private $view;

    private $auth;

    public function __construct() {

        $this->petModel = new PetModel();
        $this->ownerModel = new OwnerModel();
        $this->view = new PetView();
        $this->auth = new AuthHelper();
    }

    public function getAllPets(){
        $pets =$this->petModel->getPets();
        $owners = $this->ownerModel->getOwners();
        $this->view->showPets($pets,$owners);
    }

    public function getPetById($idpet){
        $pet = $this->petModel->getPetByID($idpet);
        $idowner = $pet->ID_DUENIO;
        $owner = $this->ownerModel->getOwnerByID($idowner);
        $this->view->showSpecificPet($pet,$owner);
    }
    
    
    public function getPetsByOwner($idOwner){
        $pets = $this->petModel->getPetsByOwner($idOwner);
        $owner = $this->ownerModel->getOwnerByID($idOwner);

        $this->view->showPetsByOwner($owner,$pets);
    }

    //------ ABM PETS ------ //

    //funcion para mostrar la vista de creación de una mascota para un dueño
    public function showCreatePet(){
        $this->auth->verify();
        $owners = $this->ownerModel->getOwners();
        $this->view->showCreatePet($owners);        
    }
    

    //funcion para crear una pet
    public function createPet(){
        $this->auth->verify();
        $name = $_POST['name'];
        $age = $_POST['age'];
        $weight = $_POST['weight'];
        $type = $_POST['type'];
        $idowner = $_POST['idowner'];
        $this->petModel->insertPet($name, $age, $weight, $type, $idowner);
        header("Location: ".BASE_URL."/list-pets");
    }

    //funcion para mostrar la edición de una pet
    public function showEditPet($idpet){
        $this->auth->verify();
        $owners = $this->ownerModel->getOwners();
        $pet = $this->petModel->getPetByID($idpet);
        $this->view->showEditPet($pet,$owners);
    }

    //funcion para editar una pet
    public function editPet($idpet){
        $this->auth->verify();
        $name = $_POST['name'];
        $age = $_POST['age'];
        $weight = $_POST['weight'];
        $type = $_POST['type'];
        $idowner = $_POST['idowner'];
        $this->petModel->editPet($idpet,$name, $age, $weight, $type, $idowner);
        header("Location: ".BASE_URL."/list-pets");
    }

    //funcion para eliminar una pet
    public function deletePet($idpet){
        $this->auth->verify();
        $this->petModel->deletePet($idpet);
        header("Location: ".BASE_URL."/list-pets");
    }
      
}
