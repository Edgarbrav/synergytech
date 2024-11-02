<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asistencia de Alumnos</title>
    <link rel="stylesheet" href="styles1.css">
</head>
<body>
    <!-- Encabezado de la página con logotipo y barra de navegación -->
    <header class="header">
        <div class="logo">Asistencia <span>Alumnos</span></div>
        <nav class="navbar">
            <a href="#home" class="active">Inicio</a>
            <a href="#about">Acerca de</a>
            <a href="#services">Servicios</a>
            <a href="#contact">Contacto</a>
        </nav>
        <div id="menu-icon">&#9776;</div>
    </header>

    <!-- Sección principal -->
    <section class="home" id="home">
        <div class="home-content">
            <h1>Bienvenidos a la Asistencia de Alumnos</h1>
            <p>Gestiona y controla la asistencia de estudiantes de forma eficiente y confiable.</p>
        </div>
    </section>

    <!-- Sección de formulario de inicio de sesión -->
    <section class="login-section">
        <div class="login-form">
            <h2>Iniciar Sesión</h2>
            <form action="login.php" method="POST">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Ingresa tu email" required>

                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" required>

                <button type="submit" class="btn">Iniciar Sesión</button>
                <p>¿No tienes cuenta? <a href="register.php">Regístrate</a></p>
            </form>
        </div>
    </section>
</body>
</html>
