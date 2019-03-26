<?php
require_once('sessao.php');
require_once('db.class.php');
$banco = new db();
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
else if (isset($_GET['editar']) && $_GET['editar'] == 'conta'){
$resultado = $banco->seleciona4($_SESSION['cpf']);
$dados = $resultado->fetchAll();
$nome = $dados[0]['nome'];
$CPF = $dados[0]['CPF'];
$dataDeNascimento = $dados[0]['dataDeNascimento'];

  $configuracoes = '
    <h4>Editar Minha Conta</h4>
  <hr class="mt-0"> 
  <form class="" enctype="multipart/form-data" method="post" id="meuForm" autocomplete="off">


          <div class="form-group input-group col-sm-12 mx-auto">

            <div class="form-group input-group col-sm-8 mx-auto">
              <label for="nome">Nome</label>
              <div class="input-group"></div>
              <input type="text" required id="nome" name="nome" class="form-control" required value="'.$nome.'" aria-label="Digite o seu nome" required aria-describedby="basic-addon2">
              <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2"><i id="validadorNome" class="fas fa-times"></i></span>
              </div>
            </div>

            <div class="form-group input-group col-sm-8 mx-auto">
              <label for="CPF">CPF</label>
              <div class="input-group"></div>
              <input type="text" id="CPF" maxlength="11" name="cpf" class="form-control" required value="'.$CPF.'" aria-label="Digite o seu email" required aria-describedby="basic-addon2">
              <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2"><i id="validadorCPF" class="fas fa-times"></i></span>
              </div>
            </div>


            <div class="form-group input-group col-sm-8 mx-auto">
              <label for="senha">Senha</label>
              <div class="input-group"></div>
              <input type="password" id="senha" name="senha" class="form-control" placeholder="Digite a sua senha" required aria-label="Digite o seu email" required aria-describedby="basic-addon2">
              <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2"><i id="validadorSenha" class="fas fa-times"></i></span>
              </div>
            </div>

            <div class="form-group input-group col-sm-8 mx-auto">
              <label for="senha">Confirme a sua Senha</label>
              <div class="input-group"></div>
              <input type="password" id="conf_senha" name="senha" class="form-control" placeholder="Digite a sua senha" required aria-label="Digite o seu email" required aria-describedby="basic-addon2">
              <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2"><i id="validadorConfirmaSenha" class="fas fa-times"></i></span>
              </div>
            </div>  

            <div class="form-group input-group col-sm-8 mx-auto">
              <label for="senha">Data de Nascimento</label>
              <div class="input-group"></div>
              <input type="text" id="dataNasc" name="dataNasc" class="form-control" value="'.$dataDeNascimento.'" required aria-describedby="basic-addon2">
              <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2"><i class="far fa-calendar-alt"></i></span>
              </div>
            </div>            

            <div class="form-group input-group col-sm-8 mx-auto">
              <label for="senha">Senha de 4 dígitos</label>
              <div class="input-group"></div>
              <input type="password" maxlength="4" id="senha4" name="senha4" class="form-control" placeholder="Digite a sua senha" required aria-label="Digite o seu email" required aria-describedby="basic-addon2">
              <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2"><i id="validadorSenha4" class="fas fa-times"></i></span>
              </div>
            </div>

            <div class="form-group input-group col-sm-8 mx-auto">
              <label for="senha">Confirme a sua Senha</label>
              <div class="input-group"></div>
              <input type="password" maxlength="4" id="conf_senha4" name="senha4" class="form-control" placeholder="Digite a sua senha" required aria-label="Digite o seu email" required aria-describedby="basic-addon2">
              <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2"><i id="validadorConfirmaSenha4" class="fas fa-times"></i></span>
              </div>
            </div>

            <div class="form-group input-group col-sm-8 mx-auto">
              <label for="senha">Escolha uma Imagem de Perfil</label>
                <input type="file" required name="fotoPerfil" class="form-control-file" id="exampleFormControlFile1">
              </div>

            <div class="form-group input-group col-sm-8 mx-auto">
              <input type="submit" disabled style="margin: auto" id="cadastrar" class="btn btn-primary" value="Cadastrar">
            </div>
          </div>
        </form>
  ';

}
?>
<link href="../CSS/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">  
<link rel="stylesheet" type="text/css" href="../CSS/bootstrap-datepicker3.standalone.min.css">
<link href="../Bibliotecas/Font-Awesome/css/all.min.css" rel="stylesheet">
<link href="../CSS/home.css" rel="stylesheet">
<link href="../CSS/multi-select.css" media="screen" rel="stylesheet" type="text/css">
<script src="../Javascript/jquery-3.3.1.js"></script>
<script src="../Javascript/bootstrap.min.js"></script>
<script src="../Javascript/home.js"></script>
<script src="../Javascript/jquery.multi-select.js" type="text/javascript"></script>
<script src="../Javascript/jquery.quicksearch.js" type="text/javascript"></script>
  <script src="../Javascript/jquery.mask.js"></script>
  <script src="../Javascript/bootstrap-datepicker.min.js"></script>
  <script src="../Javascript/bootstrap-datepicker.pt-BR.min.js"></script>
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
            <img class="img-responsive img-rounded" width="100px" height="100px" <?php echo "src='../fotosPerfil/".$_SESSION['cpf'].".png'";?>
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
        <?php
        echo $configuracoes;
        ?>
      </div>
    </main>
</div>
</body>
<script type="text/javascript">
  $(document).ready(function() {
    var url_string = window.location.href;
var url = new URL(url_string);
var c = url.searchParams.get("editar");
if (c === 'home'){
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
}
else if (c === 'conta'){
    $('#CPF').mask('000.000.000-00',{clearIfNotMatch: true});
    $('#dataNasc').datepicker({
      maxViewMode: 2,
      todayBtn: "linked",
      language: "pt-BR",
      autoclose: true,
      todayHighlight: true
    });


    $('#senha, #conf_senha').on('keyup focusout', function () {
      if ($('#senha').val() == $('#conf_senha').val() && $('#senha').val().length > 6 ) {
        $( "#senha" ).removeClass("bg-danger text-white");
        $( "#conf_senha" ).removeClass("bg-danger text-white");
        $( "#validadorSenha" ).removeClass( "fas fa-times");
        $( "#validadorConfirmaSenha" ).removeClass( "fas fa-times");
        $( "#validadorSenha" ).addClass( "fas fa-check");
        $( "#validadorConfirmaSenha" ).addClass( "fas fa-check");
        $('#cadastrar').prop("disabled", false);
      } else {
        $( "#validadorSenha" ).removeClass( "fas fa-check");
        $( "#validadorSenha" ).addClass( "fas fa-times");
        $( "#validadorConfirmaSenha" ).addClass( "fas fa-times");
        $( "#senha" ).addClass("bg-danger text-white");
        $( "#conf_senha" ).addClass("bg-danger text-white");

      }
    });

    $('#senha4, #conf_senha4').on('keyup focusout', function () {
      if ($('#senha4').val() == $('#conf_senha4').val() && $('#senha4').val().length > 3 ) {
        $( "#senha4" ).removeClass("bg-danger text-white");
        $( "#conf_senha4" ).removeClass("bg-danger text-white");
        $( "#validadorSenha4" ).removeClass( "fas fa-times");
        $( "#validadorConfirmaSenha4" ).removeClass( "fas fa-times");
        $( "#validadorSenha4" ).addClass( "fas fa-check");
        $( "#validadorConfirmaSenha4" ).addClass( "fas fa-check");
        $('#cadastrar').prop("disabled", false);
      } else {
        $( "#validadorSenha4" ).removeClass( "fas fa-check");
        $( "#validadorSenha4" ).addClass( "fas fa-times");
        $( "#validadorConfirmaSenha4" ).addClass( "fas fa-times");
        $( "#senha4" ).addClass("bg-danger text-white");
        $( "#conf_senha4" ).addClass("bg-danger text-white");

      }
    });
    $('#CPF').focusout(function(){
      var testarCPF = TestaCPF($("#CPF").val());
      if(testarCPF == false) {
        $( "#validadorCPF" ).removeClass( "fas fa-check");
        $( "#validadorCPF" ).addClass( "fas fa-times");
        $( "#CPF" ).addClass("bg-danger text-white");
      }
      else{
        $( "#CPF" ).removeClass("bg-danger text-white");
        $( "#validadorCPF" ).removeClass( "fas fa-times");
        $( "#validadorCPF" ).addClass( "fas fa-check");
      }
    });

    $('#nome').focusout(function(){
      if($("#nome").val().length < 5) {
        $( "#validadorNome" ).removeClass( "fas fa-check");
        $( "#validadorNome" ).addClass( "fas fa-times");
        $( "#nome" ).addClass("bg-danger text-white");
      }
      else{
        $( "#nome" ).removeClass("bg-danger text-white");
        $( "#validadorNome" ).removeClass( "fas fa-times");
        $( "#validadorNome" ).addClass( "fas fa-check");
        $('#cadastrar').prop("disabled", true);
      }
    });
  $("form#meuForm").submit(function(e) {
    $('#CPF').unmask();
  });  
  function TestaCPF(c) {
    if((c = c.replace(/[^\d]/g,"")).length != 11)
      return false

    if (c.length != 11 || 
      c == "00000000000" || 
      c == "11111111111" || 
      c == "22222222222" || 
      c == "33333333333" || 
      c == "44444444444" || 
      c == "55555555555" || 
      c == "66666666666" || 
      c == "77777777777" || 
      c == "88888888888" || 
      c == "99999999999")
      return false;

    var r;
    var s = 0;

    for (i=1; i<=9; i++)
      s = s + parseInt(c[i-1]) * (11 - i);

    r = (s * 10) % 11;

    if ((r == 10) || (r == 11))
      r = 0;

    if (r != parseInt(c[9]))
      return false;

    s = 0;

    for (i = 1; i <= 10; i++)
      s = s + parseInt(c[i-1]) * (12 - i);

    r = (s * 10) % 11;

    if ((r == 10) || (r == 11))
      r = 0;

    if (r != parseInt(c[10]))
      return false;

    return true;
  }
}
  });
</script>
</html>