<?php

session_start();

if (isset($_SESSION['atividade']) && (time() - $_SESSION['atividade'] > 21600)) {
  session_destroy();
  session_unset();
  header('HTTP/1.0 400 Bad error');
  exit;
}
$_SESSION['atividade'] = time();

?>