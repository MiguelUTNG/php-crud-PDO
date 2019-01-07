<?php
  session_start();

  require '../../controller/database.php';
  require '../../Clases/Maestro.php';
  require '../../Clases/MaestroModel.php';
  
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
  $alm = new Maestro();
  $model = new MaestroModel();
  if(isset($_REQUEST['action']))
  {
      switch($_REQUEST['action'])
      {
          case 'actualizar':
              $alm->__SET('id',              $_REQUEST['id']);
              $alm->__SET('Nombre',          $_REQUEST['Nombre']);
              $alm->__SET('Apellido',        $_REQUEST['Apellido']);
              $alm->__SET('Telefono',        $_REQUEST['Telefono']);
              $alm->__SET('Materia',         $_REQUEST['Materia']);
              $model->Actualizar($alm);
              break;
          case 'registrar':
              $alm->__SET('Nombre',          $_REQUEST['Nombre']);
              $alm->__SET('Apellido',        $_REQUEST['Apellido']);
              $alm->__SET('Telefono',        $_REQUEST['Telefono']);
              $alm->__SET('Materia',         $_REQUEST['Materia']);
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
    <script type="text/javascript">
          function marcar(source) 
	    {
		checkboxes=document.getElementsByTagName('input'); //obtenemos todos los controles del tipo Input
		for(i=0;i<checkboxes.length;i++) //recoremos todos los controles
		{
			if(checkboxes[i].type == "checkbox") //solo si es un checkbox entramos
			{
				checkboxes[i].checked=source.checked; //si es un checkbox le damos el valor del checkbox que lo llamó (Marcar/Desmarcar Todos)
			}
		}
	    }
    </script>
    <body >
    <input type="checkbox" onclick="marcar(this);" /> Marcar/Desmarcar Todos
    <div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="assets/img/sidebar-5.jpg">
    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="header.php" class="simple-text">
                   Dashboard
                </a>
            </div>
            <ul class="nav">
                <li class="active">
                    <a href="alumnos.php">
                        <i class="pe-7s-user"></i>
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
                                <h4 class="title">Maestros</h4>
                            </div>
                            <div class="content">
                                
                                <div class="footer">
                                <form action="?action=<?php echo $alm->id > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" >
                    <input type="hidden" name="id" value="<?php echo $alm->__GET('id'); ?>" />
                    <table >
                        <tr>
                            <th >Nombre</th>
                            <td><input type="text" name="Nombre" value="<?php echo $alm->__GET('Nombre'); ?>"  /></td>
                        </tr>
                        <tr>
                            <th >Apellido</th>
                            <td><input type="text" name="Apellido" value="<?php echo $alm->__GET('Apellido'); ?>"  /></td>
                        </tr>
                        <tr>
                            <th >Telefono</th>
                                    <td><input type="number" name="Telefono" value="<?php echo $alm->__GET('Telefono'); ?>"  /></td>
                        </tr>
                        <tr>
                            <th >Materia</th>
                            <td><input type="text" name="Materia" value="<?php echo $alm->__GET('Materia'); ?>"  /></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <button type="submit" class="pure-button pure-button-primary">Guardar</button>
                            </td>
                        </tr>
                    </table>
                </form>
                <table class="pure-table pure-table-horizontal">
                    <thead>
                        <tr>
                            <th></th>
                            <th >Nombre</th>
                            <th >Apellido</th>
                            <th >Telefono</th>
                            <th >Materia</th>
                            <th></th><th></th>
                        </tr>
                    </thead>
                    <?php foreach($model->Listar() as $r): ?>
                        <tr>
                            <th> 
                                <input type="checkbox" id="setting-5" class="settings"/>
                            </th>
                            <td><?php echo $r->__GET('Nombre');  ?></td>
                            <td><?php echo $r->__GET('Apellido');?></td>
                            <td><?php echo $r->__GET('Telefono');?></td>
                            <td><?php echo $r->__GET('Materia'); ?></td>
                            <td>
                                <a href="?action=editar&id=<?php echo $r->id; ?>">Editar</a>
                            </td>
                            <td>
                                <a href="?action=eliminar&id=<?php echo $r->id; ?>">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>     
            </div>
        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>