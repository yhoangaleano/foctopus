<?php 

class fgenerator 
{
	private $conn = null;
	private $template = "";

	function __construct()
	{
		$this->conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	}

	public function index(){
		$table = "";
		$tableList = array();
		$res = $this->conn->query("SHOW TABLES");
		while($cRow = mysqli_fetch_array($res))
		{	
			$table .= '<option value='.'"'.$cRow[0].'"'.'>'.$cRow[0].'</option>';
		}
		return $table;
	}

	public function createFiles(){

		if($_POST["table"] != null){
			$columns = $this->conn->query("SHOW COLUMNS FROM ".DB_NAME.".".$_POST["table"]);
			$array = array();
			while($cCol = mysqli_fetch_array($columns))
			{
				$array[] = array(
					'Field'=>$cCol["Field"],
					'Key'=>$cCol["Key"],
					'AutoIncrement' => $cCol["Extra"]
					);
			}

			if($_POST["template"] != null){
				$this->template = $_POST["template"];
				echo $this->createModel($_POST["table"],$array)?"</br> Creo el modelo":"No fue posible crear el modelo";
			    echo $this->createController($_POST["table"],$array)?"</br> Creo el controlador":"No fue posible crear el modelo";
			}else{
				echo "Debes seleccionar un template";
			}

		}else{
			echo "Debes seleccionar una base de datos";
		}
	}

	public function createModel($nombreClase, $columns){

		require APP.'libs/templates/models/'.$this->template.'.php';

		try{
			$archivo=fopen(APP.'model/model'.ucwords($nombreClase).'.php','w');
			fwrite($archivo, $cModel);
			fclose($archivo);
			return true;
		}catch(Excpetion $e){
			return false;
		}
	}

	public function createController($nombreClase, $columns){

		require APP.'libs/templates/controllers/'.$this->template.'.php';

		try{
			$archivo=fopen(APP.'controller/'.strtolower($nombreClase).'.php','w');//abrir archivo, nombre archivo, modo apertura
			fwrite($archivo, $cController);
			fclose($archivo); //cerrar archivo
			return true;
		}catch(Excpetion $e){
			return false;
		}

	}
}
?>