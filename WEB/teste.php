<?php
$output= shell_exec('PowerShell -ExecutionPolicy Bypass -Command "'. __DIR__ .'\lerRFID.ps1"');
var_dump ($output);
?>