<?php
     require_once($_SERVER['DOCUMENT_ROOT'] . "/core/debug.php");
     require_once($_SERVER['DOCUMENT_ROOT'] . "/core/misc.php");

     
     $_ADDRESS = "http://clients.technomobile.lan:85/";
     //$_ADDRESS = "http://localhost/";
  
     //$cfg['database'] = $_SERVER['DOCUMENT_ROOT'] . "/database/clients.db";
     //$cfg['reservations'] = $_SERVER['DOCUMENT_ROOT'] . "/database/reserv.db";
 
     $cfg['title'] = 'Endirecto';
     //$cfg['title'] = 'Cuba4u-DMC';

     $database['type'] = "mysql";
     $database['host'] = "127.0.0.1";
     $database['port'] = "3306";
     $database['user'] = "root";
     $database['pass'] = "";
     $database['data'] = "endirecto";
     

?>