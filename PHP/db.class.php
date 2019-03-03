<?php
class db {
	function conectar(){
		$con = new PDO("mysql:host=localhost;dbname=arduinowebaccesscontroller", "root", "");
		$con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		return $con;
	}

	function seleciona($valor){
		$conexao = $this->conectar();
		$sql  = "SELECT id FROM usuario where TAGRFID = '$valor'";
		$stmt = $conexao->prepare($sql);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		return $stmt;
	}
	function seleciona1($cpf,$senha){
		$conexao = $this->conectar();
		$sql  = "SELECT id FROM usuario where CPF = '$cpf' and senha = '$senha'";
		$stmt = $conexao->prepare($sql);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		return $stmt;
	}

	function insere(){


	}

	function apaga(){


	}

	function altera(){

	}

	function LiberaMemoria($result){

		mysql_free_result($result);

	}

}
?>
