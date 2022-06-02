<?php
    session_start();

    require_once ($_SERVER['DOCUMENT_ROOT'] . "/new" . '/core/config.php');

    $voucherID = $_GET['id'];
   
    $data = (array) json_decode( api("vouchers","print","id=" . $voucherID));
    $date = DateTime::createFromFormat("Y-m-d", $data['in_date']);
    $vID = $date->format("Y") . str_pad($voucherID, 3, '0', STR_PAD_LEFT);

    $data['voucher_id'] = $vID;
    $data['data'] = nl2br($data['data']);
    $data['companions'] = @show_companions($data['companions']);

    
    $html = file_get_contents( $_SERVER['DOCUMENT_ROOT'] . "/new/core/themes/voucher/voucher_" . $config['title'] . ".html" );
    echo tokenize($data, $html);
    
?>