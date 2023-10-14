<?php
class Model {
    private $db;
    
    
    public function __construct()
    {
        require('config.php');
        $this->db = new PDO($db_dsn, $db_user, $db_pass);
    }


    function getOptions() {
        $query = $this->db->prepare('SELECT * FROM tareas');
        $query->execute();

        // $tasks es un arreglo de tareas
        $tasks = $query->fetchAll(PDO::FETCH_OBJ);

        return $tasks;
    }


    public function getPets(){
        $query = $this->db->prepare('SELECT * FROM `mascotas` WHERE 1');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getOwners(){
        $query = $this->db->prepare('SELECT * FROM `duenio` WHERE 1');
        $query-> execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getOwnerByID($id){
        $query = $this->db->prepare('SELECT * FROM `duenio` WHERE `ID` = ?');
        $query-> execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function getPetByID($id){
        $query = $this->db->prepare('SELECT * FROM `mascotas` WHERE `ID` = ?');
        $query-> execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function getAll(){
        $query = $this->db->prepare('SELECT * FROM `mascotas` WHERE 1');
        $query->execute();
        $pets = $query->fetchAll(PDO::FETCH_OBJ);
    
        $query2 = $this->db->prepare('SELECT * FROM `duenio` WHERE 1');
        $query2->execute();
        $owners = $query2->fetchAll(PDO::FETCH_OBJ);
    
        return ['mascotas' => $pets, 'duenio' => $owners];
    }
    
}