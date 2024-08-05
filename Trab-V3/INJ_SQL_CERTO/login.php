<?php
// login.php (Versão Segura)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test_db";
$port = 7306;
$conn = new mysqli($servername, $username, $password, $dbname,$port);
if ($conn->connect_error) {
die("Conexão falhou: " . $conn->connect_error);
}
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
// Usando Prepared Statements para evitar SQL Injection
$stmt = $conn->prepare("SELECT * FROM usuarios WHERE usuario = ? AND senha = ?");
$stmt->bind_param("ss", $usuario, $senha);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
echo "Login realizado com sucesso!";
} else {
echo "Usuário ou senha inválidos.";
}
$stmt->close();
$conn->close();
?>