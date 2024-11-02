<?php
session_start();

// Conexión a la base de datos
$conn = new mysqli('localhost', 'root', '', 'asistencia_alumnos');

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar datos del formulario
$email = $_POST['email'];
$password = $_POST['password'];

// Consultar usuario
$sql = "SELECT * FROM usuarios WHERE email = '$email'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['rol'] = $user['rol'];
    if ($user['rol'] == 'maestro') {
        header("Location: dashboard_maestro.php");
    } else {
        header("Location: dashboard_alumno.php");
    }
} else {
    echo "Email o contraseña incorrectos.";
}

$conn->close();
?>
