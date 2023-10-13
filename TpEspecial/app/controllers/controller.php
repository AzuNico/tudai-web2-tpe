<?php
require_once './app/models/model.php';
require_once './app/views/view.php';
class Controller {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new Model();
        $this->view = new View();
    }

    public function showOptions(){
        $options = 
        array( 'Listado de items',
                'Listado de categorias',
                'Listado de items por categoria',
            );
        $this->view->showOptions($options);
    }

    public function listItems() {
        $data = $this->model->getAll();
        $pets = $data['mascotas'];
        $owners = $data['duenio'];
    
        $this->view->showOwnersAndPets($pets, $owners);
    }
    
    

    
}
