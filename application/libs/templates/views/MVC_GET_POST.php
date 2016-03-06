<?php

$cView = "";
$jsTemplate = "";
$jsLibrary = "";
$htmlTemplate = "";

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


$htmlTemplate .= "<div class=\"container\">\n";
$htmlTemplate .= "\t<div class=\"row\">\n";
$htmlTemplate .= "\t\t<div class=\"col-md-12\">\n";
$htmlTemplate .= "\t\t\t<form id=\"form".ucwords($nombreClase)."\" class=\"panel panel-default\">\n";
$htmlTemplate .= "\t\t\t\t<div class=\"panel-heading\">\n";
$htmlTemplate .= "\t\t\t\t\t<h3 class=\"panel-title\">Crear ".ucwords($nombreClase)."</h3>\n";
$htmlTemplate .= "\t\t\t\t</div>\n";
$htmlTemplate .= "\t\t\t\t<div class=\"panel-body\">\n";
$htmlTemplate .= "\t\t\t\t\t<div class=\"row\">\n";


if (!$autoIncrement) {
	$htmlTemplate .= "\t\t\t\t\t\t\t\t<input type=\"hidden\" id=\"txt".ucwords($primary)."\" name=\"txt".ucwords($primary)."\" placeholder=\"".ucwords($primary)."\" class=\"form-control\">\n";
}

foreach ($columsNPK as $value) {
	$htmlTemplate .= "\t\t\t\t\t\t<div class=\"col-md-4\">\n";
	$htmlTemplate .= "\t\t\t\t\t\t\t<div class=\"form-group\">\n";
	$htmlTemplate .= "\t\t\t\t\t\t\t\t<label for=\"txt".ucwords($value['Field'])."\">".ucwords($value['Field'])."</label>\n";
	$htmlTemplate .= "\t\t\t\t\t\t\t\t<input type=\"text\" id=\"txt".ucwords($value['Field'])."\" name=\"txt".ucwords($value['Field'])."\" placeholder=\"".ucwords($value['Field'])."\" class=\"form-control\">\n";
	$htmlTemplate .= "\t\t\t\t\t\t\t</div>\n";
	$htmlTemplate .= "\t\t\t\t\t\t</div>\n";
}

$htmlTemplate .= "\t\t\t\t\t</div>\n";
$htmlTemplate .= "\t\t\t\t</div>\n";
$htmlTemplate .= "\t\t\t\t<div class=\"panel-footer\">\n";
$htmlTemplate .= "\t\t\t\t\t<div class=\"row\">\n";

$htmlTemplate .= "\t\t\t\t\t\t<div class=\"col-md-offset-8 col-md-2\">\n";
$htmlTemplate .= "\t\t\t\t\t\t\t<button type=\"button\" id=\"btnGuardar\" name=\"action\" class=\"btn btn-success btn-block\">Guardar</button>\n";
$htmlTemplate .= "\t\t\t\t\t\t</div>\n";

$htmlTemplate .= "\t\t\t\t\t\t<div class=\"col-md-2\">\n";
$htmlTemplate .= "\t\t\t\t\t\t\t<button type=\"button\" id=\"btnLimpiar\" class=\"btn btn-default btn-block\">Limpiar</button>\n";
$htmlTemplate .= "\t\t\t\t\t\t</div>\n";

$htmlTemplate .= "\t\t\t\t\t</div>\n";
$htmlTemplate .= "\t\t\t\t</div>\n";
$htmlTemplate .= "\t\t\t</form>\n";

$htmlTemplate .= "\t\t\t<div class=\"panel panel-default\">\n";
$htmlTemplate .= "\t\t\t\t<div class=\"panel-heading\">Listado de ".ucwords($nombreClase)."s</div>\n";

$htmlTemplate .= "\t\t\t\t<table class=\"table table-hover\" id=\"tbl".ucwords($nombreClase)."\">\n";
$htmlTemplate .= "\t\t\t\t\t<thead>\n";
$htmlTemplate .= "\t\t\t\t\t\t<tr>\n";

foreach ($columns as $value) {
	$htmlTemplate .= "\t\t\t\t\t\t\t<th>".ucwords($value['Field'])."</th>\n";
}

$htmlTemplate .= "\t\t\t\t\t\t\t<th>Eliminar</th>\n";
$htmlTemplate .= "\t\t\t\t\t\t\t<th>Editar</th>\n";
$htmlTemplate .= "\t\t\t\t\t\t</tr>\n";
$htmlTemplate .= "\t\t\t\t\t</thead>\n";
$htmlTemplate .= "\t\t\t\t\t<tbody id=\"tbody".ucwords($nombreClase)."\">\n";
$htmlTemplate .= "\t\t\t\t\t</tbody>\n";
$htmlTemplate .= "\t\t\t\t</table>\n";

$htmlTemplate .= "\t\t\t</div>\n";

$htmlTemplate .= "\t\t</div>\n";
$htmlTemplate .= "\t</div>\n";
$htmlTemplate .= "</div>\n\n\n";

$cView .= $htmlTemplate;

$cView .= "<?php\n\n"; 

$jsTemplate .= "\$template = '<script type=\"text/x-tmpl\" id=\"tmpl-data-".strtolower($nombreClase)."\">\n";
$jsTemplate .= "<tr>\n";

foreach ($columns as $value) {
	$jsTemplate .= "\t<td>{%=o.".strtolower($value['Field'])."%}</td>\n";
}

$jsTemplate .= "\t<td>\n";
$jsTemplate .= "\t\t<a href=\"".strtolower($nombreClase)."/delete/{%=o.".$primary."%}\" class=\"btn btn-block btn-danger\">Eliminar</a>\n";
$jsTemplate .= "\t</td>\n";
$jsTemplate .= "\t<td>\n";
$jsTemplate .= "\t\t<a href=\"".strtolower($nombreClase)."/edit/{%=o.".$primary."%}\" class=\"btn btn-block btn-primary\">Editar</a>\n";
$jsTemplate .= "\t</td>\n";
$jsTemplate .= "</tr>\n";
$jsTemplate .= "</script>';\n\n";

$cView .= $jsTemplate;

$jsLibrary .= "\$js = '<script src=\"'.URL.'js/pages/".strtolower($nombreClase)."Ajax.js\" type=\"text/javascript\"></script>';\n\n";

$cView .= $jsLibrary;

$cView .= "?>";


?>