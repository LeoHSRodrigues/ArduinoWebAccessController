<?php
session_start();
require_once('db.class.php');
$banco = new db();
    $senhaRFID = hash('sha512',$_POST['senhaRFID']);
    $rfid = $_POST['RFID']; 
    $resultado = $banco->seleciona('nome, tipoConta,CPF','usuario','where senha4 = "'.$senhaRFID.'" and TAGRFID = "'.$rfid.'"');
    $teste = $resultado->rowCount();
    if ($teste != 1){
        echo 'n cadastrado';
    }
    else{
        $_SESSION['atividade'] = time();
        $dados = $resultado->fetchAll();
        $_SESSION['nome'] = $dados[0]['nome'];
        $_SESSION['cpf'] = $dados[0]['CPF'];
        $_SESSION['permissao'] = $dados[0]['tipoConta'];
        if($dados[0]['tipoConta'] == 'adm'){
        $_SESSION['tipoConta'] = 'Administrador';
        }
        else if($dados[0]['tipoConta'] == 'func'){
        $_SESSION['tipoConta'] = 'Funcionário';
        }
        else{
        $_SESSION['tipoConta'] = 'Usuário';
        }
        echo 'cadastrado';
    }

?>