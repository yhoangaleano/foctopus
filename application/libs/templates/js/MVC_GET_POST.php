<?php

$cJS = "";
$initJS = "";

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


$initJS .= "jQuery(document).ready(function() {\n";
$initJS .= "\t".strtolower($nombreClase).".init();\n";
$initJS .= "\t".strtolower($nombreClase).".getAll();\n";
$initJS .= "});\n\n";

$initJS .= "var ".strtolower($nombreClase)." = {\n";
$initJS .= "\tinit: function(){\n";
$initJS .="\t\tvar form = \$(\"#form".ucwords($nombreClase)."\");\n\n";
$initJS .="\t\t\$(\"#btnGuardar\").click(function() {\n";
$initJS .="\t\t\tif (form.valid()) {\n";
$initJS .="\t\t\t\t".strtolower($nombreClase).".add();\n";
$initJS .="\t\t\t};\n";
$initJS .="\t\t});\n\n";
$initJS .="\t\t\$(\"#btnLimpiar\").on(\"click\", function(){\n";
$initJS .="\t\t\tform.trigger(\"reset\");\n";
$initJS .="\t\t});\n\n";
$initJS .= "\t},\n\n";

$initJS .= "\tadd: function(){\n";
$initJS .= "\t\tvar form = \$(\"#form".ucwords($nombreClase)."\");\n";
$initJS .= "\t\tvar fd = new FormData(form[0]);\n";
$initJS .= "\t\tfd.append(\"action\", \"add\");\n\n";

$initJS .= "\t\t\$.ajax({\n";
$initJS .= "\t\t\turl: url+\"".strtolower($nombreClase)."/add".ucwords($nombreClase)."\",\n";
$initJS .= "\t\t\ttype: 'POST',\n";
$initJS .= "\t\t\tdataType: 'json',\n";
$initJS .= "\t\t\tdata: fd,\n";
$initJS .= "\t\t\tprocessData: false,\n";
$initJS .= "\t\t\tcontentType: false\n";
$initJS .= "\t\t})\n";
$initJS .= "\t\t.done(function(respuesta) {\n";
$initJS .= "\t\t\tif (respuesta.result) {\n";
$initJS .= "\t\t\t\talertify.success(\"Buen trabajo! La ha sido creada con éxito.\");\n";
$initJS .= "\t\t\t\tform.trigger(\"reset\");\n";
$initJS .= "\t\t\t\t".strtolower($nombreClase).".getAll();\n";
$initJS .= "\t\t\t}else{\n";
$initJS .= "\t\t\t\talertify.error(\"Ohh no!! Ha ocurrido un error al crear\");\n";
$initJS .= "\t\t\t}\n";
$initJS .= "\t\t})\n";
$initJS .= "\t\t.fail(function(error) {\n";
$initJS .= "\t\t\tconsole.log(error);\n";
$initJS .= "\t\t});\n\n";
$initJS .= "\t},\n\n";

$initJS .= "\tgetAll: function(){\n";
$initJS .= "\t\t\$.ajax({\n";
$initJS .= "\t\t\turl: url+\"".strtolower($nombreClase)."/getAll".ucwords($nombreClase)."\",\n";
$initJS .= "\t\t\ttype: 'POST',\n";
$initJS .= "\t\t\tdataType: 'json'\n";
$initJS .= "\t\t})\n";
$initJS .= "\t\t.done(function(respuesta) {\n";
$initJS .= "\t\t\tvar tbl".ucwords($nombreClase)." = $(\"#tbl".ucwords($nombreClase)."\").dataTable();\n";
$initJS .= "\t\t\ttbl".ucwords($nombreClase).".fnClearTable();\n";
$initJS .= "\t\t\ttbl".ucwords($nombreClase).".fnDestroy();\n";
$initJS .= "\t\t\t\$.each( respuesta, function( i, item ) {\n";
$initJS .= "\t\t\t\t$(\"#tbody".ucwords($nombreClase)."\").append(tmpl(\"tmpl-data-".strtolower($nombreClase)."\", item));\n";
$initJS .= "\t\t\t});\n";
$initJS .= "\t\t\ttbl".ucwords($nombreClase)." = $('#tbl".ucwords($nombreClase)."').dataTable({\n";
$initJS .= "\t\t\t\t\"language\": {\n";
$initJS .= "\t\t\t\t\t\"url\": url+\"js/plugins/datatables/Spanish.json\"\n";
$initJS .= "\t\t\t\t}\n";
$initJS .= "\t\t\t});\n";
$initJS .= "\t\t})\n";
$initJS .= "\t\t.fail(function(error) {\n";
$initJS .= "\t\t\tconsole.log(error);\n";
$initJS .= "\t\t})\n";
$initJS .= "\t}\n";

$initJS .= "}\n";

$cJS .= $initJS;

?>

