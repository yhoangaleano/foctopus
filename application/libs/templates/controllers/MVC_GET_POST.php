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
$rUpdate .= "\t\t\t\t\$this->".$model."->__SET('".$primary."', \$".$primary.");\n";
$rUpdate .= "\t\t\t\t\$".strtolower($nombreClase)." = \$this->".$model."->get".ucwords($nombreClase)."();\n";
$rUpdate .= "\t\t\t\t\$this->render('edit');\n";
$rUpdate .= "\t\t\t} else {\n";
$rUpdate .=	"\t\t\t\theader('location: ' . URL . 'songs/index');\n";
$rUpdate .= "\t\t\t}\n";
$rUpdate .= "\t\t}\n\n";
$cController .= $rUpdate;


$cUpdate .= "\t\tpublic function update".ucwords($nombreClase)."()\n";
$cUpdate .= "\t\t{\n";
$cUpdate .= "\t\t\tif (isset(\$_POST[\"action\"])) {\n";

foreach ($columns as $value) {
	$cUpdate .= "\t\t\t\t\$this->".$model."->__SET('".$value['Field']."', \$_POST[\"txt".ucwords($value['Field'])."\"]);\n";
}

$cUpdate .= "\t\t\t\t\$result = \$this->".$model."->update".ucwords($nombreClase)."();\n";
$cUpdate .= "\t\t\t\techo json_encode(array('result' => \$result));\n";
$cUpdate .= "\t\t\t\treturn;\n";
$cUpdate .= "\t\t\t}\n";
$cUpdate .= "\t\t\techo json_encode(array('result' => false));\n";
$cUpdate .= "\t\t}\n\n";
$cController .= $cUpdate;

$rDelete .= "\t\tpublic function delete(\$".$primary.")\n";
$rDelete .= "\t\t{\n";
$rDelete .= "\t\t\tif (!is_null(\$".$primary.")) {\n";
$rDelete .= "\t\t\t\t\$this->".$model."->__SET('".$primary."', \$".$primary.");\n";
$rDelete .= "\t\t\t\t\$".strtolower($nombreClase)." = \$this->".$model."->get".ucwords($nombreClase)."();\n";
$rDelete .= "\t\t\t\t\$this->render('delete');\n";
$rDelete .= "\t\t\t} else {\n";
$rDelete .=	"\t\t\t\theader('location: ' . URL . 'songs/index');\n";
$rDelete .= "\t\t\t}\n";
$rDelete .= "\t\t}\n\n";
$cController .= $rDelete;

$cDelete .= "\t\tpublic function delete".ucwords($nombreClase)."()\n";
$cDelete .= "\t\t{\n";
$cDelete .= "\t\t\tif (isset(\$_POST[\"action\"])) {\n";
$cDelete .= "\t\t\t\t\$this->".$model."->__SET('".$primary."', \$_POST[\"txt".ucwords($primary)."\"]);\n";
$cDelete .= "\t\t\t\t\$result = \$this->".$model."->delete".ucwords($nombreClase)."();\n";
$cDelete .= "\t\t\t\techo json_encode(array('result' => \$result));\n";
$cDelete .= "\t\t\t\treturn;\n";
$cDelete .= "\t\t\t}\n";
$cDelete .= "\t\t\techo json_encode(array('result' => false));\n";
$cDelete .= "\t\t}\n\n";
$cController .= $cDelete;

$cGet .= "\t\tpublic function get".ucwords($nombreClase)."()\n";
$cGet .= "\t\t{\n";
$cGet .= "\t\t\t\$this->".$model."->__SET('".$primary."', \$_POST[\"txt".ucwords($primary)."\"]);\n";
$cGet .= "\t\t\t\$".strtolower($nombreClase)." = \$this->".$model."->get".ucwords($nombreClase)."();\n";
$cGet .= "\t\t\techo json_encode(array('result' => \$".strtolower($nombreClase)."));\n";
$cGet .= "\t\t}\n\n";
$cController .= $cGet;

$cController .= "\t}\n";
$cController .= "?>";


?>