jQuery(document).ready(function() {
	song.init();
	song.getAll();
});

var song = {
	init: function(){
		var form = $("#formSong");

		$("#btnGuardar").click(function() {
			if (form.valid()) {
				song.add();
			};
		});

		$("#btnLimpiar").on("click", function(){
			form.trigger("reset");
		});

	},

	add: function(){
		var form = $("#formSong");
		var fd = new FormData(form[0]);
		fd.append("action", "add");

		$.ajax({
			url: url+"song/addSong",
			type: 'POST',
			dataType: 'json',
			data: fd,
			processData: false,
			contentType: false
		})
		.done(function(respuesta) {
			if (respuesta.result) {
				alertify.success("Buen trabajo! La ha sido creada con éxito.");
				form.trigger("reset");
				song.getAll();
			}else{
				alertify.error("Ohh no!! Ha ocurrido un error al crear");
			}
		})
		.fail(function(error) {
			console.log(error);
		});

	},

	getAll: function(){
		$.ajax({
			url: url+"song/getAllSong",
			type: 'POST',
			dataType: 'json'
		})
		.done(function(respuesta) {
			var tblSong = $("#tblSong").dataTable();
			tblSong.fnClearTable();
			tblSong.fnDestroy();
			$.each( respuesta, function( i, item ) {
				$("#tbodySong").append(tmpl("tmpl-data-song", item));
			});
			tblSong = $('#tblSong').dataTable({
				"language": {
					"url": url+"js/plugins/datatables/Spanish.json"
				}
			});
		})
		.fail(function(error) {
			console.log(error);
		})
	}
}
