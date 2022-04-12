<?php

//incluir a conexao no banco de dados
require_once "../conexao.php";
ob_start();



// receber os dados do formulario
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//verifica se o usuario clicou no botão

if(!empty($dados['submit'])){

    //validar os campos individual
    if(empty($dados['nome'])){
        $_SESSION['msg1'] = "<p style='color: red;'>Erro: Necessário preencher o campo nome!</p>";
        header("location: ../painelusuario.php");
    }elseif(empty($dados['telefone'])){
        $_SESSION['msg1'] = "<p style='color: red;'>Erro: Necessário preencher o campo telefone!</p>";
        header("location: ../painelusuario.php");
    }elseif(empty($dados['email'])){
        $_SESSION['msg1'] = "<p style='color: red;'>Erro: Necessário preencher o campo email!!</p>";
        header("location: ../painelusuario.php");
    }elseif(empty($dados['senha'])){
        $_SESSION['msg1'] = "<p style='color: red;'>Erro: Necessário preencher o campo senha!</p>";
        header("location: ../painelusuario.php");
    }elseif($dados['senha'] != $dados['confirmsenha']){
    $_SESSION['msg1'] = "<p style='color: red;'>Erro: Senhas não coincidem!</p>";
    header("location: ../painelusuario.php");
    }else{
        if($dados['email']){
            $sql = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
            $sql->bindValue(':email', $dados['email'], PDO::PARAM_STR);
            $sql->execute();
    
            if($sql->rowCount() === 0){
                
                $query_veiculos = "INSERT INTO usuarios (nome, telefone, email, senha) values (:nome, :telefone, :email, :senha)";
                $cad_veiculos = $pdo->prepare($query_veiculos);
                $cad_veiculos->bindValue(':nome', $dados['nome'], PDO::PARAM_STR);
                $cad_veiculos->bindValue(':telefone', $dados['telefone'], PDO::PARAM_STR);
                $cad_veiculos->bindValue(':email', $dados['email'], PDO::PARAM_STR);
                $cad_veiculos->bindValue(':senha', md5($dados['senha']), PDO::PARAM_STR);
                $cad_veiculos->execute();
             
                //cria a variavel global para salvar a mensagem
                 $_SESSION['msg1'] = "<p style='color: green;'>Usuario cadastrado com sucesso!</p>";
             
                 //Redirecionar o usuario a pagina
                 header("location: ../painelusuario.php.php");
                
            }else{
                $_SESSION['msg1'] = "<p style='color: red;'>Erro: Email já cadastrado!</p>";
                header("location: ../painelusuario.php.php");
            }
    
        }else{
            header("location: ../painelusuario.php.php");
        }
    }

}else{
    //criar a variavel global para salvar a mensagem
    $_SESSION['msg'] = "<p style='color: red;'>Erro: Veiculo não cadastrado!</p>";

    //Redirecionar o usuario a pagina
    header("location: ../painelusuario.php.php");
}

?>

