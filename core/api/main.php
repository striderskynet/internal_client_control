<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/config.php');
    include($_SERVER['DOCUMENT_ROOT'] . "/core/addons/mysql.php");

    $api_directory = $_SERVER['DOCUMENT_ROOT'] . "/core/api/";

    //debug(3, "Connecting to mysql database: " . str_replace("\n", "", var_export($database, true)));
    $db = new db($database['host'], $database['user'], $database['pass'], $database['data']); 

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
?>