<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta name="description" content="">
  <meta name="author" content="">

  <title>Ejemplo</title>


  <link href="<?php echo URL; ?>css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo URL; ?>css/alertify.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/t/bs/dt-1.10.11/datatables.min.css"/>

  <style>
    .panel > .dataTables_wrapper {
      padding: 15px;
    }    
  </style>



</head>

<body>

  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Brand</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
          <li><a href="#">Link</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#">Action</a></li>
              <li><a href="#">Another action</a></li>
              <li><a href="#">Something else here</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="#">Separated link</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="#">One more separated link</a></li>
            </ul>
          </li>
        </ul>
        <form class="navbar-form navbar-left" role="search">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
          </div>
          <button type="submit" class="btn btn-default">Submit</button>
        </form>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#">Link</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#">Action</a></li>
              <li><a href="#">Another action</a></li>
              <li><a href="#">Something else here</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="#">Separated link</a></li>
            </ul>
          </li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>

  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <?php require content; ?>
      </div>
    </div>
  </div>


  <script>
    var url = "<?php echo URL; ?>";
  </script>

  <script src="<?php echo URL; ?>js/plugins/jquery/jquery.min.js"></script>
  <script src="<?php echo URL; ?>js/plugins/tmpl/tmpl.min.js"></script>
  <script src="<?php echo URL; ?>js/plugins/bootstrap/bootstrap.min.js"></script>
  <script src="<?php echo URL; ?>js/plugins/alertify/alertify.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/t/bs/dt-1.10.11/datatables.min.js"></script>
  <script src="<?php echo URL; ?>js/plugins/jquery.validator/jquery.validate.min.js"></script>

  <?php

  if (isset($template)) {
    echo $template;
  };

  if (isset($js)) {
    echo $js;
  };

  ?>

</body>
</html>
