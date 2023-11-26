<?php
require_once './app/models/pet.model.php';
require_once './app/models/owner.model.php';
require_once './app/views/pet.view.php';
require_once './app/controllers/auth.controller.php';
require_once './app/controllers/notification.controller.php';
class PetController
{
    private $petModel;
    private $ownerModel;
    private $view;

    private $auth;

    private $notification;

    public function __construct()
    {

        $this->petModel = new PetModel();
        $this->ownerModel = new OwnerModel();
        $this->view = new PetView();
        $this->auth = new AuthHelper();
        $this->notification = new NotificationController();
    }

    public function getAllPets()
    {
        $pets = $this->petModel->getPets();
        $owners = $this->ownerModel->getOwners();
        $this->view->showPets($pets, $owners);
        $this->notification->clean();
    }

    public function getPetById($idpet)
    {
        try {
            $pet = $this->petModel->getPetByID($idpet);
            if (empty($pet)) {
                $this->view->showError404();
                exit;
            }
            $idowner = $pet->ID_DUENIO;
            $owner = $this->ownerModel->getOwnerByID($idowner);
            $this->view->showSpecificPet($pet, $owner);
        } catch (\Throwable $th) {
            $this->view->showError500();
        }
    }


    public function getPetsByOwner($idOwner)
    {
        try {
            if (empty($idOwner)) {
                $this->view->showError404();
                exit;
            }
            $pets = $this->petModel->getPetsByOwner($idOwner);
            $owner = $this->ownerModel->getOwnerByID($idOwner);

            if (empty($pets) || empty($owner)) {
                $this->view->showError404();
                exit;
            }

            $this->view->showPetsByOwner($owner, $pets);
        } catch (\Throwable $th) {
            $this->view->showError500();
        }
    }

    //------ ABM PETS ------ //

    //funcion para mostrar la vista de creación de una mascota para un dueño
    public function showCreatePet()
    {
        $this->auth->verify();
        $owners = $this->ownerModel->getOwners();
        if (empty($owners)) {
            header("Location: " . BASE_URL . "list-pets");
            exit;
        } else {

            $this->view->showCreatePet($owners);
            $this->notification->clean();
            return;
        }
    }


    //funcion para crear una pet
    public function createPet()
    {
        try {
            $this->auth->verify();

            $name = $_POST['name'];
            $age = $_POST['age'];
            $weight = $_POST['weight'];
            $type = $_POST['type'];
            $idowner = $_POST['idowner'];

            if (empty($name) || empty($age) || empty($weight) || empty($type) || empty($idowner)) {
                $notification = $this->notification->setError("Debe completar todos los campos");
                $json = json_encode($notification);
                echo $json;
                // header("Location: " . BASE_URL . "add-pet");
                exit;
            }

            $owner = $this->ownerModel->getOwnerByID($idowner);
            if (empty($owner)) {
                $notification = $this->notification->setError("El dueño no existe");
                $json = json_encode($notification);
                echo $json;
                // header("Location: " . BASE_URL . "add-pet");
                exit;
            }

            if (!is_numeric($age) || !is_numeric($weight)) {
                $notification = $this->notification->setError("La edad y el peso deben ser números");
                $json = json_encode($notification);
                echo $json;
                // header("Location: " . BASE_URL . "add-pet");
                exit;
            }

            $idpet = $this->petModel->insertPet($name, $age, $weight, $type, $idowner);

            if (empty($idpet)) {
                $notification = $this->notification->setError("No se pudo crear la mascota");
                echo json_encode($notification);
                // header("Location: " . BASE_URL . "add-pet");
                exit;
            }

            $notification = $this->notification->setSuccess("Mascota creada con éxito");
            $notification['url'] = BASE_URL . 'list-pets';
            echo json_encode($notification);
            exit;
            // header("Location: " . BASE_URL . "list-pets");
        } catch (\Throwable $th) {
            $this->view->showError500();
        }
    }

    //funcion para mostrar la edición de una pet
    public function showEditPet($idpet)
    {
        try {
            $this->auth->verify();
            if (empty($idpet)) {
                $this->view->showError404();
                exit;
            }
            $pet = $this->petModel->getPetByID($idpet);
            if (empty($pet)) {
                $this->view->showError404();
                exit;
            }
            $owners = $this->ownerModel->getOwners();
            $this->view->showEditPet($pet, $owners);
        } catch (\Throwable $th) {
            //throw $th;
            $this->view->showError500();
        }
    }

    //funcion para editar una pet
    public function editPet($idpet)
    {
        try {
            $this->auth->verify();

            if (empty($idpet)) {
                $this->view->showError404();
                exit;
            }

            $name = $_POST['name'];
            $age = $_POST['age'];
            $weight = $_POST['weight'];
            $type = $_POST['type'];
            $idowner = $_POST['idowner'];

            if (empty($name) || empty($age) || empty($weight) || empty($type) || empty($idowner)) {
                $notification = $this->notification->setError("Debe completar todos los campos");
                $json = json_encode($notification);
                echo $json;
                // header("Location: " . BASE_URL . "add-pet");
                exit;
            }

            $owner = $this->ownerModel->getOwnerByID($idowner);
            if (empty($owner)) {
                $notification = $this->notification->setError("El dueño no existe");
                $json = json_encode($notification);
                echo $json;
                // header("Location: " . BASE_URL . "add-pet");
                exit;
            }

            if (!is_numeric($age) || !is_numeric($weight)) {
                $notification = $this->notification->setError("La edad y el peso deben ser números");
                $json = json_encode($notification);
                echo $json;
                // header("Location: " . BASE_URL . "add-pet");
                exit;
            }

            $this->petModel->editPet($idpet, $name, $age, $weight, $type, $idowner);
            $notification = $this->notification->setSuccess("Mascota editada con éxito");
            $notification['url'] = BASE_URL . 'list-pets';
            echo json_encode($notification);
        } catch (\Throwable $th) {
            //throw $th;
            $this->view->showError500();
        }
    }

    //funcion para eliminar una pet
    public function deletePet($idpet)
    {
        try {
            $this->auth->verify();
            if (empty($idpet)) {
                $this->view->showError404();
                exit;
            }

            $pet = $this->petModel->getPetByID($idpet);
            if (empty($pet)) {
                $this->view->showError404();
                exit;
            }

            $this->petModel->deletePet($idpet);
            $response = array("status" => 200, "msg" => "La mascota se eliminó correctamente.");
            echo json_encode($response);
            // $notification = $this->notification->setSuccess("Mascota eliminada con éxito");
            // echo json_encode($notification);
        } catch (\Throwable $th) {
            //throw $th;
            $this->view->showError500();
        }
    }
}
