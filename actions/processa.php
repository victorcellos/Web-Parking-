<?php

//incluir a conexao no banco de dados
require_once "../conexao.php";


// receber os dados do formulario
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//verifica se o usuario clicou no botão

if(!empty($dados['submit'])){
   $query_usuario = "INSERT INTO usuarios (nome, telefone, email, senha) values (:nome, :telefone, :email, :senha)";
   $cad_usuario = $pdo->prepare($query_usuario);
   $cad_usuario->bindValue(':nome', $dados['nome'], PDO::PARAM_STR);
   $cad_usuario->bindValue(':telefone', $dados['telefone'], PDO::PARAM_STR);
   $cad_usuario->bindValue(':email', $dados['email'], PDO::PARAM_STR);
   $cad_usuario->bindValue(':senha', md5($dados['senha']), PDO::PARAM_STR);
   $cad_usuario->execute();

   header("location: ../login.php");

}else{
    echo "Error";
}











// require_once "../classes/usuarios.php";
// $u = new Usuario;

// if(isset($_POST['nome']))
// {
//     $nome = addslashes($_POST['nome']);
//     $telefone = addslashes($_POST['telefone']);
//     $email = addslashes($_POST['email']);
//     $senha = addslashes($_POST['senha']);
//     $confirmarSenha = addslashes($_POST['confSenha']);
//     //Verificar se esta preenchido
//     if (!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confirmarsenha))
//     {
//         $u->conectar("projeto2", "localhost", "root", "");
//         if($u->msgErro == "")//esta tudo ok
//         {
//             if($senha == $confirmarSenha){
//                if($u->cadastrar($nome, $telefone, $email, $senha))
//                {
//                    echo "Cadastrado com sucesso! Acesse para entrar!";
//                }
//                else{
//                    echo "Email já cadastrado";
//                }
//             }else{
//                 echo "Senhas não correspondem!";
//             }
//         }
//         else{
//             echo "Error: ".$u->msgErro;
//         }
//     }else{
//         echo "Preencha todos os campos!";
//     }
// }






?>

