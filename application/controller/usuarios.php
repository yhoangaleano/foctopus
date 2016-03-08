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
        $this->render("index");
    }

    public function login()
    {        
        if ($_POST != null) {

            $username = $_POST["txtUsername"];
            $password = $_POST["txtPassword"];
            
            $this->modelUser->__SET("username", $username);
            $this->modelUser->__SET("password", $password);

            $respuesta = $this->modelUser->getUsers();
            
            if ($respuesta) {
               $_SESSION["rol"] = $respuesta->rol;
               $_SESSION["id"] = $respuesta->id;

               if ($respuesta->rol == "administrador") {
                header("Location:/foctopus/administrador/index"); 
            }else{
                header("Location:/foctopus/cliente/index");
            }
        }else{
            header("Location:/foctopus/usuarios/index?error");
        }



    }else{
        echo "error";
    }

}

public function logout()
{
    session_destroy();
    session_unset();
    header("Location:/foctopus/usuarios/index");
}
}