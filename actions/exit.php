<?php
require_once "../projeto3/conexao.php";

if(isset($_SESSION['idUser']) && !empty($_SESSION['idUser'])){
    require_once "Usuario.Class.php";
    $u = new Usuario();

    $usuarioLogado = $u->logged($_SESSION['idUser']);

    $nomeUser = $usuarioLogado['nome'];


} else {
  header("location: ../projeto3/login.php");
}
?>