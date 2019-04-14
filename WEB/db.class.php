<?php
class db {
	function conectar(){
		$con = new PDO("mysql:host=localhost;dbname=arduinowebaccesscontroller", "root", "");
		$con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$con->exec("set names utf8");
		return $con;
	}

	function seleciona($campos,$tabela,$where){
		$conexao = $this->conectar();
		try {
			$sql  = "SELECT ".$campos." FROM ".$tabela." ".$where."";
			//var_dump($sql);exit;
			$stmt = $conexao->prepare($sql);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			return $stmt;
		}
		catch (Exception $e) {
			header('Content-Type: application/json');
			echo json_encode($e);
			exit;
		}

	}
	function insere($nomeTabela,$campos,$qtdeCampos,$dados){
		try {
			$conexao = $this->conectar();
			$sql = "INSERT INTO ".$nomeTabela." (".$campos.") VALUES (".$qtdeCampos.")";
			$conexao->prepare($sql)->execute(array_values($dados));
		}
		catch (Exception $e) {
			header('Content-Type: application/json');
			echo json_encode($e);
			exit;
		}

	}

	function apaga($tabela,$campos,$dados){
		try {
			$conexao = $this->conectar();
			$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $conexao->prepare('DELETE FROM '.$tabela. ' WHERE '.$campos);
			if (gettype($dados) == 'string'){
				$stmt->bindParam(':id', $dados); 
				$stmt->execute();
			}
			else{
				$stmt->execute(array_values($dados));
			}

			echo $stmt->rowCount(); 
		} catch(PDOException $e) {
			header('Content-Type: application/json');
			echo json_encode($e);
			exit;
		}
	}

	function altera($nomeTabela,$query,$dados){
		try {   
			$conexao = $this->conectar();
			if ($_SESSION['permissao'] === 'adm'){
				$stmt = $conexao->prepare('UPDATE '.$nomeTabela.' SET '.$query);
				$stmt->execute(array_values($dados));
			}
			else{
				$stmt = $conexao->prepare('UPDATE '.$nomeTabela.' SET '.$query);
				$stmt->execute(array_values($dados));
			}

		} catch(PDOException $e) {
			header('Content-Type: application/json');
			echo json_encode($e);
			exit;
		}

	}

	function LiberaMemoria(){


	}

}
?>
