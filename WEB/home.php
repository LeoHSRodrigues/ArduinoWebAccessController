<?php
require_once('sessao.php');
?>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
<link rel="stylesheet" type="text/css" href="../CSS/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../CSS/estilo.css">
<link rel="stylesheet" type="text/css" href="../Bibliotecas/Font-Awesome/css/all.min.css">
<link rel="stylesheet" type="text/css" href="../Bibliotecas/Argon/css/argon.min.css" >
<link rel="stylesheet" href="../Bibliotecas/Argon/vendor/nucleo/css/nucleo.css">
<script src="../Javascript/jquery-3.3.1.js"></script>
<script src="../Javascript/popper.min.js"></script>
<script src="../Javascript/bootstrap.min.js"></script>
<script src="../Bibliotecas/Font-Awesome/js/all.min.js"></script>
<script src="../Javascript/jquery.mask.js"></script>
<script src="../Javascript/bootstrap-datepicker.min.js"></script>
<script src="../Javascript/bootstrap-datepicker.pt-BR.min.js"></script>
<link href="../CSS/home.css" rel="stylesheet">
<script src="../Javascript/home.js"></script>
<link rel="shortcut icon" href="../Imagens/favicon-lock.ico" />

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home</title>
  <style>
    .card-header{
      background-color: inherit;
    }
    body{
      background: #485563;  /* fallback for old browsers */
      background: -webkit-linear-gradient(to right, #29323c, #485563);  /* Chrome 10-25, Safari 5.1-6 */
      background: linear-gradient(to right, #29323c, #485563); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

    }
    
  </style>
</head>

<body>
  <div class="page-wrapper chiller-theme toggled">
    <?php include('admin/navbar.php'); ?>
    <main class="page-content">
      <div class="container-fluid">
        <div class="row">
          <div class="card text-black bg-secondary mb-3 col-sm-6 " onclick="location.href='controle.php';"
          style="max-width: 18rem; cursor: pointer;">
          <div class="card-header text-center">Controle de Acesso</div>
          <div class="card-body">
            <h5 class="card-title text-center">Módulo Acesso</h5>
            <p class="card-text">Módulo do sistema para modificação ou liberação de catracas</p>
          </div>
        </div>
        <div class="card text-black bg-secondary mb-3 col-sm-6" onclick="location.href='#';"
        style="max-width: 18rem; cursor: pointer;">
        <div class="card-header text-center">Configurações</div>
        <div class="card-body">
          <h5 class="card-title text-center">Módulo Configurações</h5>
          <p class="card-text">Módulo do sistema para configurar o sistema</p>
        </div>
      </div>
      <div class="card text-black bg-secondary mb-3 col-sm-6"  onclick="location.href='#';"
      style="max-width: 18rem; cursor: pointer;">
      <div class="card-header text-center">Administrador</div>
      <div class="card-body">
        <h5 class="card-title text-center">Módulo Administrador</h5>
        <p class="card-text">Módulo com acesso restrito a administradores. Gerenciamento de Logs entre outros</p>
      </div>
    </div>
  </div>
</div>

</main>
</div>
</body>
</html>