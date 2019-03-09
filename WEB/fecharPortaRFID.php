<?php
ini_set('max_execution_time', 5);
$output= shell_exec('PowerShell -ExecutionPolicy Bypass -Command "'. __DIR__ .'\fecharPortaRFID.ps1"');
?>