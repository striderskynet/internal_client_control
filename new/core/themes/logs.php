<?php
        $position = array('Logs', 'Panel de Logs', 'logs');

        $theme_script = "logs";
        //$clients_data = api("clients", "list");
        $log_dir = $_SERVER['DOCUMENT_ROOT'] . "/new/logs/";
        
        if ( @isset($_GET['log']) )
        {
            die ( read_logs( $log_dir . $_GET['log'] ) );
        }

        function dir_logs($log_dir)
        {
            $files =  array_reverse (array_diff(scandir($log_dir), array('..', '.')));

            $result = null;
            $q = 0;

            foreach ($files as $f)
            {
                if ( $q == 0)
                    $selected = "selected";
                else $selected = "";

                $result .= "\t\t\t<option value=\"{$f}\" {$selected}>{$f}</option>\n";
                $q++;
            }

            return  $result;
        }

        function read_logs($log_file)
        {
            $logs = file_get_contents($log_file);
            $logs = explode("\n", $logs);

            foreach ($logs as $l)
            {
                $r = explode ( "|", $l);
                parse_logs($r);
            }
        }
        //echo str_replace("\n", "<br>\n", htmlentities(htmlspecialchars($logs)));

        function parse_logs($log){
            if (array_key_exists(2, $log))
            {
                $type = trim($log[1]);
                $value = trim ($log[2]);

                if ( strtolower($type) != "data" )
                {
                    $value = str_replace("(", "(<span class='important'>", $value);
                    $value = str_replace(")", "</span>)", $value);
                }
                echo "<div class='log log_" . strtolower($type) . "'><span class='date'>" . trim($log[0]) . "</span>\t\t|\t\t <span class='type'>" . $type . "</span>\t\t|\t\t <span class='value'>" . $value . "</span></div>\n";
            } else {
                echo "<div class='log log_default'>" . $log[0] . "</div>\n";
            }
        }
    ?>
<style>

    .log_wrapper .card{
        margin: 0px 50px;
    }
  
    .log_select{
        display: block;
        margin: 20px;
        text-align: right;
        width: 90%;
    }

    .log_select .form-select
    {
        margin-left: auto;
        display: block;
        max-width: 500px;
    }
</style>
<div class='log_select' >
    <select id='logs_select' class="form-select" onchange='load_logs(this.value)'>
<?php echo dir_logs($log_dir) ?>
    </select>
</div>
<div id='log_wrapper' class='log_wrapper'>
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 id="file_name" class="text-primary font-weight-bold m-0">{file_name}</h6>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <div class="row align-items-center no-gutters">
                        <div class="col mr-2">
                            <h6 class="mb-0"><strong>Lunch meeting</strong></h6>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
</div>
<script>
    let pagination = <?php echo $config['misc']['pagination'] ?>;
    let position = [];

    position['sub_title'] = '<?php echo $position[0] ?>';
    position['title'] = '<?php echo $position[1] ?>';
    position['var'] = '<?php echo $position[2] ?>';

    var clients_data_api = null;

    function load_logs(log_file)
    {
        $.ajax({
                    url: "core/themes/logs.php?log=" + log_file,
                    cache: false
                })
                    .done(function( result ) {
                        $("#log_wrapper").html(result);
                    //$("#log_wrapper").html(result);
                   // insertHTML("log_wrapper", result);
                });

        console.log ( "Loading logs file: " + log_file);
    }

    load_logs(document.getElementById('logs_select').value);
</script>