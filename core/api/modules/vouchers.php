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

       // debug(4, $query);
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

        if ( !$rebound )
            $visible = "none";
        //debug(4, $query);
        $dat = $db->query($query)->fetchAll();
        
        ?>
        <div class='search-input-div'>
      <input style='display: <?php echo $visible ?>;' id='search-input' class="search-input" type='text' placeholder="Buscar..." onkeyup="searchInput()">
    </div>
<div role="table" aria-label="Clients Table" aria-describedby="QuanticaLabs">
    <input id="wrap-text" name="#" type="checkbox">
        <div style='display: <?php echo $visible ?>; visibility: hidden;' class="table-desc">
           <span></span>
            <div class="filter-panel">
                <label for="filter-column">Filtros</label>
                <a href="#_" class="add-content" data-bs-toggle="modal" data-bs-target="#modal_contact">Agregar</a>                
                
                <ul>
                    <li><label for="col-1">ID</label></li>
                    <li><label for="col-2">Nombre</label></li>
                    <li><label for="col-3">Pasaporte</label></li>
                    <li><label for="col-4">Telefono</label></li>
                    <li><label for="col-5">eMail</label></li>
                    <li><label for="col-6">Pais</label></li>
                    <li><label for="col-7">Fecha</label></li>
                    <li><label for="col-8">Empresa</label></li>
                    <li><label for="col-9">Datos</label></li>
                </ul>			
            </div>
        </div>
	<!--TABLE HEADER-->
        <div role="row-group">
            <div role="row">
                <span role="column-header" style='text-align: center;'>ID</span>
                <span role="column-header" >Cliente</span>
                <span role="column-header">Cantidad</span>
                <span role="column-header">Tipo</span>
                <span role="column-header">Info</span>
                <span role="column-header">Entrada</span>
                <span role="column-header">Salida</span>
                <span role="column-header">Voucher</span>
            </div>
        </div>

<div role="row-group" id='row-group2'>
        <?php
        
        if ( $dat )
        {
        foreach ($dat as $d) {
                $client_assoc = $db->query('SELECT * FROM main_clients WHERE id = ?', $d['main_client'])->fetchArray();
                $d['main_client_name'] = $client_assoc['name'] . " " . $client_assoc['lastname'];

                $data_first_line = explode("\n",trim($d['data']))[0];

                $date = DateTime::createFromFormat("Y-m-d", $d['in_date']);
                $vID = $date->format("Y") . str_pad( $d['id'], 3, '0', STR_PAD_LEFT);

                $output = ("\n<div class=\"mainRow\" role=\"row\">\n" .
                "<span role=\"cell\" data-toggle=\"Id\" data-placement=\"top\" role=\"cell\" data-header=\"ID\" style='text-align: center;'>{$vID}</span>\n" .
                "<span role=\"cell\" data-header=\"Cliente\" >{$d['main_client_name']}</span>\n" .
                "<span role=\"cell\" data-header=\"Cantidad\" style=\"text-align: center;\"><span>" . $d['additional_clients']+1 . "</span></span>\n" . 
                "<span role=\"cell\" data-header=\"Tipo\">{$d['type']}</span>\n" .
                "<span role=\"cell\" data-header=\"Info\"><span href='#' class='button' title='{$d['data']}'>{$data_first_line}</span></span>\n" .
                "<span role=\"cell\" data-header=\"Entrada\">{$d['in_date']}</span>\n" .
                "<span role=\"cell\" data-header=\"Salida\">{$d['out_date']}</span>\n" .
                "<span role=\"cell\" data-header=\"Voucher\" style=\"text-align: center; \">
                <button onClick='delRes({$d['id']}, {$d['main_client']}, {$rebound})' type='button' title='Borrar' class='btn btn-danger btn-sm'><i class=\"fa fa-ban\"></i></button>\n" .
                "<button onClick='voucher({$d['id']});' type='button' title='Imprimir' class='btn btn-primary btn-sm'><i class=\"fa fa-print\"></i></button></span>\n" . 
                "</div>");

                echo $output;
            }
        }
    ?>
    </div></div>
    <br>
    <div class='text-end'>
    <?php if ( @isset($_GET['client']) ) { ?>
    <button type="button" class="btn btn-success btn-sm" onclick="showAddReserv(<?php echo $_GET['client'] ?>, '<?php echo $client_name['full_name'] ?>');" data-bs-target="#addReservation" data-bs-toggle="modal" data-bs-dismiss="modal">Agregar</button>
    <?php } ?>
    <button type="button" class="btn btn-primary btn-sm">Imprimir todos</button>
    </div></div>
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

