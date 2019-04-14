<?php
require_once('sessao.php');
require_once('db.class.php');
$banco = new db();

if($_SESSION['permissao'] != 'adm'){
 $_SESSION['msg'] = "<div class='alert alert-danger' style='text-align:center;' role='alert'>Você não tem permissao para acessar essa página!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
 header('Location:home.php');
}

else if (isset($_GET['listar']) && $_GET['listar'] == 'home'){

  $configuracoes = '
  <div class="text-center text-muted mb-4">
  <p>EDITAR USUÁRIO</p>
  </div>
  
  <hr>

  <table id="example" class="display table table-hover" style="width:100%">
  <thead>
  <tr>
  <th>ID</th>
  <th>Cod. Setor</th>
  <th>Nome do Setor</th>
  <th>Editar</th>
  <th>Apagar</th>
  <th>Cadastrar Usuario ao setor</th>
  </tr>
  </thead>
  </table>';

}

else if (isset($_GET['excluir']) && $_GET['excluir'] == 'setor'){

$resultado = $banco->apaga('setor','id = :id', $_POST['id']);

  $_SESSION['msg'] = "<div class='alert alert-success' style='text-align:center;' role='alert'>Usuário apagado com sucesso!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
  header("Location:setores.php?listar=home");
}
else if (isset($_GET['salvar']) && $_GET['salvar'] == 'conta')
{
  $dados = array();

  if (isset($_POST['Sigla']) && $_POST['Sigla'] != ''){
   $dados['Sigla'] = $_POST['Sigla'];
 }   
 if (isset($_POST['idSetor']) && $_POST['idSetor'] != ''){
   $dados['idSetor'] = $_POST['idSetor'];
 }  
 $id = $_POST['id'];
 $campos = array_keys($dados);
 $dados = array_values($dados);
 $teste = array_combine($campos, $dados);
 $valor = count($dados);
 for ($i=0; $i < $valor ; $i++) { 
  $testequery[] = $campos[$i]. ' = :'. $campos[$i];
}
$testequery = implode(" , ", $testequery);
$query = $testequery. ' where id = '.$id;
//var_dump($query);exit;

$resultado = $banco->altera('setor',$query,$dados);

if ($resultado == null){
 $_SESSION['msg'] = "<div class='alert alert-success' style='text-align:center;' role='alert'>Usuário Atualizado com sucesso!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
 header("Location:setores.php?listar=home");
}

}

else if (isset($_GET['salvar']) && $_GET['salvar'] == 'novaConta')
{
  $dados = array();

  $dados['Sigla'] = $_POST['Sigla'];   
  $dados['idSetor'] = $_POST['idSetor'];
  $campos = array_keys($dados);

  $valor = count($dados);
  for ($i=0; $i < $valor ; $i++) { 
    $testequery[] = '?';
  }
  $contador = implode(" , ", $testequery);
  $campos = implode(" , ", $campos);

  $resultado = $banco->insere('setor',$campos,$contador,$dados);

  if ($resultado == null){
   $_SESSION['msg'] = "<div class='alert alert-success' style='text-align:center;' role='alert'>Usuário Cadastrado com sucesso!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
   header("Location:setores.php?listar=home");
 }

}
else if (isset($_GET['salvar']) && $_GET['salvar'] == 'setorUsuario')
{
  $dados = array();

  $dados['CPF'] = $_POST['adicionarSetor'];   
  $dados['idSetor'] = $_POST['id'];
  $campos = array_keys($dados);
  $valor = count($dados);
  for ($i=0; $i < $valor ; $i++) { 
    $testequery[] = '?';
  }
  $contador = implode(" , ", $testequery);
  $campos = implode(" , ", $campos);

  $resultado = $banco->insere('setorusuario',$campos,$contador,$dados);

  if ($resultado == null){
   $_SESSION['msg'] = "<div class='alert alert-success' style='text-align:center;' role='alert'>Usuário Cadastrado com sucesso!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
   header("Location:setores.php?listar=home");
 }

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
        <form method="POST" action="setores.php?excluir=setor" autocomplete="off">
          <input type="hidden" name="id" id="id">
          <div class="modal-footer">
            <button type="submit" class="btn btn-danger">Apagar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal" id="modal-editar" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <div>
            <h5 class="modal-title">ATUALIZAR SETOR</h5>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" method="post" id="meuForm" action="setores.php?salvar=conta" enctype="multipart/form-data" autocomplete="off">

            <div class="form-group">
              <div class="input-group input-group-alternative mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                </div>
                <input class="form-control" value=""  placeholder="Nome do Setor" id="setor" name="Sigla" type="text">
              </div>
            </div>

            <div class="form-group">
             <div class="input-group input-group-alternative mb-3">
               <div class="input-group-prepend">
                 <span class="input-group-text"><i class="far fa-address-card"></i></span>
               </div>
               <input class="form-control" value=""  data-toggle="tooltip" placeholder="Cod. do Setor" id="idSetor" name="idSetor" type="text">
             </div>
             <div class="text-center">
               <button type="submit" id="cadastrarBotao" class="btn btn-primary mt-4">Atualizar</button>
             </div>  
           </div>
           <input class="form-control" value="" id="idEditar" name="id" type="hidden">
         </form>
       </div>
     </div>
   </div>
 </div>  

 <div class="modal" id="modal-adicionar" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div>
          <h5 class="modal-title">ADICIONAR AO SETOR</h5>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" method="post" id="meuForm" action="setores.php?salvar=setorUsuario" enctype="multipart/form-data" autocomplete="off">

          <div class="form-group">
            <div class="input-group input-group-alternative mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
              </div>
              <input class="form-control" value="" readonly placeholder="Nome do Setor" id="idSetorAdicionar" name="idSetor" type="text">
            </div>
          </div>

          <div class="form-group">
           <div class="input-group input-group-alternative mb-3">
             <div class="input-group-prepend">
               <span class="input-group-text"><i class="far fa-address-card"></i></span>
             </div>
             <select class="form-control" name="adicionarSetor" id="NomeUsuarioSetor">
               <option selected>- SELECIONE -</option>
             </select>
           </div>
         </div>
         <div class="text-center">
           <button type="submit" id="cadastrarBotao" class="btn btn-primary mt-4">Atualizar</button>
         </div>  
         <input class="form-control" value="" id="idAdicionarSetor" name="id" type="hidden">
       </form>
     </div>
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
      "ajax": "api.php?buscarSetor",
      "columns": [
      { "data": "id",orderable: false, "visible": false},
      { "data": "idSetor" },
      { "data": "Sigla" },
      {
        data: null,
        orderable: false,
        className: "center",
        defaultContent: '<button class="btn btn-light" id="editar">Editar</button>'
      },    
      {
        data: null,
        orderable: false,
        className: "center",
        defaultContent: '<button class="btn btn-danger" id="apagar">Apagar</button>'
      },
      {
        data: null,
        orderable: false,
        className: "center",
        defaultContent: '<div style="text-align:center"><button class="btn btn-info" id="adicionar">Adicionar</button></div>'
      }
      ]
    } );

    var table = $('#example').DataTable();

    $('#example').on('init.dt', function () {  
      $('#example_filter').append('<button class="btn btn-primary" id="cadastrar">Cadastrar</button>');
    });

    $('.container-fluid').on( 'click', '#cadastrar', function () {
      $('#modal-editar').modal({
        show: true
      });
      $('.modal-title').html('Cadastrar');
      $('#cadastrarBotao').html('Cadastrar');
      $('#idEditar').val('');
      $('#setor').val('');
      $('#idSetor').val('');
      $('#setor').attr('required', true);
      $('#idSetor').attr('required', true);
      $('#meuForm').attr('action','setores.php?salvar=novaConta');
    });

    $('#example tbody').on( 'click', '#editar', function () {
      var data = table.row( $(this).parents('tr') ).data();
      $('#modal-editar').modal({
        show: true
      });
      $('#idEditar').val(data.id);
      $('#setor').val(data.Sigla);
      $('#idSetor').val(data.idSetor);
      $('#cadastrarBotao').html('Atualizar');
    } );   

    $('#example tbody').on( 'click', '#apagar', function () {
      var data = table.row( $(this).parents('tr') ).data();
      $('#modal-excluir').modal({
        show: true
      });
      $('#id').val(data.id);
    } );    

    $('#example tbody').on( 'click', '#adicionar', function () {
      var data = table.row( $(this).parents('tr') ).data();
      $('#modal-adicionar').modal({
        show: true
      });
      $('#idSetorAdicionar').val(data.Sigla);
      $('#idAdicionarSetor').val(data.idSetor);
      $('#cadastrarBotao').html('Cadastrar');
    });

    $('#modal-adicionar').on('show.bs.modal', function (e) {
      $.ajax({
        url: "api.php?buscarNome",
        dataType: "json",
        success: function(msg){
          $("#NomeUsuarioSetor").empty();
          $("#NomeUsuarioSetor").html('<option selected>- SELECIONE -</option>');
          var options = $("#NomeUsuarioSetor");
          $.each(msg, function (i, d) {
            $('<option>').val(d.CPF).text(d.nome).appendTo(options);
          });
        },
        error: function(msg){

        }
      });
    });

  });
</script>
</html>