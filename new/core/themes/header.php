<!DOCTYPE html>
<html>
<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <title>Endirecto</title>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link href="./assets/css/font.awesome.min.css" rel="stylesheet"/>
  <link href="./assets/css/font.google.css" rel="stylesheet"/>
  
  <!-- Material Design Bootstrap -->
  <!--<link href="./assets/css/mdb.min.css" rel="stylesheet" />
  <link href="./assets/css/mdb.css" rel="stylesheet" />-->
  <link href="./assets/css/bootstrap.css" rel="stylesheet" />
  <link href="./assets/css/main.css" rel="stylesheet" />
  <link href="./assets/css/flags.css" rel="stylesheet" />

  <script type="text/javascript" src="./assets/js/jquery.min.js"></script>
  <script type="text/javascript" src="./assets/js/popper.min.js"></script>
	<script type="text/javascript" src="./assets/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="./assets/js/bootstrap-autocomplete.js"></script>
  <script type="text/javascript" src="./assets/js/jquery.bootstrap-growl.js"></script>

</head>
<body>

<nav class="navbar navbar-expand-lg sticky-top navbar-light bg-light shadow-box">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><i class="fa fa-plane text-primary fa-2x" aria-hidden="true"></i></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <!--<li class="nav-item">
          <a class="nav-link" id='nav_link_panel' href="?">Panel</a>
        </li>-->
        <li class="nav-item">
          <a class="nav-link" id='nav_link_clients' href="?clients">Clientes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id='nav_link_voucher' href="?voucher">Reservas</a>
        </li>
      </ul>
    </div>
          <form class="d-flex" name='main_search'>
              <input class="form-control no-right-round" type="search" placeholder="Buscar" name="main_search" id="main_search" aria-label="Search" />
              <button type="button" class="btn btn-primary no-left-round"><i class="fas fa-search"></i></button>
          </form>
          <div class="nav-item dropdown">
            <a class="nav-link dropdown hidden-arrow" href="#" id="userDropDown" role="button" data-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-user-circle fa-2x"></i></a>

            <ul class="dropdown-menu left-100" aria-labelledby="navbarDropdownMenuAvatar">
                <li><a class="dropdown-item" href="#"><?php echo @ucfirst($_SESSION['USERID']) ?></a></li>
                <li><a class="dropdown-item" href="#" >Ajustes &raquo;</a>
                <ul class="dropdown-menu dropdown-submenu dropdown-submenu-left">
                    <li><a class="dropdown-item" href="#"><input class="form-check-input" type="checkbox" value="" name='small_table_value' id="small_table_value" />
                    <label class="form-check-label" for="small_table_value">Small table</label></a></li>
                </ul>
                </li>
                <li><hr class="dropdown-divider" /></li>
                <li><a id='logout_button' class="dropdown-item" href="#"><i style='float:right; margin-top: 5px;' class="fas fa-sign-out-alt"></i>Salir </a></li>
            </ul>
          </div>
  </div>
</nav>
   
<div class="p-4 bg-light mb-4">
    <h1 class="" id='position_title'>Listado de Clientes</h1>
    <!-- Breadcrumb -->
    <nav class="d-flex">
    <h6 class="mb-0"><a href="" class="text-reset">Inicio</a><span> / </span><a href="" class="text-reset"><u id='position_sub_title'>Clientes</u></a></h6>
    </nav>
    <!-- Breadcrumb -->
</div>