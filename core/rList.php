<?php
   include ("core/addons/sqlite.php");
   include ("core/addons/simplexlsx.php");

    /*$reserv_sqlite = sqlite_open("./database/reserv.db");
    $xlsx = new SimpleXLSX('price.xlsx');
    if ( !$xlsx->success() ) {
        echo 'xlsx error: '.$xlsx->error();
    } else {
        $q = 0;
        foreach( $xlsx->rows(0) as $r  ) {
            if ( $q > 0 )
            {
                $addQuery = "INSERT INTO
            Reservations(Code,hotelname,hoteltype,hotelplace)
            VALUES('".$r['0']."','".$r['1']."','".$r['2']."','".$r['4']."')";
                 
                echo $addQuery;
                 $reserv_sqlite->query($addQuery);
            }
            $q++;

        if ($q >= 10)
                break;
         }
             //echo $xlsx->toHTML();
     } 
*/
?>