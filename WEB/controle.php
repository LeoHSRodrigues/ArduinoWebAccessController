<?php
require_once('sessao.php');
?>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
<link rel="stylesheet" type="text/css" href="../CSS/bootstrap.min.css">
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
</head>
<style>
  body{
    background: #485563;  /* fallback for old browsers */
    background: -webkit-linear-gradient(to right, #29323c, #485563);  /* Chrome 10-25, Safari 5.1-6 */
    background: linear-gradient(to right, #29323c, #485563); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

  }
  .container-fluid{
    margin-top: 100px;
  }
  .cards {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    max-width: 300px;
    margin: auto;
    text-align: center;
    z-index: 9999;
    background: white;
  }

  .titles {
    color: black;
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
    <?php include('admin/navbar.php'); ?>
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
          if (msg == 'erro'){   
            $(".container-fluid").html("<div class='alert alert-danger' style='text-align:center;' role='alert'>Cartão Não Cadastrado<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
          }
          else if (msg == 'n inserido'){
            $(".container-fluid").empty();
          }
          else{
            var dados = JSON.parse(msg);
            $(".container-fluid").html('<div class="cards"><img src="../fotosPerfil/'+dados[0]['CPF']+'.png" alt="John" style="width:100%"><h3>'+dados[0]['nome']+'</h3><p class="titles">'+dados[0]['cargo']+'</p><p>'+dados[0]['sigla']+'</p><p><button class="botao">Informações</button></p></div>');
            $( ".cards" ).fadeOut( 8000, "linear");
//        setTimeout(function (){
//        $( ".cards" ).remove();
//        }, 10000);
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