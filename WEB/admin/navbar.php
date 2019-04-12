
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
        <img class="img-responsive img-rounded" width="100px" height="100px" 
        <?php 
        $filename = '../fotosPerfil/'.$_SESSION['cpf'].'.png';
        if (file_exists($filename)) {
         echo "src='../fotosPerfil/".$_SESSION['cpf'].".png'";
       } else {
         echo "src='../fotosPerfil/default.png'";
       }
       
       ;?> alt="User picture">
     </div>
     <div class="user-info">
      <span class="user-name"><strong><?php echo $_SESSION['nome']?></strong>
      </span>
      <span class="user-role"><?php echo $_SESSION['tipoConta']?></span>
    </div>
  </div>
  <div class="sidebar-menu">
    <ul>
      <li>
        <a href="home.php">
          <i class="fas fa-home"></i>
          <span>Home</span>
        </a>
      </li>
      <li>
        <a href="controle.php">
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
              <a href="configuracoes.php?editar=conta">Editar Minha Conta</a>
            </li>
            <li>
              <a href="configuracoes.php?editar=usuario">Gerenciar Usuários</a>
            </li>
            <li>
              <a href="configuracoes.php?editar=home">Editar Tela de Inicio</a>
            </li>
          </ul>
        </div>
      </li>
      <?php
      if ($_SESSION['permissao'] === 'adm'){
        ?>
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
                <a href="#">Gerenciar Funcionários</a>
              </li>
              <li>
                <a href="#">Gráficos<span class="badge badge-pill badge-primary">Beta</span></a>
              </li>
            </ul>
          </div>
        </li>
        <?php
      }
      ?>
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
</div>
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