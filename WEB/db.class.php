<?php
class db {
	function conectar(){
		$con = new PDO("mysql:host=localhost;dbname=arduinowebaccesscontroller", "root", "");
		$con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$con->exec("set names utf8");
		return $con;
	}

	function seleciona($valor){
		$conexao = $this->conectar();
		$sql  = "SELECT nome,status FROM usuario where TAGRFID = '$valor'";
		$stmt = $conexao->prepare($sql);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		return $stmt;
	}
	function seleciona1($cpf,$senha){
		$conexao = $this->conectar();
		$sql  = "SELECT nome, tipoConta,CPF FROM usuario where CPF = '$cpf' and senha = '$senha'";
		$stmt = $conexao->prepare($sql);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		return $stmt;
	}
	function seleciona2($senha){
		$conexao = $this->conectar();
		$sql  = "SELECT nome, tipoConta FROM usuario where senha4 = '$senha'";
		$stmt = $conexao->prepare($sql);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		return $stmt;
	}
    function seleciona3($rfid){
		$conexao = $this->conectar();
		$sql = "select nome,status,sigla,cargo from usuario as u inner join setorusuario as su on u.CPF = su.CPF inner join setor as s on s.idSetor = su.idSetor where u.TAGRFID = \"$rfid\"";
		$stmt = $conexao->prepare($sql);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		return $stmt;
	}
	function seleciona4($cpf){
		$conexao = $this->conectar();
		$sql = "select nome,CPF,date_format(dataDeNascimento,'%d/%m/%Y') as dataDeNascimento from usuario where CPF = \"$cpf\"";
		$stmt = $conexao->prepare($sql);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		return $stmt;
	}

    // nome,cpf,senha,senha4
	function insere($dados){
		try {
			$conexao = $this->conectar();
			$sql = "INSERT INTO usuario (nome, CPF, senha,senha4,dataDeNascimento) VALUES (?,?,?,?,?)";
			$conexao->prepare($sql)->execute([$dados['nome'], $dados['cpf'], $dados['senha'],$dados['senha4'],$dados['dataNasc']]);
			$_SESSION['msg'] = "<div class='alert alert-success' style='text-align: center;' role='alert'>Usuário Cadastrado!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-text='true'>&times;</span></button></div>";
			header("Location:login.php");
			exit();
		}
		catch (Exception $e) {
			$_SESSION['msg'] = "<div class='alert alert-danger' style='text-align: center;' role='alert'>".$e."<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-text='true'>&times;</span></button></div>";
		}

	}

	function apaga(){


	}

	function altera(){

	}

	function LiberaMemoria(){


	}

}
?>
