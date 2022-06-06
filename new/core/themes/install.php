<?php
    $position = array('Instalacion','Instalacion del Sistema', 'install');
    
    $theme_script = "";
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

<div id="install-user-modal" data-backdrop="static" class="modal fade show" aria-modal="true" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id='install-user-form' method="post" autocomplete="on">
                <div class="modal-header bg-success text-light">				
                    <h4 class="modal-title">Instalacion</h4>
                </div>
                <div class="modal-body">	
                    
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                <input autocomplete='username' placeholder="Usuario" type="text" id="username_login" name="username_login" class="form-control form-icon-trailing" required="required" />
                            </div>
                        </div><br>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-asterisk"></i></span>
                                <input autocomplete='current-password' placeholder="Contraseña" type="password" id="password_login" name="password_login" class="form-control form-icon-trailing" required="required" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-asterisk"></i></span>
                                <input autocomplete='current-password' placeholder="Repetir Contraseña" type="password" id="password2_login" name="password2_login" class="form-control form-icon-trailing" required="required" />
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <p>Paso 2 de 2</p>
                    <input type="submit" class="btn btn-success" value="Crear Usuario">
                </div>
            </form>
        </div>
    </div>
</div>

<div id="install-database-modal" data-backdrop="static" class="modal fade show" aria-modal="true" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id='install-database-form' method="post" autocomplete="on">
                <div class="modal-header bg-success text-light">				
                    <h4 class="modal-title">Crear Base de Datos</h4>
                    
                </div>
                <div class="modal-body">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                <input autocomplete='username' placeholder="Usuario" value='root' type="text" id="user_data" name="user_data" class="form-control form-icon-trailing" required="required" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-asterisk"></i></span>
                                <input autocomplete='current-password' placeholder="Contraseña" type="password" id="pass_data" name="pass_data" class="form-control form-icon-trailing" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-asterisk"></i></span>
                                <input autocomplete='hostname' placeholder="Servidor" value='127.0.0.1' type="text" id="host_data" name="host_data" class="form-control form-icon-trailing" required="required" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-asterisk"></i></span>
                                <input autocomplete='database' placeholder="Base de datos" value='endirecto2' type="text" id="db_data" name="db_data" class="form-control form-icon-trailing" required="required" />
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <p>Paso 1 de 2</p>
                    <input type="submit" class="btn btn-success" value="Crear Base de Datos">
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('#install-database-modal').modal({
        backdrop: 'static'
    });
    $('#install-database-modal').show();
    
    $("#install-database-form").submit(function(e) {
    e.preventDefault();

        var form_login = $(this);
        var info = [];

        info['log_user']    = form_login[0].user_data.value;
        info['log_pass']    = form_login[0].pass_data.value;
        info['log_host']    = form_login[0].host_data.value;
        info['log_db']      = form_login[0].db_data.value;

        $.ajax({
            method: "POST",
            url: "./install/install.php",
            // Passing all the variables
            data: { 
                user: info['log_user'],
                pass:  info['log_pass'],
                host: info['log_host'],
                data: info['log_db']
            }
        }).done(function( msg ) {
            console.log(msg);

            $('#install-database-modal').hide();
            $('#install-user-modal').show();
        });

        console.log ( info );
    });

    $("#install-user-form").submit(function(e) {
    e.preventDefault();

        var form_login = $(this);

        var log_user = form_login[0].username_login.value;
        var log_pass = form_login[0].password_login.value;
        var log_pass2 = form_login[0].password2_login.value;

        if ( log_pass === log_pass2 ){
            $.ajax({
            method: "POST",
            url: "./api/?users&install",
            // Passing all the variables
            data: { 
                username: log_user,
                password: log_pass,
                password2: log_pass2
            }
        }).done(function( msg ) {
            document.location = "./";
        });
        }
    });

</script>