<div class='search-input-div'>
      <input id='search-input' class="search-input" type='text' placeholder="Buscar..." onkeyup="searchInput()">
    </div>
<div role="table" aria-label="Clients Table" aria-describedby="QuanticaLabs">
	<!--DESCRIPTION / COLUMN FILTERING -->
    <input id="col-1" class="column" name="#" type="checkbox">
    <input id="col-2" class="column" name="#" type="checkbox">
    <input id="col-3" class="column" name="#" type="checkbox">
    <input id="col-4" class="column" name="#" type="checkbox">
    <input id="col-5" class="column" name="#" type="checkbox">
    <input id="col-6" class="column" name="#" type="checkbox">
    <input id="col-7" class="column" name="#" type="checkbox">
    <input id="col-8" class="column" name="#" type="checkbox">
    <input id="col-9" class="column" name="#" type="checkbox">
    <input id="col-10" class="column" name="#" type="checkbox">
    <input id="col-11" class="column" name="#" type="checkbox">
    <input id="col-12" class="column" name="#" type="checkbox">
    <input id="col-13" class="column" name="#" type="checkbox">
    <input id="col-14" class="column" name="#" type="checkbox">
    <input id="col-15" class="column" name="#" type="checkbox">
    <input id="col-16" class="column" name="#" type="checkbox">
    
    <input id="filter-column" name="#" type="checkbox">
   
    <input id="wrap-text" name="#" type="checkbox">
        <div class="table-desc">
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
                <span role="column-header">Nombre</span>
                <span role="column-header">Pasaporte</span>
                <span role="column-header">Telefono</span>
                <span role="column-header">eMail</span>
                <span role="column-header">Pais</span>
                <span role="column-header">Fecha</span>
                <span role="column-header">Empresa</span>
                <span role="column-header">Datos</span>
            </div>
        </div>
        <div role="row-group" id='row-group'>
	    </div>
</div>

<div class="modal fade" id="newModal" tabindex="-1" role="dialog">
</div>

<div class="modal fade" id="modal_contact" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form action='?add_client' method='post' id="modal_form_contact" novalidate="novalidate">
            <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="fa fa-send"></i> Agregar Cliente
                        </h5>
                 </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                <select name='modal_contact_prefix' id="modal_contact_prefix" class='form-select'>
                                    <option value="Sr.">Sr.</option>
                                    <option value="Sra.">Sra.</option>
                                    <option value="Dr.">Dr.</option>
                                    <option value="Msc">MSc</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                <input type="text" id="modal_contact_firstname" name="modal_contact_firstname" aria-label="First name" class="form-control" placeholder="Nombre">
                                <span class="input-group-text"><i class="fa fa-link"></i></span>
                                <input type="text" id="modal_contact_lastname" name="modal_contact_lastname" aria-label="Last name" class="form-control" placeholder="Apellidos">
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                <input type="text" id="modal_contact_phone" name="modal_contact_phone" aria-label="Telefono" class="form-control" placeholder="Telefono">
                                </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                <input type="text" id="modal_contact_email" name="modal_contact_email" aria-label="Telefono" class="form-control" placeholder="Correo">
                                </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-edit"></i></span>
                                <input type="text" id="modal_contact_passport" name="modal_contact_passport" aria-label="Pasaporte" class="form-control" placeholder="Pasaporte">
                                <span class="input-group-text"><i class="fa fa-edit"></i></span>
                                <select name='modal_contact_country' id='countrypicker' class='form-select'></select>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-edit"></i></span>
                                <input type="text" id="modal_contact_source" name="modal_contact_source" aria-label="Empresa" class="form-control" placeholder="Empresa a la que pertenece el cliente">
                                </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-edit"></i></span>
                                <textarea id="modal_contact_message" name="modal_contact_message" class="form-control" placeholder="Informacion"></textarea>
                               </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCELAR</button>
                        <button type="submit" class="btn btn-primary">ENVIAR</button>
                    </div>
            </div>
        </form>
    </div>
</div>
</div>

<div class="modal fade " id="addReservation" aria-hidden="true" aria-labelledby="addReservation" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="fa fa-send"></i> Agregar Reservación
                            </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                <input type="text" id="mres_client_name" name="mres_client_name" class="form-control" placeholder="Nombre del Cliente" disabled>
                                <input type="hidden" id="mres_client_id" name="mres_client_id" value=''>
                               </div><br>

                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                <input onkeyup="countClients();" type="text" id="mres_additional_clients" name="mres_additional_clients" class="form-control" placeholder="Acompañantes">
                                <span class="input-group-text">Total</span>
                                <input type="text" id="mres_total_clients" class="form-control" placeholder="1" disabled>
                               </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="input-group">
                                <label class="input-group-text" for="inputGroupSelect01">Tipo</label>
                                <input class="form-control" list="datalistOptions" id="mres_type" placeholder="Escojer el tipo de reserva">
                                <datalist id="datalistOptions">
                                                <option value="Hotel / House">
                                                <option value="Event / Show">
                                                <option value="Transfer">
                                                <option value="Otro">
                                </datalist>
                                </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="input-group">
                            <div class="input-group"><span class="input-group-text"><i class="fa fa-edit"></i></span>
                            <div class="form-floating">
                            <textarea class="form-control" id="mres_details" style="height: 100px; width:213%;"></textarea>
                            <label for="mres_details">Detalles</label>
</div></div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="input-group">
                                    <div class="date_picker input-group date" id="datepicker">
                                        <input type="text" class="form-control" id="mres_inDate" placeholder="Fecha de Entrada" />
                                        <span class="input-group-append">
                                        <span class="input-group-text bg-light d-block">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        </span>
                                    </div>
                            </div><br>
                            <div class="input-group">
                                    <div class="date_picker input-group date" id="datepicker">
                                        <input type="text" class="form-control" id="mres_outDate" placeholder="Fecha de Salida" />
                                        <span class="input-group-append">
                                        <span class="input-group-text bg-light d-block">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        </span>
                                    </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-edit"></i></span>
                                <input type="text" id="mres_servicePartner" name="mres_servicePartner" class="form-control" placeholder="Prestatario del Servicio">
                                </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="input-group"><span class="input-group-text"><i class="fa fa-edit"></i></span>
                            <div class="form-floating">
                                
                                <textarea class="form-control" placeholder="Observaciones" id="mres_observations" style="height: 100px; width:213%;"></textarea>
                                <label for="mres_observations">Observaciones</label>
</div>
                            </div><br>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-hashtag"></i></span>
                                <input type="text" id="mres_confNumber" name="mres_confNumber" class="form-control" placeholder="Numero de Confirmacion" >
                               </div>
                        </div>
                        
                    </div>
      <div class="modal-footer">
        <button onclick="addReservation();" class="btn btn-success">Guardar</button>
        <button class="btn btn-primary" data-bs-target="#newModal" data-bs-toggle="modal" data-bs-dismiss="modal">Atras</button>
        
    </div>
    </div>
  </div>
</div>
</div>


<div id="myToast" class="toast text-white bg-primary border-0 bottom-0 start-50 translate-middle-x" role="alert" aria-live="assertive" aria-atomic="true" style="position: absolute;">
  <div class="d-flex">
    <div class="toast-body" id='toast-body'>
    </div>
    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
</div>
<script>
        function countClients()
        {
            item = document.getElementById("mres_additional_clients");
            itemTotal = document.getElementById("mres_total_clients");
            itemTotal.value = parseInt(item.value) + 1;
        }
</script>

