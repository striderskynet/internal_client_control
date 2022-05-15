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
            <span><input class="search-input" placeholder="Buscar..." ></span>
            
            <div class="filter-panel">
                <label for="filter-column">Filtros</label>
                <label for="wrap-text">Expandir...</label>
                <a href="#_" class="add-content" data-toggle="modal" data-target="#modal_contact">Agregar</a>                

                <ul>
                    <li><label for="col-1">ID</label></li>
                    <li><label for="col-2">Cliente</label></li>
                    <li><label for="col-3">Direccion</label></li>
                    <li><label for="col-4">Telefono</label></li>
                    <li><label for="col-5">Estado</label></li>
                    <li><label for="col-6">Modelo</label></li>
                    <li><label for="col-7">Fecha</label></li>
                    <li><label for="col-8">Fuente</label></li>
                    <li><label for="col-9">Informacion</label></li>
                </ul>			
            </div>
        </div>
			  
	<!--TABLE HEADER-->
        <div role="row-group">
            <div role="row">
                <span role="column-header" style='text-align: center; max-width: 20px !important'>ID</span>
                <span role="column-header">Cliente</span>
                <span role="column-header">Direccion</span>
                <span role="column-header">Telefono</span>
                <span role="column-header">Estado</span>
                <span role="column-header">Modelo</span>
                <span role="column-header">Fecha</span>
                <span role="column-header">Fuente</span>
                <span role="column-header">Informacion</span>
            </div>
        </div>
			  
	<!--TABLE BODY -->
    <div role="row-group">
        <?php
            $month = null;
            $subheader = false;
            foreach ( $var['data'] as $d )
            {
                $data['date'] = date("d/m/Y", strtotime($d->date) );
                $data['smalldate'] = date("d M \d\\e\l Y, D", strtotime($d->date) );
                $data['month'] = date("Y, M", strtotime($d->date) );

                $data['phones'] = null;
                if (is_array($d->phone))
                {
                    $q = 0;
                    foreach ($d->phone as $p)
                    {
                        if (strlen(trim($p)) > 0)
                            $data['phones'] .= $p . "; ";

                        $q++;
                    }
                    $data['phones'] =  substr($data['phones'],0,-2);
                } else 
                $data['phones'] = $d->phone;
                

                if ($month != null)
                {
                    if ($month != $data['month'])
                        $subheader = true;
                }
                $month = $data['month'];
                
                if ($subheader == true)
                {
                ?>
                <div role="subheader">
                    <span role="cell"><?php echo $data['month']?></span>
                </div>
                <?php } ?>
        <!-- ROW 1 -->
        <div role="row">
        
            <!-- EXPANDABLE/ COLLAPSIBLE SECTION -->
            <input id="row-<?php echo $d->id?>" name="#" type="checkbox">
            <div class="expandable" role="cell">
                <div role="row">
                    <?php echo $d->message ?>
                </div>
            </div>
            
            <!-- ROW CELLS -->
            <span role="cell" data-header="ID" style='text-align: center; max-width: 20px !important'><a href="#"><?php echo $d->id?></a></span>
            <span role="cell" data-header="Cliente"><?php echo $d->name?></span>
            <span role="cell" data-header="Direccion"><span><?php echo $d->address?></span></span>
            <span role="cell" data-header="Telefono"><?php echo $data['phones']?></span>
            <span role="cell" data-header="Estado" class="status"><span status-bar="id-<?php echo trim($d->status)?>"><?php echo $cfg['pending_status'][trim($d->status)]?></span></span>
            <span role="cell" data-header="Modelo"><span></span><?php echo trim($d->model)?></span>
            <span role="cell" data-header="Fecha"><span tooltip="Fecha de Encargo: <?php echo $data['smalldate']?>"><?php echo $data['date']?></span></span>
            <span role="cell" data-header="Fuente"><?php echo $d->source?></span>
            <span role="cell" data-header="Informacion">
                <label for="row-<?php echo $d->id?>"></label>
                <label onclick="deleteUser(<?php echo $d->id?>, '<?php echo $d->name?>')" class='delete-user'></label>
            </span>
        </div>
        
        <?php } ?>
    </div>
</div>

<div class="modal fade" id="modal_contact" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action='?add_user' method='post' id="modal_form_contact" novalidate="novalidate">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="fa fa-send mr-1"></i>Agregar Contacto
                        </h5>
                        <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="modal_contact_firstname">Nombre</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                        </span>
                                        <input type="text" id="modal_contact_firstname" name="modal_contact_firstname" class="form-control" placeholder="Nombre" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group" id='modal-phone'>
                                    <label for="modal_contact_phone">Telefono/s</label>
                                    <div class="input-group" id='modal-phone-input'>
                                        <span class="input-group-addon">
                                            <i class="fa fa-phone"></i>
                                        </span>
                                        <input type="text" id="modal_contact_phone" name="modal_contact_phone[]" class="form-control" placeholder="Telefono/s" />
                                        <span class="input-group-addon more-phones" onclick='addPhone()'>
                                            <span class="fa fa-plus" href='#'  alt='Agregar mas telefonos'></span>
                                        </span>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="modal_contact_address">Direccion</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-envelope"></i>
                                </span>
                                <input type="address" id="modal_contact_address" name="modal_contact_address" class="form-control" placeholder="Escribe la direccion" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="modal_contact_model">Equipo</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-laptop"></i>
                                </span>
                                <input type="model" id="modal_contact_model" name="modal_contact_model" class="form-control" placeholder="Escribe el equipo" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="modal_contact_message">Informacion</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-edit"></i>
                                </span>
                                <textarea id="modal_contact_message" name="modal_contact_message" class="form-control" placeholder="Message body"></textarea>
                            </div>
                        </div>  
                        <div class="form-group">
                            <label for="modal_contact_source">Fuente</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-link"></i>
                                </span>
                                <input type="text" id="modal_contact_source" name="modal_contact_source" class="form-control" placeholder="Escribe la fuente" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
                        <button type="submit" class="btn btn-primary">ENVIAR</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
