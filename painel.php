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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Painel de Usuario</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-secondary">
  <div class="container-fluid">
    <img class="navbar-brand" width="30px" src="../projeto3/imagens/nexusgroup2.ico" alt="alt"><b>Painel De Controle</b></img>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="#"><b>Home</b></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="#"><b>Trocar senha</b></a>
        </li>
        <li class="nav-item">
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-Secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <b>Listagem de veiculos</b>
                </button>

                <!-- Modal -->
            <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Lista de Veiculos</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                                <div class="modal-body">
                                    <table class="table text-uppercase">
                                        <thead>
                                            <tr>
                                            <th scope="col">ID Veiculos</th>
                                            <th scope="col">Marca</th>
                                            <th scope="col">Modelo</th>
                                            <th scope="col">Placa</th>
                                            <th scope="col">Cor</th>
                                            <th scope="col">Entrada:</th>
                                            <th scope="col">Saida:</th>
                                            <th scope="col">...</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $query_veiculos = "SELECT cars.idcarros, cars.marca, cars.modelo, cars.placa, cars.cor,
                                                                                                    regtime.entrada, regtime.saida 
                                                                                            FROM carros cars
                                                                                            LEFT JOIN registro AS regtime ON regtime.veiculo_id=cars.idcarros
                                                                                                ORDER BY cars.idcarros DESC";

                                                $result_veiculos = $pdo->prepare($query_veiculos);
                                                $result_veiculos->execute();



                                                while($row_veiculos = $result_veiculos->fetch(PDO::FETCH_ASSOC)){
                                                        echo "<tr>";
                                                        echo "<td>".$row_veiculos['idcarros']."</td>";
                                                        echo "<td>".$row_veiculos['marca']."</td>";
                                                        echo "<td>".$row_veiculos['modelo']."</td>";
                                                        echo "<td>".$row_veiculos['placa']."</td>";
                                                        echo "<td>".$row_veiculos['cor']."</td>";
                                                        echo "<td>".$row_veiculos['entrada']."</td>";
                                                        echo "<td>".$row_veiculos['saida']."</td>";
                                                        echo "<td>Ações</td>";
                                                        }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <b>Cadastro</b>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="cadastrar.php" target="_blank">Registros de usuarios</a></li>
            <li><a class="dropdown-item" href="cadveiculos.php" target="_blank">Registros de carros</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Falar com suporte</a></li>
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







  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>