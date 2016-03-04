<?php

/**
 * Class Songs
 * This is a demo class.
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class usuarios extends Controller
{

    public $modelUser = null;

    function __construct(){
        $this->modelUser = $this->loadModel("mdlUsuario");
    }   

    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/songs/index
     */
    public function index()
    {
        $this->layout = "tmpLogin";
        $this->render("login");
    }

    public function login($username, $password)
    {
        if ($_POST != null) {
            echo json_encode(["usuario" => $username, "password"=>$password]);
        }else{
            echo "error";
        }
        
    }
}