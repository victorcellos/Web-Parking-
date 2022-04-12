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
      <img class="navbar-brand" width="30px" src="../projeto3/imagens/nexusgroup2.ico" alt="alt"></img>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#"><b>Home</b></a>
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
  <br><br>
  <div style="display: flex; justify-content: center; gap: .1%;">
    <input type="search" class="form-control w-25" placeholder="pesquisar" id="pesquisar">
    <button onclick="searchData()" class="btn btn-primary">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
      <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
      </svg>
    </button>
  </div>
  <div class="m-5">
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
                  if (!empty($_GET['search'])) {
                    $pesquisa = $_GET['search'];
                                  $query_veiculos = "SELECT cars.idcarros, cars.marca, cars.modelo, cars.placa, cars.cor,
                                  regtime.entrada, regtime.saida 
                                    FROM carros cars
                                      LEFT JOIN registro AS regtime ON regtime.veiculo_id=cars.idcarros
                                      WHERE cars.idcarros LIKE '%$pesquisa%' or cars.marca LIKE '%$pesquisa%' or cars.modelo LIKE '%$pesquisa%' or cars.modelo LIKE '%$pesquisa%' or cars.placa LIKE '%$pesquisa%' or cars.cor LIKE '%$pesquisa%' or regtime.entrada LIKE '%$pesquisa%' or regtime.saida LIKE '%$pesquisa%'
                                      ORDER BY cars.idcarros DESC";
                  
                                    $result_veiculos = $pdo->prepare($query_veiculos);
                                    $result_veiculos->execute();
                    
                  }else{
                    $query_veiculos = "SELECT cars.idcarros, cars.marca, cars.modelo, cars.placa, cars.cor,
                    regtime.entrada, regtime.saida 
                      FROM carros cars
                        LEFT JOIN registro AS regtime ON regtime.veiculo_id=cars.idcarros
                            ORDER BY cars.idcarros DESC";
                  
                      $result_veiculos = $pdo->prepare($query_veiculos);
                      $result_veiculos->execute();
                  }


              while($row_veiculos = $result_veiculos->fetch(PDO::FETCH_ASSOC)){
                  echo "<tr>";
                  echo "<td>".$row_veiculos['idcarros']."</td>";
                  echo "<td>".$row_veiculos['marca']."</td>";
                  echo "<td>".$row_veiculos['modelo']."</td>";
                  echo "<td>".$row_veiculos['placa']."</td>";
                  echo "<td>".$row_veiculos['cor']."</td>";
                  echo "<td>".$row_veiculos['entrada']."</td>";
                  echo "<td>".$row_veiculos['saida']."</td>";
                  echo "<td> <a class='btn btn-sm btn-primary' href='paineledit.php?idcarros=$row_veiculos[idcarros]'> 
                  <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
                  <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/>
                  </svg>
                </td>";
              }
            ?>
        </tbody>
      </table>
  </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
<script>
  var search = document.getElementById('pesquisar');
  
    search.addEventListener("keydown", function(event){
      if  (event.key === "Enter")
      {
        searchData();
      }
    });

  function searchData(){
    window.location = 'listaveiculos.php?search='+search.value;
  }
</script>
</html>