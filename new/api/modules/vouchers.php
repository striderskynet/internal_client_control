<?php

     switch(@array_keys($_GET)[1]){
        case "delete":
            echo voucher_delete();
            break;
        case "add":
            echo voucher_add();
            break;
        case "print":
            echo voucher_print();
            break;
        case "list":
            echo voucher_list();
            break;
        default:
            echo voucher_show();
            break;
    }

    function voucher_print()
    {
        global $db;

        $query = 'SELECT *, `main_vouchers`.`id` as voucher_id FROM main_vouchers, main_clients WHERE `main_vouchers`.`id` = ' . $_GET['id'] . ' AND main_clients.`id` = main_vouchers.`main_client` ORDER BY main_vouchers.`id` DESC;';
      
        debug(4, $query);
        $data = $db->query($query)->fetchArray();
        
        $query_companions = "SELECT client_id FROM `voucher_client_array` WHERE `voucher_id` = {$data['voucher_id']}";
        $comp = $db->query($query_companions); 
        $comp =  $comp->fetchAll();

        $q = 0;
            foreach ( $comp as $c ){
                $query_comp = "SELECT `id`, `passport`, `name`, `lastname`, concat(prefix, ' ', name, ' ',  lastname) AS full_name FROM `main_clients` WHERE `id` = {$c['client_id']}";

                $co = $db->query($query_comp); 
                $co =  $co->fetchAll();

                $data['companions'][$q]['id'] = $co[0]['id'];
                $data['companions'][$q]['name'] = $co[0]['full_name'];
                $data['companions'][$q]['passport'] = $co[0]['passport'];
                //$data['companions'][$q]['profile_picture'] = profile_picture ($co[0]['passport'], $co[0]['name'], $co[0]['lastname'], true);
                $q++;
            }

        return json_encode($data) ;
    }

    function voucher_list(){
        global $db, $config;

        $where = null;
        $limit = null;
        $offset = null;
        if ( @isset($_GET['data']) )
        {
            $where  = "WHERE `name` LIKE '%" . $_GET['data'] . "%'";
            $where .= " OR `lastname` LIKE '%" . $_GET['data'] . "%'";
            $where .= " OR `passport` LIKE '%" . $_GET['data'] . "%'";
            $where .= " OR `email` LIKE '%" . $_GET['data'] . "%'";
            $where .= " OR `phone` LIKE '%" . $_GET['data'] . "%'";
            $where .= " OR `company` LIKE '%" . $_GET['data'] . "%'";
        }
            
        $limit = "LIMIT " . $config['misc']['pagination'];

        if ( @isset($_GET['offset']) )
            $offset = "OFFSET " . ( ($_GET['offset'] - 1) * $config['misc']['pagination']);

       
        $query = 'SELECT *, `main_vouchers`.`id` as voucher_id FROM main_vouchers, main_clients ' . $where . 'WHERE main_clients.`id` = main_vouchers.`main_client` ORDER BY main_vouchers.`id` DESC ' . $limit .' ' . $offset .';';
        $query_no_limit = 'SELECT count(*) as `total` FROM main_vouchers ' . $where . ' ORDER BY `id` DESC;';

        //debug(4, $query);
        $res = $db->query($query);
        $accounts = $res->fetchAll();
        
        foreach ($accounts as $account) {

            $account['profile_picture'] = profile_picture ($account['passport'] ,  $account['name'] ,  $account['lastname']);
            
            $query_companions = "SELECT client_id FROM `voucher_client_array` WHERE `voucher_id` = {$account['voucher_id']}";
            
            $comp = $db->query($query_companions); 
            $comp =  $comp->fetchAll();

            $q = 0;
            foreach ( $comp as $c ){
                $query_comp = "SELECT `id`, `passport`, `name`, `lastname`, concat(prefix, ' ', name, ' ',  lastname) AS full_name FROM `main_clients` WHERE `id` = {$c['client_id']}";

                $co = $db->query($query_comp); 
                $co =  $co->fetchAll();

                $account['companions'][$q]['id'] = $co[0]['id'];
                $account['companions'][$q]['name'] = $co[0]['full_name'];
                $account['companions'][$q]['profile_picture'] = profile_picture ($co[0]['passport'], $co[0]['name'], $co[0]['lastname'], true);
                $q++;
            }

            $data[] = $account;
        }

        $data['info'] = $db->query($query_no_limit)->fetchAll();

        if (!isset($data))
            return json_encode("");
        
       
        //return json_encode($data, JSON_PRETTY_PRINT);
        return json_encode($data);
    }

    function profile_picture($passport, $name, $lastname, $small =  false){

        $profile_picture = md5 (  $passport .  $name .  $lastname );
            
        if ( $small == true )
            $small = array ("ps-15", "fa-1x");
        else $small = array ("ps-45", "fa-2x");

            if ( file_exists ('../uploaded/'.  $profile_picture . ".jpg") )
                return "<img class='{$small[0]} rounded-circle' src='./uploaded/" . $profile_picture . ".jpg' />";
            else
                return "<i class='fas fa-user-alt {$small[1]}'></i>";

        
    }
/*    function voucher_show()
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
}*/

    function voucher_delete(){
        global $db;
        
        $query = "DELETE FROM main_vouchers WHERE `id` = {$_GET['id']}";
        $accounts = $db->query($query);

        debug(4, $query);
        return true;
    }

    function voucher_add(){
        global $db;
        
        //return json_encode($_POST);
        
        $query = "INSERT INTO `main_vouchers` (`main_client`, `type`, `data`, `in_date`, `out_date`, `information`, `service_partner`, `confirmation_number`) VALUES
        ('{$_POST['avf_client_id']}', '{$_POST['avf_type']}', '{$_POST['avf_data']}', '{$_POST['avf_inDate']}', '{$_POST['avf_outDate']}', '{$_POST['avf_details']}', '{$_POST['avf_servicePartner']}', '{$_POST['avf_confirmationNumber']}');";

        debug(4, $query);
        $db->query($query);

        foreach ($_POST['avf_companion_id'] as $comp){
            $query_comp = "INSERT INTO voucher_client_array SELECT id AS `voucher_id`, {$comp} FROM `main_vouchers` ORDER BY `id` DESC LIMIT 1;";
            $db->query($query_comp);
        }
        
        return true;
    }
