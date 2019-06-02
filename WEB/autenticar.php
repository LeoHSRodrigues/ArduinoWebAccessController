<?php
require_once('db.class.php');
$banco = new db();
session_start();
include "PhpSerial.php";

    // Let's start the class
$serial = new phpSerial();

    // First we must specify the device. This works on both Linux and Windows (if
    // your Linux serial device is /dev/ttyS0 for COM1, etc.)
$serial->deviceSet("/dev/ttyACM0");
    //$serial->deviceSet("COM3");

    $serial->confBaudRate(9600); //Baud rate: 9600

    if(isset($_GET['acao']) && $_GET['acao'] == 'lerRFIDSenha'){
    // ini_set('max_execution_time', 2);
    // $output= shell_exec('PowerShell -ExecutionPolicy Bypass -Command "'. __DIR__ .'\lerRFID.ps1"');
    // Then we need to open it
        $serial->deviceOpen();
        sleep(2);
    // Read data
        $read = $serial->readPort();

    // Print out the data
        $output = $read;

    // If you want to change the configuration, the device must be closed.
        $serial->deviceClose();
        $tagHasheado = hash('sha512', trim($output));
        $resultado = $banco->seleciona('nome,status','usuario','where TAGRFID = "'.$tagHasheado.'"');
        $teste = $resultado->rowCount();
        if ($teste != 1){
            header('HTTP/1.1 415 Tag não encontrada');
        }
        else{
            echo $tagHasheado;
        }
    }
    else if (isset($_GET['acao']) && $_GET['acao'] == 'lerCatraca'){
    // ini_set('max_execution_time', 0.5);
    // $output = shell_exec('PowerShell -ExecutionPolicy Bypass -Command "'. __DIR__ .'\lerRFID.ps1"');
    // Then we need to open it
        $serial->deviceOpen();
        sleep(2);
    // Read data
        $read = $serial->readPort();

    // Print out the data
        $output = $read;

    // If you want to change the configuration, the device must be closed.
        $serial->deviceClose();
        $nomeComputador = gethostname();
        $valor = hash('sha512', trim($output));
        $resultado = $banco->seleciona('nome,status,s.idSetor,sigla,cargo,U.CPF','usuario as u inner join setorusuario as su on u.CPF = su.CPF inner join setor as s on s.idSetor = su.idSetor','where u.TAGRFID = "'.$valor.'" and computadorResponsavel = "'.$nomeComputador.'"');
        $teste = $resultado->rowCount();
        if ($teste === 1){
            $dados = $resultado->fetchAll();

            $valores['tagRFID'] = $valor;
            $valores['data'] = date();
            $valores['idSetor'] = $dados[0]['idSetor'];

            $campos = array_keys($valores);
            $valor = count($valores);
            for ($i=0; $i < $valor ; $i++) { 
              $testequery[] = '?';
            }
            $contador = implode(" , ", $testequery);
            $campos = implode(" , ", $campos);
          
            $log = $banco->insere('log',$campos,$contador,$valores);
          
            $dados[0]['cpf'] = $output;
            echo json_encode($dados);
            //$output = shell_exec('PowerShell -ExecutionPolicy Bypass -Command "'. __DIR__ .'\fecharPortaRFID.ps1"');
        }
        else{
            if ($output != null){
                echo 'erro';
                //$output = shell_exec('PowerShell -ExecutionPolicy Bypass -Command "'. __DIR__ .'\fecharPortaRFID.ps1"');
            }
            else{
                echo 'n inserido';
            }

        }
    }
    else if (isset($_GET['acao']) && $_GET['acao'] == 'lerRFID'){
    // ini_set('max_execution_time', 0.5);
    // $output = shell_exec('PowerShell -ExecutionPolicy Bypass -Command "'. __DIR__ .'\lerRFID.ps1"');
    // $output = shell_exec('PowerShell -ExecutionPolicy Bypass -Command "'. __DIR__ .'\fecharPortaRFID.ps1"');
    // Then we need to open it
        $serial->deviceOpen();
        sleep(2);
    // Read data
        $read = $serial->readPort();

    // Print out the data
        $output = $read;
        echo $output;

    // If you want to change the configuration, the device must be closed.
        $serial->deviceClose();
    }
    ?>