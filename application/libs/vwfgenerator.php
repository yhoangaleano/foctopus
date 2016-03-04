
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="../../favicon.ico">

  <title>FOctopus</title>
  <!-- css -->
  <link href="<?php echo URL; ?>css/bootstrap.min.css" rel="stylesheet">

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
        <a class="navbar-brand" href="#">FOctopus - FGenerator</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
          <li><a href="#">Link</a></li>
          
        </ul>
        
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#">Link</a></li>
          
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>

  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-12">
        <h1 class="page-header">Auto Generador Código</h1>
        <form action="fgenerator/create" method="post">
          <div class="form-group">
            <select name="table" class="form-control">
              <option value="">Seleccione Tabla</option>
              <?php echo $table; ?>
            </select>
          </div>
          
          <div class="form-group">
            <select name="template" class="form-control">
              <option value="">Seleccione un template</option>
              <option value="MVC_GET_POST">Metodos HTTP (GET, POST)</option>
            </select>
          </div>

          <button type="submit" class="btn btn-success">Crear Crud</button>
        </form>
      </div>
    </div>
  </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo URL; ?>js/plugins/jquery/jquery.min.js"></script>
    <!-- our JavaScript -->
    <script src="<?php echo URL; ?>js/plugins/bootstrap/bootstrap.min.js"></script>
  </body>
  </html>