<?php
    if (@isset($_GET['test_db']))
    {
        $error = null;
        try{
            $conn = new mysqli($_GET['host'], $_GET['user'], $_GET['pass'], $_GET['db']);
        } catch (Exception $e) {
           $error = $e->getMessage();
        }

        if ( $error == null )
            die("<label class=\"true\">Sucess!</label>");

        die("<label class=\"false\">" . $error . "</label>");
    }
?>
<link rel="stylesheet" href="../assets/css/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="../assets/css/font-awesome.min.css" type="text/css" />
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>

<style>
* {
    margin: 0;
    padding: 0;
}

html {
    height: 100%;
}

p {
	color: grey;
}

#heading {
	text-transform: uppercase;
	color: var(--bs-blue);
	font-weight: normal;
}

#msform {
    text-align: center;
    position: relative;
    margin-top: 20px;
}

#msform fieldset {
    background: white;
    border: 0 none;
    border-radius: 0.5rem;
    box-sizing: border-box;
    width: 100%;
    margin: 0;
    padding-bottom: 20px;

    /*stacking fieldsets above each other*/
    position: relative;
}

.form-card {
	text-align: left;
}

/*Hide all except first fieldset*/
#msform fieldset:not(:first-of-type) {
    /*display: none;*/
}

#msform input, #msform textarea {
    padding: 8px 15px 8px 15px;
    border: 1px solid #ccc;
    border-radius: 0px;
    margin-bottom: 25px;
    margin-top: 2px;
    width: 100%;
    /*box-sizing: border-box;
    font-family: montserrat;
    color: #2C3E50;
    background-color: #ECEFF1;*/
    font-size: 16px;
    letter-spacing: 1px;
}

#msform input:focus, #msform textarea:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    border: 1px solid var(--bs-blue);
    outline-width: 0;
}

/*Next Buttons*/
#msform .action-button {
    width: 100px;
    background: var(--bs-blue);
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 0px 10px 5px;
    float: right;
}

#msform .action-button:hover, #msform .action-button:focus {
    background-color: var(--bs-blue);
}

/*Previous Buttons*/
#msform .action-button-previous {
    width: 100px;
    background: #616161;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px 10px 0px;
    float: right;
}

#msform .action-button-previous:hover, #msform .action-button-previous:focus {
    background-color: #000000;
}

/*The background card*/
.card {
    z-index: 0;
    border: none;
    position: relative;
}

/*FieldSet headings*/
.fs-title {
    font-size: 25px;
    color: var(--bs-blue);
    margin-bottom: 15px;
    font-weight: normal;
    text-align: left;
}

.purple-text {
	color: var(--bs-blue);
    font-weight: normal;
}

/*Step Count*/
.steps {
	font-size: 25px;
    color: gray;
    margin-bottom: 10px;
    font-weight: normal;
    text-align: right;
}

/*Field names*/
.fieldlabels {
	color: gray;
	text-align: left;
}

/*Icon progressbar*/
#progressbar {
    margin-bottom: 30px;
    overflow: hidden;
    color: lightgrey;
}

#progressbar .active {
    color: var(--bs-blue);
}

#progressbar li {
    list-style-type: none;
    font-size: 15px;
    width: 20%;
    float: left;
    position: relative;
    font-weight: 400;
}

/*Icons in the ProgressBar*/
#progressbar #account:before {
    font-family: FontAwesome;
    content: "\f007";
}

#progressbar #directory:before {
    font-family: FontAwesome;
    content: "\f17a";
}

#progressbar #database:before {
    font-family: FontAwesome;
    content: "\f1c0";
}

#progressbar #resumee:before {
    font-family: FontAwesome;
    content: "\f0ae";
}

#progressbar #confirm:before {
    font-family: FontAwesome;
    content: "\f00c";
}

/*Icon ProgressBar before any progress*/
#progressbar li:before {
    width: 50px;
    height: 50px;
    line-height: 45px;
    display: block;
    font-size: 20px;
    color: #ffffff;
    background: lightgray;
    border-radius: 50%;
    margin: 0 auto 10px auto;
    padding: 2px;
}

/*ProgressBar connectors*/
#progressbar li:after {
    content: '';
    width: 100%;
    height: 2px;
    background: lightgray;
    position: absolute;
    left: 0;
    top: 25px;
    z-index: -1;
}

/*Color number of the step and the connector before it*/
#progressbar li.active:before, #progressbar li.active:after {
    background: var(--bs-blue);
}

/*Animated Progress Bar*/
.progress {
	height: 20px;
}

.progress-bar {
	background-color: var(--bs-blue);
}

/*Fit image in bootstrap div*/
.fit-image{
    width: 100%;
    object-fit: cover;
}

.next, .previous
{
    float: right;
    margin-left: 10px;
}

.normal{ color: blue; float: right; }
.false{ color: red; }
.true{ color: green; }

#test_db{
    margin-left: 20px;
}
</style>

<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-11 col-sm-10 col-md-7 col-lg-7 col-xl-5 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                <h2 id="heading">INSTALACION DEL SISTEMA SCCS</h2>
                <p>Llena todos los campos y sigue los pasos</p>

                <form id="msform">
                    <!-- progressbar -->
                    <ul id="progressbar">
                        <li class="active" id="account"><strong>Cuenta</strong></li>
                        <li id="directory"><strong>Sistema</strong></li>
                        <li id="database"><strong>Base de Datos</strong></li>
                        <li id="resumee"><strong>Resumen</strong></li>
                        <li id="confirm"><strong>Finalizar</strong></li>
                    </ul>
                    <div class="progress">
                    	<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                	</div>
                    <br>
                    <!-- fieldsets -->
                    <fieldset>
                        <div class="form-card">
                        	<div class="row">
                        		<div class="col-7">
                            		<h2 class="fs-title">Cuenta principal:</h2>
                            	</div>
                            	<div class="col-5">
                            		<h2 class="steps">Paso 1 - 5</h2>
                            	</div>
                            </div>
                            <label class="fieldlabels">Username: *</label>
                            <input type="text" id='uname' name="uname" placeholder="Username" value=""/>
                            <label class="fieldlabels">Password: *</label>
                            <input type="password" id='upwd' name="upwd" placeholder="Password" value=""/>
                            <label class="fieldlabels">Confirmar Password: *</label>
                            <input type="password" id='ucpwd' name="ucpwd" placeholder="Confirmar Password" value=""/>
                        </div>
                        <button type="button" class="btn btn-primary next">Siguiente</button>
                    </fieldset>
                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                        		<div class="col-7">
                            		<h2 class="fs-title">Informacion del sistema:</h2>
                            	</div>
                            	<div class="col-5">
                            		<h2 class="steps">Paso 2 - 5</h2>
                            	</div>
                            </div>

                            <?php
                                $run = true;
                                ob_start();  
                                if(function_exists('phpinfo')) @phpinfo(-1);
                                $phpinfo = array('phpinfo' => array());
                                if(preg_match_all('#(?:<h2>(?:<a name=".*?">)?(.*?)(?:</a>)?</h2>)|(?:<tr(?: class=".*?")?><t[hd](?: class=".*?")?>(.*?)\s*</t[hd]>(?:<t[hd](?: class=".*?")?>(.*?)\s*</t[hd]>(?:<t[hd](?: class=".*?")?>(.*?)\s*</t[hd]>)?)?</tr>)#s', ob_get_clean(), $matches, PREG_SET_ORDER))
                                foreach($matches as $match){
                                    $array_keys = array_keys($phpinfo);
                                    $end_array_keys = end($array_keys);
                                    if(strlen($match[1])){
                                        $phpinfo[$match[1]] = array();
                                    }else if(isset($match[3])){
                                        $phpinfo[$end_array_keys][$match[2]] = isset($match[4]) ? array($match[3], $match[4]) : $match[3];
                                    }else{
                                        $phpinfo[$end_array_keys][] = $match[2];
                                    }
                                }
                                
                                function check_true_false($val1, $val2, $type = "plus")
                                {
                                    global $run;
                                    $color = "false";

                                    switch ($type) {
                                        case "plus":
                                            if ( $val1 >= $val2 )
                                                $color = "true";
                                            break;
                                        case "equal":
                                            if ( $val1 == $val2)
                                                $color = "true";
                                            break;
                                        default:
                                                $color = "true";
                                            break;
                                    }

                                    if ($color == "false")
                                    {
                                        $run = false;
                                        return "<b class='$color'>$val1</b> <b class='normal'>$val2</b>";
                                    } else return "<b class='$color'>$val1</b>";
                                }

                                $data['php_version'] = check_true_false(phpversion(), "7", "plus");
                                $data['system'] = check_true_false($phpinfo['phpinfo']['System'], "");
                                $data['arch'] = check_true_false($phpinfo['phpinfo']['Architecture'], "x64", "equal");
                                $data['build'] = check_true_false($phpinfo['phpinfo']['Build Date'], "");
                                $data['server_api'] = check_true_false($phpinfo['phpinfo']['Server API'], "");


                               // print_r ( $phpinfo );
                            ?>
                            <label style='display: block; font-weight: bold;'>Obtener informacion del Servidor</label>
                            <label style='display: block;' >PHP Version: <?php echo $data['php_version'] ?></label>
                            <label style='display: block;' class="fieldlabels">Sistema: <?php echo $data['system']?></label>
                            <label style='display: block;' class="fieldlabels">Arquitectura del sistema: <?php echo $data['arch']?></label>
                            <label style='display: block;' class="fieldlabels">Fecha de compilación: <?php echo $data['build']?></label>
                            <label style='display: block;' class="fieldlabels">Servidor de la API: <?php echo $data['server_api']?></label>
                        </div>
                        
                        <button type="button" class="btn btn-primary next">Siguiente</button>
                        <button type="button" class="btn btn-secondary previous">Atras</button>
                    </fieldset>
                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                        		<div class="col-7">
                            		<h2 class="fs-title">Base de Datos:</h2>
                            	</div>
                            	<div class="col-5">
                            		<h2 class="steps">Paso 3 - 5</h2>
                            	</div>
                            </div>
                            <label class="fieldlabels">Host: *</label>
                            <input type="text" name="db_host" placeholder="localhost" value="localhost"/>
                            <label class="fieldlabels">Database: *</label>
                            <input type="text" name="db_database" placeholder="endirecto" value="endirecto"/>
                            <label class="fieldlabels">Username: *</label>
                            <input type="text" name="db_user" placeholder="root" value="root"/>
                            <label class="fieldlabels">Password: </label>
                            <input type="text" name="db_password" placeholder="" value=""/>

                            <button id='test_sql' type="button" class="btn btn-primary">Probar conexion</button> <span id='test_db'></span>
                        </div>
                        <button type="button" class="btn btn-primary next">Siguiente</button>
                        <button type="button" class="btn btn-secondary previous">Atras</button>
                    </fieldset>
                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                        		<div class="col-7">
                            		<h2 class="fs-title">Image Upload:</h2>
                            	</div>
                            	<div class="col-5">
                            		<h2 class="steps">Paso 4 - 5</h2>
                            	</div>
                            </div>
                            <label class="fieldlabels">Upload Your Photo:</label>
                            <input type="file" name="pic" accept="image/*">
                            <label class="fieldlabels">Upload Signature Photo:</label>
                            <input type="file" name="pic" accept="image/*">
                        </div>
                        <button type="button" class="btn btn-primary next">Siguiente</button>
                        <button type="button" class="btn btn-secondary previous">Atras</button>
                    </fieldset>
                    <fieldset>
                        <div class="form-card">
                        	<div class="row">
                        		<div class="col-7">
                            		<h2 class="fs-title">Finalizado:</h2>
                            	</div>
                            	<div class="col-5">
                            		<h2 class="steps">Paso 5 - 5</h2>
                            	</div>
                            </div>
                            <br><br>
                            <h2 class="purple-text text-center"><strong>Exito!</strong></h2>
                            <br>
                            <div class="row justify-content-center text-center">
                                    <i style='color: var(--bs-primary); font-size: 200px;' class="fa fa-5x fa-check"></i>
                            </div>
                            <br><br>
                            <div class="row justify-content-center">
                                <div class="col-7 text-center">
                                    <h5 class="text-center">Se ha instalado todo correcto</h5>
                                    <h6 class="text-center"><a href='../'>Desea ir al sitio</a></h6>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
	</div>
</div>

<script>
    $(document).ready(function(){
    
    var current_fs, next_fs, previous_fs; //fieldsets
    var opacity;
    var current = 1;
    var steps = $("fieldset").length;
    
    setProgressBar(current);
    
    $(".next").click(function(){
        
        if ( validate("uname") != true ) return false;
        if ( validate("upwd") != true ) return false;
        if ( validate("ucpwd") != true ) return false;

        current_fs = $(this).parent();
        next_fs = $(this).parent().next();
        
        //Add Class Active
        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
        
        //show the next fieldset
        next_fs.show(); 
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function(now) {
                // for making fielset appear animation
                opacity = 1 - now;
    
                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                next_fs.css({'opacity': opacity});
            }, 
            duration: 500
        });
        setProgressBar(++current);
    });
    
    $(".previous").click(function(){
        
        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();
        

        //Remove class active
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
        
        //show the previous fieldset
        previous_fs.show();
    
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function(now) {
                // for making fielset appear animation
                opacity = 1 - now;
    
                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                previous_fs.css({'opacity': opacity});
            }, 
            duration: 500
        });
        setProgressBar(--current);
    });
    
    function setProgressBar(curStep){
        var percent = parseFloat(100 / steps) * curStep;
        percent = percent.toFixed();
        $(".progress-bar")
          .css("width",percent+"%")   
    }

    function validate(id){

        obj = document.getElementById(id);
        obj1 = document.getElementById('upwd');

        dat = obj.value;
        dat1 = obj1.value;
        
        console.log("Validating: " + id);

        switch (id)
        {
            case "uname":
                if ( dat.length > 5) { obj.style = "background: #ddffdd;"; return true;} 
                break;
            case "upwd":
                if ( dat.length > 5) { obj.style = "background: #ddffdd;"; return true;} 
                break;
            case "ucpwd":
                if ( dat1 == dat) { obj.style = "background: #ddffdd;"; return true;} 
                break;
        }
       
         obj.style="background: #ffdddd;";
         return false;
            

    }
    
    $(".submit").click(function(){
        return false;
    })

    $("#test_sql").click(function(){

        var d = [];

        d['host'] = document.getElementsByName("db_host")[0].value;
        d['user'] = document.getElementsByName("db_user")[0].value;
        d['pass'] = document.getElementsByName("db_password")[0].value;
        d['data'] = document.getElementsByName("db_database")[0].value;

        $.ajax({
                url: "./?test_db&host=" + d['host'] + "&user=" + d['user'] + "&pass=" + d['pass'] + "&db=" + d['data'],
                cache: false
            })
                .done(function( html ) {
                    document.getElementById("test_db").innerHTML = html;
                })

        return false;
    })
        
    });    
</script>