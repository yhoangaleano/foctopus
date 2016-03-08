<?php if (!isset($_SESSION["rol"]) && !isset($_SESSION["id"])) {
    header("Location:/foctopus/usuarios/index");
} ?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Octopus Software</title>

    <link href="<?php echo URL; ?>inspina/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo URL; ?>inspina/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo URL; ?>inspina/css/animate.css" rel="stylesheet">
    <link href="<?php echo URL; ?>inspina/css/style.css" rel="stylesheet">

    <!-- Mainly scripts -->



</head>

<body>
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="img/profile_small.jpg" />
                        </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $_SESSION["rol"]; ?></strong>
                            </span> <span class="text-muted text-xs block">Octopus <b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="profile.html">Profile</a></li>
                                <li><a href="mailbox.html">Mailbox</a></li>
                                <li class="divider"></li>
                                <li><a href="/foctopus/usuarios/logout">Logout</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            IN+
                        </div>
                    </li>
                    <?php if (isset($_SESSION["rol"]) && $_SESSION["rol"] == "administrador") {
                        # code...
                     ?>
                    <li>
                        <a href="/foctopus/mailing/index"><i class="fa fa-envelope"></i> <span class="nav-label">Generar Email</span><span class="label label-warning pull-right">16/24</span></a>
                    </li>
                    <?php } ?>
                    <li>
                        <a href="widgets.html"><i class="fa fa-flask"></i> <span class="nav-label">Correos Entrantes</span></a>
                    </li>

                    
                </ul>

            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                    
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                        <span class="m-r-sm text-muted welcome-message">Bienvenido a Octopus app.</span>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                <i class="fa fa-envelope"></i>  <span class="label label-warning">16</span>
                            </a>
                            <ul class="dropdown-menu dropdown-messages">
                                <li>
                                    <div class="dropdown-messages-box">
                                        <a href="profile.html" class="pull-left">
                                            <img alt="image" class="img-circle" src="img/a7.jpg">
                                        </a>
                                        <div>
                                            <small class="pull-right">46h ago</small>
                                            <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>. <br>
                                            <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <div class="dropdown-messages-box">
                                        <a href="profile.html" class="pull-left">
                                            <img alt="image" class="img-circle" src="img/a4.jpg">
                                        </a>
                                        <div>
                                            <small class="pull-right text-navy">5h ago</small>
                                            <strong>Chris Johnatan Overtunk</strong> started following <strong>Monica Smith</strong>. <br>
                                            <small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <div class="dropdown-messages-box">
                                        <a href="profile.html" class="pull-left">
                                            <img alt="image" class="img-circle" src="img/profile.jpg">
                                        </a>
                                        <div>
                                            <small class="pull-right">23h ago</small>
                                            <strong>Monica Smith</strong> love <strong>Kim Smith</strong>. <br>
                                            <small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <div class="text-center link-block">
                                        <a href="mailbox.html">
                                            <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>


                        <li>
                            <a href="/foctopus/usuarios/logout">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                        </li>
                    </ul>

                </nav>
            </div>
            <div class="wrapper wrapper-content">
             <?php require content; ?> 
         </div>
         <div class="footer">
            <div>
                <strong>Copyright</strong> Octopus Software
            </div>
        </div>
    </div>    
</div>

<script src="<?php echo URL; ?>inspina/js/jquery-2.1.1.js"></script>
<script src="<?php echo URL; ?>inspina/js/bootstrap.min.js"></script>



<!-- Custom and plugin javascript -->
<script src="<?php echo URL; ?>inspina/js/inspinia.js"></script>
<script src="<?php echo URL; ?>inspina/js/plugins/pace/pace.min.js"></script>

<!-- jQuery UI -->
<script src="<?php echo URL; ?>inspina/js/plugins/jquery-ui/jquery-ui.min.js"></script>

<script src="<?php echo URL; ?>ckeditor/ckeditor.js"></script>
<script src="<?php echo URL; ?>ckeditor/styles.js"></script>
<script src="<?php echo URL; ?>ckeditor/ckfinder/ckfinder.js"></script>


<?php 
if (isset($js)) {
    echo $js;
};

?>

</body>
</html>
