<?php
require './app/models/owner.model.php';
require_once './app/views/owner.view.php';
class OwnerController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new OwnerModel();
        $this->view = new OwnerView();
    }

    public function getAllOwners(){
        $owners = $this->model->getOwners();
        $this->view->showOwners($owners);
    }

    public function getOwnerById($idowner){
        $owner = $this->model->getOwnerByID($idowner);
        $this->view->showSpecificOwner($owner);
    }
   

    //------ ABM OWNERS ------ //

    //funcion para mostrar la vista de creación de owner
    public function showCreateOwner(){
        // $this->view->showCreateOwner();
    }

      
}
