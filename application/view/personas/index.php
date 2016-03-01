
<div class="row">

	<div class="col-md-12">
		
		<!-- Button trigger modal -->
		<button id="btnAbrirModal" type="button" class="btn btn-primary btn-lg">
			Crear persona
		</button>

		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Datos persona</h4>
					</div>
					<div class="modal-body">
						<form id="frmPersona">
							<div class="form-group">
								<input type="hidden" id="txtId" name="txtId" class="form-control">
								<label for="txtNombre">Nombre</label>
								<input type="text" id="txtNombre" name="txtNombre" class="form-control">
							</div>
							<div class="form-group">
								<label for="txtApellido">Apellido</label>
								<input type="text" id="txtApellido" name="txtApellido" class="form-control">

							</div>
							<div class="form-group">
								<label for="txtEdad">Edad</label>
								<input type="text" id="txtEdad" name="txtEdad" class="form-control">
							</div>
							<div class="form-group">
								<input type="button" id="btnGuardar" name="btnGuardar" class="btn btn-success btn-block" value="Guardar" />
								<input type="button" id="btnModificar" name="btnModificar" class="btn btn-primary btn-block" value="Modificar" />
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary">Save changes</button>
					</div>
				</div>
			</div>
		</div>

		
		
	</div>
</div>

<h3>Listado de personas en la base de datos</h3>
<table class="table table-hover">
	<thead style="background-color: #ddd; font-weight: bold;">
		<tr>
			<td>Id</td>
			<td>Nombre</td>
			<td>Apellido</td>
			<td>Edad</td>
			<td>DELETE</td>
			<td>EDIT</td>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($personas as $persona) { ?>
		<tr>
			<td><?php if (isset($persona->id)) echo htmlspecialchars($persona->id, ENT_QUOTES, 'UTF-8'); ?></td>
			<td><?php if (isset($persona->nombre)) echo htmlspecialchars($persona->nombre, ENT_QUOTES, 'UTF-8'); ?></td>
			<td><?php if (isset($persona->apellido)) echo htmlspecialchars($persona->apellido, ENT_QUOTES, 'UTF-8'); ?></td>
			<td><?php if (isset($persona->edad)) echo htmlspecialchars($persona->edad, ENT_QUOTES, 'UTF-8'); ?></td>
			<td><a href="<?php echo URL . 'personas/deletepersona/' . htmlspecialchars($persona->id, ENT_QUOTES, 'UTF-8'); ?>">delete</a></td>
			<td><a onclick='personas.edit(<?php echo json_encode($persona); ?>)'>edit</a></td>
		</tr>
		<?php } ?>
	</tbody>
</table>


<?php 

$js = '<script src="'.URL.'js/personas.js" type="text/javascript"></script>';

?>