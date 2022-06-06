<?php
session_start();

require_once("./core/config.php");

//Building the website
require_once(_LOCAL . "core/themes/header.php");

if (isset($_SESSION['USERID'])) {
  switch (@array_keys($_GET)[0]) {
    default:
      include_once(_LOCAL . "core/themes/default.php");
      break;
    case "voucher":
      include_once(_LOCAL . "core/themes/voucher.php");
      break;
    case "panel":
      include_once(_LOCAL . "core/themes/panel.php");
      break;
    case "logs":
      include_once(_LOCAL . "core/themes/logs.php");
      break;
  }
} else {

  // Check if this is a new Install and Execute Install.php

  if (api("users", "total") == 1){
    include_once(_LOCAL . "core/themes/login.php");
  } else {
    if ( file_exists(_LOCAL . "core/themes/install.php") )
      include_once(_LOCAL . "core/themes/install.php");
  }
    
}


require_once(_LOCAL . "core/themes/modals.php");

require_once(_LOCAL . "core/themes/footer.php");
