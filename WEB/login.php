<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  require_once('db.class.php');
  $banco = new db();
  if(isset($_POST['acesso']) && ($_POST['acesso'] == 'normal')) {
    $usuario = $_POST['cpf'];
    $senha = hash('sha512', $_POST['senha']);
    $resultado = $banco->seleciona1($usuario,$senha);
    $teste = $resultado->rowCount();
    if ($teste > 1){
      $_SESSION['msg'] = "<div class='alert alert-danger' style='text-align:center;' role='alert'>Login ou Senha incorretos!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
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
      header("Location:home.php");
    }
  }
}
?>


<html>
<head>
  <meta charset="UTF-8"> 
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="../CSS/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../CSS/estilo.css">
  <link rel="stylesheet" type="text/css" href="../Bibliotecas/Font-Awesome/css/all.min.css">
  <script src="../Javascript/jquery-3.3.1.js"></script>
  <script src="../Javascript/popper.min.js"></script>
  <script src="../Javascript/bootstrap.min.js"></script>
  <script src="../Bibliotecas/Font-Awesome/js/all.min.js"></script>
  <script src="../Javascript/jquery.mask.js"></script>
  <link rel="shortcut icon" href="../Imagens/favicon-lock.ico" />
</head>
<body>
  <div class="main_container">
    <div role="alert" aria-live="assertive" style="position: absolute; z-index: 9999; top: 0; right: 0;" aria-atomic="true" class="toast" data-autohide="false">
      <div class="toast-header">
        <strong class="mr-auto">Validação dos Campos</strong>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="toast-body">
        <p style="line-height: 0.1;" class="font-weight-light">CPF:</p>
        <small>O campo CPF deve possuir 11 caracteres.</small><br/><br/>
        <p style="line-height: 0.1;" class="font-weight-light">Senha:</p>
        <small>O campo senha deve possuir no mínimo 4 caracteres.</small>
      </div>
    </div>

    <div class="loginbox mx-auto page-wrapper">
      <div class="card mx-auto bordaRounded">
        <div class="card-body mx-auto">
          <h5 class="card-title center_text">LOGIN</h5>
        </div>
        <form class="" method="post" id="meuForm" autocomplete="off" >


          <div class="msg_erro">
            <?php
            if(isset($_SESSION['msg'])){
              echo $_SESSION['msg'];
              unset($_SESSION['msg']);
            } else {
              unset($_SESSION['msg']);
            }?>
          </div>


          <div class="form-group input-group col-sm-12 mx-auto">

            <div class="form-group input-group col-sm-8 mx-auto">
              <label for="CPF">CPF</label>
              <div class="input-group"></div>
              <input type="text" id="CPF" name="cpf" class="form-control" required placeholder="Digite o seu CPF" aria-label="Digite o seu email" required aria-describedby="basic-addon2">
              <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2"><i id="validadorCPF" class="fas fa-times"></i></span>
              </div>
            </div>


            <div class="form-group input-group col-sm-8 mx-auto">
              <label for="senha">Senha</label>
              <div class="input-group"></div>
              <input type="password" id="senha" name="senha" class="form-control" placeholder="Digite a sua senha" required aria-label="Digite o seu email" required aria-describedby="basic-addon2">
              <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2"><i id="validadorSenha" class="fas fa-times"></i></span>
              </div>
            </div>


            <div style="text-align:center;" class="form-group col-sm-12 mt-2 mb-4">
              <input type="submit" disabled name="enviar" id="enviar"  class="btn btn-primary" value="Entrar">
              <br/>
              <br/>
              <a href="cadastro.php">Criar Cadastro</a><br/>
              <a href="esqueci.php">Esqueci a Senha</a><br/>
              <span>Entrar com Cartão RFID</span>
              <hr>
              <a href="#" data-toggle="modal" data-target="#myModal"><img src="../Imagens/loginwithRFID.png" alt="RFID" height="70" width="70"></a>
            </div>
          </div>
          <input type="text" style="display: none;" id="acesso" name="acesso" value="normal">
        </form>
      </div>
    </div>
  </div>

  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="content">
            <div id="erro"></div>
            <div class="imagemRFID">
              <p>Aproxime o cartão da leitora</p>
              <img class="pulse"src="../Imagens/approachRFID.png" width="300px" height="300px"></div>
              <div id="loading"></div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-info" data-dismiss="modal">Fechar</button>
          </div>
        </div>
      </div>
    </div>

  </body>
  <script type="text/javascript">
    $(document).ready(function() {
     $('#CPF').mask('000.000.000-00',{clearIfNotMatch: true});

     $('.toast').toast('show');


     $('#senha').bind("keyup focusout", function () {
      if($("#senha").val().length < 5) {
          $( "#validadorSenha" ).removeClass( "fas fa-check");
          $( "#validadorSenha" ).addClass( "fas fa-times");
          $( "#senha" ).addClass("bg-danger text-white");
          $('#enviar').prop("disabled", true);
          }
          else{
            $( "#senha" ).removeClass("bg-danger text-white");
            $( "#validadorSenha" ).removeClass( "fas fa-times");
            $( "#validadorSenha" ).addClass( "fas fa-check");
            $('#enviar').prop("disabled", false);
          }
        });
     $('#CPF').focusout(function(){
      if($("#CPF").val().length < 11) {
        $( "#validadorCPF" ).removeClass( "fas fa-check");
        $( "#validadorCPF" ).addClass( "fas fa-times");
        $( "#CPF" ).addClass("bg-danger text-white");
      }
      else{
        $( "#CPF" ).removeClass("bg-danger text-white");
        $( "#validadorCPF" ).removeClass( "fas fa-times");
        $( "#validadorCPF" ).addClass( "fas fa-check");
      }
    });


     $(document).on('shown.bs.modal', function (e) {
      $.ajax({
        type: "POST",
        url: "autenticar.php?acao=lerRFIDSenha",
        success: function(msg){
          if (msg == 'achou'){
           $( ".imagemRFID" ).remove();
           $("#loading").html('<div style="text-align: center;"><form id="formRFID" autocomplete="off"><label class="align-content-center" for="senha">Senha</label><input type="password" id="senhaRFID" name="senhaRFID" class="form-control" placeholder="Digite a sua senha"><br/><input type="submit" name="enviarRFID" id="enviarRFID"  class="btn btn-primary" value="Entrar"></div></form>');
         }
         else{
          $( ".imagemRFID" ).remove();
          $("#loading").html("<div class='alert alert-danger' style='text-align:center;' role='alert'>Cartão Não Cadastrado!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
        }
      }
    });
    });
     $(document).on('hidden.bs.modal', function () {
      $( ".imagemRFID" ).remove();
      $( "#loading" ).empty();
      $('.content').append('<div class="imagemRFID"><p>Aproxime o cartão da leitora</p><img class="pulse"src="../Imagens/approachRFID.png" width="300px" height="300px"></div>');
      $.ajax({
       url: "fecharPortaRFID.php",
        cache: false
      });
    })
   });
 </script>
 <script>
  $('#loading').on('submit','form',function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
      type: "POST",
      url: "autenticarRFID.php",
      data: formData,
      success: function(data)
      {
        if (data == 'cadastrado'){
          window.location.href = "../WEB/home.php";
        }
        else{
          $('#erro').css('display', 'block');
          $('#erro').html("<div style='text-align:center;' class='alert alert-danger' role='alert'><span>Senha Incorreta!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></span></div>");
          $("#senhaRFID").val('');
        }
      },
      cache: false,
      contentType: false,
      processData: false
    });
    return false;
  });

  $("form#meuForm").submit(function(e) {
    $('#CPF').unmask();
  });  

  function isValidSenha(senha) {
    var pattern = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;
    return pattern.test(senha);
  }
  
</script>
</html>