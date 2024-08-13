<?php
// Conectar com o banco de dados
$host = "localhost";
$port = "5432";
$dbname = "sistema_cadastro";
$user = "postgres";
$password = "1234";

$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");
if (!$conn) {
    die("Conexão falhou: " . pg_last_error());
}

// Verificar se o ID do usuário foi passado
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Obter os dados do usuário
    $sql = "SELECT * FROM usuarios WHERE cod_user = $1";
    $result = pg_query_params($conn, $sql, array($id));
    $user = pg_fetch_assoc($result);
}

// Atualizar o usuário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $celular = $_POST['celular'];
    $endereco = $_POST['endereco'];
    $cpf = $_POST['cpf'];
    $titulo = $_POST['titulo'];
    $email = $_POST['email'];

    $sql = "UPDATE usuarios SET nome_user = $1, telefone_user = $2, endereco_user = $3, cpf_user = $4, titulo_user = $5, email_user = $6 WHERE cod_user = $7";
    $result = pg_query_params($conn, $sql, array($nome, $celular, $endereco, $cpf, $titulo, $email, $id));

    if ($result) {
        header("Location: visualizar.php");
        exit();
    } else {
        echo "Erro ao atualizar: " . pg_last_error($conn);
    }
}

pg_close($conn);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="assets/css/editar.css">
</head>
<body>
    <header>
        <nav>
            <a href="visualizar.php">Voltar para a lista</a>
        </nav>
    </header>
    <main>
        <div class="visualizar-cadastro">
            <h1>Editar Usuário</h1>
            <form action="" method="post">
                <input type="text" name="nome" placeholder="Nome" value="<?php echo htmlspecialchars($user['nome_user']); ?>" required>
                <input type="text" name="celular" placeholder="Celular" value="<?php echo htmlspecialchars($user['telefone_user']); ?>" required>
                <input type="text" name="endereco" placeholder="Endereço" value="<?php echo htmlspecialchars($user['endereco_user']); ?>" required>
                <input type="text" name="cpf" placeholder="CPF" value="<?php echo htmlspecialchars($user['cpf_user']); ?>" required>
                <input type="text" name="titulo" placeholder="Título de Eleitor" value="<?php echo htmlspecialchars($user['titulo_user']); ?>" required>
                <input type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($user['email_user']); ?>" required>
                <button type="submit">Atualizar</button>
            </form>
        </div>
    </main>
</body>
</html>
