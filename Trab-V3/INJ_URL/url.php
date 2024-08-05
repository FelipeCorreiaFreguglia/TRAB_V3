<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Usuários</title>
</head>
<body>
<h1>Usuários</h1>
<?php
// Configuração de exibição de erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test_db";
$port = 7306;
$conn = new mysqli($servername, $username, $password, $dbname, $port);
if ($conn->connect_error) {
die("Conexão falhou: " . $conn->connect_error);
}
// Obter o parâmetro 'id' da URL
$id = isset($_GET['id']) ? $_GET['id'] : '';
// Construir a consulta SQL vulnerável
$sql = "SELECT * FROM users WHERE id = $id";
// Exibir a consulta SQL para depuração
echo "<p>Consulta SQL: $sql</p>";
// Executar a consulta
$result = $conn->query($sql);
if ($result === false) {
echo "Erro na consulta: " . $conn->error;
} elseif ($result->num_rows > 0) {
// Exibir os usuários encontrados
while ($row = $result->fetch_assoc()) {
echo "<h2>Usuário: " . htmlspecialchars($row['username']) . "</h2>";
echo "<p>Email: " . htmlspecialchars($row['email']) . "</p>";
}
} else {
echo "Nenhum usuário encontrado.";
}
$conn->close();
?>
</body>
</html>