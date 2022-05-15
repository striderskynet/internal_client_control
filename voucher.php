<?php
    error_reporting(E_ALL);

    $db = new SQLite3("./database/reserv.db");
    $voucherID = $_GET['id'];
    $query = 'SELECT * FROM `main_reservations` where `id`=' . $voucherID;

    $res = $db->query($query);
    $data = $res->fetchArray();

    $typeFirstLine = explode("\n",trim($data['data']))[0];
    $typeRest = str_replace($typeFirstLine, "",trim($data['data']));

    $date = DateTime::createFromFormat("Y-m-d", $data['inDate']);
    $vID = $date->format("Y") . str_pad($voucherID, 3, '0', STR_PAD_LEFT);

    if ($data['additional_clients'] == null)
        $data['additional_clients'] = 0;
        
    switch ($data['additional_clients']){
        case 0:
            $companions = "Sin acompañantes";
            break;
        case 1:
            $companions = "Un acompanante";
            break;
        default:
            $companions = $data['additional_clients'] . " acompanantes";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body{
            margin: 0px;
            padding: 0px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 16px;
        }
        .voucher
        {
            margin: auto;
            margin-top : 50px;
            width: 800px;
            padding-bottom: 50px;
            text-align: center;
        }

        .voucher .top .logo img{
            max-width: 350px;
            margin-bottom: 20px;
        }

        .voucher .bottom
        {
            text-align: left;
            margin: 50px;
        }
        .voucher .bottom span
        {
            display: block;
        }

        .vtable {
            display: grid;
            grid-template-columns: 15% 35% 25% 25%;
            /*grid-gap: 0.5em 0;*/
            max-width: 750px;
            font-size: 14px;
            margin: auto;
            border: 1px solid #000;
        }

        .vtable > div {
            border: #666 1px solid;
            padding: 0.5em;
            background: rgba(255,255,255,0.7);
        }

        .bold {
            font-weight: bold;
        }

        .left {
            text-align: left;
        }

        .span-3 {
            grid-column: span 3;
        }

        .span-4 {
            grid-column: span 4;
        }

        .row-2 {
            grid-row: span 2;
        }
       
    </style>
</head>
<body>
    <div class="voucher">
        <div class="top">
            <span class="logo">
                <img alt="asd" src="../assets/images/mainlogo.png" >
            </span>
        </div>
        <div class='vtable'>
            <div class='bold span-4'>
                ENDIRECTO GmbH <br>
                Am Römerstein 4 <br>
                82205 Gilching <br>
                Deutschland
            </div>
            <div class='bold span-4'>
                VOUCHER DE SERVICIO No. <?php echo $vID ?>
            </div>
            
            <div class='bold left'>
                Nombre del Cliente
            </div>
            <div class='left span-3'>
                Sr. <?php echo $data['main_client_name'] ?> <br>
                <?php echo $companions ?>
            </div>

            <div class='bold left'>
                Proveedor
            </div>
            <div class='left'>
                <?php echo $data['data'] ?>
            </div>
            <div class='left bold'>
                <span>No. Confirmacion</span>
            </div>
            <div>
                <span>RL 139614</span>
            </div>

            <div class='left bold row-2'>
                Descripcion de Servicios
            </div>
            <div class='left row-2'>
                <?php echo $data['observations'] ?>
            </div>
            <div class='left bold'>
                <span>Desde</span>
            </div>
            <div class='left bold'>
                <span>Hasta</span>
            </div>
            <div class='left'>
                <span><?php echo $data['inDate'] ?></span>
            </div>
            <div class='left'>
                <span><?php echo $data['outDate'] ?></span>
            </div>
        </div>
        <div class='bottom'>
            <span>Dr. Jorge Tejero Garcia</span>
            <span>Representante</span>
        </div>
    </div>
<script>
   // window.print();
</script>
</body>
</html>