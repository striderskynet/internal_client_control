<?php
$position = array('Reservas', 'Listado de Reservas', 'voucher');

$theme_script = "voucher";
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
<!-- Voucher Table Wrapper -->
<main class="main_wrapper mx-auto flex-shrink-0">
    <div class="form-check left-absolute">

    </div>
    <div class='d-flex justify-content-end'>
        <button id="button_voucher_add" type="button" class="btn btn-success m-2"><i class="fas fa-plus"></i> Agregar</button>
    </div>


    <table id='main-table' style='table-layout:fixed;' class="table table-striped table-hover align-middle mb-0 bg-white rounded-top">
        <thead class="table-dark">
            <tr>
                <th>A nombre de</th>
                <th>Acompañantes</th>
                <th>Tipo</th>
                <th>Data</th>
                <th>Company</th>
                <th>Entrada / Salida</th>
                <th>Confirmacion</th>
                <th>Accion</th>
            </tr>
        </thead>
        <tbody id='main-table-body'>
            <!-- Data ROW -->
            <tr class='hide' id='data-default' data-user-id="u01">
                <td>
                    <div class="d-flex align-items-center">
                        {profile_picture}</i>
                        <div class="ms-3" style='font-size: 15px;'>
                            <p class="fw-bold mb-1"><strong>{prefix}</strong> {name} {lastname}</p>
                        </div>
                    </div>
                </td>
                <td class="align-middle">{additional_clients}</td>
                <td class="align-middle">{type}</td>
                <td class="align-middle">{data}</td>
                <td class="align-middle">{service_partner}</td>
                <td class="align-middle"><span class='text-success'><i class="fa fa-sign-in" aria-hidden="true"></i> {in_date}</span><br><span class='text-danger'><i class="fa fa-sign-out" aria-hidden="true"></i> {out_date}</span></td>
                <td class="align-middle">{confirmation_number}</td>
                <td class="align-middle">
                    <button id="button_voucher_print" onclick="button_voucher_print(this)" data-voucher-id="{voucher_id}" type="button" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-mdb-placement="top" title="Imprimir reserva..."><i class="fas fa-print"></i></button>
                    <button id="button_voucher_del" onclick="button_voucher_del(this)" data-voucher-id="{voucher_id}" type="button" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-mdb-placement="top" title="Borrar reserva..."><i class="fas fa-ban"></i></button>
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