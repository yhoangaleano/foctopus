<form id="login" action="/foctopus/usuarios/login" method="POST">
    <div class="form-group">
        <input type="email" class="form-control" placeholder="Username" required="" id="txtUsername" name="txtUsername">
    </div>
    <div class="form-group">
        <input type="password" class="form-control" placeholder="Password" required="" id="txtPassword" name="txtPassword">
    </div>
    <button type="submit" class="btn btn-primary block full-width m-b" id="btnInit">Login</button>
    <p><?php if (isset($_GET["error"])) {
    	echo "Ocurrio un error con las credenciales";
    } ?></p>
</form>

<?php

$js = '<script src="'.URL.'js/pages/users.js" type="text/javascript"></script>';


?>