<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  require_once('db.class.php');
  $banco = new db();
    $usuario = $_POST['cpf'];
    $senha = hash('sha512', $_POST['senha']);
    $resultado = $banco->seleciona('nome, tipoConta,CPF,id','usuario','where CPF = "'.$usuario.'" and senha = "'.$senha.'"');
    $teste = $resultado->rowCount();
    if ($teste != 1){
      $_SESSION['msg'] = "<div class='alert alert-danger' style='text-align:center;' role='alert'>Login ou Senha incorretos!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
    }
    else{
      $_SESSION['atividade'] = time();
      $dados = $resultado->fetchAll();
      $_SESSION['id'] = $dados[0]['id'];
      $_SESSION['nome'] = $dados[0]['nome'];
      $_SESSION['permissao'] = $dados[0]['tipoConta'];
      $_SESSION['cpf'] = $dados[0]['CPF'];
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
?>


<html>
<head>
  <meta charset="UTF-8"> 
  <title>Login</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <link rel="stylesheet" type="text/css" href="../CSS/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../CSS/estilo.css">
  <link rel="stylesheet" type="text/css" href="../Bibliotecas/Font-Awesome/css/all.min.css">
  <link rel="stylesheet" type="text/css" href="../Bibliotecas/Argon/css/argon.min.css" >
  <link rel="stylesheet" href="../Bibliotecas/Argon/vendor/nucleo/css/nucleo.css">
  <script src="../Javascript/jquery-3.3.1.js"></script>
  <script src="../Javascript/popper.min.js"></script>
  <script src="../Javascript/bootstrap.min.js"></script>
  <script src="../Bibliotecas/Font-Awesome/js/all.min.js"></script>
  <script src="../Javascript/jquery.mask.js"></script>
  <link rel="shortcut icon" href="../Imagens/favicon-lock.ico" />
</head>
<body>
  <div class="main_container">
    <div role="alert" aria-live="assertive" style="position: absolute; z-index: 9999; top: 0; right: 0;" aria-atomic="true" class="toast"  data-delay="7000">
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
        <small>O campo senha deve possuir no mínimo 6 caracteres.</small>
      </div>
    </div>

    <div class="msg_erro">
      <?php
      if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
      } else {
        unset($_SESSION['msg']);
      }?>
    </div>
    
          <div class="msg_erro">
            <?php
            if(isset($_SESSION['msg'])){
              echo $_SESSION['msg'];
              unset($_SESSION['msg']);
            } else {
              unset($_SESSION['msg']);
            }?>
          </div>
    
    <div class="loginbox col-lg-5">
      <div class="card bg-secondary shadow border-0">
        <div class="card-body px-lg-5 py-lg-5">
          <div class="text-center text-muted mb-4">
            <small>LOGIN</small>
          </div>
          <form role="form" method="post" id="meuForm" autocomplete="off">
            <div class="form-group mb-3">
              <div class="input-group input-group-alternative">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="far fa-address-card"></i></span>
                </div>
                <input class="form-control" required name="cpf" id="CPF" placeholder="CPF" type="text">
              </div>
            </div>
            <div class="form-group">
              <div class="input-group input-group-alternative">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                </div>
                <input class="form-control" required name="senha" id="senha" placeholder="Senha" type="password">
              </div>
            </div>
            <div class="text-center">
              <button type="submit" id="enviar" disabled class="btn btn-primary my-4">Login</button>
            </div>
          </form>
          <hr>
          <div class="text-center text-muted mb-4">
            <small>LOGIN COM RFID</small>
          </div>          
          <div class="text-center ">
            <a href="#" data-toggle="modal" data-target="#modal-form"><img src="../Imagens/loginwithRFID.png" alt="RFID" height="70" width="70"></a>
          </div>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-6">
          <a href="#" class="text-light">
            <small>Esqueci a senha</small>
          </a>
        </div>
        <div class="col-6 text-right">
          <a href="cadastro.php" class="text-light">
            <small>Criar Conta</small>
          </a>
        </div>
      </div>
    </div>
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
                <form role="form">
                </form>
              </div>
            </div>
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
      if($("#senha").val().length < 6) {
        $( "#senha" ).addClass( "is-invalid");
        $('#enviar').prop("disabled", true);
      }
      else{
        $( "#senha" ).removeClass("is-invalid");
        $( "#senha" ).addClass("is-valid");
        $('#enviar').prop("disabled", false);
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


     $(document).on('shown.bs.modal', function (e) {
      $.ajax({
        type: "POST",
        url: "autenticar.php?acao=lerRFIDSenha",
        success: function(msg){
           $( ".imagemRFID" ).remove();
           $("#loading").html('<div style="text-align: center;"><form id="formRFID" autocomplete="off"><label class="align-content-center" for="senha">Senha</label><input type="password" id="senhaRFID" name="senhaRFID" class="form-control" placeholder="Digite a sua senha"><br/><input type="hidden" value="'+msg+'"  name="RFID" ><input type="submit" name="enviarRFID" id="enviarRFID"  class="btn btn-primary" value="Entrar"></div></form>');
        },
        error: function(msg){
          $( ".imagemRFID" ).remove();
          $("#loading").html("<div class='alert alert-danger' style='text-align:center;' role='alert'>Cartão Não Cadastrado!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
      }
    });
    });
     $(document).on('hidden.bs.modal', function () {
      $( ".imagemRFID" ).remove();
      $( ".erro" ).remove();
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
          console.log(data);
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
    <script>
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
</script>
</html>