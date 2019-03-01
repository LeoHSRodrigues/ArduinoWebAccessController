<?php
session_start();
require_once('db.class.php');
if(isset($_POST['acesso']) && ($_POST['acesso'] == 'normal')) {
    $banco = new db();
    $usuario = $_POST['cpf'];
    $senha = $_POST['senha'];
    $acesso = $_POST['acesso'];
    $resultado = $banco->seleciona($usuario);
    $teste = $resultado->rowCount();
    if ($teste < 1){
        header('HTTP/1.0 400 Bad error');
        exit;
    }
    else{
        $_SESSION['atividade'] = time();
    }
}
    else{
        // echo 'O nome foi '.$usuario. ' e a senha ' . $senha;
                // ini_set('max_execution_time', 3);
                // $output= shell_exec('PowerShell -ExecutionPolicy Bypass -Command "'. __DIR__ .'\lerRFID.ps1"');
                // echo $output;

    }
?>