<?php

if (isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['senha']) && !empty($_POST['senha'])){

    require_once "../conexao.php";
    require_once "Usuario.Class.php";

    $u = new Usuario();
    
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);
    
    if($u->login($email, $senha) == true){

        if(isset($_SESSION['idUser'])){
            header("location: ../painel.php");
        }else{
            header("location: ../login.php");
        }

    }else{
        header("location: ../login.php");
    }
    
}else{
    header("location: ../login.php");
}


?>