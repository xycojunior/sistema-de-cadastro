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

    // Excluir o usuário
    $sql = "DELETE FROM usuarios WHERE cod_user = $1";
    $result = pg_query_params($conn, $sql, array($id));

    if ($result) {
        header("Location: visualizar.php");
        exit();
    } else {
        echo "Erro ao excluir: " . pg_last_error($conn);
    }
}

pg_close($conn);
?>
