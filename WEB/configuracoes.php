<?php
require_once('sessao.php');
if (isset($_GET['editar']) && $_GET['editar'] == 'home'){
  $configuracoes = '
  <div class="row">
  <form>
  <h4>Selecione os módulos que você deseja mostrar na tela inicial</h4>
  <hr class="mt-0"> 
  <div class="form-group col-sm-12 campoOption">
  <select id="custom-headers" multiple="multiple">
  <option value="elem_1">Controle de Acesso</option>
  <option value="elem_2">Configurações</option>
  <option value="elem_3">Configurações/Editar Usuário</option>
  <option value="elem_4">Configurações/Editar Minha Conta</option>
  </select>
  </div>
  <br/>
  <div>
  <button type="submit" class="btn btn-primary">Salvar</button>
  </form>
  </div>
  </div>';
}
?>
<link href="../CSS/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="../Bibliotecas/Font-Awesome/css/all.min.css" rel="stylesheet">
<link href="../CSS/home.css" rel="stylesheet">
<link href="../CSS/multi-select.css" media="screen" rel="stylesheet" type="text/css">
<script src="../Javascript/bootstrap.min.js"></script>
<script src="../Javascript/jquery-3.3.1.js"></script>
<script src="../Javascript/home.js"></script>
<script src="../Javascript/jquery.multi-select.js" type="text/javascript"></script>
<script src="../Javascript/jquery.quicksearch.js" type="text/javascript"></script>
<link rel="shortcut icon" href="../Imagens/favicon-lock.ico"/>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Configurações</title>
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
              <a href="home.php">
                <i class="fas fa-home"></i>
                <span>Home</span>
              </a>
            </li>
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
                  <li>
                    <a href="configuracoes.php?editar=home">Editar Tela de Inicio</a>
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
    <main class="page-content">
      <div class="container-fluid">
        <?php
        echo $configuracoes;
        ?>
      </div>
    </main>
  </div>
</body>
<script type="text/javascript">
  $(document).ready(function() {
    $('.campoOption').multiSelect({
      selectableHeader: "<input type='text' style='width: 165.5px; text-align:center' class='search-input' autocomplete='off' placeholder='Buscar'>",
      selectionHeader: "<input type='text' style='width: 165.5px; text-align:center' class='search-input' autocomplete='off' placeholder='Buscar'>",
      afterInit: function(ms){
        var that = this,
        $selectableSearch = that.$selectableUl.prev(),
        $selectionSearch = that.$selectionUl.prev(),
        selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
        selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

        that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
        .on('keydown', function(e){
          if (e.which === 40){
            that.$selectableUl.focus();
            return false;
          }
        });

        that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
        .on('keydown', function(e){
          if (e.which == 40){
            that.$selectionUl.focus();
            return false;
          }
        });
      },
      afterSelect: function(){
        this.qs1.cache();
        this.qs2.cache();
      },
      afterDeselect: function(){
        this.qs1.cache();
        this.qs2.cache();
      }
    });
  });

</script>
</html>