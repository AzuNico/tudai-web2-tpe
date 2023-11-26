<?php
class OwnerModel
{
    private $db;


    public function __construct()
    {
        require('config.php');
        $this->db = new PDO($db_dsn, $db_user, $db_pass);
    }

    public function getOwners()
    {
        $query = $this->db->prepare('SELECT * FROM `duenio` WHERE 1');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getOwnerByID($id)
    {
        $query = $this->db->prepare('SELECT * FROM `duenio` WHERE `ID` = ?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    // Obtener owner por mail
    public function getOwnerByEmail($email)
    {
        $query = $this->db->prepare('SELECT * FROM `duenio` WHERE `MAIL` = ?');
        $query->execute([$email]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    //Esta funcion hace un alta de un dueño
    public function insertOwner($name, $email, $tel)
    {
        $query = $this->db->prepare('INSERT INTO `duenio`(`NOMBRE`, `MAIL`,`TELEFONO` ) VALUES (?,?,?)');
        $query->execute([$name, $email, $tel]);
        return $this->db->lastInsertId();
    }

    //Esta funcion edita un dueño
    public function editOwner($id, $name, $email, $tel)
    {
        $query = $this->db->prepare('UPDATE `duenio` SET `NOMBRE`=?,`MAIL`=?,`TELEFONO`=? WHERE `ID`=?');
        $query->execute([$name, $email, $tel, $id]);
    }

    //Esta funcion elimina un dueño
    public function deleteOwner($id)
    {
        $query = $this->db->prepare('DELETE FROM `duenio` WHERE `ID`=?');
        $query->execute([$id]);
    }

}
