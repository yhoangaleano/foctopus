<?php

class mdlUsuario
{
    public $id;
    public $username;
    public $password;
    public $rol;


    public function __GET($key){
        return $this->$key;
    }

    public function __SET($key, $value){
        $this->$key = $value;
    }


    /**
     * @param object $db A PDO database connection
     */
    function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    public function getUsers()
    {
        $sql = "SELECT * FROM login WHERE username = :us AND password = :pass";
        $query = $this->db->prepare($sql);

        $query->bindValue(":us", $this->__GET("username"));
        $query->bindValue(":pass", $this->__GET("password"));

        $query->execute();
        return $query->fetch();
    }
}