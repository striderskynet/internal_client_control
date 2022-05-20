<?php
       
        $log_dir = $_SERVER['DOCUMENT_ROOT'] . "/logs/";
        
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
    .log_wrapper{
        padding: 20px;
        background: #f5f5f5;
    }
    .log {
        font-family: Lucida Console; 
        font-size: 15px;
       
    }

    .log .date{
        color: blue;
    }

    .log .important
    {
        font-weight: bold;
        color: magenta;
    }

    .log_warn .type{
        color: orange;
    }

    .log_info .type{
        color: lightblue;
    }

    .log_data .type{
        color: magenta;
    }

    .log_data .value, .log_default{
        color: magenta;
    }
    .log_default{
        margin-left: 260px;
    }

    .log_logi .type{
        color: green;
    }

    .log_select{
        display: block;
        margin: 20px;
        text-align: right;
        width: 100%;
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
</div>
<script>
    function load_logs(log_file)
    {
        $.ajax({
                    url: "core/logs.php?log=" + log_file,
                    cache: false
                })
                    .done(function( result ) {
                    insertHTML("log_wrapper", result);
                });

        console.log ( "Loading logs file: " + log_file);
    }

    load_logs(document.getElementById('logs_select').value);
</script>