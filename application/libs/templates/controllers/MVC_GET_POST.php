<?php 


$cController = "";
$cAttributes = "";
$cConstructors = "";

//Methods CRUD
$rGetAll = "";
$cGetAll = "";

$rAdd = "";
$cAdd = "";

$rDelete = "";
$cDelete = "";

$cGet = "";

$rUpdate= "";
$cUpdate = "";


//Primary Key
$primary = "";
$autoIncrement = false;

//Columnas sin las primary Keys que sean autoincrement
$columsNPK = array();

foreach ($columns as $value) {
	if($value["Key"] == "PRI"){
		$primary = strtolower($value["Field"]);
		if($value["AutoIncrement"] == "auto_increment"){
			$autoIncrement = true;
		}else{
			$columsNPK[] = $value;
		}
	}else{
		$columsNPK[] = $value;
	}
}


$model = "model".ucwords($nombreClase);

$cController .= "<?php\n"; 
$cController .= "\tclass ".ucwords($nombreClase)." extends Controller\n";
$cController .= "\t{\n";

$cAttributes .= "\t\tpublic \$".$model." = null;\n\n";
$cController .= $cAttributes;

$cConstructors .= "\t\tfunction __construct()\n";
$cConstructors .= "\t\t{\n";
$cConstructors .= "\t\t\t\$this->".$model." = \$this->loadModel(\"".$model."\");\n";
$cConstructors .= "\t\t}\n\n";
$cController .= $cConstructors;

$rGetAll .= "\t\tpublic function index(){\n";
$rGetAll .= "\t\t\t\$"."this->render('index');\n";
$rGetAll .= "\t\t}\n\n";
$cController .= $rGetAll;

$cGetAll .= "\t\tpublic function getAll".ucwords($nombreClase)."()\n";
$cGetAll .= "\t\t{\n";
$cGetAll .= "\t\t\t\$result = \$this->".$model."->getAll".ucwords($nombreClase)."();\n";
$cGetAll .= "\t\t\techo json_encode(\$result);\n";
$cGetAll .= "\t\t}\n\n";
$cController .= $cGetAll;

$rAdd .= "\t\tpublic function create()\n";
$rAdd .= "\t\t{\n";
$rAdd .= "\t\t\t\$"."this->render('create');\n";
$rAdd .= "\t\t}\n\n";
$cController .= $rAdd;

$cAdd .= "\t\tpublic function add".ucwords($nombreClase)."()\n";
$cAdd .= "\t\t{\n";
$cAdd .= "\t\t\tif (isset(\$_POST[\"action\"])) {\n";

if ($autoIncrement == true) {
	foreach ($columsNPK as $value) {
		$cAdd .= "\t\t\t\t\$this->".$model."->__SET('".$value['Field']."', \$_POST[\"txt".ucwords($value['Field'])."\"]);\n";
	}
}else{
	foreach ($columns as $value) {
		$cAdd .= "\t\t\t\t\$this->".$model."->__SET('".$value['Field']."', \$_POST[\"txt".ucwords($value['Field'])."\"]);\n";
	}
}

$cAdd .= "\t\t\t\t\$result = \$this->".$model."->add".ucwords($nombreClase)."();\n";
$cAdd .= "\t\t\t\techo json_encode(array('result' => \$result));\n";
$cAdd .= "\t\t\t\treturn;\n";
$cAdd .= "\t\t\t}\n";
$cAdd .= "\t\t\techo json_encode(array('result' => false));\n";
$cAdd .= "\t\t}\n\n";
$cController .= $cAdd;

$rUpdate .= "\t\tpublic function edit(\$".$primary.")\n";
$rUpdate .= "\t\t{\n";
$rUpdate .= "\t\t\tif (!is_null(\$".$primary.")) {\n";
$rUpdate .= "\t\t\t\t\$this->".$model."->__SET('".$primary."', \$_POST[\"txt".ucwords($primary)."\"]);\n";
$rUpdate .= "\t\t\t\t\$".strtolower($nombreClase)." = \$this->".$model."->get".ucwords($nombreClase)."();\n";
$rUpdate .= "\t\t\t\t\$this->render('edit');\n";
$rUpdate .= "\t\t\t} else {\n";
$rUpdate .=	"\t\t\t\theader('location: ' . URL . 'songs/index');\n";
$rUpdate .= "\t\t\t}\n";
$rUpdate .= "\t\t}\n\n";
$cController .= $rUpdate;

$cGet .= "\t\tpublic function get".ucwords($nombreClase)."()\n";
$cGet .= "\t\t{\n";
$cGet .= "\t\t\t\$this->".$model."->__SET('".$primary."', \$_POST[\"txt".ucwords($primary)."\"]);\n";
$cGet .= "\t\t\t\$".strtolower($nombreClase)." = \$this->".$model."->get".ucwords($nombreClase)."();\n";
$cGet .= "\t\t\techo json_encode(array('result' => \$".strtolower($nombreClase)."));\n";
$cGet .= "\t\t}\n\n";
$cController .= $cGet;


// $cController .= "\t\tpublic function crear(){\n";
// $cController .= "\t\t\t$".ucwords($nombreClase)." = $"."this->loadModel("."'".strtolower($nombreClase)."'".")->find('all');\n\n";
// $cController .= "\t\t\t".$apguardar."\n";
// $cController .= "\t\t\t$"."mensaje = null;\n";
// $cController .= "\t\t\t$"."modelo = new ".strtolower($nombreClase)."($"."parametros);\n";
// $cController .= "\t\t\ttry{\n";
// $cController .= "\t\t\t\tif($"."modelo->save()){\n";
// $cController .= "\t\t\t\t\t$"."mensaje = 'Operación exitosa';\n";
// $cController .= "\t\t\t\t}else{\n";
// $cController .= "\t\t\t\t\t$"."mensaje = 'Ha ocurrido un error';\n";
// $cController .= "\t\t\t\t}\n";
// $cController .= "\t\t\t}catch(Exception $"."e){\n";
// $cController .= "\t\t\t\t\t$"."mensaje = $"."e->getMessage();\n";
// $cController .= "\t\t\t}\n";
// $cController .= "\t\t\t$"."this->render('index',array('datos'=>$".ucwords($nombreClase).",'mensaje'=>$"."mensaje));\n";
// $cController .= "\t\t}\n\n";

// $cController .= "\t\tpublic function modificar(){\n";
// $cController .= "\t\t\t$".ucwords($nombreClase)." = $"."this->loadModel("."'".strtolower($nombreClase)."'".")->find('all');\n";
// $cController .= "\t\t\t$"."model = $"."this->loadModel("."'".strtolower($nombreClase)."'".")->find($"."_POST[".'"'."codigo".'"'."]".");\n\n";
// $cController .= "".$apmodificar."\n";
// $cController .= "\t\t\t$"."mensaje = null;\n";
// $cController .= "\t\t\ttry{\n";
// $cController .= "\t\t\t\tif($"."model->save()){\n";
// $cController .= "\t\t\t\t\t$"."mensaje = 'Operación exitosa';\n";
// $cController .= "\t\t\t\t}else{\n";
// $cController .= "\t\t\t\t\t$"."mensaje = 'Ha ocurrido un error';\n";
// $cController .= "\t\t\t\t}\n";
// $cController .= "\t\t\t}catch(Exception $"."e){\n";
// $cController .= "\t\t\t\t\t$"."mensaje = $"."e->getMessage();\n";
// $cController .= "\t\t\t}\n";
// $cController .= "\t\t\t$"."this->render('index',array('datos'=>$".ucwords($nombreClase).",'mensaje'=>$"."mensaje));\n";
// $cController .= "\t\t}\n\n";


// $cController .= "\t\tpublic function modificar($"."codigo){\n";
// $cController .= "\t\t\t$".ucwords($nombreClase)." = $"."this->loadModel("."'".strtolower($nombreClase)."'".")->find('all');\n";
// $cController .= "\t\t\t$"."model = $"."this->loadModel("."'".strtolower($nombreClase)."'".")->find($"."codigo);\n";
// $cController .= "\t\t\t$"."mensaje = null;\n";
// $cController .= "\t\t\ttry{\n";
// $cController .= "\t\t\t\tif($"."model->delete()){\n";
// $cController .= "\t\t\t\t\t$"."mensaje = 'Operación exitosa';\n";
// $cController .= "\t\t\t\t}else{\n";
// $cController .= "\t\t\t\t\t$"."mensaje = 'Ha ocurrido un error';\n";
// $cController .= "\t\t\t\t}\n";
// $cController .= "\t\t\t}catch(Exception $"."e){\n";
// $cController .= "\t\t\t\t\t$"."mensaje = $"."e->getMessage();\n";
// $cController .= "\t\t\t}\n";
// $cController .= "\t\t\t$"."this->render('index',array('datos'=>$".ucwords($nombreClase).",'mensaje'=>$"."mensaje));\n";
// $cController .= "\t\t}\n\n";

$cController .= "\t}\n";
$cController .= "?>";


?>