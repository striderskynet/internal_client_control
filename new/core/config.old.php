<?php
    define("_LOCAL", $_SERVER['DOCUMENT_ROOT'] . "/new/");
    define("_DEBUG", true);


    $config['title'] = "Endirecto";
    $_ADDRESS = "http://clients.technomobile.lan:85/new/";


    $config['db']['host'] = "127.0.0.1";
    $config['db']['user'] = "root";
    $config['db']['pass'] = "";
    $config['db']['data'] = "test";

    $config['misc']['pagination'] = 10;

    
    require_once ( _LOCAL . "core/misc.php" );
    require_once ( _LOCAL . "core/debug.php" );
    require_once ( _LOCAL . "core/class/mysql.php" );
    
?>