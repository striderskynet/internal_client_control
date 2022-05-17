<?php
     switch(array_keys($_GET)[1]){
        case "total":
            echo clients_total();
            break;
        case "add":
            echo clients_add();
            break;
        case "list":
            echo clients_list();
            break;
        case "delete":
            echo clients_delete();
            break;
    }

    function clients_total()
    {
        global $db;
        return $db->query('SELECT * FROM main_clients')->numRows();
    }

    function clients_add(){
        global $db;

        $query = "INSERT INTO `main_clients` (`prefix`, `name`, `lastname`, `passport`, `phone`, `email`, `country`, `date_added`, `company`, `observations`, `last_touch`) VALUES
        ('{$_GET['prefix']}', '{$_GET['name']}', '{$_GET['lastname']}', '{$_GET['passport']}', '{$_GET['phone']}', '{$_GET['email']}', '{$_GET['country']}', now(), '{$_GET['company']}', '{$_GET['observations']}', '{$_GET['last_touch']}');";

        debug(4, $query);
        
        if ( $db->query($query) ) return true;
        else return false;
    }

    function clients_delete(){
        global $db;

        $query = "DELETE FROM main_vouchers WHERE `main_client` = '{$_GET['id']}';";
        $query1 = "DELETE FROM main_clients WHERE `id` = '{$_GET['id']}';";
        

        debug(4, $query . " " . $query1);
        $db->query($query);
        $db->query($query1);

       return true;
    }

    function clients_list(){
        global $db;
        
        $data = null;
        $q = 1;

        $accounts = $db->query('SELECT * FROM main_clients')->fetchAll();
        foreach ($accounts as $account) {
            $data[] = $account;
        }

        return json_encode($data);
    }
        
?>