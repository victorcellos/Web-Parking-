<?php
session_start(); // iniciado a sessão
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../projeto3/css/login.css">

    <title>Projeto Sistema</title>
</head>
<body>
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
</div>    
</body>
</html>