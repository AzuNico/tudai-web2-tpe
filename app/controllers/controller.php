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
        $this->view->showOptions($options);
    }

    public function listOwnersAndPets() {
        $data = $this->model->getAll();
        $pets = $data['mascotas'];
        $owners = $data['duenio'];
    
        $this->view->showOwnersAndPets($pets, $owners);
    }

}