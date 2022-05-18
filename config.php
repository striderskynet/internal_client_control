<?php
     ini_set('display_errors', 1);
     ini_set('display_startup_errors', 1);
     error_reporting(E_ALL);
     
     $_DEBUG = true;
     require_once($_SERVER['DOCUMENT_ROOT'] . "/core/debug.php");
     require_once($_SERVER['DOCUMENT_ROOT'] . "/core/misc.php");

     //$_ADDRESS = "http://localhost/";
     $_ADDRESS = "http://clients.technomobile.lan:85/";
 
 
     //$cfg['database'] = $_SERVER['DOCUMENT_ROOT'] . "/database/clients.db";
     $cfg['reservations'] = $_SERVER['DOCUMENT_ROOT'] . "/database/reserv.db";
 
    
     $cfg['title'] = 'Endirecto';
     //$cfg['title'] = 'Cuba4u-DMC';

     $database['type'] = "mysql";
     $database['host'] = "127.0.0.1";
     $database['port'] = "3306";
     $database['user'] = "root";
     $database['pass'] = "";
     $database['data'] = "endirecto";

?>