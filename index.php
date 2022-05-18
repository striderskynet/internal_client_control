<?php
    session_start();

    // --------------------------- \\
    // Do not touch below this point
    require_once ("./config.php");
    
    
    // Check if is a new instalation and Create a Root User
    if ( @isset ($_GET['gen_user']) )
    {
        print_r ($_POST);

        debug(1, "Detected new instalation, asking for new user and password");
        if ( $_POST['password'] != $_POST['password2'] )
            session_destroy();

        debug(1, "Saving username and password for ROOT access");
        //file_get_contents($_ADDRESS . "core/api/main.php?users&add&username={$_POST['user']}&password={$_POST['password']}&password2={$_POST['password2']}");
        api("users","add","username={$_POST['user']}&password={$_POST['password']}&password2={$_POST['password2']}");
        
        reload();
    }

    // Check if username and password are correct and login
    if ( @isset ($_POST['user']) && @isset( $_POST['password'] ) )
    {
        $password = md5($_POST['password']);
        //$result = json_decode(file_get_contents($_ADDRESS . "core/api/main.php?users&verify&username={$_POST['user']}&password={$password}"));
        $result = api("users","verify","username={$_POST['user']}&password={$password}", true);

        if ( isset($result->role) )
        {
            $_SESSION['userUUID']['username'] = $result->username;
            $_SESSION['userUUID']['category'] = $result->role;

            debug(0, "Login as username ($result->username) from ({$_SERVER['REMOTE_ADDR']})");
        } else {
            debug(1, "Failed login attempt for ({$_POST['user']}) from ({$_SERVER['REMOTE_ADDR']})");
            $login_error = "<br>Username or password incorrect";
        }
    }

    // Check if logout is set and execute logout
    if ( @isset ($_GET['logout'] ) )
    {
            session_destroy();
            debug(0, "Logout username ({$_SESSION['userUUID']['username']}) from ({$_SERVER['REMOTE_ADDR']})");
            reload();
    }

    // Check if add_user is set and execute
    if (@isset($_GET['add_client']) && @isset ( $_POST ))
    {
        debug(0, "Adding new client to the database");
        $result = api("clients", "add", "prefix=". urlencode($_POST['modal_contact_prefix']) . "&" .
                                       "name=". urlencode($_POST['modal_contact_firstname']) . "&" .
                                       "lastname=". urlencode($_POST['modal_contact_lastname']) . "&" .
                                       "passport=". urlencode($_POST['modal_contact_passport']) . "&" .
                                       "phone=". urlencode($_POST['modal_contact_phone']) . "&" .
                                       "email=". urlencode($_POST['modal_contact_email']) . "&" .
                                       "country=". urlencode($_POST['modal_contact_country']) . "&" .
                                       "company=". urlencode($_POST['modal_contact_source']) . "&" .
                                       "observations=". urlencode($_POST['modal_contact_message']) . "&" .
                                       "last_touch=". urlencode($_SESSION['userUUID']['username'] . " | " . date('m/d/Y h:i:s a', time())) );
        die ("<header><script>window.location = '/';</script>");
    }

    // Check if del_user is set and execute
    if ( @isset($_GET['del_client']) )
    {
        debug(0, "Deleting client {$_GET['del_client']} by ({$_SESSION['userUUID']['username']}) from ({$_SERVER['REMOTE_ADDR']})");
        api("clients", "delete", "id={$_GET['del_client']}");

        reload();
    }

    // Read the clients information into JS Variable
    $mData = null;
    if (@isset($_SESSION['userUUID'])) 
    {
        $mData = str_replace("\\\"", "", api("clients", "list"));
 
    }

    // Show the exact site page
    if (@array_keys($_GET)[0]!="agregar_reserva")
        require ( "./core/header.php" );

    if (@count(array_keys($_GET)) == 0)
    {
        require ( "./core/core.php" );
    } else {
        switch (array_keys($_GET)[0]){
            case "reservas":
                    //require ( "./core/integrators/reservations.php");
                    echo api("vouchers");
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
