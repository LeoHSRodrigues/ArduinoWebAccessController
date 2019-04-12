<?php
if (isset($_GET['buscarUsuario'])){
    require_once('db.class.php');
    $banco = new db();
    $resultado = $banco->seleciona5();
    $dados['data'] = $resultado->fetchAll();
    header('Content-Type: application/json');
    echo json_encode($dados);
}

?>