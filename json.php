<?php
    session_start();
    sleep(4);
    header('Content-Type: application/json; charset=utf-8');
    if ( !isset($_SESSION['log']) ) $_SESSION['log'] = array();
    echo(json_encode($_SESSION['log']));
?>
