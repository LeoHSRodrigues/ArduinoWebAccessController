<?php
session_start();
require_once('db.class.php');
$banco = new db();
ini_set('max_execution_time', 3);
$output= shell_exec('PowerShell -ExecutionPolicy Bypass -Command "'. __DIR__ .'\lerRFID.ps1"');
$tagHasheado = hash('sha512', trim($output));
$resultado = $banco->seleciona($tagHasheado);
$teste = $resultado->rowCount();
if ($teste < 1){
    echo 'n achou';
}
else{
    echo 'achou';
}

?>