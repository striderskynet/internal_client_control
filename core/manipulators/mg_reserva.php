<?php
    error_reporting(E_ALL);

    $db = new SQLite3("./database/reserv.db");
    require_once ($_SERVER['DOCUMENT_ROOT']."/core/debug.php");

    if (@isset($_GET['delete']))
        $query = "DELETE FROM main_reservations WHERE `id`='{$_GET['delete']}'";
    else
        $query = "INSERT INTO main_reservations ( main_client, main_client_name, additional_clients, type, data, inDate, outDate, observations, servicePartner, reservation_number) 
    VALUES ({$_POST['main_client']}, '{$_POST['main_client_name']}', '{$_POST['additional_clients']}', '{$_POST['type']}', '{$_POST['details']}', '{$_POST['inDate']}', '{$_POST['outDate']}', '{$_POST['observations']}', '{$_POST['servicePartner']}', '{$_POST['reservation_number']}');";

    debug(0, "Executing query into the Database:" . $query);
    $res = $db->query($query);
?>