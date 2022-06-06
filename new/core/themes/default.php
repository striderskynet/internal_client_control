<?php
    $position = array('Clientes','Listado de Clientes', 'clients');
    
    $theme_script = "default";
    //$clients_data = api("clients", "list");
?>
<script defer>
    let pagination = <?php echo $config['misc']['pagination'] ?>;
    let position = [];
    
    position['sub_title'] = '<?php echo $position[0] ?>';
    position['title'] = '<?php echo $position[1] ?>';
    position['var'] = '<?php echo $position[2] ?>';

    var clients_data_api = null;
</script>
<!-- Main Table Wrapper -->
    <main class="main_wrapper mx-auto flex-shrink-0">
        <div class='d-flex justify-content-end'>
            <?php if ( _DEBUG ) { ?>
            <button id="button_generate_client" type="button" class="btn btn-primary m-2"><i class="fas fa-plus"></i> Generar Cliente</button>
            <?php } ?>
            <button id="button_client_add" type="button" class="btn btn-success m-2"><i class="fas fa-plus"></i> Agregar</button>
        </div>
        
        
        <table id='main-table' style='table-layout:fixed;' class="table table-striped table-responsive table-hover align-middle mb-0 bg-white rounded-top">
            <thead class="table-dark">
            <tr>
                <th style='width: 400px' data-order-id='lastname'>Nombre</th>
                <th style='width: 200px' data-order-id='country'>Pasaporte / Pais</th>
                <th style='width: 200px' data-order-id='status'>Estado</th>
                <th style='width: 250px' data-order-id='date_added'>Fecha</th>
                <th style='width: 150px' data-order-id='company'>Empresa</th>
                <th style='width: 100px'>Accion</th>
            </tr>
            </thead>
            <tbody id='main-table-body'>
            <!-- Data ROW -->
                <tr class='hide' id='data-default' data-user-id="u01">
                    <td>
                    <div class="d-flex align-items-center">
                    {profile_picture}</i>
                        <div class="ms-3" style='font-size: 15px;'>
                            <p class="fw-bold mb-0"><strong>{prefix}</strong> {name} {lastname}</p>
                            <p class="fw-bolder ms-2 mb-0"><a class='text-info' href='mailto:{email}'>{email}</a></p>
                            <p class="fw-bolder ms-2 mb-0"><a class='text-info' href='tel:{phone}'>{phone}</a></p>
                        </div>
                    </div>
                    </td>
                    <td class="align-middle">
                    <p class="fw-normal mb-1">{passport}</p>
                    <p class="fw-bolder mb-0"><span class="fi fi-{country_lowercase}"></span> {country} / {country_full}</p>
                    </td>
                    <td class="align-middle">
                        <h5><span class="badge bg-{status_type} p-2">{status}</span></h5>
                    </td>
                    <td class="align-middle">{date_added}</td>
                    <td class="align-middle">{company}</td>
                    <td class="align-middle">
                        <button id="button_voucher_add" onclick="button_voucher_add(this)" data-user-id="{id}" data-user-name="{full_name}" type="button" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-mdb-placement="top" title="Agregar reserva..."><i class="fas fa-plus"></i></button>
                        <button id="button_user_del" onclick="button_user_del(this)" data-user-id="u{id}" type="button" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-mdb-placement="top" title="Borrar cliente..."><i class="fas fa-ban"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
        
        <nav aria-label="...">
            <div class='table-label'>Mostrando <strong id='table-label-min'>0</strong>-<strong id='table-label-max'>0</strong> de un total de <strong id='table-label-total'>0</strong></div>
            <ul id='main_client_pagination' class="pagination pagination-circle m-3 justify-content-end">
            </ul>
        </nav>
    </main>
    <br><br>