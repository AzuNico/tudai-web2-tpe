<?php
class Model {
    private $db;
    
    
    public function __construct()
    {
        require('config.php');
        $this->db = new PDO($db_dsn, $db_user, $db_pass);   
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