<?php
session_start();

require_once($_SERVER['DOCUMENT_ROOT'] . "/new/" . "core/config.php");

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
  }
} else {

  include_once(_LOCAL . "core/themes/login.php");
}


require_once(_LOCAL . "core/themes/modals.php");

require_once(_LOCAL . "core/themes/footer.php");
