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
	function seleciona2($senha,$RFID){
		$conexao = $this->conectar();
		$sql  = "SELECT nome, tipoConta,CPF FROM usuario where senha4 = '$senha' and TAGRFID = '$RFID'";
		$stmt = $conexao->prepare($sql);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		return $stmt;
	}
    function seleciona3($rfid){
		$conexao = $this->conectar();
		$sql = "select nome,status,sigla,cargo,U.CPF from usuario as u inner join setorusuario as su on u.CPF = su.CPF inner join setor as s on s.idSetor = su.idSetor where u.TAGRFID = \"$rfid\"";
		$stmt = $conexao->prepare($sql);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		return $stmt;
	}
	function seleciona4($cpf){
		$conexao = $this->conectar();
		$sql = "select id,nome,CPF,date_format(dataDeNascimento,'%d/%m/%Y') as dataDeNascimento from usuario where CPF = \"$cpf\"";
		$stmt = $conexao->prepare($sql);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		return $stmt;
	}

    // nome,cpf,senha,senha4
	function insere($dados){
		try {
			$conexao = $this->conectar();
			$sql = "INSERT INTO usuario (nome, CPF, senha,senha4,dataDeNascimento,tagRFID) VALUES (?,?,?,?,?,?)";
			$conexao->prepare($sql)->execute([$dados['nome'], $dados['cpf'], $dados['senha'],$dados['senha4'],$dados['dataNasc'],$dados['rfid']]);
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

	function altera($dados){

// $dados[0] = nome;
// $dados[1] = cpf;
// $dados[2] = senha;
// $dados[3] = senha4;
// $dados[4] = rfid;
// $dados[5] = dataNasc;
// $dados[6] = id;
// var_dump($dados);exit;
		try {   
  $conexao = $this->conectar();
  if ($_SESSION['permissao'] === 'adm'){
  $stmt = $conexao->prepare('UPDATE usuario SET nome = :nome , CPF = :CPF , dataDeNascimento = :dataDeNascimento , tagRFID = :tagRFID , senha = :senha , senha4 = :senha4 WHERE id = :id');
  $stmt->execute(array(
    ':id'   => $dados['id'],
    ':CPF' => $dados['cpf'],
    ':nome' => $dados['nome'],
    ':dataDeNascimento' => $dados['dataNasc'],
    ':tagRFID' => $dados['rfid'],
    'senha' => $dados['senha'],
    'senha4' => $dados['senha4']
  ));
}
else{
  $stmt = $conexao->prepare('UPDATE usuario SET nome = :nome , dataDeNascimento = :dataDeNascimento , tagRFID = :tagRFID , senha = :senha , senha4 = :senha4 WHERE id = :id');
  $stmt->execute(array(
    ':id'   => $dados['id'],
    ':nome' => $dados['nome'],
    ':dataDeNascimento' => $dados['dataNasc'],
    ':tagRFID' => $dados['rfid'],
    'senha' => $dados['senha'],
    'senha4' => $dados['senha4']
  ));
}
     
  echo $stmt->rowCount(); 
} catch(PDOException $e) {
  echo 'Error: ' . $e->getMessage();
}

	}

	function LiberaMemoria(){


	}

}
?>
