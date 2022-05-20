<?php
     switch(array_keys($_GET)[1]){
        case "total":
            echo users_total();
            break;
        case "add":
            echo users_add();
            break;
        case "verify":
            echo users_verify();
            break;
            
    }

    function users_total()
    {
        global $db;
        return $db->query('SELECT * FROM general_users')->numRows();
    }

    function users_add(){
        global $db;

        $val['user'] = $_GET['username'];
        $val['pass1'] = $_GET['password'];
        $val['pass2'] = $_GET['password2'];
        $val['pass'] = md5($val['pass1']);
        $val['role'] = "root";

        $query = "INSERT INTO general_users( `username`, `password`, `role`)
        VALUES ('{$val['user']}','{$val['pass']}','{$val['role']}');";

        debug(4, $query);
        
        if ( $db->query($query) ) return true;
        else return false;
    }

    function users_verify(){
        global $db;


        $result = $db->query("SELECT * FROM general_users WHERE `username`='{$_GET['username']}' AND `password`='{$_GET['password']}'")->fetchArray();

        return json_encode($result);
    }
        
?>