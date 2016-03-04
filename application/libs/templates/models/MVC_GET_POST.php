<?php

$fecthMode = "PDO::FETCH_ASSOC";

$cModel = "";
$attributes = "";
$magicMethods = "";
$constructors = "";

//Methods CRUD
$getAll = "";
$add = "";
$delete = "";
$get = "";
$update = "";

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

//Begin method GetAll

$getAll .= "\tpublic function getAll".ucwords($nombreClase)."()\n";
$getAll .= "\t{\n";
$getAll .= "\t\t\$sql = \"SELECT ";
$getAll .= strtolower(implode(', ', array_column($columns, 'Field')))." ";

$getAll .= "FROM ".strtolower($nombreClase)."\";\n";
$getAll .= "\t\t\$query = \$this->db->prepare(\$sql);\n";
$getAll .= "\t\t\$query->execute();\n";

if (isset($fecthMode)) {
	$getAll .= "\t\treturn \$query->fetchAll(".$fecthMode.");\n";
}else{
	$getAll .= "\t\treturn \$query->fetchAll();\n";
}

$getAll .= "\t}\n\n";

$cModel .= $getAll;

//End Method GetAll


//Begin Method Add

$add .= "\tpublic function add".ucwords($nombreClase)."()\n";
$add .= "\t{\n";
$add .= "\t\t\$sql = \"INSERT INTO ".strtolower($nombreClase)." (";

if ($autoIncrement == true) {
	$add .= strtolower(implode(', ', array_column($columsNPK, 'Field')))." ";
	$add .= ") VALUES (";
	$add .= implode(', ', array_map(function ($value) {
		return ":".$value['Field'];
	}, $columsNPK));
}else{
	$add .= strtolower(implode(', ', array_column($columns, 'Field')))." ";
	$add .= ") VALUES (";
	$add .= implode(', ', array_map(function ($value) {
		return ":".$value['Field'];
	}, $columns));
}

$add .= ")\";\n";

$add .= "\t\t\$query = \$this->db->prepare(\$sql);\n";
$add .= "\t\t\$parameters = array(\n";

if ($autoIncrement == true) {
	$add .= "\t\t\t".implode(', ', array_map(function ($value) {
		return " ':".strtolower($value["Field"])."' => strip_tags(\$this->__GET(\"".strtolower($value["Field"])."\"))";
	}, $columsNPK))."\n";
}else{
	$add .= "\t\t\t".implode(', ', array_map(function ($value) {
		return " ':".strtolower($value["Field"])."' => strip_tags(\$this->__GET(\"".strtolower($value["Field"])."\"))";
	}, $columns))."\n";
}

$add .= "\t\t);\n";

$add .= "\t\t\$validate = false;\n";
$add .= "\t\t\$query->execute(\$parameters);\n";

$add .= "\t\tif (\$query->rowCount() > 0) {\n";
$add .= "\t\t\t\$validate = true;\n";
$add .= "\t\t}\n";

$add .= "\t\treturn \$validate;\n";
$add .= "\t}\n\n";

$cModel .= $add;

//End Method Add

//Begin Method Delete

$delete .= "\tpublic function delete".ucwords($nombreClase)."()\n";
$delete .= "\t{\n";
$delete .= "\t\t\$sql = \"DELETE FROM ".strtolower($nombreClase)." WHERE ".$primary." = :".$primary."\";\n";
$delete .= "\t\t\$query = \$this->db->prepare(\$sql);\n";
$delete .= "\t\t\$parameters = array(\n";
$delete .= "\t\t\t':".strtolower($primary)."' => strip_tags(\$this->__GET(\"".strtolower($primary)."\"))\n";
$delete .= "\t\t);\n\n";

$delete .= "\t\t// useful for debugging: you can see the SQL behind above construction by using:\n";
$delete .= "\t\t// echo '[ PDO DEBUG ]: ' . Helper::debugPDO(\$sql, \$parameters);  exit();\n\n";

$delete .= "\t\t\$validate = false;\n";
$delete .= "\t\t\$query->execute(\$parameters);\n\n";

$delete .= "\t\tif (\$query->rowCount() > 0) {\n";
$delete .= "\t\t\t\$validate = true;\n";
$delete .= "\t\t}\n\n";

$delete .= "\t\treturn \$validate;\n";
$delete .= "\t}\n\n";

$cModel .= $delete;

//End Method Delete

//Begin Method Get

$get .= "\tpublic function get".ucwords($nombreClase)."()\n";
$get .= "\t{\n";
$get .= "\t\t\$sql = \"SELECT ";
$get .= strtolower(implode(', ', array_column($columns, 'Field')))." ";
$get .= "FROM ".strtolower($nombreClase)." WHERE ".strtolower($primary)." = :".strtolower($primary)."\";\n";

$get .= "\t\t\$query = \$this->db->prepare(\$sql);\n";
$get .= "\t\t\$parameters = array(\n";
$get .= "\t\t\t':".strtolower($primary)."' => strip_tags(\$this->__GET(\"".strtolower($primary)."\"))\n";
$get .= "\t\t);\n\n";

$get .= "\t\t// useful for debugging: you can see the SQL behind above construction by using:\n";
$get .= "\t\t// echo '[ PDO DEBUG ]: ' . Helper::debugPDO(\$sql, \$parameters);  exit();\n";

$get .= "\t\t\$query->execute(\$parameters);\n";

$get .= "\t\t// fetch() is the PDO method that get exactly one result\n";
$get .= "\t\treturn \$query->fetch(".$fecthMode.");\n";
$get .= "\t}\n\n";

$cModel .= $get;

//End Method Get

//Begin Method Update

$update .= "\tpublic function update".ucwords($nombreClase)."()\n";
$update .= "\t{\n";
$update .= "\t\t\$sql = \"UPDATE ".strtolower($nombreClase)." SET ";
$update .= implode(', ', array_map(function ($value) {
	return strtolower($value["Field"])." = :".strtolower($value["Field"]);
}, $columsNPK));


$update .= " WHERE ".strtolower($primary)." = :".strtolower($primary)."\";\n";
$update .= "\t\t\$query = \$this->db->prepare(\$sql);\n";

$update .= "\t\t\$parameters = array(\n";

$update .= "\t\t\t".implode(', ', array_map(function ($value) {
	return " ':".strtolower($value["Field"])."' => strip_tags(\$this->__GET(\"".strtolower($value["Field"])."\"))";
}, $columns))."\n";

$update .= "\t\t);\n";


$update .= "\t\t// useful for debugging: you can see the SQL behind above construction by using:\n";
$update .= "\t\t// echo '[ PDO DEBUG ]: ' . Helper::debugPDO(\$sql, \$parameters);  exit();\n\n";

$update .= "\t\t\$validate = false;\n";
$update .= "\t\t\$query->execute(\$parameters);\n\n";

$update .= "\t\tif (\$query->rowCount() > 0) {\n";
$update .= "\t\t\t\$validate = true;\n";
$update .= "\t\t}\n\n";

$update .= "\t\treturn \$validate; \n";
$update .= "\t}\n\n";

$cModel .= $update;

//End Method Update


$cModel .= "}\n";
$cModel .= "?>";

?>