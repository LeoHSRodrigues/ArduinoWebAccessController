<?php
if (isset($_GET['buscarUsuario'])){
    require_once('db.class.php');
    $banco = new db();
    $resultado = $banco->seleciona("id,nome,CPF,tipoConta,status,date_format(dataDeNascimento,'%d/%m/%Y') as dataDeNascimento",'usuario','','1');
    $dados['data'] = $resultado->fetchAll();
    header('Content-Type: application/json');
    echo json_encode($dados);
}
if (isset($_GET['buscarNome'])){
    require_once('db.class.php');
    $banco = new db();
    $resultado = $banco->seleciona("CPF,nome",'usuario','','1');
    $dados = $resultado->fetchAll();
    header('Content-Type: application/json');
    echo json_encode($dados);
}
if (isset($_GET['buscarSetor'])){
    require_once('db.class.php');
    $banco = new db();
    $resultado = $banco->seleciona(' * ','setor','where 1');
    $dados['data'] = $resultado->fetchAll();
    header('Content-Type: application/json');
    echo json_encode($dados);
}
if (isset($_GET['buscarSetorUsuario'])){
    require_once('db.class.php');
    $banco = new db();
    $resultado = $banco->seleciona('nome,sigla,su.idSetor,u.CPF','usuario as u inner join setorusuario as su on u.CPF = su.CPF inner join setor as s on s.idSetor = su.idSetor','where 1');
    $dados['data'] = $resultado->fetchAll();
    header('Content-Type: application/json');
    echo json_encode($dados);
}
if (isset($_GET['buscarLogs'])){
    require_once('db.class.php');
    $banco = new db();
    $resultado = $banco->seleciona('l.id,DATE_FORMAT(dataAcesso, "%d/%m/%Y %H:%i:%s") as dataAcesso,Sigla,nome','log as l inner join setor as s on l.idSetor = s.idSetor inner join usuario as u on l.tagRFID = u.tagRFID','where 1 order by id desc');
    $dados['data'] = $resultado->fetchAll();
    header('Content-Type: application/json');
    echo json_encode($dados);
}

?>