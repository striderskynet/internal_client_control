<table class="table table-sm table-light table-striped table-hover table-bordered caption-top table-responsive">
<caption>Listado de reservas</caption>
  <thead class='reservHead'>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Cliente</th>
      <th scope="col">Cantidad de Personas</th>
      <th scope="col">Tipo</th>
      <th scope="col">Info</th>
      <th scope="col">Entrada</th>
      <th scope="col">Salida</th>
      <th class='text-end' scope="col">Voucher</th>
    </tr>
  </thead>
  <tbody>
  <?php
    error_reporting(E_ALL);

    $database = $_SERVER['DOCUMENT_ROOT']."/database/reserv.db";
    include ($_SERVER['DOCUMENT_ROOT']."/core/addons/sqlite.php");

    if ( @isset($_GET['client']) )
      $query = 'SELECT * FROM `main_reservations` WHERE `main_client` = "' . $_GET['client'] . '"';
    else
      $query = 'SELECT * FROM `main_reservations`';

    $db = new SQLite3($database);
    $res = $db->query($query);

    if ( !stristr($_SERVER['SCRIPT_FILENAME'],"reservations.php") )
    { $rebound = "true"; } else { $rebound = "false"; }

    $q = 0;
    while ($row = $res->fetchArray()) {
     
        $data = $row['data'];
        $data_line = explode("\n",trim($data))[0];

        if ( $row['additional_clients'] == null)
          $row['additional_clients'] = 0;

        $date = DateTime::createFromFormat("Y-m-d", $row['inDate']);
        $vID = $date->format("Y") . str_pad( $row['id'], 3, '0', STR_PAD_LEFT);
       
?>
    <tr>
      <th scope="row"><?php echo $vID?></th>
      <td id='clientRow'><?php echo $row['main_client_name'] ?></td>
      <td id='addclientRow'> <b><?php echo $row['additional_clients']+1 ?></b> (total) </td>
      <td><?php echo $row['type']?></td>
      <td><a href="#" class='button' title="<?php echo $row['data']?>"><?php echo $data_line?></a></td>
      <td><?php echo $row['inDate']?></td>
      <td><?php echo $row['outDate']?></td>
      <td class='text-end'>
      <!--<button type="button" class="btn btn-warning btn-sm">Editar</button>-->
      <button onClick='delRes(<?php echo $row['id']?>, <?php echo $row['main_client']?>, <?php echo $rebound ?>)' type="button" class="btn btn-danger btn-sm">Eliminar</button>
      <button onClick='voucher(<?php echo $row['id']?>);' type="button" class="btn btn-primary btn-sm">Imprimir</button></td>
    </tr>
<?php   
    $q++;
    }
?>
  </tbody>
</table>
<div class='text-end'>
  <?php if ( @isset($_GET['client']) ) { ?>
<button type="button" class="btn btn-success btn-sm" onclick="showAddReserv();" data-bs-target="#addReservation" data-bs-toggle="modal" data-bs-dismiss="modal">Agregar</button>
  <?php } ?>
<button type="button" class="btn btn-primary btn-sm">Imprimir todos</button>
</div>