<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
$diretorioFotoPerfil = '../fotosPerfil/';
$foto = $_FILES['teste']['tmp_name'];
if( in_array( $_FILES['teste']['type'], array("image/jpeg") ) || in_array( $_FILES['teste']['type'], array("image/png") )){
$uploadfile = $diretorioFotoPerfil . 'teste.png';
move_uploaded_file($_FILES['teste']['tmp_name'], $uploadfile);
$nomeArquivo = $_FILES['teste']['name'];
//header("Content-Type: image/jpeg");
//echo file_get_contents($diretorioFotoPerfil);
}
   else{
       echo 'não é imagem';
   }
}
?>
<form enctype="multipart/form-data" method="post">
  <div class="form-group">
    <label for="exampleFormControlFile1">Example file input</label>
    <input type="file" name="teste" class="form-control-file" id="exampleFormControlFile1">
      <input type="submit" value="Enviar">
  </div>
</form>