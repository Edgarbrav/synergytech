<?php
session_start();
if ($_SESSION['rol'] != 'maestro') {
    header("Location: index.php");
    exit;
}

$conn = new mysqli('localhost', 'root', '', 'asistencia_alumnos');
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$maestro_id = $_SESSION['user_id'];

// Crear un grupo
if (isset($_POST['crear_grupo'])) {
    $nombre_grupo = $_POST['nombre_grupo'];
    $sql = "INSERT INTO grupos (nombre_grupo, maestro_id) VALUES ('$nombre_grupo', '$maestro_id')";
    echo $conn->query($sql) === TRUE ? "Grupo creado exitosamente." : "Error al crear grupo: " . $conn->error;
}

// Agregar un alumno a un grupo con verificación de duplicado
if (isset($_POST['agregar_alumno'])) {
    $grupo_id = $_POST['grupo_id'];
    $alumno_id = $_POST['alumno_id'];

    $check_sql = "SELECT * FROM grupo_alumnos WHERE grupo_id = '$grupo_id' AND alumno_id = '$alumno_id'";
    $check_result = $conn->query($check_sql);
    
    if ($check_result->num_rows == 0) {
        $sql = "INSERT INTO grupo_alumnos (grupo_id, alumno_id) VALUES ('$grupo_id', '$alumno_id')";
        echo $conn->query($sql) === TRUE ? "Alumno agregado exitosamente al grupo." : "Error al agregar alumno al grupo: " . $conn->error;
    } else {
        echo "El alumno ya está en este grupo.";
    }
}

// Registrar asistencia de un alumno
if (isset($_POST['marcar_asistencia'])) {
    $alumno_id = $_POST['alumno_id'];
    $grupo_id = $_POST['grupo_id'];
    $estado = $_POST['estado'];
    $fecha = date("Y-m-d");

    $hora_llegada = ($estado === 'ausente') ? NULL : $_POST['hora_llegada'];

    $grupo_check = $conn->query("SELECT id FROM grupos WHERE id = '$grupo_id'");
    if ($grupo_check->num_rows > 0) {
        $stmt = $conn->prepare("INSERT INTO asistencias (alumno_id, clase_id, fecha, estado, hora_llegada) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iisss", $alumno_id, $grupo_id, $fecha, $estado, $hora_llegada);

        if ($stmt->execute()) {
            echo "Asistencia registrada exitosamente.";
        } else {
            echo "Error al registrar asistencia: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error: El grupo seleccionado no existe.";
    }
}

// Publicar un aviso
if (isset($_POST['publicar_aviso'])) {
    $grupo_id = $_POST['grupo_id'];
    $mensaje = $_POST['mensaje'];
    $fecha = date("Y-m-d");

    $grupo_check = $conn->query("SELECT id FROM grupos WHERE id = '$grupo_id'");
    if ($grupo_check->num_rows > 0) {
        $sql = "INSERT INTO anuncios (clase_id, mensaje, fecha) VALUES ('$grupo_id', '$mensaje', '$fecha')";
        echo $conn->query($sql) === TRUE ? "Aviso publicado exitosamente." : "Error al publicar aviso: " . $conn->error;
    } else {
        echo "Error: El grupo seleccionado no existe.";
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Maestro</title>
    <link rel="stylesheet" href="styles4.css">
</head>
<body>
    <header class="header">
        <div class="logo">Dashboard <span>Maestro</span></div>
        <nav class="navbar">
            <a href="../inicio/index.html">Inicio</a>
            <a href="index.php">Cerrar Sesión</a>
        </nav>
    </header>

    <section class="dashboard-section">
        <div class="dashboard-container">
            <!-- Crear Grupo -->
            <h2>Crear Grupo</h2>
            <form action="" method="POST" class="form-dashboard">
                <label>Nombre del Grupo:</label>
                <input type="text" name="nombre_grupo" required>
                <button type="submit" name="crear_grupo" class="btn">Crear Grupo</button>
            </form>

            <!-- Agregar Alumnos a Grupo -->
            <h2>Agregar Alumnos a Grupo</h2>
            <form action="" method="POST" class="form-dashboard">
                <label>Selecciona Grupo:</label>
                <select name="grupo_id">
                    <?php 
                    // Consulta para obtener los grupos para el formulario de agregar alumnos
                    $grupos = $conn->query("SELECT * FROM grupos WHERE maestro_id = '$maestro_id'");
                    while ($grupo = $grupos->fetch_assoc()) { ?>
                        <option value="<?= $grupo['id'] ?>"><?= $grupo['nombre_grupo'] ?></option>
                    <?php } ?>
                </select>

                <label>Selecciona Alumno:</label>
                <select name="alumno_id">
                    <?php 
                    $alumnos = $conn->query("SELECT * FROM usuarios WHERE rol = 'alumno'");
                    while ($alumno = $alumnos->fetch_assoc()) { ?>
                        <option value="<?= $alumno['id'] ?>"><?= $alumno['nombre'] ?> (<?= $alumno['email'] ?>)</option>
                    <?php } ?>
                </select>

                <button type="submit" name="agregar_alumno" class="btn">Agregar Alumno</button>
            </form>

            <!-- Marcar Asistencia -->
            <h2>Marcar Asistencia</h2>
            <form id="form-asistencia" class="form-dashboard">
                <label>Selecciona Alumno:</label>
                <select name="alumno_id" id="alumno_id" required></select>

                <label>Selecciona Grupo:</label>
                <select name="grupo_id" id="grupo_id" required></select>

                <label>Estado:</label>
                <select name="estado" id="estado" required>
                    <option value="presente">Presente</option>
                    <option value="ausente">Ausente</option>
                    <option value="retardo">Retardo</option>
                </select>
                
                <label>Hora de Llegada:</label>
                <input type="time" name="hora_llegada" id="hora_llegada">

                <button type="button" onclick="marcarAsistencia()" class="btn">Marcar Asistencia</button>
            </form>

            <p id="response-message"></p>

            <!-- Publicar Aviso -->
            <h2>Publicar Aviso</h2>
            <form action="" method="POST" class="form-dashboard">
                <label>Selecciona Grupo:</label>
                <select name="grupo_id">
                    <?php 
                    // Consulta para obtener los grupos para el formulario de publicar aviso
                    $grupos = $conn->query("SELECT * FROM grupos WHERE maestro_id = '$maestro_id'");
                    while ($grupo = $grupos->fetch_assoc()) { ?>
                        <option value="<?= $grupo['id'] ?>"><?= $grupo['nombre_grupo'] ?></option>
                    <?php } ?>
                </select>
                <label>Mensaje:</label>
                <textarea name="mensaje" required></textarea>
                <button type="submit" name="publicar_aviso" class="btn">Publicar Aviso</button>
            </form>
        </div>
    </section>

    <script>
    // JavaScript para cargar alumnos y grupos en los formularios de asistencia
    document.addEventListener("DOMContentLoaded", () => {
        cargarAlumnos();
        cargarGrupos();
    });

    function cargarAlumnos() {
        fetch('ajax_handler.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'action=load_alumnos'
        })
        .then(response => response.json())
        .then(data => {
            let alumnoSelect = document.getElementById("alumno_id");
            alumnoSelect.innerHTML = '<option value="">Seleccione un alumno</option>';
            data.forEach(alumno => {
                let option = document.createElement("option");
                option.value = alumno.id;
                option.textContent = `${alumno.nombre} (${alumno.email})`;
                alumnoSelect.appendChild(option);
            });
        });
    }

    function cargarGrupos() {
        fetch('ajax_handler.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'action=load_grupos'
        })
        .then(response => response.json())
        .then(data => {
            let grupoSelect = document.getElementById("grupo_id");
            grupoSelect.innerHTML = '<option value="">Seleccione un grupo</option>';
            data.forEach(grupo => {
                let option = document.createElement("option");
                option.value = grupo.id;
                option.textContent = grupo.nombre_grupo;
                grupoSelect.appendChild(option);
            });
        });
    }

    function marcarAsistencia() {
        let alumno_id = document.getElementById("alumno_id").value;
        let grupo_id = document.getElementById("grupo_id").value;
        let estado = document.getElementById("estado").value;
        let hora_llegada = document.getElementById("hora_llegada").value;

        let formData = new URLSearchParams();
        formData.append("action", "marcar_asistencia");
        formData.append("alumno_id", alumno_id);
        formData.append("grupo_id", grupo_id);
        formData.append("estado", estado);
        formData.append("hora_llegada", hora_llegada);

        fetch('ajax_handler.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: formData.toString()
        })
        .then(response => response.text())
        .then(data => {
            document.getElementById("response-message").textContent = data;
        });
    }
    </script>
</body>
</html>

<?php $conn->close(); ?>
