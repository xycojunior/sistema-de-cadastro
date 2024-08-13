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

// Obter os dados do formulário
$nome = $_POST['nome'];
$celular = $_POST['celular'];
$endereco = $_POST['endereco'];
$cpf = $_POST['cpf'];
$titulo = $_POST['titulo'];
$email = $_POST['email'];

// Inserir os dados na tabela
$sql = "INSERT INTO usuarios (nome_user, telefone_user, endereco_user, cpf_user, titulo_user, email_user) VALUES ($1, $2, $3, $4, $5, $6)";
$result = pg_query_params($conn, $sql, array($nome, $celular, $endereco, $cpf, $titulo, $email));

if ($result) {
    // Redirecionar para a página de usuários cadastrados com uma mensagem de sucesso
    header("Location: visualizar.php?message=" . urlencode("Cadastro realizado com sucesso!"));
} else {
    // Redirecionar para a página de usuários cadastrados com uma mensagem de erro
    header("Location: visualizar.php?message=" . urlencode("Erro ao cadastrar: " . pg_last_error($conn)));
}

// Fechar a conexão
pg_close($conn);
exit(); // Certifique-se de usar exit() após header() para evitar execução adicional
?>
