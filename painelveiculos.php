<?php 
require_once "../projeto3/actions/exit.php";
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

<div>
  <img class="background" src="../projeto3/imagens/banner2.png" alt="background">
</div>

<form class="form" action="../projeto3/actions/processos-v.php" method="POST">
        <div class="card">
            <div class="card-top">
                <?php 
                if(isset($_SESSION['msg'])){
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                }
                ?>
                <h2 class="titulo">Painel de Controle</h2>
                <p>Registro de Veiculos</p>
            </div>

            <div class="card-grupo">
                <label><b>Marca:</b></label>
                <input  type="text" id="marca" name="marca" placeholder="Digite a marca:" maxlength="32">
            </div>

            <div class="card-grupo">
                <label><b>Modelo:</b></label>
                <input class="col-sm-5" type="text" id="modelo" name="modelo" placeholder="Modelo:" maxlength="32">
            </div>

            <div class="card-grupo">
                <label><b>Placa:</b></label>
                <input  type="text" id="placa" name="placa" placeholder="Digite a placa:" maxlength="32" required>
            </div>

            <div class="card-grupo">
                <label><b>Cor:</b></label>
                <input  type="cor" id="cor" name="cor" placeholder="Digite a cor:" maxlength="32" required>
            </div>

            <div class="card-grupo">
                <label style="margin-left: 43%;">Entrada: </label>
                <input type="datetime" name="entrada" id="entrada" placeholder="Entrada do veiculo:">
            </div>

            <div>
                <input class="submit"  value="Cadastrar" type="submit" name="submit" id="submit">
            </div>

        </div>
    </form>





  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>