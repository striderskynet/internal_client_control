<?php
    function is_active($id) {
        if ($id == "main" & !isset(array_keys($_GET)[0]))
        { return "active"; }
        elseif ( isset($_GET) && @array_keys($_GET)[0] == $id )
        { return "active"; }
          return "";
      }

    function api($module, $action = null, $values = null, $decode = false){
        global $_ADDRESS;
        $address = $_ADDRESS . "core/api/main.php?" . $module . "&" . $action . "&" . $values;

        if ($decode == true)
            return json_decode(file_get_contents($address));
        else
            return file_get_contents($address);
    }
    
    function reload($address = null)
    {
        die ("<header><script>window.location = '/" . $address . "';</script>");
    }
?>