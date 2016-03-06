<div class="container">
	<div class="row">
		<div class="col-md-12">
			<form id="formSong" class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Crear Song</h3>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="txtArtist">Artist</label>
								<input type="text" id="txtArtist" name="txtArtist" placeholder="Artist" class="form-control">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="txtTrack">Track</label>
								<input type="text" id="txtTrack" name="txtTrack" placeholder="Track" class="form-control">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="txtLink">Link</label>
								<input type="text" id="txtLink" name="txtLink" placeholder="Link" class="form-control">
							</div>
						</div>
					</div>
				</div>
				<div class="panel-footer">
					<div class="row">
						<div class="col-md-offset-8 col-md-2">
							<button type="button" id="btnGuardar" name="action" class="btn btn-success btn-block">Guardar</button>
						</div>
						<div class="col-md-2">
							<button type="button" id="btnLimpiar" class="btn btn-default btn-block">Limpiar</button>
						</div>
					</div>
				</div>
			</form>
			<div class="panel panel-default">
				<div class="panel-heading">Listado de Songs</div>
				<table class="table table-hover" id="tblSong">
					<thead>
						<tr>
							<th>Id</th>
							<th>Artist</th>
							<th>Track</th>
							<th>Link</th>
							<th>Eliminar</th>
							<th>Editar</th>
						</tr>
					</thead>
					<tbody id="tbodySong">
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


<?php

$template = '<script type="text/x-tmpl" id="tmpl-data-song">
<tr>
	<td>{%=o.id%}</td>
	<td>{%=o.artist%}</td>
	<td>{%=o.track%}</td>
	<td>{%=o.link%}</td>
	<td>
		<a href="song/delete/{%=o.id%}" class="btn btn-block btn-danger">Eliminar</a>
	</td>
	<td>
		<a href="song/edit/{%=o.id%}" class="btn btn-block btn-primary">Editar</a>
	</td>
</tr>
</script>';

$js = '<script src="'.URL.'js/pages/songAjax.js" type="text/javascript"></script>';

?>