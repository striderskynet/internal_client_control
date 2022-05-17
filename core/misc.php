<?php
    function is_active($id) {
        if ($id == "main" & !isset(array_keys($_GET)[0]))
        { return "active"; }
        elseif ( isset($_GET) && @array_keys($_GET)[0] == $id )
        { return "active"; }
          return "";
      }
?>