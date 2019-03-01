<?php
        ini_set('max_execution_time', 3);
        $output= shell_exec('PowerShell -ExecutionPolicy Bypass -Command "'. __DIR__ .'\lerRFID.ps1"');
        echo $output;
?>