<?php

     switch(@array_keys($_GET)[1]){
        case "delete":
            echo voucher_delete();
            break;
        case "add":
            voucher_add();
            break;
        case "print":
            echo voucher_print();
            break;
        default:
            echo voucher_show();
            break;
    }

    function voucher_print()
    {
        global $db;

        $query = 'SELECT * FROM `main_vouchers` WHERE `id` = ' . $_GET['id'] . ' LIMIT 1';

        debug(4, $query);
        $voucher = $db->query($query)->fetchArray();
        
        $client_name = $db->query('SELECT concat(prefix, " ", NAME, " ",  lastname) AS full_name FROM main_clients WHERE id = ?', $voucher['main_client'])->fetchArray();
        $voucher["full_name"] = $client_name['full_name'];

        return json_encode($voucher) ;
    }

    function voucher_show()
    {
        global $db;

        $query = 'SELECT * FROM `main_vouchers`';
        $rebound = true;

        if ( @isset($_GET['client']) )
        {
            $query = 'SELECT * FROM `main_vouchers` WHERE `main_client` = "' . $_GET['client'] . '"';
            $client_name = $db->query('SELECT concat(prefix, " ", NAME, " ",  lastname) AS full_name FROM main_clients WHERE id = ?', $_GET['client'])->fetchArray();
            $rebound = false;
        }

        debug(4, $query);
        $dat = $db->query($query)->fetchAll();
        
        ?>
        <div class='search-input-div'>
      <input id='search-input' class="search-input" type='text' placeholder="Buscar..." onkeyup="searchInput()">
    </div>
<div role="table" aria-label="Clients Table" aria-describedby="QuanticaLabs">
    <input id="wrap-text" name="#" type="checkbox">
        <div class="table-desc">
           <span></span>
        </div>
			  
	<!--TABLE HEADER-->
        <div role="row-group">
            <div role="row">
                <span role="column-header" style='text-align: center;'>ID</span>
                <span role="column-header">Cliente</span>
                <span role="column-header">Cantidad de Personas</span>
                <span role="column-header">Tipo</span>
                <span role="column-header">Info</span>
                <span role="column-header">Entrada</span>
                <span role="column-header">Salida</span>
                <span role="column-header">Voucher</span>
            </div>
        </div>
        <div role="row-group" id='row-group'>
	    </div>
</div>

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
        
        if ( $dat )
        {
        foreach ($dat as $d) {
                $client_assoc = $db->query('SELECT * FROM main_clients WHERE id = ?', $d['main_client'])->fetchArray();
                $d['main_client_name'] = $client_assoc['name'] . " " . $client_assoc['lastname'];

                $data_first_line = explode("\n",trim($d['data']))[0];

                $date = DateTime::createFromFormat("Y-m-d", $d['in_date']);
                $vID = $date->format("Y") . str_pad( $d['id'], 3, '0', STR_PAD_LEFT);
            ?>
                <tr>
                <th scope="row"><?php echo $vID?></th>
                <td id='clientRow'><?php echo $d['main_client_name'] ?></td>
                <td id='addclientRow'> <b><?php echo $d['additional_clients']+1 ?></b> (total) </td>
                <td><?php echo $d['type']?></td>
                <td><a href="#" class='button' title="<?php echo $d['data']?>"><?php echo $data_first_line?></a></td>
                <td><?php echo $d['in_date']?></td>
                <td><?php echo $d['out_date']?></td>
                <td class='text-end'>
                <button onClick='delRes(<?php echo $d['id']?>, <?php echo $d['main_client']?>, <?php echo $rebound ?>)' type="button" class="btn btn-danger btn-sm">Eliminar</button>
                <button onClick='voucher(<?php echo $d['id']?>);' type="button" class="btn btn-primary btn-sm">Imprimir</button></td>
                </tr>
                </tbody>
            <?php
            }
        }
    ?>
    </table>
    <div class='text-end'>
    <?php if ( @isset($_GET['client']) ) { ?>
    <button type="button" class="btn btn-success btn-sm" onclick="showAddReserv(<?php echo $_GET['client'] ?>, '<?php echo $client_name['full_name'] ?>');" data-bs-target="#addReservation" data-bs-toggle="modal" data-bs-dismiss="modal">Agregar</button>
    <?php } ?>
    <button type="button" class="btn btn-primary btn-sm">Imprimir todos</button>
    </div>
    <?php
}

    function voucher_delete(){
        global $db;
        
        $accounts = $db->query("DELETE FROM main_vouchers WHERE `id` = {$_GET['id']}");

        return true;
    }

    function voucher_add(){
        global $db;
        
        $query = "INSERT INTO `main_vouchers` (`main_client`, `additional_clients`, `type`, `data`, `in_date`, `out_date`, `observations`, `service_partner`, `confirmation_number`) VALUES
        ('{$_POST['main_client']}', '{$_POST['additional_clients']}', '{$_POST['type']}', '{$_POST['data']}', '{$_POST['in_date']}', '{$_POST['out_date']}', '{$_POST['observations']}', '{$_POST['service_partner']}', '{$_POST['confirmation_number']}');";

        debug(4, $query);
        
        if ( $db->query($query) ) return true;
        else return false;
    }
        
?>

