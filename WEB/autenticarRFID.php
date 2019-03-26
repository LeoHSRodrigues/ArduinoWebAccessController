<?php
session_start();
require_once('db.class.php');
$banco = new db();
    $resultado = $banco->seleciona2(hash('sha512', $_POST['senhaRFID']));
    $teste = $resultado->rowCount();
    if ($teste < 1){
        echo 'n cadastrado';
    }
    else{
        $_SESSION['atividade'] = time();
        $dados = $resultado->fetchAll();
        $_SESSION['nome'] = $dados[0]['nome'];
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