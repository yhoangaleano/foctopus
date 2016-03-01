<?php 

class fgenerator 
{
	private $conn = null;

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
					'Key'=>$cCol["Key"]
					);
			}
			echo $this->createModel($_POST["table"],$array)?"</br> Creo el modelo":"No fue posible crear el modelo";
			//echo $this->createController($_POST["table"],$array)?"</br> Creo el controlador":"No fue posible crear el modelo";
		}else{
			echo "Debes seleccionar una base de datos";
		}
	}

	public function createModel($nombreClase, $columns){

		$cModel = "";
		$attributes = "";
		$magicMethods = "";
		$constructors = "";

		$cModel .= "<?php\n"; 
		$cModel .= "class ".strtolower($nombreClase)."\n";
		$cModel .= "{\n";
		$cModel .= "\n";

		foreach ($columns as $value) {
			$attributes .= "\tprivate \$".strtolower($value["Field"]).";\n";
		}


		$attributes .= "\n";
		$cModel .= $attributes;

		$magicMethods .= "\tpublic function __GET(\$key)\n";
		$magicMethods .= "\t{\n";
		$magicMethods .= "\t\treturn \$this->\$key;\n";
		$magicMethods .= "\t}\n";

		$magicMethods .= "\n";

		$magicMethods .= "\tpublic function __SET(\$key, \$value)\n";
		$magicMethods .= "\t{\n";
		$magicMethods .= "\t\t\$this->\$key = \$value;\n";
		$magicMethods .= "\t}\n";

		$magicMethods .= "\n";

		$cModel .= $magicMethods;

		$constructors .= "\t/**\n";
		$constructors .= "\t* @param object \$db Conexión a PDO con la configuración establecida\n";
		$constructors .= "\t*/\n";
		$constructors .= "\tfunction __construct(\$db)\n";
		$constructors .= "\t{\n";
		$constructors .= "\t\ttry {\n";
		$constructors .= "\t\t\t\$this->db = \$db;\n";
		$constructors .= "\t\t}\n";
		$constructors .= "\t\tcatch (PDOException \$e) {\n";
		$constructors .= "\t\t\texit('Database connection could not be established.');\n";
		$constructors .= "\t\t}\n";
		$constructors .= "\t}\n";
		$constructors .= "\n";

		$cModel .= $constructors;

		$cModel .= "}\n";
		$cModel .= "?>";

		try{
			$archivo=fopen(APP.'model/'.ucwords($nombreClase).'.php','w');//abrir archivo, nombre archivo, modo apertura
			fwrite($archivo, $cModel);
			fclose($archivo); //cerrar archivo
			return true;
		}catch(Excpetion $e){
			return false;
		}

	}

	public function createController($nombreClase, $columns){

		$apguardar = "$"."parametros = array(\n";
		$apmodificar = "";
		foreach ($columns as $value) {
			$apguardar .= "\t\t\t\t'".$value["Field"]."'=>$"."_POST['txt".ucwords($value["Field"])."'],\n";
			$apmodificar .= "\t\t\t$"."modelo->".strtolower($value["Field"])."= $"."_POST['txt".ucwords($value["Field"])."'];\n";
		}
		$apguardar .= "\t\t\t);";
		
		$cController = "";
		$cController .= "<?php\n"; 
		$cController .= "\tclass ".ucwords($nombreClase)."Controller extends controller\n";
		$cController .= "\t{\n";
		$cController .= "\t\t$"."this->layout='header';"."\n\n";
		$cController .= "\t\tpublic function index(){\n";
		$cController .= "\t\t\t$".ucwords($nombreClase)." = $"."this->loadModel("."'".ucwords($nombreClase)."'".")->find('all');\n";
		$cController .= "\t\t\t$"."this->render('index',array('datos'=>$".ucwords($nombreClase)."));\n";
		$cController .= "\t\t}\n\n";

		$cController .= "\t\tpublic function crear(){\n";
		$cController .= "\t\t\t$".ucwords($nombreClase)." = $"."this->loadModel("."'".strtolower($nombreClase)."'".")->find('all');\n\n";
		$cController .= "\t\t\t".$apguardar."\n";
		$cController .= "\t\t\t$"."mensaje = null;\n";
		$cController .= "\t\t\t$"."modelo = new ".strtolower($nombreClase)."($"."parametros);\n";
		$cController .= "\t\t\ttry{\n";
		$cController .= "\t\t\t\tif($"."modelo->save()){\n";
		$cController .= "\t\t\t\t\t$"."mensaje = 'Operación exitosa';\n";
		$cController .= "\t\t\t\t}else{\n";
		$cController .= "\t\t\t\t\t$"."mensaje = 'Ha ocurrido un error';\n";
		$cController .= "\t\t\t\t}\n";
		$cController .= "\t\t\t}catch(Exception $"."e){\n";
		$cController .= "\t\t\t\t\t$"."mensaje = $"."e->getMessage();\n";
		$cController .= "\t\t\t}\n";
		$cController .= "\t\t\t$"."this->render('index',array('datos'=>$".ucwords($nombreClase).",'mensaje'=>$"."mensaje));\n";
		$cController .= "\t\t}\n\n";

		$cController .= "\t\tpublic function modificar(){\n";
		$cController .= "\t\t\t$".ucwords($nombreClase)." = $"."this->loadModel("."'".strtolower($nombreClase)."'".")->find('all');\n";
		$cController .= "\t\t\t$"."model = $"."this->loadModel("."'".strtolower($nombreClase)."'".")->find($"."_POST[".'"'."codigo".'"'."]".");\n\n";
		$cController .= "".$apmodificar."\n";
		$cController .= "\t\t\t$"."mensaje = null;\n";
		$cController .= "\t\t\ttry{\n";
		$cController .= "\t\t\t\tif($"."model->save()){\n";
		$cController .= "\t\t\t\t\t$"."mensaje = 'Operación exitosa';\n";
		$cController .= "\t\t\t\t}else{\n";
		$cController .= "\t\t\t\t\t$"."mensaje = 'Ha ocurrido un error';\n";
		$cController .= "\t\t\t\t}\n";
		$cController .= "\t\t\t}catch(Exception $"."e){\n";
		$cController .= "\t\t\t\t\t$"."mensaje = $"."e->getMessage();\n";
		$cController .= "\t\t\t}\n";
		$cController .= "\t\t\t$"."this->render('index',array('datos'=>$".ucwords($nombreClase).",'mensaje'=>$"."mensaje));\n";
		$cController .= "\t\t}\n\n";


		$cController .= "\t\tpublic function modificar($"."codigo){\n";
		$cController .= "\t\t\t$".ucwords($nombreClase)." = $"."this->loadModel("."'".strtolower($nombreClase)."'".")->find('all');\n";
		$cController .= "\t\t\t$"."model = $"."this->loadModel("."'".strtolower($nombreClase)."'".")->find($"."codigo);\n";
		$cController .= "\t\t\t$"."mensaje = null;\n";
		$cController .= "\t\t\ttry{\n";
		$cController .= "\t\t\t\tif($"."model->delete()){\n";
		$cController .= "\t\t\t\t\t$"."mensaje = 'Operación exitosa';\n";
		$cController .= "\t\t\t\t}else{\n";
		$cController .= "\t\t\t\t\t$"."mensaje = 'Ha ocurrido un error';\n";
		$cController .= "\t\t\t\t}\n";
		$cController .= "\t\t\t}catch(Exception $"."e){\n";
		$cController .= "\t\t\t\t\t$"."mensaje = $"."e->getMessage();\n";
		$cController .= "\t\t\t}\n";
		$cController .= "\t\t\t$"."this->render('index',array('datos'=>$".ucwords($nombreClase).",'mensaje'=>$"."mensaje));\n";
		$cController .= "\t\t}\n\n";

		$cController .= "\t}\n";
		$cController .= "?>";


		try{
			$archivo=fopen(APP.'controller/'.ucwords($nombreClase).'ControllerXXX.php','w');//abrir archivo, nombre archivo, modo apertura
			fwrite($archivo, $cController);
			fclose($archivo); //cerrar archivo
			return true;
		}catch(Excpetion $e){
			return false;
		}

	}
}
?>