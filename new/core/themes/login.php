<?php
    $position = array('Loguearse','Loguearse', 'login');

    $theme_script = "login";
    $login = true;
    //$clients_data = api("clients", "list");
?>
<script>
    
    let pagination = <?php echo $config['misc']['pagination'] ?>;
    let position = [];
    
    position['sub_title'] = '<?php echo $position[0] ?>';
    position['title'] = '<?php echo $position[1] ?>';
    position['var'] = '<?php echo $position[2] ?>';

    var clients_data_api = null;
</script>

<div id="login-modal" data-bs-backdrop="static" class="modal fade show" aria-modal="true" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id='login-form' method="post" autocomplete="on">
                <div class="modal-header bg-primary text-light">				
                    <h4 class="modal-title">Entrar</h4>
                    
                </div>
                <div class="modal-body">	
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                <input autocomplete='username' placeholder="Username" type="text" id="username_login" name="username_login" class="form-control form-icon-trailing" required="required" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-asterisk"></i></span>
                                <input autocomplete='current-password' placeholder="Password" type="password" id="password_login" name="assword_login" class="form-control form-icon-trailing" required="required" />
                            </div>
                        </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <label class="form-check-label"><input type="checkbox"> Recordarme</label>
                    <input type="submit" class="btn btn-primary" value="Entrar">
                </div>
            </form>
        </div>
    </div>
</div>