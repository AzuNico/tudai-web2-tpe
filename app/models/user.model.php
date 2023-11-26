<?php

class UsersModel
{
    private $db;

    function __construct()
    {
        require('config.php');
        $this->db = new PDO($db_dsn, $db_user, $db_pass);
    }

    public function getByUser($user)
    {
        $query = $this->db->prepare('SELECT * FROM usuarios WHERE USER = ?');
        $query->execute([$user]);

        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function registerUser($user, $password)
    {
        $query = $this->db->prepare('INSERT INTO usuarios (USER, PASSWORD) VALUES (?,?)');
        $query->execute([$user, password_hash($password, PASSWORD_BCRYPT)]);
        return $this->db->lastInsertId();
    }

    //Esta funcion elimina un usuario de la tabla usuarios
    public function deleteUser($id)
    {
        $query = $this->db->prepare('DELETE FROM usuarios WHERE ID=?');
        $query->execute([$id]);
    }

    //Esta funcion edita un usuario de la tabla usuarios
    public function editUser($id, $user, $password)
    {
        $query = $this->db->prepare('UPDATE usuarios SET USER=?, PASSWORD=? WHERE ID=?');
        $query->execute([$user, password_hash($password, PASSWORD_BCRYPT), $id]);
    }

    //Obtener usuario por id
    public function getUserById($id)
    {
        $query = $this->db->prepare('SELECT * FROM usuarios WHERE ID = ?');
        $query->execute([$id]);

        return $query->fetch(PDO::FETCH_OBJ);
    }

    //Obtener todos los usuarios
    public function getAllUsers()
    {
        $query = $this->db->prepare('SELECT * FROM usuarios');
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }
}
