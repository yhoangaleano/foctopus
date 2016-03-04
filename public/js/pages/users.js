jQuery(document).ready(function() {
	login.init();
});


var login = {

	init: function(){


		$( "#btnInit" ).click(function() {
			debugger;
				login.iniciar();
		});

	},

	iniciar: function(){

		var user = $("#txtUsername").val();
		var pass = $("#txtPassword").val();

		$.ajax({
			url: url+"usuarios/login",
			type: 'POST',
			dataType: 'json',
			data: {username: user, password: pass },
		})
		.done(function(respuesta) {
debugger;
console.log(respuesta);
			alertify.success(respuesta.username + " " + respuesta.password);
			
		})
		.fail(function(error) {
			console.log(error);
		});
		
	}
};