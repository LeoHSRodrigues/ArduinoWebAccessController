<?php
require_once('sessao.php');
?>

<link href="../CSS/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="../Bibliotecas/Font-Awesome/css/all.min.css" rel="stylesheet">
<link href="../CSS/home.css" rel="stylesheet">
<script src="../Javascript/jquery-3.3.1.js"></script>
<script src="../Javascript/bootstrap.min.js"></script>
<script src="../Javascript/home.js"></script>
<link rel="shortcut icon" href="../Imagens/favicon-lock.ico" />

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home</title>
</head>
<style>
    .container-fluid{
        margin-top: 100px;
    }
    .cards {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 300px;
  margin: auto;
  text-align: center;
}

.titles {
  color: grey;
  font-size: 18px;
}

.botao {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}

.teste {
  text-decoration: none;
  font-size: 22px;
  color: black;
}

button:hover, a:hover {
  opacity: 0.7;
}
    </style>
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
            <span class="user-name"><strong><?php echo $_SESSION['nome']?></strong>
            </span>
            <span class="user-role"><?php echo $_SESSION['tipoConta']?></span>
          </div>
        </div>
        <div class="sidebar-menu">
          <ul>
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
                    <a href="#">Adicionar Funcionários</a>
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
    <main class="page-content">
      <div class="container-fluid">
</div>

</main>
</div>
</body>
<script>
$( document ).ready(function() {
    var interval = 1000;
                function doAjax() {
          $.ajax({
        type: "POST",
        url: "autenticar.php?acao=lerCatraca",
        success: function(msg){
            if (msg != 'erro'){   
            var dados = JSON.parse(msg);
        $(".container-fluid").html('<div class="cards"><img src="../fotosPerfil/'+dados[0]['imagem']+'.png" alt="John" style="width:100%"><h3>'+dados[0]['nome']+'</h3><p class="titles">'+dados[0]['cargo']+'</p><p>'+dados[0]['sigla']+'</p><p><button class="botao">Informações</button></p></div>');
        $( ".cards" ).fadeOut( 8000, "linear");
//        setTimeout(function (){
//        $( ".cards" ).remove();
//        }, 10000);
        }
            else{
        $(".container-fluid").html("<div class='alert alert-danger' style='text-align:center;' role='alert'>Cartão Não Cadastrado<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
            }
      },
    complete: function () {
    setTimeout(doAjax, interval);
            }
    });
};
setTimeout(doAjax, interval);
});
</script>
</html>