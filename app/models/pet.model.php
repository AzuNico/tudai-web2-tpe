<?php
class PetModel {
    private $db;
    
    
    public function __construct()
    {
        require('config.php');
        $this->db = new PDO($db_dsn, $db_user, $db_pass);   
    }


    public function getPets(){
        $query = $this->db->prepare('SELECT * FROM `mascotas`');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getPetByID($id){
        $query = $this->db->prepare('SELECT * FROM `mascotas` WHERE `ID` = ?');
        $query-> execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    //Esta funcion hace un alta de una mascota la tabla mascotas tiene columnas ID, NOMBRE, EDAD ,PESO ,TIPO,ID_DUENIO
    public function insertPet($name, $age, $weight, $type, $idowner){
        $query = $this->db->prepare('INSERT INTO `mascotas`(`NOMBRE`, `EDAD`, `PESO`, `TIPO`, `ID_DUENIO`) VALUES (?,?,?,?,?)');
        $query->execute([$name, $age, $weight, $type, $idowner]);
        return $this->db->lastInsertId();
    }

    //Esta funcion edita una mascota
    public function editPet($id, $name, $age, $weight, $type, $idowner){
        $query = $this->db->prepare('UPDATE `mascotas` SET `NOMBRE`=?,`EDAD`=?,`PESO`=?,`TIPO`=?,`ID_DUENIO`=? WHERE `ID`=?');
        $query->execute([$name, $age, $weight, $type, $idowner, $id]);
    }
    
    //Esta funcion elimina una mascota
    public function deletePet($id){
        $query = $this->db->prepare('DELETE FROM `mascotas` WHERE `ID`=?');
        $query->execute([$id]);
    }


}