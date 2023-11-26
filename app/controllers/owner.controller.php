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

    private $notification;

    public function __construct()
    {
        $this->model = new OwnerModel();
        $this->view = new OwnerView();
        $this->auth = new AuthHelper();
        $this->petModel = new PetModel();
        $this->notification = new NotificationController();
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
        try {
            $this->auth->verify();
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];

            if (empty($name) || empty($email) || empty($phone)) {
                $notification = $this->notification->setError("No puede haber campos vacíos");
                $json = json_encode($notification);
                echo $json;
                // header("Location: " . BASE_URL . "add-pet");
                exit;
            }

            $this->model->insertOwner($name, $email, $phone);
            $notification = $this->notification->setSuccess("Dueño creado con éxito");
            $notification['url'] = BASE_URL . 'list-owners';
            echo json_encode($notification);
            
        } catch (\Throwable $th) {
            $this->view->showError500();
        }
    }

    //funcion para mostrar la edición de un owner
    public function showEditOwner($idowner)
    {
        try {
            $this->auth->verify();

            if (empty($idowner)) {
                $this->view->showError404();
                exit;
            }

            $owner = $this->model->getOwnerByID($idowner);

            if (empty($owner)) {
                $this->view->showError404();
                exit;
            }

            $this->view->showEditOwner($owner);
        } catch (\Throwable $th) {
            $this->view->showError500();
        }
    }

    //funcion para editar un owner
    public function editOwner($idowner)
    {
        try {
            $this->auth->verify();

            if (empty($idowner)) {
                $this->view->showError404();
                exit;
            }

            $owner = $this->model->getOwnerByID($idowner);

            if (empty($owner)) {
                $this->view->showError404();
                exit;
            }

            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];

            if (empty($name) || empty($email) || empty($phone)) {
                $notification = $this->notification->setError("No puede haber campos vacíos");
                $json = json_encode($notification);
                echo $json;
                // header("Location: " . BASE_URL . "add-pet");
                exit;
            }

            $this->model->editOwner($idowner, $name, $email, $phone);
            $notification = $this->notification->setSuccess("Dueño editado con éxito");
            $notification['url'] = BASE_URL . 'list-owners';
            echo json_encode($notification);
        } catch (\Throwable $th) {
            $this->view->showError500();
        }
    }

    //funcion para eliminar un owner
    public function deleteOwner($idowner)
    {
        try {
            $this->auth->verify();
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

            if (!empty($pets)) {
                $response = array("status" => 403, "msg" => "No se puede eliminar el dueño porque tiene mascotas asociadas.");
                echo json_encode($response);
                // $notification = $this->notification->setError("No se puede eliminar el dueño porque tiene mascotas asociadas.");
                // $json = json_encode($notification);
                // echo $json;
                exit;
            }

            $this->model->deleteOwner($idowner);
            $response = array("status" => 200, "msg" => "Dueño eliminado con éxito");
            echo json_encode($response);
            // $notification = $this->notification->setSuccess("Dueño eliminado con éxito");
            // echo json_encode($notification);

        } catch (\Throwable $th) {
            //throw $th;
            $this->view->showError500();
        }
    }
}
