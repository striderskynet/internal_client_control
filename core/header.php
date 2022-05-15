<?php
     if ($_DEBUG == true)
     //require_once ("static/debug.js")
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if ($_DEBUG == true) { ?>
        <meta http-equiv="refresh" content="5; URL=<?php echo $_ADDRESS ?>">
    <?php } ?>
    <title><?php echo $cfg['title'] ?> - Listado de Clientes</title>    
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="assets/css/bootstrap-datepicker.min.css" type="text/css" />
<link rel="stylesheet" href="assets/css/font-awesome.min.css" type="text/css" />
<link rel="stylesheet" href="assets/css/bootstrap-select-country.min.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/flexbox.css">

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/bootstrap-datepicker.min.js"></script>
<script src="assets/js/plugins/jquery-validation/localization/messages_es.min.js"></script>

   <?php if (@isset($_SESSION['userUUID'])) { ?>
    <script>
        let dataText = '<?php echo str_replace("\\\"", "", json_encode(json_decode(file_get_contents($cfg['database']))))?>';
    </script>
    <?php } ?>
    <style>
        body
        {
            margin: 10px;
        }

        .body{
          margin-left: 30px;
          margin-right: 30px;
        }
        
        .rightLabel
        {
            font-weight: bold;
            margin: 0px 10px 0px 5px;
            /*border: 1px solid #ddd;
            padding: 5px 20px 5px 10px;
            border-radius: 5px;
            background: #eee;*/

            border-bottom: 1px dotted #333;
        }

        .clientCard .form-group{
           margin-top: 10px;
        }

        .button-left
        {
            position: absolute;
            float: left;
            left: 20px;
        }
        
    </style>
</head>
<body>

<?php
  function is_active($id)
  {
    if ($id == "main" & !isset(array_keys($_GET)[0]))
    {
     // php_info();
      return "active";
    }
    elseif ( isset($_GET) )
    {
      if (@array_keys($_GET)[0] == $id)
        return "active";
    }
      return "";
  }
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="/"><?php echo $cfg['title'] ?></a>
        
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link <?php echo is_active('main')?>" aria-current="page" href="<?php echo $_ADDRESS ?>">Clientes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo is_active('reservas')?>" href="<?php echo $_ADDRESS ?>?reservas">Reservas</a>
        </li>
        <li class="nav-item">
        </li>
        <!--<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Herramientas
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#"></a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="?lista_de_reserva">Actualizar tabla de Reservas</a></li>
          </ul>
        </li>
-->
      </ul>
      
      <?php if (@isset($_SESSION['userUUID']))
      { ?>
      <a class="nav-link" style='color: #fff;' ><?php echo $_SESSION['userUUID']['username'] . " [" . $_SESSION['userUUID']['category'] . "]"?></a>
      <button class="btn btn-danger" onClick="goTo('<?php echo $_ADDRESS ?>/?logout')">Salir</button>
      <?php } ?>
    </div>
  </div>
</nav>
    <Br>
  <div class='body'>
<?php 
    if (!isset($_SESSION['userUUID']) && file_exists($cfg['users']))
    {
?>
<div id="myModal" class="modal fade" data-backdrop="static">
	<div class="modal-dialog modal-login">
		<div class="modal-content">
			<form action="" method="post">
				<div class="modal-header">				
					<h4 class="modal-title">Login</h4>
				</div>
				<div class="modal-body">				
					<div class="form-group">
						<label>Usuario</label>
						<input name='user' type="text" class="form-control" required="required">
					</div>
					<div class="form-group">
						<div class="clearfix">
							<label>Contraseña</label>

						</div>
						
						<input name='password' type="password" class="form-control" required="required">
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<label class="form-check-label"><input type="checkbox"> Recuerdame</label>
					<input type="submit" class="btn btn-primary" value="Entrar">
				</div>
			</form>
		</div>
	</div>
</div>    



<script>
var myModal = new bootstrap.Modal(document.getElementById('myModal'), {
  backdrop: "static"
})

myModal.show(); 
</script>
<?php } elseif (!isset($_SESSION['userUUID']) && !file_exists($cfg['users'])) { ?>
  <div id="myModal" class="modal fade" data-backdrop="static">
	<div class="modal-dialog modal-login">
		<div class="modal-content">
			<form action="?gen_user" method="post">
				<div class="modal-header">				
					<h4 class="modal-title">Instalacion</h4>
				</div>
				<div class="modal-body">				
					<div class="form-group">
						<label>Crear Usuario</label>
						<input name='user' type="text" class="form-control" required="required">
					</div>
					<div class="form-group">
						<div class="clearfix">
							<label>Crear Contraseña</label>
						</div>
						<input name='password' type="password" class="form-control" required="required">
					</div>
          <div class="form-group">
						<div class="clearfix">
							<label>Repetir Contraseña</label>
						</div>
						<input name='password2' type="password" class="form-control" required="required">
					</div>
				</div>
				<div class="modal-footer">
					
					<input type="submit" class="btn btn-primary" value="Crear">
				</div>
			</form>
		</div>
	</div>
</div>    



<script>
var myModal = new bootstrap.Modal(document.getElementById('myModal'), {
  backdrop: "static"
})

myModal.show(); 
</script>
<?php } ?>
