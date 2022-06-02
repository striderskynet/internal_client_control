<?php
    session_start();
    
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/new" . '/core/config.php');

    $api_directory = _LOCAL . "api/";
   
    //debug(3, "Connecting to mysql database: " . str_replace("\n", "", var_export($database, true)));
    $db = new db($config['db']['host'], $config['db']['user'], $config['db']['pass'], $config['db']['data']);
   
    switch(array_keys($_GET)[0]){
            case "users":
                require_once ($api_directory . "modules/users.php");
                break;
            case "clients":
                require_once ($api_directory . "modules/clients.php");
                break;
            case "vouchers":
                require_once ($api_directory . "modules/vouchers.php");
                break;
    }

    $db->close();
