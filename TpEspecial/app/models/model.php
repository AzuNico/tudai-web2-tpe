<?php
class Model {
    private $db;
    
    
    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=libretamascotas;charset=utf8', 'root', '');
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