<?php
require_once('sessao.php');
require_once('db.class.php');
$banco = new db();
//var_dump($_SESSION['tipoConta']);
if (isset($_GET['editar']) && $_GET['editar'] == 'home'){
  $configuracoes = '
  <div class="row">
  <form>
  <h4 style="color:white;">Selecione os módulos que você deseja mostrar na tela inicial</h4>
  <hr class="mt-0"> 
  <div class="form-group col-sm-12 campoOption">
  <select id="custom-headers" multiple="multiple">
  <option value="elem_1">Controle de Acesso</option>
  <option value="elem_2">Configurações</option>
  <option value="elem_3">Configurações/Editar Usuário</option>
  <option value="elem_4">Configurações/Editar Minha Conta</option>
  </select>
  </div>
  <br/>
  <div>
  <button type="submit" class="btn btn-primary">Salvar</button>
  </form>
  </div>
  </div>';
}
else if (isset($_GET['editar']) && $_GET['editar'] == 'conta'){
  $resultado = $banco->seleciona("id,nome,CPF,date_format(dataDeNascimento,'%d/%m/%Y') as dataDeNascimento","usuario","CPF", $_SESSION['cpf']);
  $dados = $resultado->fetchAll();
  $nome = $dados[0]['nome'];
  $CPF = $dados[0]['CPF'];
  $id = $dados[0]['id'];
  $dataDeNascimento = $dados[0]['dataDeNascimento'];

  $configuracoes = '
  <div class="col-lg-5" style="margin:auto;">
  <div class="card  border-0">
  <div class="card-body px-lg-5 py-lg-5">
  
  <div class="text-center text-muted mb-4">
  <p>ATUALIZAR MINHA CONTA</p>
  </div>
  
  <hr>
  
  <form role="form" method="post" id="meuForm" action="configuracoes.php?salvar=conta" enctype="multipart/form-data" autocomplete="off">
  
  <div class="form-group">
  <div class="input-group input-group-alternative mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
  </div>
  <input class="form-control" value="'.$nome.'"  placeholder="Nome" id="nome" name="nome" type="text">
  </div>
  </div>
  ';
  if ($_SESSION['permissao'] === 'adm'){
   $configuracoes .= '  <div class="form-group">
   <div class="input-group input-group-alternative mb-3">
   <div class="input-group-prepend">
   <span class="input-group-text"><i class="far fa-address-card"></i></span>
   </div>
   <input class="form-control" value="'.$CPF.'"  placeholder="CPF" id="CPF" name="CPF" type="text">  
   </div>
   </div>'; 
 }
 else{
   $configuracoes .= '  <div class="form-group">
   <div class="input-group input-group-alternative mb-3">
   <div class="input-group-prepend">
   <span class="input-group-text"><i class="far fa-address-card"></i></span>
   </div>
   <input class="form-control" value="'.$CPF.'" data-toggle="tooltip" disabled placeholder="CPF" id="CPF" name="CPF" type="text">  
   <span class="input-group-text"><i class="fas fa-question" data-placement="top" title="Para alterar o CPF contate um administrador">Para alterar o CPF contate um administrador</i></span>
   </div>
   </div>'; 
   
 }

 $configuracoes .= '
 <div class="form-group">
 <div class="input-group input-group-alternative">
 <div class="input-group-prepend">
 <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
 </div>
 <input class="form-control"  placeholder="Senha" id="senha" name="senha" type="password">
 </div>
 </div>  
 
 <div class="form-group">
 <div class="input-group input-group-alternative">
 <div class="input-group-prepend">
 <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
 </div>
 <input class="form-control"  placeholder="Confirme sua Senha" id="conf_senha" name="conf_senha" type="password">
 </div>
 </div>
 
 <div class="form-group">
 <div class="input-group input-group-alternative">
 <div class="input-group-prepend">
 <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
 </div>
 <input class="form-control" value="'.$dataDeNascimento.'"  placeholder="Data de Nascimento" id="dataDeNascimento" name="dataDeNascimento" type="text">
 </div>
 </div>
 
 <div class="form-group">
 <div class="input-group input-group-alternative">
 <div class="input-group-prepend">
 <span class="input-group-text"><i class="fas fa-key"></i></span>
 </div>
 <input class="form-control"  placeholder="Senha de 4 dígitos" id="senha4" name="senha4" type="password">
 </div>
 </div>                  
 
 
 <div class="form-group">
 <div class="input-group input-group-alternative">
 <div class="input-group-prepend">
 <span class="input-group-text"><i class="fas fa-key"></i></span>
 </div>
 <input class="form-control"  placeholder="Confirme sua senha de 4 dígitos" id="conf_senha4" name="conf_senha4" type="password">
 </div>
 </div>
 
 <div class="form-group">
 <div class="input-group input-group-alternative">
 <div class="input-group-prepend">
 <span class="input-group-text"><i class="fas fa-satellite-dish"></i></span>
 </div>
 <input class="form-control" value="" data-toggle="modal" data-target="#modal-form" placeholder="Cadastrar Cartão RFID" id="rfid" name="rfid" type="text">
 </div>
 </div>
 
 <div class="form-group arquivo">
 <div class="input-group input-group-alternative">
 <div class="input-group-prepend">
 <span class="input-group-text"><i class="far fa-file"></i></span>
 </div>
 <div class="custom-file text-muted">
 <input type="file" class="form-control custom-file-input" name="fotoPerfil" id="fotoPerfil" >
 <label class="custom-file-label form-control " for="validatedCustomFile">Selecione um arquivo</label>
 </div>
 </div>
 </div>
 
 <div class="text-center">
 <button type="submit" id="cadastrar" class="btn btn-primary mt-4">Atualizar</button>
 </div>        
 <input class="form-control" value="'.$id.'"  placeholder="Nome" id="id" name="id" type="hidden">
 </form>
 </div>
 </div>
 </div>
 ';

}
else if (isset($_GET['editar']) && $_GET['editar'] == 'usuario'){

  $configuracoes = '
  <div class="text-center text-muted mb-4">
  <p>EDITAR USUÁRIO</p>
  </div>
  
  <hr>

  <table id="example" class="display table table-hover" style="width:100%">
  <thead>
  <tr>
  <th>Nome</th>
  <th>CPF</th>
  <th>Tipo de Conta</th>
  <th>Data de Nascimento</th>
  <th>Status</th>
  <th>ID</th>
  <th>Editar</th>
  <th>Apagar</th>
  </tr>
  </thead>
  </table>';

}
else if (isset($_GET['excluir']) && $_GET['excluir'] == 'usuario'){

  $resultado = $banco->apaga('usuario','id = :id', $_POST['id']);

  $_SESSION['msg'] = "<div class='alert alert-success' style='text-align:center;' role='alert'>Usuário apagado com sucesso!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
  header("Location:setores.php?listar=home");
  $_SESSION['msg'] = "<div class='alert alert-success' style='text-align:center;' role='alert'>Usuário apagado com sucesso!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
  header("Location:configuracoes.php?editar=usuario");
  exit;
}
else if (isset($_GET['salvar']) && $_GET['salvar'] == 'conta')
{
  $dados = array();

  if ($_SESSION['id'] == $_POST['id']){
    $_SESSION['nome'] = $_POST['nome'];
    $_SESSION['permissao'] = $_POST['tipoConta'];
  }

  if (isset($_POST['nome']) && $_POST['nome'] != ''){
   $dados['nome'] = $_POST['nome'];
 }   
 if (isset($_POST['CPF']) && $_POST['CPF'] != ''){
   $dados['CPF'] = $_POST['CPF'];
 }  
 if (isset($_POST['tipoConta']) && $_POST['tipoConta'] != ''){
   $dados['tipoConta'] = $_POST['tipoConta'];
 }    
 if (isset($_POST['status']) && $_POST['status'] != ''){
   $dados['status'] = $_POST['status'];
 }   
 if (isset($_POST['senha']) && $_POST['senha'] != ''){
   $dados['senha'] = hash('sha512', $_POST['senha']);
 }    
 if (isset($_POST['senha4']) && $_POST['senha4'] != ''){
   $dados['senha4'] = hash('sha512', $_POST['senha4']);
 }    
 if (isset($_POST['rfid']) && $_POST['rfid'] != ''){
   $dados['rfid'] = hash('sha512', $_POST['rfid']);
 }
 if (isset($_POST['dataDeNascimento'])){
   $dados['dataDeNascimento']  = date("Y-m-d", strtotime(str_replace('/', '-', $_POST['dataDeNascimento'])));
 }
 $id = $_POST['id'];
 $diretorioFotoPerfil = '../fotosPerfil/';
 if ($_FILES['fotoPerfil']['tmp_name']){
   $foto = $_FILES['fotoPerfil']['tmp_name'];
   if( in_array( $_FILES['fotoPerfil']['type'], array("image/jpeg") ) || in_array( $_FILES['fotoPerfil']['type'], array("image/png") )){
    $uploadfile = $diretorioFotoPerfil . $dados['CPF'] .'.png';
    move_uploaded_file($_FILES['fotoPerfil']['tmp_name'], $uploadfile);
    $nomeArquivo = $_FILES['fotoPerfil']['name'];
  }
  else{
   $_SESSION['msg'] = "<div class='alert alert-danger' style='text-align:center;' role='alert'>A imagem anexada não é suportada!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";

 }

}
$campos = array_keys($dados);
$dados = array_values($dados);
$teste = array_combine($campos, $dados);
$valor = count($dados);
for ($i=0; $i < $valor ; $i++) { 
  $testequery[] = $campos[$i]. ' = :'. $campos[$i];
}
$testequery = implode(" , ", $testequery);
$query = $testequery. ' where id = '.$id;
$resultado = $banco->altera('usuario',$query,$dados);

if ($resultado == null){
 $_SESSION['msg'] = "<div class='alert alert-success' style='text-align:center;' role='alert'>Usuário Atualizado com sucesso!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
 header("Location:configuracoes.php?editar=usuario");
 exit;
}

}

else if (isset($_GET['salvar']) && $_GET['salvar'] == 'novaConta')
{
  $dados = array();

  if (isset($_POST['nome']) && $_POST['nome'] != ''){
   $dados['nome'] = $_POST['nome'];
 }   
 if (isset($_POST['CPF']) && $_POST['CPF'] != ''){
   $dados['CPF'] = $_POST['CPF'];
 }  
 if (isset($_POST['senha']) && $_POST['senha'] != ''){
   $dados['senha'] = hash('sha512', $_POST['senha']);
 }    
 if (isset($_POST['senha4']) && $_POST['senha4'] != ''){
   $dados['senha4'] = hash('sha512', $_POST['senha4']);
 }    
 if (isset($_POST['dataDeNascimento'])){
   $dados['dataDeNascimento']  = date("Y-m-d", strtotime(str_replace('/', '-', $_POST['dataDeNascimento'])));
 }
 if (isset($_POST['rfid']) && $_POST['rfid'] != ''){
   $dados['tagRFID'] = hash('sha512', $_POST['rfid']);
 }

 if ($_FILES['fotoPerfil']['tmp_name']){
  $diretorioFotoPerfil = '../fotosPerfil/';
  $foto = $_FILES['fotoPerfil']['tmp_name'];
  if( in_array( $_FILES['fotoPerfil']['type'], array("image/jpeg") ) || in_array( $_FILES['fotoPerfil']['type'], array("image/png") )){
    $uploadfile = $diretorioFotoPerfil . $dados['CPF'] .'.png';
    move_uploaded_file($_FILES['fotoPerfil']['tmp_name'], $uploadfile);
    $nomeArquivo = $_FILES['fotoPerfil']['name'];
  }
  else{
   $_SESSION['msg'] = "<div class='alert alert-danger' style='text-align:center;' role='alert'>A imagem anexada não é suportada!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";

 }

}
  $campos = array_keys($dados);
  $valor = count($dados);
  for ($i=0; $i < $valor ; $i++) { 
    $testequery[] = '?';
  }
  $contador = implode(" , ", $testequery);
  $campos = implode(" , ", $campos);

  $resultado = $banco->insere('usuario',$campos,$contador,$dados);
//$resultado = $banco->insere($dados);

 $_SESSION['msg'] = "<div class='alert alert-success' style='text-align:center;' role='alert'>Usuário Cadastrado com sucesso!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
 header("Location:configuracoes.php?editar=usuario");
 exit;

}
?>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
<link rel="stylesheet" type="text/css" href="../CSS/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../CSS/estilo.css">
<link rel="stylesheet" type="text/css" href="../CSS/bootstrap-datepicker.min.css">
<!-- <link rel="stylesheet" type="text/css" href="../Bibliotecas/Argon/css/argon.min.css" > -->
<link rel="stylesheet" type="text/css" href="../CSS/datatables.min.css">
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
    .custom-file-input ~ .custom-file-label::after {
      content: "Procurar";
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

  <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-body p-0">
          <div class="card bg-secondary shadow border-0">
            <div class="card-body px-lg-5 py-lg-5">
              <div class="content">
                <div id="erro"></div>
                <div class="imagemRFID">
                  <div class="text-center text-muted mb-4">
                    <p>Aproxime o cartão da leitora</p>
                  </div>  
                  <img class="pulse"src="../Imagens/approachRFID.png" width="300px" height="300px"></div>
                  <div id="loading"></div>
                </div>
                <div class="text-center text-muted mb-4">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
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
          <form method="POST" action="configuracoes.php?excluir=usuario" autocomplete="off">
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
              <h5 class="modal-title">ATUALIZAR CONTA</h5>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form role="form" method="post" id="meuForm" action="configuracoes.php?salvar=conta" enctype="multipart/form-data" autocomplete="off">

              <div class="form-group">
                <div class="input-group input-group-alternative mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                  </div>
                  <input class="form-control" value=""  placeholder="Nome" id="nome" name="nome" type="text">
                </div>
              </div>

              <div class="form-group">
               <div class="input-group input-group-alternative mb-3">
                 <div class="input-group-prepend">
                   <span class="input-group-text"><i class="far fa-address-card"></i></span>
                 </div>
                 <input class="form-control" value=""  data-toggle="tooltip" disabled placeholder="CPF" id="CPF" name="CPF" type="text">  
               </div>
             </div>

             <div class="form-group">
               <div class="input-group input-group-alternative">
                 <div class="input-group-prepend">
                   <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                 </div>
                 <input class="form-control"  placeholder="Senha" id="senha" name="senha" type="password">
               </div>
             </div>  

             <div class="form-group">
               <div class="input-group input-group-alternative">
                 <div class="input-group-prepend">
                   <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                 </div>
                 <input class="form-control"  placeholder="Confirme sua Senha" id="conf_senha" name="conf_senha" type="password">
               </div>
             </div>

             <div class="form-group">
               <div class="input-group input-group-alternative">
                 <div class="input-group-prepend">
                   <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                 </div>
                 <input class="form-control" value=""  placeholder="Data de Nascimento" id="dataDeNascimento" name="dataDeNascimento" type="text">
               </div>
             </div>

             <div class="form-group">
               <div class="input-group input-group-alternative">
                 <div class="input-group-prepend">
                   <span class="input-group-text"><i class="fas fa-key"></i></span>
                 </div>
                 <input class="form-control"  placeholder="Senha de 4 dígitos" id="senha4" name="senha4" type="password">
               </div>
             </div>                  


             <div class="form-group">
               <div class="input-group input-group-alternative">
                 <div class="input-group-prepend">
                   <span class="input-group-text"><i class="fas fa-key"></i></span>
                 </div>
                 <input class="form-control"  placeholder="Confirme sua senha de 4 dígitos" id="conf_senha4" name="conf_senha4" type="password">
               </div>
             </div>             

             <div class="form-group escolhatipoConta">
               <div class="input-group input-group-alternative">
                 <div class="input-group-prepend">
                   <span class="input-group-text"><i class="fas fa-user-cog"></i></span>
                 </div>
                 <select name="tipoConta" class="form-control">
                   <option selected>- SELECIONE -</option>
                   <option value="adm">Administrador</option>
                   <option value="func">Funcionário</option>
                   <option value="user">Usuário</option>
                 </select>
               </div>
             </div>             

             <div class="form-group escolhaStatus">
               <div class="input-group input-group-alternative">
                 <div class="input-group-prepend">
                   <span class="input-group-text"><i class="fas fa-user-cog"></i></span>
                 </div>
                 <select name="status" class="form-control">
                   <option selected>- SELECIONE -</option>
                   <option value="Ativo">Ativo</option>
                   <option value="Bloqueado">Bloqueado</option>
                 </select>
               </div>
             </div>

             <div class="form-group">
               <div class="input-group input-group-alternative">
                 <div class="input-group-prepend">
                   <span class="input-group-text"><i class="fas fa-satellite-dish"></i></span>
                 </div>
                 <input class="form-control" value="" data-toggle="modal" data-target="#modal-form" placeholder="Cadastrar Cartão RFID" id="rfid" name="rfid" type="text">
               </div>
             </div>

             <div class="form-group arquivo">
               <div class="input-group input-group-alternative">
                 <div class="input-group-prepend">
                   <span class="input-group-text"><i class="far fa-file"></i></span>
                 </div>
                 <div class="custom-file text-muted">
                   <input type="file" class="form-control custom-file-input" name="fotoPerfil" id="fotoPerfil" >
                   <label class="custom-file-label form-control " id="legendaFoto" for="validatedCustomFile">Selecione um arquivo</label>
                 </div>
               </div>
             </div>

             <div class="text-center">
               <button type="submit" id="cadastrarBotao" class="btn btn-primary mt-4">Atualizar</button>
             </div>        
             <input class="form-control" value="" id="idEditar" name="id" type="hidden">
           </form>
         </div>
       </div>
     </div>
   </div>


 </body>
 <script type="text/javascript">
  $(document).ready(function() {

    var tipoConta = "<?php echo ($_SESSION['permissao']); ?>";

    $('#example').DataTable( {
      "processing": true,
      "language": {
        "url": "../Javascript/Portuguese-Brasil.json"
      },
      "ajax": "api.php?buscarUsuario",
      "columns": [
      { "data": "nome" },
      { "data": "CPF" },
      { "data": "tipoConta" ,orderable: false,},
      { "data": "dataDeNascimento",orderable: false, },
      { "data": "status" ,orderable: false},
      { "data": "id",orderable: false, "visible": false},
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
      $('#CPF').attr('disabled',false);
      $('.escolhatipoConta').empty();
      $('.escolhaStatus').empty();
      $('#idEditar').val('');
      $('#nome').val('');
      $('#CPF').val('');
      $('#dataDeNascimento').val('');
      $( "#senha" ).val('');
      $( "#conf_senha" ).val('');
      $('#rfid').val('');
      $('#legendaFoto').text('Selecione um arquivo');
      $('#fotoPerfil').attr('readonly', false);
      $('#meuForm').attr('action','configuracoes.php?salvar=novaConta');
    });

    $('#example tbody').on( 'click', '#editar', function () {
      var data = table.row( $(this).parents('tr') ).data();
      $('#modal-editar').modal({
        show: true
      });
      $('#idEditar').val(data.id);
      $('#nome').val(data.nome);
      $('#CPF').val(data.CPF);

      if (tipoConta != 'adm'){
        if (data.tipoConta != 'user'){
          $('#CPF').attr('disabled', true);
          $('#CPF').append('<span class="input-group-text"><i class="fas fa-question" data-placement="top" title="Para alterar o CPF contate um administrador">Para alterar o CPF contate um administrador</i></span>');
        }
        else{
          $('#CPF').attr('disabled', false);
        }
      }
      else{
        $('#CPF').attr('disabled', false);

      }
      $('#cadastrarBotao').html('Atualizar');
      $('#dataDeNascimento').val(data.dataDeNascimento);
    } );   

    $('#modal-editar').on('hidden.bs.modal', function (e) {
      $( "#dataDeNascimento" ).removeClass("is-valid");
      $( "#dataDeNascimento" ).removeClass("is-invalid");

      $( "#senha" ).removeClass("is-invalid");
      $( "#conf_senha" ).removeClass("is-invalid");
      $( "#senha" ).removeClass("is-valid");
      $( "#conf_senha" ).removeClass("is-valid");

      $( "#senha4" ).removeClass("is-invalid");
      $( "#conf_senha4" ).removeClass("is-invalid");
      $( "#senha4" ).removeClass("is-valid");
      $( "#conf_senha4" ).removeClass("is-valid");

      $( "#CPF" ).removeClass("is-valid");
      $( "#CPF" ).removeClass("is-invalid");

      $( "#nome" ).removeClass("is-invalid");
      $( "#nome" ).removeClass("is-valid");
    });

    $('#example tbody').on( 'click', '#apagar', function () {
      var data = table.row( $(this).parents('tr') ).data();
      $('#modal-excluir').modal({
        show: true
      });
      $('#id').val(data.id);
    } );

    var url_string = window.location.href;
    var url = new URL(url_string);
    var c = url.searchParams.get("editar");
    if (c === 'home'){
      $('.campoOption').multiSelect({
        selectableHeader: "<input type='text' style='width: 165.5px; text-align:center' class='search-input' autocomplete='off' placeholder='Buscar'>",
        selectionHeader: "<input type='text' style='width: 165.5px; text-align:center' class='search-input' autocomplete='off' placeholder='Buscar'>",
        afterInit: function(ms){
          var that = this,
          $selectableSearch = that.$selectableUl.prev(),
          $selectionSearch = that.$selectionUl.prev(),
          selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
          selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

          that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
          .on('keydown', function(e){
            if (e.which === 40){
              that.$selectableUl.focus();
              return false;
            }
          });

          that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
          .on('keydown', function(e){
            if (e.which == 40){
              that.$selectionUl.focus();
              return false;
            }
          });
        },
        afterSelect: function(){
          this.qs1.cache();
          this.qs2.cache();
        },
        afterDeselect: function(){
          this.qs1.cache();
          this.qs2.cache();
        }
      });
    }
    else if (c === 'conta' || c === 'usuario'){
      $('#CPF').mask('000.000.000-00',{clearIfNotMatch: true});
      
      $('#dataDeNascimento').datepicker({
       maxViewMode: 2,
       todayBtn: "linked",
       language: "pt-BR",
       autoclose: true,
       todayHighlight: true
     });
      
      $('#fotoPerfil').on('change',function(){
        var fileName = document.getElementById("fotoPerfil").files[0].name;
        $('.custom-file-label').text(fileName);
      })
      
      $('#dataDeNascimento').focusout(function(){
        $( "#dataDeNascimento" ).addClass("is-valid");
      });

      $('#senha, #conf_senha').on('keyup focusout', function () {
       if ($('#senha').val() == $('#conf_senha').val() && $('#senha').val().length > 6 ) {
        $( "#senha" ).removeClass("is-invalid");
        $( "#conf_senha" ).removeClass("is-invalid");
        $( "#senha" ).addClass("is-valid");
        $( "#conf_senha" ).addClass("is-valid");
      } else {
        $( "#senha" ).removeClass("is-valid");
        $( "#conf_senha" ).removeClass("is-valid");
        $( "#senha" ).addClass("is-invalid");
        $( "#conf_senha" ).addClass("is-invalid");

      }
    });

      $('#senha4, #conf_senha4').on('keyup focusout', function () {
       if ($('#senha4').val() == $('#conf_senha4').val() && $('#senha4').val().length > 3 ) {
        $( "#senha4" ).removeClass("is-invalid");
        $( "#conf_senha4" ).removeClass("is-invalid");
        $( "#senha4" ).addClass("is-valid");
        $( "#conf_senha4" ).addClass("is-valid");
      } else {
        $( "#senha4" ).removeClass("is-valid");
        $( "#conf_senha4" ).removeClass("is-valid");
        $( "#senha4" ).addClass("is-invalid");
        $( "#conf_senha4" ).addClass("is-invalid");

      }
    });
      
      $('#CPF').focusout(function(){
       var testarCPF = TestaCPF($("#CPF").val());
       if(testarCPF == false) {
        $( "#CPF" ).removeClass("is-valid");
        $( "#CPF" ).addClass("is-invalid");
      }
      else{
        $( "#CPF" ).removeClass("is-invalid");
        $( "#CPF" ).addClass("is-valid");
      }
    });

      $('#nome').focusout(function(){
       if($("#nome").val().length < 5) {
        $( "#nome" ).addClass("is-invalid");
        $( "#nome" ).removeClass("is-valid");
      }
      else{
        $( "#nome" ).removeClass("is-invalid");
        $( "#nome" ).addClass("is-valid");
      }
    });

      $('#rfid').focus(function(){
        $('#modal-form').modal({
          show: true
        });
      });
      
      $('#modal-form').on('shown.bs.modal', function (e) {
        $.ajax({
          type: "POST",
          url: "autenticar.php?acao=lerRFID",
          success: function(msg){
            $('#rfid').val(msg);
            $('#rfid').attr('readonly', true);
            $('#modal-form').modal('hide');
          }
        });
      });
      
      $("form#meuForm").submit(function(e) {
        $('#CPF').unmask();
      });  
      function TestaCPF(c) {
        if((c = c.replace(/[^\d]/g,"")).length != 11)
         return false

       if (c.length != 11 || 
         c == "00000000000" || 
         c == "11111111111" || 
         c == "22222222222" || 
         c == "33333333333" || 
         c == "44444444444" || 
         c == "55555555555" || 
         c == "66666666666" || 
         c == "77777777777" || 
         c == "88888888888" || 
         c == "99999999999")
         return false;

       var r;
       var s = 0;

       for (i=1; i<=9; i++)
         s = s + parseInt(c[i-1]) * (11 - i);

       r = (s * 10) % 11;

       if ((r == 10) || (r == 11))
         r = 0;

       if (r != parseInt(c[9]))
         return false;

       s = 0;

       for (i = 1; i <= 10; i++)
         s = s + parseInt(c[i-1]) * (12 - i);

       r = (s * 10) % 11;

       if ((r == 10) || (r == 11))
         r = 0;

       if (r != parseInt(c[10]))
         return false;

       return true;
     }
     
     
     
     
   }
 });

</script>
</html>