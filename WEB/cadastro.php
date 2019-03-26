<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	require_once('db.class.php');
	$banco = new db();
	$dados = array();
	$dados['nome'] = $_POST['nome'];
	$dados['cpf'] = $_POST['cpf'];
	$dados['senha'] = hash('sha512', $_POST['senha']);
	$dados['senha4'] = hash('sha512', $_POST['senha4']);
	$dados['dataNasc']  = date("Y-m-d", strtotime(str_replace('/', '-', $_POST['dataNasc'])));
	//var_dump($dados['dataNasc']);exit;
	$diretorioFotoPerfil = '../fotosPerfil/';
	$foto = $_FILES['fotoPerfil']['tmp_name'];
	if( in_array( $_FILES['fotoPerfil']['type'], array("image/jpeg") ) || in_array( $_FILES['fotoPerfil']['type'], array("image/png") )){
		$uploadfile = $diretorioFotoPerfil . $dados['cpf'] .'.png';
		move_uploaded_file($_FILES['fotoPerfil']['tmp_name'], $uploadfile);
		$nomeArquivo = $_FILES['fotoPerfil']['name'];
		$resultado = $banco->insere($dados);
	}
	else{
		$_SESSION['msg'] = "<div class='alert alert-danger' style='text-align:center;' role='alert'>A imagem anexada não é suportada!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
	}
}
?>


<html>
<head>
	<meta charset="UTF-8"> 
	<title>Cadastro</title>
	<link rel="stylesheet" type="text/css" href="../CSS/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../CSS/estilo.css">
	<link rel="stylesheet" type="text/css" href="../CSS/bootstrap-datepicker3.standalone.min.css">
	<link rel="stylesheet" type="text/css" href="../Bibliotecas/Font-Awesome/css/all.min.css">
	<script src="../Javascript/jquery-3.3.1.js"></script>
	<script src="../Javascript/popper.min.js"></script>
	<script src="../Javascript/bootstrap.min.js"></script>
	<script src="../Bibliotecas/Font-Awesome/js/all.min.js"></script>
	<script src="../Javascript/jquery.mask.js"></script>
	<script src="../Javascript/bootstrap-datepicker.min.js"></script>
	<script src="../Javascript/bootstrap-datepicker.pt-BR.min.js"></script>
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
				<form class="" enctype="multipart/form-data" method="post" id="meuForm" autocomplete="off">


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
							<input type="text" id="CPF" maxlength="11" name="cpf" class="form-control" required placeholder="Digite o seu CPF" aria-label="Digite o seu email" required aria-describedby="basic-addon2">
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
							<label for="senha">Data de Nascimento</label>
							<div class="input-group"></div>
							<input type="text" id="dataNasc" name="dataNasc" class="form-control" required aria-describedby="basic-addon2">
							<div class="input-group-append">
								<span class="input-group-text" id="basic-addon2"><i class="far fa-calendar-alt"></i></span>
							</div>
						</div>						

						<div class="form-group input-group col-sm-8 mx-auto">
							<label for="senha">Senha de 4 dígitos</label>
							<div class="input-group"></div>
							<input type="password" maxlength="4" id="senha4" name="senha4" class="form-control" placeholder="Digite a sua senha" required aria-label="Digite o seu email" required aria-describedby="basic-addon2">
							<div class="input-group-append">
								<span class="input-group-text" id="basic-addon2"><i id="validadorSenha4" class="fas fa-times"></i></span>
							</div>
						</div>

						<div class="form-group input-group col-sm-8 mx-auto">
							<label for="senha">Confirme a sua Senha</label>
							<div class="input-group"></div>
							<input type="password" maxlength="4" id="conf_senha4" name="senha4" class="form-control" placeholder="Digite a sua senha" required aria-label="Digite o seu email" required aria-describedby="basic-addon2">
							<div class="input-group-append">
								<span class="input-group-text" id="basic-addon2"><i id="validadorConfirmaSenha4" class="fas fa-times"></i></span>
							</div>
						</div>

						<div class="form-group input-group col-sm-8 mx-auto">
							<label for="senha">Escolha uma Imagem de Perfil</label>
							<div class="form-group">
								<input type="file" required name="fotoPerfil" class="form-control-file" id="exampleFormControlFile1">
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
		$('#dataNasc').datepicker({
			maxViewMode: 2,
			todayBtn: "linked",
			language: "pt-BR",
			autoclose: true,
			todayHighlight: true
		});


		$('#senha, #conf_senha').on('keyup focusout', function () {
			if ($('#senha').val() == $('#conf_senha').val() && $('#senha').val().length > 6 ) {
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

		$('#senha4, #conf_senha4').on('keyup focusout', function () {
			if ($('#senha4').val() == $('#conf_senha4').val() && $('#senha4').val().length > 3 ) {
				$( "#senha4" ).removeClass("bg-danger text-white");
				$( "#conf_senha4" ).removeClass("bg-danger text-white");
				$( "#validadorSenha4" ).removeClass( "fas fa-times");
				$( "#validadorConfirmaSenha4" ).removeClass( "fas fa-times");
				$( "#validadorSenha4" ).addClass( "fas fa-check");
				$( "#validadorConfirmaSenha4" ).addClass( "fas fa-check");
				$('#cadastrar').prop("disabled", false);
			} else {
				$( "#validadorSenha4" ).removeClass( "fas fa-check");
				$( "#validadorSenha4" ).addClass( "fas fa-times");
				$( "#validadorConfirmaSenha4" ).addClass( "fas fa-times");
				$( "#senha4" ).addClass("bg-danger text-white");
				$( "#conf_senha4" ).addClass("bg-danger text-white");

			}
		});
		$('#CPF').focusout(function(){
			var testarCPF = TestaCPF($("#CPF").val());
			if(testarCPF == false) {
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