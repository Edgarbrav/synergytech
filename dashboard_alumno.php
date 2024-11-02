<?php
session_start();
if ($_SESSION['rol'] != 'alumno') {
    header("Location: index.php");
    exit;
}

$conn = new mysqli('localhost', 'root', '', 'asistencia_alumnos');
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$alumno_id = $_SESSION['user_id'];

// Consultar el historial de asistencias del alumno
$asistencias = $conn->query("SELECT * FROM asistencias WHERE alumno_id = '$alumno_id' ORDER BY fecha DESC");

// Consultar el conteo de asistencias, inasistencias y retardos
$conteo_asistencias = $conn->query("
    SELECT estado, COUNT(*) AS total 
    FROM asistencias 
    WHERE alumno_id = '$alumno_id' 
    GROUP BY estado
");

// Crear un arreglo para almacenar los conteos
$estadisticas = [
    'presente' => 0,
    'ausente' => 0,
    'retardo' => 0,
];
while ($fila = $conteo_asistencias->fetch_assoc()) {
    $estadisticas[$fila['estado']] = $fila['total'];
}

// Obtener los grupos a los que pertenece el alumno
$grupos = $conn->query("SELECT g.* FROM grupos g 
                        JOIN grupo_alumnos ga ON g.id = ga.grupo_id 
                        WHERE ga.alumno_id = '$alumno_id'");

// Obtener avisos para el alumno
$avisos = $conn->query("SELECT * FROM anuncios WHERE clase_id IN 
                        (SELECT grupo_id FROM grupo_alumnos WHERE alumno_id = '$alumno_id')");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Alumno</title>
    <link rel="stylesheet" href="styles5.css">
</head>
<body>
    <div class="dashboard-section">
        <div class="dashboard-container">
            <h1>Dashboard del Alumno</h1>

            <!-- Conteo de asistencias -->
            <div class="attendance-summary">
                <h2>Resumen de Asistencias</h2>
                <p>Asistencias: <span><?= $estadisticas['presente'] ?></span></p>
                <p>Inasistencias: <span><?= $estadisticas['ausente'] ?></span></p>
                <p>Retardos: <span><?= $estadisticas['retardo'] ?></span></p>
            </div>

            <!-- Historial de asistencias -->
            <div class="attendance-history">
                <h2>Historial de Asistencias</h2>
                <table>
                    <tr>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Hora de Llegada</th>
                    </tr>
                    <?php while ($asistencia = $asistencias->fetch_assoc()) { ?>
                        <tr>
                            <td><?= $asistencia['fecha'] ?></td>
                            <td><?= ucfirst($asistencia['estado']) ?></td>
                            <td><?= $asistencia['hora_llegada'] ?? '-' ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>

            <!-- Ver Grupos -->
            <div class="groups">
                <h2>Mis Grupos</h2>
                <ul>
                    <?php while ($grupo = $grupos->fetch_assoc()) { ?>
                        <li><?= $grupo['nombre_grupo'] ?></li>
                    <?php } ?>
                </ul>
            </div>

            <!-- Ver Avisos -->
            <div class="announcements">
                <h2>Avisos</h2>
                <ul>
                    <?php while ($aviso = $avisos->fetch_assoc()) { ?>
                        <li><strong><?= $aviso['fecha'] ?>:</strong> <?= $aviso['mensaje'] ?></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>

<?php $conn->close(); ?>
