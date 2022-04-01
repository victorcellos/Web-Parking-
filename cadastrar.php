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
    <form class="form" action="../projeto3/actions/processa.php" method="POST">
        <div class="card">
            <div class="card-top">
                <img class="imglogin" src="../projeto3/imagens/usuario.jpg" alt="usuario">
                <h2 class="titulo">Crie sua conta!</h2>
                <p>Seja bem-vindo!</p>
            </div>

            <div class="card-grupo">
                <label><b>Nome Completo:</b></label>
                <input type="text" id="nome" name="nome" placeholder="Digite seu nome:" maxlength="64" required>
            </div>

            <div class="card-grupo">
                <label><b>Telefone:</b></label>
                <input type="text" id="telefone" name="telefone" placeholder="Telefone:" maxlength="64" required>
            </div>

            <div class="card-grupo">
                <label><b>Email:</b></label>
                <input type="email" id="email" name="email" placeholder="Digite seu email:" maxlength="32" required>
            </div>

            <div class="card-grupo">
                <label><b>Senha:</b></label>
                <input type="password" id="senha" name="senha" placeholder="Digite sua senha:" maxlength="32" required>
            </div>
            
            <div>
                <input class="submit"  value="Cadastrar" type="submit" name="submit" id="submit">
            </div>

            <div>
                <a class="textcadastro" href="login.php">Já é inscrito ? <strong>login</strong></a>
            </div>

        </div>
    </form>
</div>    
</body>
</html>