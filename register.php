<!-- register.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="styles3.css">
</head>
<body>
    <!-- Encabezado de la página con logotipo y barra de navegación -->
    <header class="header">
        <div class="logo">Asistencia <span>Alumnos</span></div>
        <nav class="navbar">
            <a href="index.php">Inicio</a>
            <a href="login.php">Iniciar Sesión</a>
        </nav>
    </header>

    <!-- Sección de formulario de registro -->
    <section class="register-section">
        <div class="register-form">
            <h2>Registro</h2>
            <form action="register_action.php" method="POST">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" placeholder="Ingresa tu nombre" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Ingresa tu email" required>

                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" required>

                <label for="rol">Rol:</label>
                <select id="rol" name="rol" required>
                    <option value="alumno">Alumno</option>
                    <option value="maestro">Maestro</option>
                </select>

                <button type="submit" class="btn">Registrarse</button>
            </form>
        </div>
    </section>
</body>
</html>
