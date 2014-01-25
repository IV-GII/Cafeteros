<?php

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Cafeteros">
    <link rel="shortcut icon" href="./img/favicon.ico" />
    <!-- <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png"> -->

    <title>Cafeteros v 1.0</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <nav class="navbar navbar-default" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><img src="img/logo_tu_cafe_online_nav_peq.png"></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href=".main.php">Estado</a></li>
        <li><a href=".mantenimiento.php">Mantenimiento</a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Nombre Usuario<b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="#">Cerrar Sesión</a></li>
          </ul>
        </li>
      </ul>

    </div><!-- /.navbar-collapse -->
  </nav>
  <div class="container-fluid">
    <div class="row-fluid">

      <div class= "span3">
        <ul class="nav nav-pills nav-stacked">
          <li class="active"><a href="#">Máquina uno COD MAQUINA</a></li>
          <li><a href="#">Máquina dos COD MAQUINA</a></li>
          <li><a href="#">Máquina tres COD MAQUINA</a></li>
        </ul>
      </div>
      

      <div class= "span9">
        <div class="panel panel-success">
          <div class="panel-heading">
            <h3 class="panel-title">Código Máquina 1</h3>
          </div>
          <div class="panel-body">
            Aquí primera máquina de café.
            En esta máquina todo esta OK. VERDE.
          </div>
        </div>

        <div class="panel panel-warning">
          <div class="panel-heading">
            <h3 class="panel-title">Código Máquina 2</h3>
          </div>
          <div class="panel-body">
            Aquí segunda máquina de café.
            En esta máquina hay algo que revisar. AMARILLO.
          </div>
          
        </div>

        <div class="panel panel-danger">
          <div class="panel-heading">
            <h3 class="panel-title">Código Máquina 3</h3>
          </div>
          <div class="panel-body">
            Aquí tercera máquina de café.
            En esta máquina hay algo mal. ROJO.
          </div>
         
        </div>
      </div>

    </div>
  </div>


  
  

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
