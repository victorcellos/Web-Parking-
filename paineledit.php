<?php 
require_once "../projeto3/actions/exit.php";
ob_start();

$row_veiculos['idcarros'] = filter_input(INPUT_GET, "idcarros", FILTER_SANITIZE_NUMBER_INT);
// var_dump($row_veiculos['idcarros']);

if (empty($row_veiculos['idcarros'])) {
  $_SESSION['msg'] = "<p style='color: red;'>Erro: Usuario não encontrado!</p>";
  header("location: paineledit.php");
  exit();
}

$query_veiculo = "SELECT idcarros,marca,modelo,placa,cor FROM carros WHERE idcarros = $row_veiculos[idcarros] LIMIT 1";
$result_veiculo = $pdo->prepare($query_veiculo);
$result_veiculo->execute();

$id_veiculo = $pdo->LastInsertId();

$query_time = "SELECT entrada,saida,veiculo_id FROM registro WHERE veiculo_id = $row_veiculos[idcarros] LIMIT 1";
$result_time = $pdo->prepare($query_time);
$result_time->execute();


if(($result_veiculo) AND ($result_veiculo->rowCount() != 0)){
   $row_veiculo = $result_veiculo->fetch(PDO::FETCH_ASSOC);
   $row_time = $result_time->fetch(PDO::FETCH_ASSOC);
  // var_dump($row_veiculo, $row_time);
   
}else{
  $_SESSION['msg'] = "<p style='color: red;'>Erro: Usuario não encontrado!</p>";
}


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../projeto3/css/painel.css">
    <link rel="stylesheet" href="../projeto3/css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Painel de Usuario</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-secondary">
  <div class="container-fluid">
    <img class="navbar-brand" width="30px" src="../projeto3/imagens/nexusgroup2.ico" alt="alt"></img>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="painel.php"><b>Home</b></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="#"><b>Trocar senha</b></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="listaveiculos.php"><b>Veiculos</b></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <b>Cadastro</b>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="painelusuario.php" target="_blank">Registros de usuarios</a></li>
            <li><a class="dropdown-item" href="painelveiculos.php" target="_blank">Registros de carros</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="https://api.whatsapp.com/send?phone=5521982321789&text=Tenho%20um%20problema%20e%20desejo%20falar%20com%20o%20suporte!">Falar com suporte</a></li>
          </ul>
        </li>
      </ul>
      <div class="form-inline my-2 my-lg-0">.
      <label class="mr-2"><?php echo"{$nomeUser}"?></label>
        <a href="../projeto3/actions/logout.php" class="btn btn-danger my-2">Sair</a>
      </div>
    </div>
  </div>
</nav>


<?php 
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//verificar se o usuario clicou no botao
if(!empty($dados['submit'])){
  $empty_input = false;
  $dados = array_map('trim', $dados);
  if (in_array("", $dados)) {
      $empty_input = true;
      $_SESSION['msg'] = "<p style='color: red;'>Erro: Necessário preencher todos os campos!</p>";
  }

  if(!$empty_input){
    $query_up_veiculo = "UPDATE registro SET entrada=:entrada, saida=:saida WHERE veiculo_id=:veiculo_id";
    $edit_veiculo = $pdo->prepare($query_up_veiculo);
    $edit_veiculo->bindValue(':entrada', $dados['entrada'], PDO::PARAM_STR);
    $edit_veiculo->bindValue(':saida', $dados['saida'], PDO::PARAM_STR);
    $edit_veiculo->bindValue(':veiculo_id', $row_veiculos['idcarros'], PDO::PARAM_INT);
    
    if($edit_veiculo->execute()){
      $_SESSION['msg'] = "<p style='color: green;'>Usuario editado com sucesso!</p>";
    }else{
      $_SESSION['msg'] = "<p style='color: red;'>Erro: Usuario não editado com sucesso!</p>";
    }
    
  }
}

?>

<form class="form" action="" method="POST">
        <div class="card">
            <div class="card-top">
                <?php 
                if(isset($_SESSION['msg'])){
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                }
                ?>
                <h2 class="titulo">Painel de Controle</h2>
                <p>Edição de veiculos</p>
            </div>

            <div class="card-grupo">
                <label><b>Entrada:</b></label>
                <input style="text-transform:uppercase;" type="text" id="entrada" name="entrada" placeholder="Digite a entrada:" value="<?php if(isset($dados['entrada'])){ echo $dados['entrada']; }elseif(isset($row_time['entrada'])){ echo $row_time['entrada'];} ?>">
            </div>

            <div class="card-grupo">
                <label><b>Saida:</b></label>
                <input style="text-transform:uppercase;" class="col-sm-5" type="text" id="saida" name="saida" placeholder="saida:" value="<?php if(isset($dados['saida'])){ echo $dados['saida']; }elseif(isset($row_time['saida'])){ echo $row_time['saida'];} ?>">
            </div>

            <div>
                <input class="submit"  value="Cadastrar" type="submit" name="submit" id="submit">
            </div>

        </div>
    </form>





  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>