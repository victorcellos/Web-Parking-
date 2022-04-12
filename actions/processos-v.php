<?php

//incluir a conexao no banco de dados
require_once "../conexao.php";
ob_start();



// receber os dados do formulario
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//verifica se o usuario clicou no botão

if(!empty($dados['submit'])){

    //validar os campos individual
    if(empty($dados['marca'])){
        $_SESSION['msg'] = "<p style='color: red;'>Erro: Necessário preencher o campo marca!</p>";
        header("location: ../painelveiculos.php");
    }elseif(empty($dados['modelo'])){
        $_SESSION['msg'] = "<p style='color: red;'>Erro: Necessário preencher o campo modelo!</p>";
        header("location: ../painelveiculos.php");
    }elseif(empty($dados['placa'])){
        $_SESSION['msg'] = "<p style='color: red;'>Erro: Necessário preencher o campo placa!!</p>";
        header("location: ../painelveiculos.php");
    }elseif(empty($dados['cor'])){
        $_SESSION['msg'] = "<p style='color: red;'>Erro: Necessário preencher o campo cor!</p>";
        header("location: ../painelveiculos.php");
    }elseif(empty($dados['entrada'])){
        $_SESSION['msg'] = "<p style='color: red;'>Erro: Necessário preencher o campo entrada!</p>";
        header("location: ../painelveiculos.php");
    }else{
        if($dados['placa']){
            $sql = $pdo->prepare("SELECT * FROM carros WHERE placa = :placa");
            $sql->bindValue(':placa', $dados['placa'], PDO::PARAM_STR);
            $sql->execute();
    
            if($sql->rowCount() === 0){
                
                $query_veiculos = "INSERT INTO carros (marca, modelo, placa, cor) values (:marca, :modelo, :placa, :cor)";
                $cad_veiculos = $pdo->prepare($query_veiculos);
                $cad_veiculos->bindValue(':marca', $dados['marca'], PDO::PARAM_STR);
                $cad_veiculos->bindValue(':modelo', $dados['modelo'], PDO::PARAM_STR);
                $cad_veiculos->bindValue(':placa', $dados['placa'], PDO::PARAM_STR);
                $cad_veiculos->bindValue(':cor', $dados['cor'], PDO::PARAM_STR);
                $cad_veiculos->execute();
             
                //var_dump($pdo->LastInsertId());
                //recuperar o ultimo id
                $id_veiculo = $pdo->LastInsertId();
             
                $query_registro = "INSERT INTO registro (entrada, veiculo_id) VALUES (:entrada, :veiculo_id)";
                $cad_registro = $pdo->prepare($query_registro);
                $cad_registro->bindValue(':entrada', $dados['entrada']);
                $cad_registro->bindValue(':veiculo_id', $id_veiculo, PDO::PARAM_INT);
                $cad_registro->execute();
             
                //cria a variavel global para salvar a mensagem
                 $_SESSION['msg'] = "<p style='color: green;'>Veiculo cadastrado com sucesso!</p>";
                 header("location: ../painelveiculos.php");
                 //Redirecionar o usuario a pagina
                
                
            }else{
                $_SESSION['msg'] = "<p style='color: red;'>Erro: Placa já cadastrado!</p>";
                header("location: ../painelveiculos.php");
            }
    
        }else{
            header("location: ../painelveiculos.php");
        }
    }


}else{
    //criar a variavel global para salvar a mensagem
    $_SESSION['msg'] = "<p style='color: red;'>Erro: Veiculo não cadastrado!</p>";

    //Redirecionar o usuario a pagina
    header("location: ../painelveiculos.php");
}

?>

