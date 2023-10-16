<?php

class UserModel {
    private $db;

    function __construct() {
        require('config.php');
        $this->db = new PDO($db_dsn, $db_user, $db_pass);   
    }

    public function getByUser($user) {
        $query = $this->db->prepare('SELECT * FROM usuarios WHERE USER = ?');
        $query->execute([$user]);

        return $query->fetch(PDO::FETCH_OBJ);
    }

}
