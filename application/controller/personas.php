<?php 

class Personas extends Controller
{

	public $modelPersona = null;

	function __construct(){
		$this->modelPersona = $this->loadModel("modelPersona");

	}

	public function Index()
	{
		$personas = $this->modelPersona->getAllPersonas();

		require APP . 'view/_templates/header.php';
		require APP . 'view/personas/index.php';
		require APP . 'view/_templates/footer.php';
	}   

	public function deletepersona($id)
	{
		$persona = $this->modelPersona->getPersona($id);
		$this->render("delete", array("persona" => $persona));
	}

	public function guardar()
	{
		$this->modelPersona->__SET('nombre', $_POST["txtNombre"]);
		$this->modelPersona->__SET('apellido', $_POST["txtApellido"]);
		$this->modelPersona->__SET('edad', $_POST["txtEdad"]);
		$result = $this->modelPersona->savePersona();
		echo json_encode($result);
	}

	public function modificar()
	{
		$this->modelPersona->__SET('id', $_POST["txtId"]);
		$this->modelPersona->__SET('nombre', $_POST["txtNombre"]);
		$this->modelPersona->__SET('apellido', $_POST["txtApellido"]);
		$this->modelPersona->__SET('edad', $_POST["txtEdad"]);
		$result = $this->modelPersona->updatePersona();
		echo json_encode($result);
	}

}

?>