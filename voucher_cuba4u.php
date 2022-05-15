<?php
    error_reporting(E_ALL);

    $db = new SQLite3("./database/reserv.db");
    $voucherID = $_GET['id'];
    $query = 'SELECT * FROM `main_reservations` where `id`=' . $voucherID;

    $res = $db->query($query);
    $data = $res->fetchArray();

    $typeFirstLine = explode("\n",trim($data['data']))[0];
    $typeRest = str_replace($typeFirstLine, "",trim($data['data']));
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
            font-size: 12px;
        }
        
        .voucher
        {
            margin: auto;
            width: 800px;
            background: url("assets/images/flag.jpg") no-repeat;
            background-size:contain;
            padding-bottom: 50px;
        }

        .voucher .top
        {
            text-align: center;
            height: 100px;
        }

        .voucher .top .info
        {
            display: block;
            position:absolute;
            margin: 10px 0px;
        }

        .voucher .top .info:first-line
        {
            font-weight: bold;
        }

        .voucher .top .info ul
        {
            list-style-type: none;
            text-align: left;
        }
        
        .voucher .top .title
        {
            display: block;
            padding: 20px 0px 0px 0px;
        }

        .voucher .id
        {
            margin: -20px;
            padding: -50px 0px 70px 0px;
        }

        .voucher .logo img
        {
            display: absolute;
            width: 60px;
            height: 60px;
            float: right;
            margin-top: -20px;
            margin-right: 30px;
        }

        .dataSpan
        {
            display: block;
            min-height: 120px;
            max-height: 120px;
        }

        .vtable {
            display: grid;
            grid-template-columns: 25% 45% 15% 15%;
            /*grid-gap: 0.5em 0;*/
            max-width: 750px;
            font-size: 10px;
            margin: auto;
        }

        .vtable > div {
            border: #666 1px solid;
            padding: 0.5em;
            background: rgba(255,255,255,0.7);
        }

        .vtable > div > span {
            display:block;
            line-height: 15px;
        }

        .vtable > div > span:nth-child(1) {
            font-weight: bold;
        }

        .vtable > div > span:nth-child(2) {
            font-style: italic;
            font-size: 9px;
        }

        .vtable > div > span:nth-child(3) {
            position: fixed;
            margin: -20px 55px 0px;
            font-size: 12px;
        }
        .vtable > div > span:nth-child(4) {
            font-size: 9px;
        }
        .vtable .b,  .vtable .d {
            margin-top: 0.5em;
        }
        .vtable .b, .vtable .c {
            border-bottom: 0px;
        }

        .vtable > div:nth-child(4n+2)
        {
            border-left: 0px;
        }

        .vtable > div:nth-child(4n+3)
        {
            border-left: 0px;
            border-right: 0px;
        }

        .vtable .d1, .vtable .e1{
            border-left: 1px solid #000 !important;
        }
        .vtable .d1,  .vtable .d2{
            border-bottom: 0px;
        } 
        .vtable .d2{
            border-right: 0px;
            border-left: 0px;
        }
        .vtable .d1{
            border-right: 1px solid #000 !important;
        }

        .vtable .d3{
            grid-column: span 2; 
            grid-row: span 2;
            background: rgba(255,255,255,0.5) url("assets/images/cuba4u.gif") no-repeat;
            background-size:contain;
            background-position: center;
        }

        .vtable .middle
        {
            padding: 12px 0px 0px 10px;
        }
        
        .div-line
        {
            border-bottom: 2px dotted #ddd;
            display: block;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <?php
        for ($i = 0; $i <= 1; $i++)
        {
    ?>
    <div class="voucher">
        <div class="top">
            <div class="info">
                <ul>
                    <li>Cuba4u / SELLFIRST UG</li>
                    <li>Tel. +535 1979211</li>
                    <li>info@cuba4u-dmc.com</li>
                </ul>
            </div>
            <h1 class="title">Voucher N.</h1>
            <h4 class="id">RE0002</h4>
            
            <span class="logo">
                <img alt="asd" src="logo2.gif" >
            </span>
        </div>
    <div class="vtable">
        <div class="a">
            <span>Kundenname(n)</span>
            <span>Nombre de(l) Cliente(s)</span>
        </div>
        <div class="a middle">
            <span><?php echo $data['main_client_name']?></span>
        </div>
        <div class="a">
            <span>Anzahl</span>
            <span>Cantidad</span>
            <span><?php echo $data['additional_clients'] + 1?></span>
        </div>
        <div class="a">
            <span>Kd-Nr.:</span>
            <span>10003</span>
        </div>

        <div class="b">
            <span>Leistung</span>
            <span>Servicio</span>
        </div>
        <div class="b">
            <span>Leistungsbeschreibung</span>
            <span>Descripcion de los servicios</span>
        </div>
        <div class="b">
            <span>Leistungsbeginn</span>
            <span>Entrada</span>
        </div>
        <div class="b">
            <span>Leistungsende</span>
            <span>Salida</span>
        </div>

        <div class="c">
            <span></span>
            <span></span>
            <span></span>
            <span><?php echo $data['type']?></span>  
        </div>
        <div class="c">
            <span><?php echo $typeFirstLine?></span>
            <span></span>
            <span></span>
            <span class='dataSpan'><?php echo nl2br(htmlspecialchars(trim($typeRest)))?></span>
        </div>
        <div class="c">
            <span></span>
            <span></span>
            <span></span>
            <span><?php echo $data['inDate']?></span> 
        </div>
        <div class="c">
            <span></span>
            <span></span>
            <span></span>
            <span><?php echo $data['outDate']?></span> 
        </div>

        <div>
            <span>Bemerkungen</span>
            <span>Observaciones</span>
        </div>
        <div style="grid-column: span 3;">
            <span><?php echo $data['observations']?></span>
        </div>
        
        <div class="d d1">
            <span>Leistungstrager</span>
            <span>Prestatario del Servicio</span>
        </div>
        <div class="d d2 middle">
            <span><?php echo $data['servicePartner']?></span>
        </div>
        <div class="d d3">
            <span>Firma autorizada de Cuba4u / SELLFIRST UG</span>
        </div>
        <div class="e e1">
            <span>Reservierungsnummer</span>
            <span>Nro de la Reserva</span>
        </div>
        <div class="e e2 middle">
            <span>X12345</span>
        </div>
    </div>
</div>
<?php } ?>
<script>
    window.print();
</script>
</body>
</html>