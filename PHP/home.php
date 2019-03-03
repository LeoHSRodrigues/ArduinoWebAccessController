<?php
session_start();
if (isset($_SESSION['atividade']) && (time() - $_SESSION['atividade'] > 21600)) {
  session_destroy();
  session_unset();
  echo '<script>window.location.href = "../HTML/login.html";</script>';
}
$_SESSION['atividade'] = time();
if(isset($_SESSION['atividade']))
{
?>

<link href="../CSS/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="../Bibliotecas/Font-Awesome/css/all.min.css" rel="stylesheet">
<link href="../CSS/home.css" rel="stylesheet">
<script src="../Javascript/bootstrap.min.js"></script>
<script src="../Javascript/jquery-3.3.1.js"></script>
<script src="../Javascript/home.js"></script>
<link rel="shortcut icon" href="../Imagens/favicon-lock.ico" />
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
</head>

<body>
    <div class="page-wrapper chiller-theme toggled">
  <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
    <i class="fas fa-bars"></i>
  </a>
  <nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-content">
      <div class="sidebar-brand">
        <a href="#">MENU</a>
        <div id="close-sidebar">
          <i class="fas fa-times"></i>
        </div>
      </div>
      <div class="sidebar-header">
        <div class="user-pic">
          <img class="img-responsive img-rounded" width="100px" height="100px" src="https://raw.githubusercontent.com/azouaoui-med/pro-sidebar-template/gh-pages/src/img/user.jpg"
            alt="User picture">
        </div>
        <div class="user-info">
          <span class="user-name">Nome
            <strong>Maluco</strong>
          </span>
          <span class="user-role">Tipo de Conta</span>
        </div>
      </div>
      <div class="sidebar-menu">
        <ul>
          <li>
            <a href="#">
              <i class="fa fa-book"></i>
              <span>Controle de Acesso</span>
            </a>
          </li>
          <li class="sidebar-dropdown">
            <a href="#">
              <i class="fas fa-cog"></i>
              <span>Configurações</span>
            </a>
            <div class="sidebar-submenu">
              <ul>
                <li>
                  <a href="#">Editar Minha Conta</a>
                </li>
                <li>
                  <a href="#">Editar Usuário</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="sidebar-dropdown">
            <a href="#">
              <i class="fas fa-user-tie"></i>
              <span>Administrador</span>
            </a>
            <div class="sidebar-submenu">
              <ul>
                <li>
                  <a href="#">Gerenciar Logs</a>
                </li>
                <li>
                  <a href="#">Adicionar Funcionários</a>
                </li>
                <li>
                  <a href="#">Gráficos<span class="badge badge-pill badge-primary">Beta</span></a>
                </li>
              </ul>
            </div>
          </li>
          <li class="header-menu">
            <span>Extra</span>
          </li>
          <li>
            <a href="#">
              <i class="fa fa-book"></i>
              <span>Termos e Serviços</span>
              <span class="badge badge-pill badge-primary">Beta</span>
            </a>
          </li>
        </ul>
      </div>
      <!-- sidebar-menu  -->
    </div>
    <!-- sidebar-content  -->
    <div class="sidebar-footer">
      <a href="#">
        <i class="fa fa-bell"></i>
        <span class="badge badge-pill badge-warning notification">3</span>
      </a>
      <a href="#">
        <i class="fa fa-envelope"></i>
        <span class="badge badge-pill badge-success notification">7</span>
      </a>
      <a href="#">
        <i class="fa fa-cog"></i>
      </a>
      <a href="logout.php">
        <i class="fa fa-power-off"></i>
      </a>
    </div>
  </nav>
  <!-- sidebar-wrapper  -->
  <main class="page-content">
    <div class="container-fluid">
            <div class="row">
                    <div class="card text-white bg-primary mb-3 col-sm-6 " onclick="location.href='#';"
                     style="max-width: 18rem; cursor: pointer;">
                            <div class="card-header">Controle de Acesso</div>
                            <div class="card-body">
                              <h5 class="card-title">Módulo Acesso</h5>
                              <p class="card-text">Módulo do sistema para modificação ou liberação de catracas</p>
                            </div>
                          </div>
                          <div class="card text-white bg-success mb-3 col-sm-6" onclick="location.href='#';"
                          style="max-width: 18rem; cursor: pointer;">
                            <div class="card-header">Configurações</div>
                            <div class="card-body">
                              <h5 class="card-title">Módulo Configurações</h5>
                              <p class="card-text">Módulo do sistema para configurar o sistema</p>
                            </div>
                          </div>
                          <div class="card text-white bg-danger mb-3 col-sm-6"  onclick="location.href='#';"
                          style="max-width: 18rem; cursor: pointer;">
                            <div class="card-header">Administrador</div>
                            <div class="card-body">
                              <h5 class="card-title">Módulo Administrador</h5>
                              <p class="card-text">Módulo com acesso restrito a administradores. Gerenciamento de Logs entre outros</p>
                            </div>
                          </div>
                  </div>
    </div>

  </main>
  <!-- page-content" -->
</div>
</body>
</html>
<?php
} else {
    header("Location: login.php");
    exit();
  }

?>