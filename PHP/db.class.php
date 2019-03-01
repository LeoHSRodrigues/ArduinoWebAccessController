<?php
class db {


	function conectar(){
        $con = new PDO("mysql:host=localhost;dbname=ArduinoWebAccessController", "root", "root");
		return $conn;
	}

	function seleciona(){

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
