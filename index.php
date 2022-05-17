<?php
    session_start();

    ini_set('display_errors', 1); 
    error_reporting(E_ALL);
    
    $_DEBUG = true;

    //$_ADDRESS = "http://localhost/";
    $_ADDRESS = "http://clients.technomobile.lan:85/";


    $cfg['database'] = $_SERVER['DOCUMENT_ROOT'] . "/database/clients.db";
    $cfg['users'] = $_SERVER['DOCUMENT_ROOT'] . "/database/users.db";
    $cfg['reservations'] = $_SERVER['DOCUMENT_ROOT'] . "/database/reserv.db";


    $cfg['title'] = 'Endirecto';
    //$cfg['title'] = 'Cuba4u-DMC';


    // --------------------------- \\
    // Do not touch below this point


    require_once("./core/debug.php");
    require_once("./core/misc.php");
    // Check if is a new instalation and Create a Root User
    if ( !file_exists($cfg['users']) && @isset ($_GET['gen_user']) )
    {
        
        $users[0][0] = $_POST['user'];
        $users[0][1] = md5($_POST['password']);
        $users[0][2] = 'root';
        
        debug(1, "Detected new instalation, asking for new user and password");

        if ( $_POST['password'] != $_POST['password2'] )
        {
            session_destroy();
            die ("<header><script>window.location = '/';</script>");
        }
        debug(1, "Saving username and password for ROOT access");
        file_put_contents($cfg['users'], json_encode($users, JSON_PRETTY_PRINT));
    }

    // Check if username and password are correct and login
    if ( @isset ($_POST['user']) && @isset( $_POST['password'] ) )
    {
        $var['users'] = json_decode(file_get_contents($cfg['users']));

        foreach ($var['users'] as $u )
        {
            if (strtolower($u[0]) == strtolower($_POST['user']) && $u[1] == md5($_POST['password']) )
            {
                $_SESSION['userUUID']['username'] = $u[0];
                $_SESSION['userUUID']['category'] = $u[2];
            }
        }
    }

    // Check if logout is set and execute logout
    if ( @isset ($_GET['logout'] ) )
    {
            session_destroy();
            die ("<header><script>window.location = '/';</script>");
    }

    // Import variable from user Database
    $var['data'] = json_decode(file_get_contents($cfg['database']));

    // Check if add_user is set and execute
    if (@isset($_GET['add_user']) && @isset ( $_POST ))
    {
            $count = 0;
        if (!isset($var['data']))
            $count = 1;
        else
        {
            foreach ( $var['data'] as $v)
            {
                $count = $v->id;
            }
            $count++;
        }
       
        // Get varData from $_POST
        $var['data']->$count =  array(
            'id' => $count,
            'prefix' => $_POST['modal_contact_prefix'],
            'name' => $_POST['modal_contact_firstname'] . " " . $_POST['modal_contact_lastname'],
            'passport' => $_POST['modal_contact_passport'],
            'phone' => $_POST['modal_contact_phone'],
            'email' => $_POST['modal_contact_email'],
            'country' => $_POST['modal_contact_country'],
            'date' => date("Y/m/d"),
            'source' => $_POST['modal_contact_source'],
            'message' => trim($_POST['modal_contact_message']),
            'lastTouch' => $_SESSION['userUUID']['username'] . " | " . date('m/d/Y h:i:s a', time()),
        );
        
        debug(0, "Adding new client to the database");
        file_put_contents($cfg['database'], json_encode($var['data'], JSON_PRETTY_PRINT));
        die ("<header><script>window.location = '/';</script>");
    }

    // Check if del_user is set and execute
    if ( @isset($_GET['del_user']) )
    {
        $val = $_GET['del_user'];
        unset($var['data']->$val);
        
        debug(0, "Deleting user from database");
        file_put_contents($cfg['database'], json_encode($var['data'], JSON_PRETTY_PRINT));
    }

    $mData = null;

    if (@isset($_SESSION['userUUID'])) 
        $mData = str_replace("\\\"", "", json_encode(json_decode(file_get_contents($cfg['database']))));


    // Show the exact site page
    if (@array_keys($_GET)[0]!="agregar_reserva")
        require ( "./core/header.php" );

    if (@count(array_keys($_GET)) == 0)
    {
        require ( "./core/core.php" );
    } else {
        switch (array_keys($_GET)[0]){
            case "reservas":
                    require ( "./core/integrators/reservations.php");
                    break;

            case "agregar_reserva":
                    require ( "./core/manipulators/man_reserva.php" );
                    break;

            default:
                require ( "./core/core.php" );
                break;
        }
    }
    
    // Load Footer only if its OK
    if (@array_keys($_GET)[0]!="agregar_reserva")
        require ( "./core/footer.php" );

?>
