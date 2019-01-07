<?php
  session_start();

  require '../../controller/database.php';
  require '../../Clases/Alumno.php';
  require '../../Clases/AlumnoModel.php';
  
  if (isset($_SESSION['user_id'])) {
    $query = "SELECT id, email, password FROM USERS WHERE id ='".$_SESSION['user_id']."'";
    $consul = mysqli_query($conn, $query);
    $results = mysqli_fetch_array($consul);
  }
  else{
    header('Location: ../login.php');  
  }
  $user = null;
  if (count($results) > 0) {
    $user = $results;
  } 

  // Logica
  $alm = new Alumno();
  $model = new AlumnoModel();
  if(isset($_REQUEST['action']))
  {
      switch($_REQUEST['action'])
      {
          case 'actualizar':
              $alm->__SET('id',              $_REQUEST['id']);
              $alm->__SET('Nombre',          $_REQUEST['Nombre']);
              $alm->__SET('Apellido',        $_REQUEST['Apellido']);
              $alm->__SET('Sexo',            $_REQUEST['Sexo']);
              $alm->__SET('FechaNacimiento', $_REQUEST['FechaNacimiento']);
              $model->Actualizar($alm);
              break;
          case 'registrar':
              $alm->__SET('Nombre',          $_REQUEST['Nombre']);
              $alm->__SET('Apellido',        $_REQUEST['Apellido']);
              $alm->__SET('Sexo',            $_REQUEST['Sexo']);
              $alm->__SET('FechaNacimiento', $_REQUEST['FechaNacimiento']);
              $model->Registrar($alm);
              break;
          case 'eliminar':
              $model->Eliminar($_REQUEST['id']);
              break;
          case 'editar':
              $alm = $model->Obtener($_REQUEST['id']);
              break;
      }
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
    <meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
    <title>Anexsoft</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>
    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
    </head>
    <body >

    <div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="assets/img/sidebar-5.jpg">
    	<div class="sidebar-wrapper">
            <div class="logo">
                <a  class="simple-text">Dashboard</a>
            </div>

            <ul class="nav">
                <li class="active">
                    <a href="alumnos.php">
                        <i class="pe-7s-graph"></i>
                        <p>Alumnos</p>
                    </a>
                </li>
                <li>
                    <a href="maestros.php">
                        <i class="pe-7s-user"></i>
                        <p>Maestros</p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-dashboard"></i>
								<p class="hidden-lg hidden-md">Dashboard</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="../logout.php">
                                <p>Log out</p>
                            </a>
                        </li>
						<li class="separator hidden-lg"></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Dashboard</h4>
                            </div>
                            <div class="content">
                                
                               
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>