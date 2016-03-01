<?php 

class ModelPersona
{
	public $id;
	public $nombre;
	public $apellido;
	public $edad;


	public function __GET($key){
		return $this->$key;
	}

	public function __SET($key, $value){
		$this->$key = $value;
	}

	function __construct($db)
	{
		try {
			$this->db = $db;
		} catch (PDOException $e) {
			exit('Database connection could not be established.');
		}
	}

	public function getAllPersonas()
	{
		$sql = "SELECT id, nombre, apellido, edad FROM persona";
		$query = $this->db->prepare($sql);
		$query->execute();

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // core/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change core/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
		return $query->fetchAll();
	}

	public function getPersona($id)
	{
		$sql = "SELECT id, nombre, apellido, edad FROM persona WHERE id=".$id;
		$query = $this->db->prepare($sql);
		$query->execute();

        // fetchAll() is the PDO method that gets all result rows, here in object-style because we defined this in
        // core/controller.php! If you prefer to get an associative array as the result, then do
        // $query->fetchAll(PDO::FETCH_ASSOC); or change core/controller.php's PDO options to
        // $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ...
		return $query->fetchAll();
	}

	public function savePersona(){
		$query = $this->db->prepare("call SP_SavePersona(:nombre, :apellido, :edad)");
		$query->bindValue(":nombre", $this->__GET("nombre"), PDO::PARAM_STR);
		$query->bindValue(":apellido", $this->__GET("apellido"), PDO::PARAM_STR);
		$query->bindValue(":edad", $this->__GET("edad"), PDO::PARAM_INT);
		return $query->execute();
	}

	public function updatePersona(){
		$query = $this->db->prepare("call SP_UpdatePersona(:id, :nombre, :apellido, :edad)");
		$query->bindValue(":id", $this->__GET("id"), PDO::PARAM_INT);
		$query->bindValue(":nombre", $this->__GET("nombre"), PDO::PARAM_STR);
		$query->bindValue(":apellido", $this->__GET("apellido"), PDO::PARAM_STR);
		$query->bindValue(":edad", $this->__GET("edad"), PDO::PARAM_INT);
		return $query->execute();
	}

}

?>