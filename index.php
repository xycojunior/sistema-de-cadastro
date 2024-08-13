<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Oficial</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <nav>
            <button class="btn-pag"><a href="visualizar.php">Usuários cadastrados</a></button>
        </nav>
    </header>
    <main>
        <div class="card-cadastro">
            <h1>Cadastro de Ativistas</h1>
            <form action="cadastrar.php" method="post">
                <input type="text" id="nome" name="nome" placeholder="Nome" maxlength="50" required>
                <input type="text" id="cpf" name="cpf" placeholder="CPF" maxlength="11" required>
                <input type="text" id="titulo" name="titulo" placeholder="Título de Eleitor" maxlength="12" required>
                <input type="email" id="email" name="email" placeholder="E-mail" maxlength="50" required>
                <input type="tel" id="telefone" name="celular" placeholder="Celular" maxlength="11" required>
                <input type="text" id="endereco" name="endereco" placeholder="Endereço" maxlength="50" required>
                <button type="submit">Cadastrar</button>
            </form>
        </div>
    </main>
    <footer>
        Protótipo desenvolvido por <a href="https://github.com/xycojunior">xycojunior</a>
    </footer>
</body>
</html>
