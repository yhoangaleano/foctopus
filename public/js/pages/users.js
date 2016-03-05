jQuery(document).ready(function() {
	login.init();
});


var login = {

	init: function(){


		$( "#btnInit" ).click(function() {
			login.iniciar();
		});

	},

	iniciar: function(){

		var user = $("#txtUsername").val();
		var pass = $("#txtPassword").val();

		$.ajax({
			url: "/foctopus/usuarios/login",
			type: 'POST',
			dataType: 'json',
			data: {username: user, password: pass },
		})
		.done(function(respuesta) {
			console.log(respuesta);
			
		})
		.fail(function(error) {
			console.log(error);
		});
		
	}
};