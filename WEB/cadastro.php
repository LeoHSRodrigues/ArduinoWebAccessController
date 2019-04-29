<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	require_once('db.class.php');
	$banco = new db();
 $dados = array();


   $dados['nome'] = $_POST['nome'];
   $dados['CPF'] = $_POST['cpf'];
   $dados['senha'] = hash('sha512', $_POST['senha']);
   $dados['senha4'] = hash('sha512', $_POST['senha4']);
   $dados['dataDeNascimento']  = date("Y-m-d", strtotime(str_replace('/', '-', $_POST['dataNasc'])));
   $dados['tagRFID'] = hash('sha512', $_POST['rfid']);

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

if ($resultado == null){
 $_SESSION['msg'] = "<div class='alert alert-success' style='text-align:center;' role='alert'>Usuário Cadastrado com sucesso!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
 header("Location:login.php");
 exit;
}
}
?>
<head>
  <meta charset="UTF-8" http-equiv="Content-Language" content="pt-br">
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
  <script src="../Javascript/bootstrap-datepicker.min.js"></script>
  <script src="../Javascript/bootstrap-datepicker.pt-BR.min.js"></script>
  <script src="../Bibliotecas/Argon/js/argon.min.js"></script>
  <link rel="shortcut icon" href="../Imagens/favicon-lock.ico" />
  <style>
    
    .custom-file-input ~ .custom-file-label::after {
      content: "Procurar";
    }   
  </style>
</head>
<div class="msg_erro">
 <?php
 if(isset($_SESSION['msg'])){
  echo $_SESSION['msg'];
  unset($_SESSION['msg']);
} else {
  unset($_SESSION['msg']);
}?>
</div>
<div class="col-lg-5" style="margin:auto;">
  <div class="card bg-secondary shadow border-0">
    <div class="card-body px-lg-5 py-lg-5">
      
      <div class="text-center text-muted mb-4">
        <p>CADASTRO</p>
      </div>
      
      <hr>
      
      <form role="form" method="post" id="meuForm" enctype="multipart/form-data" autocomplete="off">
        
        <div class="form-group">
          <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
            </div>
            <input class="form-control" required placeholder="Nome" id="nome" name="nome" type="text">
          </div>
        </div>
        
        <div class="form-group">
          <div class="input-group input-group-alternative mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="far fa-address-card"></i></span>
            </div>
            <input class="form-control" required placeholder="CPF" id="CPF" name="cpf" type="text">
          </div>
        </div>
        
        <div class="form-group">
          <div class="input-group input-group-alternative">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
            </div>
            <input class="form-control" required placeholder="Senha" id="senha" name="senha" type="password">
          </div>
        </div>  
        
        <div class="form-group">
          <div class="input-group input-group-alternative">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
            </div>
            <input class="form-control" required placeholder="Confirme sua Senha" id="conf_senha" name="conf_senha" type="password">
          </div>
        </div>
        
        <div class="form-group">
          <div class="input-group input-group-alternative">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
            </div>
            <input class="form-control" required placeholder="Data de Nascimento" id="dataNasc" name="dataNasc" type="text">
          </div>
        </div>
        
        <div class="form-group">
          <div class="input-group input-group-alternative">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-key"></i></span>
            </div>
            <input class="form-control" required placeholder="Senha de 4 dígitos" id="senha4" name="senha4" type="password">
          </div>
        </div>                  
        
        
        <div class="form-group">
          <div class="input-group input-group-alternative">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-key"></i></span>
            </div>
            <input class="form-control" required placeholder="Confirme sua senha de 4 dígitos" id="conf_senha4" name="conf_senha4" type="password">
          </div>
        </div>
        
        <div class="form-group">
          <div class="input-group input-group-alternative">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-satellite-dish"></i></span>
            </div>
            <input class="form-control" value=""required data-toggle="modal" data-target="#modal-form" placeholder="Cadastrar Cartão RFID" id="rfid" name="rfid" type="text">
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
          <button type="submit" id="cadastrar" disabled class="btn btn-primary mt-4">Cadastrar</button>
          <button type="button" id="voltar" onclick="window.location.href='login.php'" class="btn btn-secondary mt-4">Voltar</button>
        </div>        
        
      </form>
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
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
   $(document).ready(function() {
    
    $('#CPF').mask('000.000.000-00',{clearIfNotMatch: true});
    
    $('#dataNasc').datepicker({
     maxViewMode: 2,
     todayBtn: "linked",
     language: "pt-BR",
     autoclose: true,
     todayHighlight: true
   });
    
    $('#fotoPerfil').on('change',function(){
      var fileName = document.getElementById("fotoPerfil").files[0].name;
      $(this).next('.custom-file-label').html(fileName);
    })
    
    $('#dataNasc').focusout(function(){
      $( "#dataNasc" ).addClass("is-valid");
    });

    $('#senha, #conf_senha').on('keyup focusout', function () {
     if ($('#senha').val() == $('#conf_senha').val() && $('#senha').val().length > 6 ) {
      $( "#senha" ).removeClass("is-invalid");
      $( "#conf_senha" ).removeClass("is-invalid");
      $( "#senha" ).addClass("is-valid");
      $( "#conf_senha" ).addClass("is-valid");
      $('#cadastrar').prop("disabled", false);
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
      $('#cadastrar').prop("disabled", false);
    } else {
      $( "#senha4" ).removeClass("is-valid");
      $( "#conf_senha4" ).removeClass("is-valid");
      $( "#senha4" ).addClass("is-invalid");
      $( "#conf_senha4" ).addClass("is-invalid");
      $('#cadastrar').prop("disabled", true);

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
      $('#cadastrar').prop("disabled", true);
    }
  });
    $('#rfid').focus(function(){
      $('#modal-form').modal({
        show: true
      });
    });
    
    $(document).on('shown.bs.modal', function (e) {
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
    
    
    
  });
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