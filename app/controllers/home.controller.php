<?php
require_once './app/models/model.php';
require_once './app/views/view.php';
class HomeController {
    private $model;
    private $ownerModel;
    private $view;

    public function __construct() {

        $this->checkLoggedIn();

        $this->model = new Model();
        $this->ownerModel = new OwnerModel();
        $this->view = new View();
    }

    private function checkLoggedIn() {
        session_start();
        if (!isset($_SESSION['ID_USER'])) {
            //header('Location: ' . LOGIN);
            //die();
        }
            
    }

    public function showOptions(){
        $options = 
        array(
                'Listado de Mascotas',
                'Listado de Dueños',
                'Listado de Mascotas por Dueño',
            );
        $owners = $this->ownerModel->getOwners();
        $this->view->showOptions($options,$owners);
    }


}