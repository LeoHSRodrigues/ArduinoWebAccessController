<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	require_once('db.class.php');
	$banco = new db();
	$nome = $_POST['nome'];
	$cpf = $_POST['cpf'];
	$senha = hash('sha512', $_POST['senha']);
	$resultado = $banco->insere($nome,$cpf,$senha);

}
?>


<html>
<head>
	<meta charset="UTF-8"> 
	<title>Cadastro</title>
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

		<div class="loginbox mx-auto page-wrapper">
			<div class="card mx-auto bordaRounded">
				<div class="card-body mx-auto">
					<h5 class="card-title center_text">Cadastrar</h5>
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
				<form class="" method="post" id="meuForm" autocomplete="off">


					<div class="form-group input-group col-sm-12 mx-auto">

						<div class="form-group input-group col-sm-8 mx-auto">
							<label for="nome">Nome</label>
							<div class="input-group"></div>
							<input type="text" required id="nome" name="nome" class="form-control" required placeholder="Digite o seu Nome" aria-label="Digite o seu nome" required aria-describedby="basic-addon2">
							<div class="input-group-append">
								<span class="input-group-text" id="basic-addon2"><i id="validadorNome" class="fas fa-times"></i></span>
							</div>
						</div>

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

						<div class="form-group input-group col-sm-8 mx-auto">
							<label for="senha">Confirme a sua Senha</label>
							<div class="input-group"></div>
							<input type="password" id="conf_senha" name="senha" class="form-control" placeholder="Digite a sua senha" required aria-label="Digite o seu email" required aria-describedby="basic-addon2">
							<div class="input-group-append">
								<span class="input-group-text" id="basic-addon2"><i id="validadorConfirmaSenha" class="fas fa-times"></i></span>
							</div>
						</div>

						<div class="form-group input-group col-sm-8 mx-auto">
							<input type="submit" disabled style="margin: auto" id="cadastrar" class="btn btn-primary" value="Cadastrar">
							<input type="button" onclick="window.location.href='login.php'" style="margin: auto" id="voltar" class="btn btn-secondary" value="Voltar">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
<script type="text/javascript">
    $(document).ready(function() {
     $('#CPF').mask('000.000.000-00',{clearIfNotMatch: true});


		$('#senha, #conf_senha').on('keyup focusout', function () {
	if ($('#senha').val() == $('#conf_senha').val() && $('#senha').val().length > 4 ) {
			$( "#senha" ).removeClass("bg-danger text-white");
			$( "#conf_senha" ).removeClass("bg-danger text-white");
			$( "#validadorSenha" ).removeClass( "fas fa-times");
			$( "#validadorConfirmaSenha" ).removeClass( "fas fa-times");
			$( "#validadorSenha" ).addClass( "fas fa-check");
			$( "#validadorConfirmaSenha" ).addClass( "fas fa-check");
			$('#cadastrar').prop("disabled", false);
	} else {
			$( "#validadorSenha" ).removeClass( "fas fa-check");
			$( "#validadorSenha" ).addClass( "fas fa-times");
			$( "#validadorConfirmaSenha" ).addClass( "fas fa-times");
			$( "#senha" ).addClass("bg-danger text-white");
			$( "#conf_senha" ).addClass("bg-danger text-white");

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

     $('#nome').focusout(function(){
      if($("#nome").val().length < 5) {
			$( "#validadorNome" ).removeClass( "fas fa-check");
			$( "#validadorNome" ).addClass( "fas fa-times");
			$( "#nome" ).addClass("bg-danger text-white");
      }
      else{
			$( "#nome" ).removeClass("bg-danger text-white");
			$( "#validadorNome" ).removeClass( "fas fa-times");
			$( "#validadorNome" ).addClass( "fas fa-check");
			$('#cadastrar').prop("disabled", true);
      }
    });

   });
 </script>
 <script>
   $("form#meuForm").submit(function(e) {
    $('#CPF').unmask();
  });  
 </script>