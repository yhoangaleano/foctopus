<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA | Login</title>

    <link href="<?php echo URL; ?>inspina/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo URL; ?>inspina/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo URL; ?>inspina/css/animate.css" rel="stylesheet">
    <link href="<?php echo URL; ?>inspina/css/style.css" rel="stylesheet">
      <link href="<?php echo URL; ?>css/alertify.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">OCT</h1>

            </div>
            <h3>Bienvenido a OctopusApp</h3>
            <p>EL multitarea que le facilitará los procesos administrativos y contables de su propiedad horizontal
                <!--Continually expanded and constantly improved Inspinia Admin Them (IN+)-->
            </p>
            <p>Iniciar Sesión</p>
            <div id="content">
                <?php require content; ?>
            </div>

            <p class="m-t"> <small>Octopus una idea que revolucionara la administracion de la propiedad horizontal</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="<?php echo URL; ?>inspina/js/jquery-2.1.1.js"></script>
    <script src="<?php echo URL; ?>inspina/js/bootstrap.min.js"></script>
    <script src="<?php echo URL; ?>js/plugins/alertify/alertify.js"></script>
    <script src="<?php echo URL; ?>js/plugins/jquery.validator/jquery.validate.min.js"></script>

</body>
<script>
var url = "<?php echo URL; ?>inspina/";
</script>

<?php 
if (isset($js)) {
    echo $js;
};

?>
</html>
