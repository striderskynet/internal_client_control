<?php
     $dbQuery = "CREATE TABLE hotel_type_reservations (
        ID          integer PRIMARY KEY AUTOINCREMENT NOT NULL UNIQUE,
        Code        varchar(15),
        hotelname   varchar(50),
        hoteltype   varchar(50),
        hotelplace  varchar(50),
        indate      date,
        outdate     date,
        season      varchar(5)
      );
      
      CREATE TABLE main_reservations (
     id                  integer PRIMARY KEY AUTOINCREMENT NOT NULL UNIQUE,
     main_client         integer NOT NULL,
     additional_clients  integer,
     type                varchar(50) NOT NULL,
     data                text,
     inDate              date,
     outDate             date,
     observations        text,
     servicePartner      varchar(50)
   );";


function sqlite_query($dbhandle,$query)
{
    $array['dbhandle'] = $dbhandle;
    $array['query'] = $query;
    $result = $dbhandle->query($query);
    return $result;
}

function sqlite_open($location)
{
    global $cfg, $dbQuery;
    $exec_intro_query = false;

    if (!file_exists($cfg['reservations']))
        $exec_intro_query = true;

    $handle = new SQLite3($location);

    if ( $exec_intro_query )
        sqlite_query($handle, $dbQuery);

    return $handle;
}

function sqlite_fetch_array(&$result,$type)
{
    #Get Columns
    $i = 0;
    while ($result->columnName($i))
    {
        $columns[ ] = $result->columnName($i);
        $i++;
    }
   
    $resx = $result->fetchArray(SQLITE3_ASSOC);
    return $resx;
}
?>