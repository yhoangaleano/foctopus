jQuery(document).ready(function() {
	song.init();
	song.listar();
});


var song = {

	init: function(){


		jQuery.validator.setDefaults({
			debug: true,
			success: "valid"
		});

		var form = $( "#formSong" );
		form.validate({
			rules: {
				txtArtist: {
					required: true,
					minlength: 2
				},
				txtTrack: {
					required: true,
					minlength: 2
				},
				txtLink: {
					required: true,
					minlength: 2,
					url: true
				}
			},
			messages: {
				txtArtist: {
					required: "El nombre del actor es requerido.",
					minlength: "Se requieren mínimo 2 caracteres."
				},
				txtTrack: {
					required: "El apellido del actor es requerido.",
					minlength: "Se requieren mínimo 2 caracteres."
				},
				txtLink: {
					required: "El apellido del actor es requerido.",
					minlength: "Se requieren mínimo 2 caracteres.",
					url: "el campo debe ser una url valida"
				}
			}
		});

		$( "#btnGuardarCancion" ).click(function() {
			if (form.valid()) {
				song.guardar();
				song.listar();
			};
		});

		$("#btnActualizarCancion").on("click", function(){
			// song.actualizar();
		});

	},

	guardar: function(){

		var Artist = $("#txtArtist").val();
		var Track = $("#txtTrack").val();
		var Link = $("#txtLink").val();

		$.ajax({
			url: url+"songs/guardar",
			type: 'POST',
			dataType: 'json',
			data: {Accion: 'guardar', Artist: Artist, Track: Track, Link: Link },
		})
		.done(function(respuesta) {

			if (respuesta.mensaje) {
				alertify.success("Canción creada :)");
			}else{
				alertify.error("Opps!! Ha ocurrido un error :)");
			}
		})
		.fail(function(error) {
			console.log(error);
		});
		
	},

	listar: function(){


		$.ajax({
			url: url+"songs/listar",
			type: 'POST',
			dataType: 'json'
		})
		.done(function(respuesta) {


			var tblSongs = $("#tblSongs").dataTable();
			tblSongs.fnClearTable();
			tblSongs.fnDestroy();

			$.each( respuesta, function( i, item ) {
				$("#tbodySongs").append(tmpl("tmpl-data-song", item));
			});

			tblSongs = $('#tblSongs').dataTable({
				"language": {
					"url": url+"js/plugins/datatables/Spanish.json"
				}
			});



		})
		.fail(function(error) {
			console.log(error);
		});


	}

};