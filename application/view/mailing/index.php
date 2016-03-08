<div id="formulario" style="margin-bottom: 30px;">
	<h5>Por favor llene la siguiente información:</h5>
	<hr>
	<div class="row">
		<div class="form-group">
			<div class="col-md-4">
				<input type="text" id="subject" name="subject" class="form form-control" placeholder="Asunto" value=""></input>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-6">
				<label class="col-md-3">Dirigido a</label>
				<div class="col-md-4">
					<label style="cursor: pointer;">Propietarios<input type="checkbox" class="checkbox" value="" /></label>
				</div>
				<div class="col-md-4" >
				<label style="cursor: pointer;">Arrendatarios<input type="checkbox" class="checkbox" value="" /> </label>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="plantillas">
	<h5>Seleccione la plantilla de correo que desea</h5>
	<hr>
	<div class="row">
		<div class="col-md-3 tmp tmpFelicitacion" style="cursor: pointer;">
			<p>Template 1</p>
			<p class="tipo">Felicitaciones</p>
		</div>
		<div class="col-md-3 tmp tmpAdvertencia" style="cursor: pointer;">
			<p>Template 2</p>
			<p class="tipo">Advertencia</p>
		</div>
		<div class="col-md-3 tmp tmpGeneral" style="cursor: pointer;">
			<p>Template 3</p>
			<p class="tipo">General</p>
		</div>
		<div class="col-md-3 tmp tmpPersonalizado" style="cursor: pointer;">
			<p>Template 4</p>
			<p class="tipo">Personalizado</p>
		</div>
	</div>
	<div class="row">
		<div id="tmpSelected">
			<textarea name="editor1" id="editor1" rows="10" cols="80">
				
			</textarea>
		</div>
	</div>
	
</div>

<?php 
$js = "<script src='".URL."js/pages/configCkeditor.js'></script>";
?>