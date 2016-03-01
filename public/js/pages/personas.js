jQuery(document).ready(function($) {
	personas.init();
});

var personas = {
	init : function(){

		$( "#btnAbrirModal" ).click(function() {
			personas.clean();
			$('#myModal').modal('show');
		});

		$( "#btnGuardar" ).click(function() {
			personas.save();
		});

		$( "#btnModificar" ).click(function() {
			personas.modify();
		});
	},
	save : function(){

		$.ajax({
			url: url+'/personas/guardar',
			type: 'POST',
			data: new FormData( document.getElementById("frmPersona") ),
			processData: false,
			dataType:'json',
			contentType: false
		}).done(function(response){

			if (response) {
				alert("Guardo");
				window.location.reload();
			};

		}).fail(function(response){

			console.log(response);

		});
	},
	modify : function(){

		$.ajax({
			url: url+'/personas/modificar',
			type: 'POST',
			data: new FormData( document.getElementById("frmPersona") ),
			processData: false,
			dataType:'json',
			contentType: false
		}).done(function(response){

			if (response) {
				alert("Modificar");
				window.location.reload();
			};

		}).fail(function(response){

			console.log(response);

		});
	},
	edit: function(persona) {
		console.log(persona);

		$("#txtId").val(persona.id);
		$("#txtNombre").val(persona.nombre);
		$("#txtApellido").val(persona.apellido);
		$("#txtEdad").val(persona.edad);

		$( "#btnGuardar" ).css("display", "none");
		$( "#btnModificar" ).css("display", "block");
		$('#myModal').modal('show');
	},
	clean: function(){

		$("#txtId").val("");
		$("#txtNombre").val("");
		$("#txtApellido").val("");
		$("#txtEdad").val("");

		$( "#btnGuardar" ).css("display", "block");
		$( "#btnModificar" ).css("display", "none");
	}
}