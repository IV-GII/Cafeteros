<!-- Copyright 2014 Jose Miguel Colella Carbonara, 
          Javier Collado López, 
          Antonio Ángel Guirola Vicente, 
          Sergio Muñoz Gamarra, 
          Francisco Ruíz López.

  This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>. -->
    
<?php
  session_start();
  ini_set ("display_errors","1" );
  error_reporting(E_ALL);
  require_once "conexion_mysqli.php";
  if(!isset($_SESSION["username"])){
    if (isset($_POST['usuario'])){
      $user = $_POST['usuario'];
    }
    if (isset($_POST['password'])){
      $password= $_POST['password']; 
    }
    if(consultarUsuario($user, $password)){
      $_SESSION['username']=$user;
    }else{
      printf('<div class="alert alert-danger"></div>');
      header("Location: index.php");
    }
  }

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
    <link href="css/main.css" rel="stylesheet">

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
      <a class="navbar-brand" id="logo" href="#"><img id = "imagen_sin_padding" src="img/logo_tu_cafe_online_nav_peq.png"></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="main.php">Estado</a></li>
        <li><a href="mantenimiento.php">Mantenimiento</a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"> <?php printf($_SESSION["username"]); ?></a></li>
        <li><a href="cerrar_sesion.php"> Cerrar Sesión</a></li>
      </ul>

    </div><!-- /.navbar-collapse -->
  </nav>
  <div id="contenedor_margen">
    <div class="row">

       <div class= "col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <ul class="nav nav-pills nav-stacked">
        <?php
          ini_set ("display_errors","1" );
          error_reporting(E_ALL);
          require_once "conexion_mysqli.php";
          $lista=consultarCodigosMaquinas();
          printf($lista);
        ?>
        </ul>
      </div>


      <div class= "col-lg-10 col-md-10 col-sm-10 col-xs-12">
        <div class="panel panel-success">
          <div class="panel-heading">
            <h3 class="panel-title">
              M&aacute;quina 0
            </h3>
          </div>
          <div class="panel-body">
              <div class="row">

                <div class= "col-lg-4 col-md-4 col-sm-4 col-xs-12">
                  <div class="panel panel-info">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        Información de Máquina
                      </h4>
                    </div>
                    <div class="panel-body">
                      <?php
                        ini_set ("display_errors","1" );
                        error_reporting(E_ALL);
                        require_once "conexion_mysqli.php";
                        $lista=consultarMaquina(0);
                        printf($lista);
                      ?>
                    </div>
                  </div>
                </div>

                <div class= "col-lg-4 col-md-4 col-sm-4 col-xs-12">
                  <div class="panel panel-info">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        Conteo pulsación teclas
                      </h4>
                    </div>
                    <div class="panel-body">
                      <?php
                        ini_set ("display_errors","1" );
                        error_reporting(E_ALL);
                        require_once "conexion_mysqli.php";
                        $botones= obtenerTablaBotones(0);
                        printf($botones);
                      ?>
                    </div>
                  </div>

            </div>
          </div>
        </div>

        <div class="panel panel-warning">
          <div class="panel-heading">
            <h3 class="panel-title">M&aacute;quina 1</h3>
          </div>
          <div class="panel-body">
            <div class="row">

                <div class= "col-lg-4 col-md-4 col-sm-4 col-xs-12">
                  <div class="panel panel-info">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        Información de Máquina
                      </h4>
                    </div>
                    <div class="panel-body">
                      <?php
                        ini_set ("display_errors","1" );
                        error_reporting(E_ALL);
                        require_once "conexion_mysqli.php";
                        $lista=consultarMaquina(1);
                        printf($lista);
                      ?>
                    </div>
                  </div>
                </div>

                <div class= "col-lg-4 col-md-4 col-sm-4 col-xs-12">
                  <div class="panel panel-info">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        Conteo pulsación teclas
                      </h4>
                    </div>
                    <div class="panel-body">
                      <?php
                        ini_set ("display_errors","1" );
                        error_reporting(E_ALL);
                        require_once "conexion_mysqli.php";
                        $botones= obtenerTablaBotones(1);
                        printf($botones);
                      ?>
                    </div>
                  </div>
                </div>

            </div>
          </div>

        </div>

        <div class="panel panel-danger">
          <div class="panel-heading">
            <h3 class="panel-title">Máquina 3</h3>
          </div>
          <div class="panel-body">
            <div class="row">

                <div class= "col-lg-4 col-md-4 col-sm-4 col-xs-12">
                  <div class="panel panel-info">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        Información de Máquina
                      </h4>
                    </div>
                    <div class="panel-body">
                      <?php
                        ini_set ("display_errors","1" );
                        error_reporting(E_ALL);
                        require_once "conexion_mysqli.php";
                        $lista=consultarMaquina(0);
                        printf($lista);
                      ?>
                    </div>
                  </div>
                </div>

                <div class= "col-lg-4 col-md-4 col-sm-4 col-xs-12">
                  <div class="panel panel-info">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        Conteo pulsación teclas
                      </h4>
                    </div>
                    <div class="panel-body">
                      <?php
                        ini_set ("display_errors","1" );
                        error_reporting(E_ALL);
                        require_once "conexion_mysqli.php";
                        $botones= obtenerTablaBotones(0);
                        printf($botones);
                      ?>
                    </div>
                  </div>
                </div>

            </div>
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
