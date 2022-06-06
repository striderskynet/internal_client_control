<?php
    require_once("config.php");

    if ( isset($_GET{'js'})){

        $script = null;

        switch ($_GET['js']){
            default:
                $script = file_get_contents( "../assets/js/main.js" );
                break;
            case "default":
                $script = file_get_contents( "./themes/default.exec.js" );
                break;
            case "voucher":
                $script = file_get_contents( "./themes/voucher.exec.js" );
                break;
            case "login":
                $script = file_get_contents( "./themes/login.exec.js" );
                break;
            case "panel":
                $script = file_get_contents( "./themes/panel.exec.js" );
                break;
        }

        if ( !_DEBUG ){
        
            require_once ("./minifier.php");
            $script = \JShrink\Minifier::minify($script);


        }
        echo $script;
    }



?>