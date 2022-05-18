<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

<script>let dataText = '<?php echo $mData ?>';</script>
</head>
<body>
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
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="toolsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Sistema</a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="?create_user">Crear usuario</a></li>
            <li><a class="dropdown-item" href="#">Analizar tabla</a></li>
          </ul>
        </li>
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
    if (!isset($_SESSION['userUUID']) && api("users", "total") > 0)
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
						<input autocomplete='username' name='user' type="text" class="form-control" required="required">
					</div>
					<div class="form-group">
						<div class="clearfix">
							<label>Contraseña</label>
							
						</div>
						<input autocomplete='password' name='password' type="password" class="form-control" required="required">
					</div>
					<div class='login_error'><?php echo @$login_error ?></div>		
				</div>
				<div class="modal-footer justify-content-between">
					<label class="form-check-label"><input type="checkbox"> Recuerdame</label>
					<input type="submit" class="btn btn-success" value="Entrar">
				</div>
			</form>
		</div>
	</div>
</div>    

<input type="submit" class="btn btn-success" value="Entrar">
<script>
  var myModal = new bootstrap.Modal(document.getElementById('myModal'), {
    backdrop: "static"
  })

  myModal.show(); 
</script>

<?php } elseif (!isset($_SESSION['userUUID']) && api("users", "total") == 0 || @array_keys($_GET)[0] == "create_user" ) {

?>
  <div id="myModal" class="modal fade" data-backdrop="static">
	<div class="modal-dialog modal-login">
		<div class="modal-content">
			<form id='createUserForm' action="?gen_user" method="post">
				<div class="modal-header">				
					<h4 class="modal-title">Instalacion</h4>
				</div>
				<div class="modal-body">				
					<div class="form-group">
						<label>Crear Usuario</label>
						<input name='user' autocomplete='username' type="text" class="form-control" required="required">
					</div>
					<div class="form-group">
						<div class="clearfix">
							<label>Crear Contraseña</label>
						</div>
						<input name='password' autocomplete='new-password' type="password" class="form-control" required="required">
					</div>
          <div class="form-group">
						<div class="clearfix">
							<label>Repetir Contraseña</label>
						</div>
						<input name='password2' autocomplete='new-password' type="password" class="form-control" required="required">
					</div>
				</div>
				<div class="modal-footer">
          <label>Crear usuario principal</label>
		  			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<input type="submit" class="btn btn-success" value="Crear">
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
