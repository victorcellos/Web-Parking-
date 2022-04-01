<?php

session_start();

$host = "localhost";
$usuario = "root";
$pass = "";
$dbname = "projeto2";

global $pdo;

try{
    //conexao orientada a objetos com pdo
    $pdo = new PDO ("mysql:host=$host;dbname=" . $dbname, $usuario, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Sistemas
    // $sql = $conn->query("SELECT * FROM usuarios");
    // $sql->execute();

    // echo $sql->rowCount();
    // echo "Sucesso";
}catch(PDOException $e){
    echo "ERROR: ".$e->getMessage();
    exit;
   // echo "erro: conexao com o servidor mal sucessido " . $err->getMessage();

}


?>