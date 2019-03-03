<?php
session_start();
require_once('db.class.php');
$banco = new db();
    //echo 'O nome foi '.$usuario. ' e a senha ' . $senha;
    //sleep(1);
ini_set('max_execution_time', 5);
$output= shell_exec('PowerShell -ExecutionPolicy Bypass -Command "'. __DIR__ .'\lerRFID.ps1"');
    //$resultado = trim($output);
$tagHasheado = hash('sha512', trim($output));
$resultado = $banco->seleciona($tagHasheado);
$teste = $resultado->rowCount();
if ($teste < 1){
    echo 'n achou';
    ob_end_flush();
    exit;
}
else{
    echo 'achou';
    ob_end_flush();
}

?>