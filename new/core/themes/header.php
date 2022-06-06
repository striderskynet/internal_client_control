<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <title>Endirecto</title>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <meta name="description" content='Client management system for Tourist Enterprises'>
  <link href="./assets/css/font.awesome.min.css" rel="stylesheet"/>
 
  
  <!-- Material Design Bootstrap -->
  <!--<link href="./assets/css/mdb.min.css" rel="stylesheet" />
  <link href="./assets/css/mdb.css" rel="stylesheet" />-->
  <link href="./assets/css/bootstrap.5.css" rel="stylesheet" />
  <link href="./assets/css/main.css" rel="stylesheet" />
  <link href="./assets/css/flags.css" rel="stylesheet" />
  <link href="./assets/css/font.google.css" rel="stylesheet"/>

  <script type="text/javascript" src="./assets/js/jquery.min.js"></script>
  <script type="text/javascript" src="./assets/js/popper.min.js"></script>
	<script type="text/javascript" src="./assets/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="./assets/js/bootstrap-autocomplete.js" defer></script>
  <script type="text/javascript" src="./assets/js/jquery.bootstrap-growl.js" defer></script>
  <script type="text/javascript" src="./assets/js/chart.min.js" defer></script>

</head>
<body>

<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
  <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
  </symbol>
  <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
  </symbol>
  <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </symbol>
</svg>


<nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
    <div class="container-fluid"><button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle me-3" type="button"><i class="fas fa-bars"></i></button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <a class="navbar-brand" href="#?panel" alt='Inicio' title='Inicio' aria-label="Inicio"><i class="fa fa-plane text-primary fa-2x" aria-hidden="true"></i></a>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <?php if ( _DEBUG ) {?><li class="nav-item">
            <a class="nav-link" id='nav_link_panel' href="?panel">Panel</a>
          </li>
          <?php } ?>
          <li class="nav-item">
            <a class="nav-link" id='nav_link_clients' href="?clients">Clientes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id='nav_link_voucher' href="?voucher">Reservas</a>
          </li>
        </ul>
      </div>
      <form class="d-none d-sm-inline-block me-auto ms-md-3 my-2 my-md-0 mw-100 navbar-search" name='main_search'>
            <div class="input-group">
            <input class="bg-light form-control border-0 small" type="Search" placeholder="Buscar por ..." name="main_search" id="main_search" aria-label="Search" />
            <button class="btn btn-primary py-0" name="main_search_button" type="button" aria-label="Buscar"><i class="fas fa-search"></i></button></div>
        </form>
        <ul class="navbar-nav flex-nowrap ms-auto">
            <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><i class="fas fa-search"></i></a>
                <div class="dropdown-menu dropdown-menu-end p-3 animated--grow-in" aria-labelledby="searchDropdown">
                    <form class="me-auto navbar-search w-100">
                        <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ..." />
                            <div class="input-group-append"><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                        </div>
                    </form>
                </div>
            </li>
            <!--<li class="nav-item dropdown no-arrow mx-1">
                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-toggle="dropdown" href="#"><span class="badge bg-danger badge-counter">3+</span><i class="fas fa-bell fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-list animated--grow-in">
                        <h6 class="dropdown-header">centro de alertas</h6><a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="me-3">
                                <div class="bg-primary icon-circle"><i class="fas fa-file-alt text-white"></i></div>
                            </div>
                            <div><span class="small text-gray-500">Junio 1, 2022</span>
                                <p>Se ha modificado un cliente que tu agregastes...</p>
                            </div>
                        </a><a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="me-3">
                                <div class="bg-success icon-circle"><i class="fas fa-donate text-white"></i></div>
                            </div>
                            <div><span class="small text-gray-500">Abril 7, 2022</span>
                                <p>Se han agregado varios vouchers desde tu ultimo inicio...</p>
                            </div>
                        </a><a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="me-3">
                                <div class="bg-warning icon-circle"><i class="fas fa-exclamation-triangle text-white"></i></div>
                            </div>
                            <div><span class="small text-gray-500">December 2, 2019</span>
                                <p>Se han eliminado algunos usuarios y reservas que tu creastes...</p>
                            </div>
                        </a><a class="dropdown-item text-center small text-gray-500" href="#">Todas las alertas</a>
                    </div>
                </div>
            </li>-->
            <div class="d-none d-sm-block topbar-divider"></div>
            <li class="nav-item dropdown no-arrow">
                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-toggle="dropdown" href="#"><span class="d-none d-lg-inline me-2 text-gray-600 small"><?php echo @ucfirst($_SESSION['USERID']) ?></span><!--<img class="border rounded-circle img-profile" src="avatars/avatar1.jpeg" />--><i class="fas fa-user-alt"></i></a>
                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in">
                    <!--<a class="dropdown-item" href="#"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i> Perfil</a>
                    <a class="dropdown-item" href="#"><i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i> Registro</a>-->
                    <a class="dropdown-item dropdown no-arrow" data-toggle="dropdown" href="#"><i class="fas fa-list fa-sm fa-fw me-2 text-gray-400"></i> Ajustes</a>
                    <ul class="dropdown-menu dropdown-submenu dropdown-submenu-left">
                        <li><a class="dropdown-item" href="#"><input class="form-check-input" type="checkbox" value="" name='small_table_value' id="small_table_value" />
                        <label class="form-check-label" for="small_table_value">Tabla peque&ntilde;a</label></a></li>
                    </ul>
                    <div class="dropdown-divider"></div>
                    <a id='logout_button' class="dropdown-item" href="#"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i> Logout</a>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>

<div class="p-4">
    <h1 class="" id='position_title'>Listado de Clientes</h1>
    <!-- Breadcrumb -->
    <nav class="d-flex">
    <a href="" class="text-reset">Inicio</a>&nbsp;&nbsp;/&nbsp;&nbsp;<a href="" class="text-reset"><u id='position_sub_title'>Clientes</u></a>
    </nav>
    <!-- Breadcrumb -->
</div>