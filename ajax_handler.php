<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'asistencia_alumnos');
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Cargar alumnos
if ($_POST['action'] == 'load_alumnos') {
    $alumnos = $conn->query("SELECT id, nombre, email FROM usuarios WHERE rol = 'alumno'");
    $alumnos_data = [];
    while ($alumno = $alumnos->fetch_assoc()) {
        $alumnos_data[] = $alumno;
    }
    echo json_encode($alumnos_data);
}

// Cargar grupos
if ($_POST['action'] == 'load_grupos') {
    $maestro_id = $_SESSION['user_id'];
    $grupos = $conn->query("SELECT id, nombre_grupo FROM grupos WHERE maestro_id = '$maestro_id'");
    $grupos_data = [];
    while ($grupo = $grupos->fetch_assoc()) {
        $grupos_data[] = $grupo;
    }
    echo json_encode($grupos_data);
}

// Registrar asistencia
if ($_POST['action'] == 'marcar_asistencia') {
    $alumno_id = $_POST['alumno_id'];
    $grupo_id = $_POST['grupo_id'];
    $estado = $_POST['estado'];
    $fecha = date("Y-m-d");
    $hora_llegada = $estado === 'ausente' ? NULL : $_POST['hora_llegada'];

    $stmt = $conn->prepare("INSERT INTO asistencias (alumno_id, clase_id, fecha, estado, hora_llegada) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iisss", $alumno_id, $grupo_id, $fecha, $estado, $hora_llegada);
    $result = $stmt->execute();

    echo $result ? "Asistencia registrada exitosamente." : "Error al registrar asistencia: " . $stmt->error;
    $stmt->close();
}
$conn->close();
?>
