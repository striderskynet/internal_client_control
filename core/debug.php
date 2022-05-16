<?php
    function debug($level, $info)
    {
        global $_DEBUG;

        $lvl[0] = "Info";
        $lvl[1] = "Warning";
        $lvl[2] = "Error";
        $lvl[3] = "Critical";

        $log = date('Y-m-d H:i:s') . "  | ".$lvl[$level] . "    |   ". $info;

        //if ( $_DEBUG )
            file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/logs/main.log", $log);
    }
?>