<?php
require_once './app/models/model.php';
require_once './app/views/view.php';
class Controller {
    private $model;
    private $view;

    public function __construct() {

        $this->checkLoggedIn();

        $this->model = new Model();
        $this->view = new View();
    }

    private function checkLoggedIn() {
        session_start();
        if (!isset($_SESSION['ID_USER'])) {
            //header('Location: ' . LOGIN);
            die();
        }
            
    }

    public function showOptions(){
        $options = 
        array( 'Listado de Items',
                'Listado de Mascotas',
                'Listado de Dueños',
                'Listado de Categorias',
            );
        $this->view->showOptions($options);
    }

    public function listItems() {
        $data = $this->model->getAll();
        $pets = $data['mascotas'];
        $owners = $data['duenio'];
    
        $this->view->showOwnersAndPets($pets, $owners);
    }


    public function listCategories() {
        $data = $this->model->getAll(); // MODIFICAR
        $pets = $data['mascotas'];
        $owners = $data['duenio'];
    
        $this->view->showOwnersAndPets($pets, $owners);
    }

    public function listOwners(){
        $owners = $this->model->getOwners();
        $this->view->showOwners($owners);
    }
    public function listPets(){
        $data = $this->model->getAll();
        $pets = $data['mascotas'];
        $owners = $data['duenio'];
        $this->view->showPets($pets,$owners);
    }
    
    public function specificOwner($idowner){
        $owner = $this->model->getOwnerByID($idowner);
        $this->view->showSpecificOwner($owner);
    }

    public function specificPet($idpet){
        $pet = $this->model->getPetByID($idpet);
        $idowner = $pet->ID_DUENIO;
        $owner = $this->model->getOwnerByID($idowner);
        $this->view->showSpecificPet($pet,$owner);
    }
      
}
