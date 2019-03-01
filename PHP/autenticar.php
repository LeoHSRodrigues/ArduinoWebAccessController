<?php
if(isset($_POST['acesso']) && ($_POST['acesso'] == 'normal')) {
        $usuario = $_POST['email'];
        $senha = $_POST['senha'];
        $acesso = $_POST['acesso'];
        echo $acesso;
    }
// echo 'O nome foi '.$usuario. ' e a senha ' . $senha;
        // ini_set('max_execution_time', 3);
        // $output= shell_exec('PowerShell -ExecutionPolicy Bypass -Command "'. __DIR__ .'\lerRFID.ps1"');
        // echo $output;
?>