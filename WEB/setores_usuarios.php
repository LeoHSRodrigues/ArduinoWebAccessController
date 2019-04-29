<?php
require_once('sessao.php');
require_once('db.class.php');
$banco = new db();

if($_SESSION['permissao'] != 'adm'){
 $_SESSION['msg'] = "<div class='alert alert-danger' style='text-align:center;' role='alert'>Você não tem permissao para acessar essa página!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
 header('Location:home.php');
 exit;
}

else if (isset($_GET['listar']) && $_GET['listar'] == 'home'){

  $configuracoes = '
  <div class="text-center text-muted mb-4">
  <p>EDITAR SETORES/USUÁRIO</p>
  </div>
  
  <hr>

  <table id="example" class="display table table-hover" style="width:100%">
  <thead>
  <tr>
  <th>ID</th>
  <th>Cod. Setor</th>
  <th>CPF</th>
  <th>Nome do Usuário</th>
  <th>Nome do Setor</th>
  <th>Apagar</th>
  </tr>
  </thead>
  </table>';

}

else if (isset($_GET['excluir']) && $_GET['excluir'] == 'setor'){

  $dados['idSetor'] = $_POST['idSetor'];
  $dados['CPF'] = $_POST['idCPF'];
$campos = array_keys($dados);
$dados = array_values($dados);
$teste = array_combine($campos, $dados);
$valor = count($dados);
for ($i=0; $i < $valor ; $i++) { 
  $testequery[] = $campos[$i]. ' = :'. $campos[$i];
}
$query = implode(" and ", $testequery);
  $resultado = $banco->apaga('setorusuario',$query,$dados);
  $_SESSION['msg'] = "<div class='alert alert-success' style='text-align:center;' role='alert'>Usuário apagado com sucesso!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
  header("Location:setores_usuarios.php?listar=home");
  exit;
}
?>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
<link rel="stylesheet" type="text/css" href="../CSS/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../CSS/estilo.css">
<link rel="stylesheet" type="text/css" href="../CSS/bootstrap-datepicker.min.css">
<!-- <link rel="stylesheet" type="text/css" href="../Bibliotecas/Argon/css/argon.min.css" > -->
<link rel="stylesheet" type="text/css" href="../CSS/dataTables.min.css">
<link rel="stylesheet" type="text/css" href="../Bibliotecas/Font-Awesome/css/all.min.css">
<link href="../CSS/home.css" rel="stylesheet">
<link rel="stylesheet" href="../Bibliotecas/Argon/vendor/nucleo/css/nucleo.css">
<link href="../CSS/multi-select.css" media="screen" rel="stylesheet" type="text/css">
<script src="../Javascript/jquery-3.3.1.js"></script>
<script src="../Javascript/jquery.dataTables.min.js"></script>
<script src="../Javascript/dataTables.bootstrap4.min.js"></script>
<script src="../Javascript/popper.min.js"></script>
<script src="../Javascript/bootstrap.min.js"></script>
<script src="../Bibliotecas/Font-Awesome/js/all.min.js"></script>
<link rel="shortcut icon" href="../Imagens/favicon-lock.ico" />
<script src="../Javascript/jquery.quicksearch.js" type="text/javascript"></script>
<script src="../Javascript/jquery.multi-select.js" type="text/javascript"></script>
<script src="../Javascript/home.js"></script>
<script src="../Javascript/jquery.mask.js"></script>
<script src="../Javascript/bootstrap-datepicker.min.js"></script>
<script src="../Javascript/bootstrap-datepicker.pt-BR.min.js"></script>
<link rel="shortcut icon" href="../Imagens/favicon-lock.ico"/>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Configurações</title>
  <style>
    body{
      background: white;  /* fallback for old browsers */

    } 
  </style>
</head>

<body>
  <div class="page-wrapper chiller-theme toggled">
    <?php include('admin/navbar.php'); ?>
    <main class="page-content">
      <div class="container-fluid">
        <div class="msg_erro">
          <?php
          if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
          } else {
            unset($_SESSION['msg']);
          }?>
        </div>
        <?php
        echo $configuracoes;
        ?>
      </div>
    </main>
  </div>


  <div class="modal" id="modal-excluir" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Apagar Usuário</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Você realmente deseja apagar esse registro?</p>
        </div>
        <form method="POST" action="setores_usuarios.php?excluir=setor" autocomplete="off">
          <input type="hidden" name="idSetor" id="idSetor">
          <input type="hidden" name="idCPF" id="idCPF">
          <div class="modal-footer">
            <button type="submit" class="btn btn-danger">Apagar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</body>
<script type="text/javascript">
  $(document).ready(function() {

    $('#example').DataTable( {
      "processing": true,
      "language": {
        "url": "../Javascript/Portuguese-Brasil.json"
      },
      "ajax": "api.php?buscarSetorUsuario",
      "columns": [
      { "data": "idSetor",orderable: false, "visible": false},
      { "data": "idSetor" },
      { "data": "CPF" },  
      { "data": "nome" },  
      { "data": "sigla" },  
      {
        data: null,
        orderable: false,
        className: "center",
        defaultContent: '<button class="btn btn-danger" id="apagar">Apagar</button>'
      },
      ]
    } );

    var table = $('#example').DataTable();

    $('#example tbody').on( 'click', '#apagar', function () {
      var data = table.row( $(this).parents('tr') ).data();
      $('#modal-excluir').modal({
        show: true
      });
      $('#idSetor').val(data.idSetor);
      $('#idCPF').val(data.CPF);
    } );   
  });
</script>
</html>