<?php
    session_start();

    ini_set('display_errors', 1); 
    error_reporting(E_ALL);
    
    $_DEBUG = false;
    //$_ADDRESS = "http://localhost/";
    $_ADDRESS = "http://clients.technomobile.lan:85/";
    $_LOCAL = "C:/Apache24/www/clients/";
    //$_ADDRESS = "https://endirecto-cuba.000webhostapp.com/";

    $cfg['database'] = "database/clients.db";
    $cfg['users'] = "database/users.db";
    $cfg['reservations'] = "database/reserv.db";


    $cfg['title'] = 'Endirecto';
    //$cfg['title'] = 'Cuba4u-DMC';

    /*$cfg['pending_status'][1] = 'Pendiente';
    $cfg['pending_status'][2] = 'Confirmado';
    $cfg['pending_status'][3] = 'en Progreso';
    $cfg['pending_status'][4] = 'Completado';
    $cfg['pending_status'][5] = 'Cancelado';*/

    // Check if is a new instalation and Create a Root User
    if ( !file_exists($cfg['users']) && @isset ($_GET['gen_user']) )
    {
        
        $users[0][0] = $_POST['user'];
        $users[0][1] = md5($_POST['password']);
        $users[0][2] = 'root';

        if ( $_POST['password'] != $_POST['password2'] )
        {
            session_destroy();
            die ("<header><script>window.location = '/';</script>");
        }

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
        
        
        file_put_contents($cfg['database'], json_encode($var['data'], JSON_PRETTY_PRINT));
        die ("<header><script>window.location = '/';</script>");
    }

    // Check if del_user is set and execute
    if ( @isset($_GET['del_user']) )
    {
        $val = $_GET['del_user'];
        unset($var['data']->$val);
      
        file_put_contents($cfg['database'], json_encode($var['data'], JSON_PRETTY_PRINT));
    }

    // Show the exact site page
    if (@array_keys($_GET)[0]!="agregar_reserva")
        require ( "./core/header.php" );

    if (@count(array_keys($_GET)) == 0)
    {
        require ( "./core/core.php" );
    } else {
        switch (array_keys($_GET)[0]){
            case "lista_de_reserva":
                require ( "./core/rList.php" );
                break;

            case "reservas":
                    require ( "./core/reserv.php" );
                    break;

            case "agregar_reserva":
                        require ( "./core/manipulators/mg_reserva.php" );
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
