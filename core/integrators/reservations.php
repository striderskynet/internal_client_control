<table class="table table-sm table-light table-striped table-hover table-bordered caption-top table-responsive">
<caption>Listado de reservas</caption>
  <thead>
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
    include ("../addons/sqlite.php");

    if ( @isset($_GET['client']) )
      $query = 'SELECT * FROM `main_reservations` WHERE `main_client` = "' . $_GET['client'] . '"';
    else
    $query = 'SELECT * FROM `main_reservations`';

    $db = new SQLite3("../../database/reserv.db");
    $res = $db->query($query);

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
      <td id='clientRow-<?php echo $q ?>'></td>
      <script>
          $( "#clientRow-<?php echo $q ?>" ).append( data[<?php echo $row['main_client']?>].name );
      </script>
      <td id='addclientRow-<?php echo $q ?>'>
            <b><?php echo $row['additional_clients']+1 ?></b> (total)
      </td>
      <td><?php echo $row['type']?></td>
      <td><a href="#" class='button' title="<?php echo $row['data']?>"><?php echo $data_line?></a></td>
      <td><?php echo $row['inDate']?></td>
      <td><?php echo $row['outDate']?></td>
      <td class='text-end'>
      <!--<button type="button" class="btn btn-warning btn-sm">Editar</button>-->
      <button onClick='delRes(<?php echo $row['id']?>, <?php echo $row['main_client']?>)' type="button" class="btn btn-danger btn-sm">Eliminar</button>
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

<script>
</script>