<?php

session_start();
if (isset($_SESSION['atividade']) || (time() - $_SESSION['atividade'] > 21600)) {
  session_destroy();
  session_unset();
  echo 'cabo';
}
else{
  $_SESSION['atividade'] = time();
  echo $_SESSION['atividade'];
}
?>