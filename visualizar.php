<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários Cadastrados</title>
    <link rel="stylesheet" href="assets/css/visualizar.css">
</head>
<body>
    <header>
        <nav>
            <button class="btn-outro-user"><a href="index.php">Cadastrar outro usuário</a></button>
            <button class="btn-impressao" onclick="window.print()">Imprimir / Salvar como PDF</button>
        </nav>
    </header>
    <main>
        <div class="visualizar-cadastro">
            <h1>Usuários Cadastrados</h1>
            <?php
            // Exibir mensagem de sucesso ou erro
            if (isset($_GET['message'])) {
                $message = htmlspecialchars($_GET['message']);
                $message_class = (strpos($message, 'Erro') === false) ? 'success' : 'error';
                echo "<p class='message $message_class'>$message</p>";
            }
            ?>
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Celular</th>
                        <th>Endereço</th>
                        <th>CPF</th>
                        <th>Título</th>
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Definir as variáveis de conexão
                    $host = "localhost";
                    $port = "5432";
                    $dbname = "sistema_cadastro";
                    $user = "postgres";
                    $password = "1234";

                    // Conectar com o banco de dados
                    $conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");
                    if (!$conn) {
                        die("Conexão falhou: " . pg_last_error());
                    }

                    // Consulta para obter os dados
                    $sql = "SELECT cod_user, nome_user, telefone_user, endereco_user, cpf_user, titulo_user, email_user FROM usuarios";
                    $result = pg_query($conn, $sql);

                    if ($result) {
                        while ($row = pg_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['nome_user']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['telefone_user']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['endereco_user']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['cpf_user']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['titulo_user']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['email_user']) . "</td>";
                            echo "<td>";
                            echo "<a href='editar.php?id=" . urlencode($row['cod_user']) . "'>Editar</a> | ";
                            echo "<a href='excluir.php?id=" . urlencode($row['cod_user']) . "' onclick='return confirm(\"Tem certeza que deseja excluir?\");'>Excluir</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>Erro ao buscar dados: " . pg_last_error($conn) . "</td></tr>";
                    }

                    // Fecha a conexão
                    pg_close($conn);
                    ?>
                </tbody>
            </table>
        </div>
    </main>
    <footer>
        Protótipo desenvolvido por <a href="https://github.com/xycojunior">xycojunior</a>
    </footer>
</body>
</html>
