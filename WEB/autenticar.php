<?php
require_once('db.class.php');
$banco = new db();
session_start();
if(isset($_GET['acao']) && $_GET['acao'] == 'lerRFIDSenha'){ 
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
}
else if (isset($_GET['acao']) && $_GET['acao'] == 'lerCatraca'){
    ini_set('max_execution_time', 0.5);
    $output = shell_exec('PowerShell -ExecutionPolicy Bypass -Command "'. __DIR__ .'\lerRFID.ps1"');
    $resultado = $banco->seleciona3(hash('sha512', $output));
    $teste = $resultado->rowCount();
    if ($teste === 1){
    $dados = $resultado->fetchAll();
    $dados[0]['imagem'] = $output;
    echo json_encode($dados);
    $output = shell_exec('PowerShell -ExecutionPolicy Bypass -Command "'. __DIR__ .'\fecharPortaRFID.ps1"');
        }
    else{
        echo 'erro';
    $output = shell_exec('PowerShell -ExecutionPolicy Bypass -Command "'. __DIR__ .'\fecharPortaRFID.ps1"');
    }
//echo $output;
}

?>