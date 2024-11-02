-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-10-2024 a las 02:13:49
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `asistencia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `id` int(11) NOT NULL,
  `clase_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `asistio` int(11) DEFAULT NULL,
  `fecha_asistencia` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencias`
--

CREATE TABLE `asistencias` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `clase_id` int(11) DEFAULT NULL,
  `asistio` tinyint(1) DEFAULT 1,
  `hora` time DEFAULT NULL,
  `mes` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asistencias`
--

INSERT INTO `asistencias` (`id`, `usuario_id`, `fecha`, `clase_id`, `asistio`, `hora`, `mes`) VALUES
(1, 1, '2024-09-22', NULL, 1, NULL, NULL),
(2, 1, '2024-09-22', NULL, 1, NULL, NULL),
(3, 1, '2024-09-22', NULL, 1, NULL, NULL),
(4, 1, '2024-09-22', NULL, 1, NULL, NULL),
(5, 1, '2024-09-22', NULL, 1, NULL, NULL),
(6, 1, '2024-09-22', NULL, 1, NULL, NULL),
(7, 2, '2024-09-22', NULL, 1, NULL, NULL),
(8, 3, '2024-09-23', NULL, 1, NULL, NULL),
(9, 3, '2024-09-23', NULL, 1, NULL, NULL),
(10, 4, '2024-09-23', NULL, 1, NULL, NULL),
(11, 4, '2024-09-23', NULL, 1, NULL, NULL),
(12, 6, '2024-09-23', NULL, 1, NULL, NULL),
(13, 2, '2024-09-23', NULL, 1, NULL, NULL),
(14, 26, '2024-09-23', NULL, 1, NULL, NULL),
(15, 27, '2024-09-23', NULL, 1, NULL, NULL),
(16, 29, '2024-09-29', NULL, 1, NULL, NULL),
(17, 30, '2024-09-29', NULL, 1, NULL, NULL),
(18, 1, '2024-09-29', NULL, 1, NULL, NULL),
(19, 1, '2024-09-29', NULL, 1, NULL, NULL),
(20, 1, '2024-09-29', NULL, 1, NULL, NULL),
(21, 1, '2024-09-29', 2, 1, NULL, NULL),
(22, 1, '2024-09-29', 2, 1, NULL, NULL),
(23, 30, '2024-09-30', 5, 1, '02:01:30', NULL),
(24, 1, '2024-09-30', 5, 1, '02:01:41', NULL),
(25, 31, '2024-09-30', NULL, 1, NULL, NULL),
(26, 2, '2024-09-30', 5, 1, '02:03:10', NULL),
(27, 3, '2024-09-30', 5, 1, '02:03:10', NULL),
(28, 4, '2024-09-30', 5, 1, '02:03:10', NULL),
(29, 6, '2024-09-30', 5, 1, '02:03:10', NULL),
(30, 31, '2024-09-30', NULL, 1, NULL, NULL),
(31, 1, '2024-09-29', 5, 1, NULL, NULL),
(32, 2, '2024-09-29', 5, 1, NULL, NULL),
(33, 3, '2024-09-29', 5, 1, NULL, NULL),
(34, 4, '2024-09-29', 5, 1, NULL, NULL),
(35, 6, '2024-09-29', 5, 1, NULL, NULL),
(36, 30, '2024-09-29', 5, 1, NULL, NULL),
(37, 1, '2024-09-29', 5, 1, NULL, NULL),
(38, 2, '2024-09-29', 5, 1, NULL, NULL),
(39, 3, '2024-09-29', 5, 1, NULL, NULL),
(40, 4, '2024-09-29', 5, 1, NULL, NULL),
(41, 6, '2024-09-29', 5, 1, NULL, NULL),
(42, 30, '2024-09-29', 5, 1, NULL, NULL),
(43, 31, '2024-09-30', NULL, 1, NULL, NULL),
(44, 1, '2024-09-29', 5, 1, NULL, NULL),
(45, 4, '2024-09-29', 5, 1, NULL, NULL),
(46, 30, '2024-09-29', 5, 1, NULL, NULL),
(47, 31, '2024-10-05', NULL, 1, NULL, NULL),
(48, 31, '2024-10-05', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistenciass`
--

CREATE TABLE `asistenciass` (
  `id` int(11) NOT NULL,
  `estudiante_id` int(11) DEFAULT NULL,
  `fecha` date NOT NULL,
  `asistencia` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clases`
--

CREATE TABLE `clases` (
  `id` int(11) NOT NULL,
  `nombre_clase` varchar(100) NOT NULL,
  `codigo_clase` varchar(50) NOT NULL,
  `maestro_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clases`
--

INSERT INTO `clases` (`id`, `nombre_clase`, `codigo_clase`, `maestro_id`) VALUES
(1, 'fisica1', '11111', 29),
(2, 'fisica2', '8888', 26),
(3, 'calculo integral', '9181', 30),
(4, 'fisica1', '8181', 30),
(5, 'fisica1', '1234', 31);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clase_usuario`
--

CREATE TABLE `clase_usuario` (
  `id` int(11) NOT NULL,
  `clase_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `es_maestro` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clase_usuario`
--

INSERT INTO `clase_usuario` (`id`, `clase_id`, `usuario_id`, `es_maestro`) VALUES
(1, 1, 1, 0),
(2, 1, 1, 0),
(3, 2, 1, 0),
(4, 3, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

CREATE TABLE `estudiantes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `grupo_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `llave_encriptada` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `email`, `password`, `llave_encriptada`) VALUES
(1, 'edgar ', 'bravo', 'edgarbravo176@gmail.com', '$2y$10$8fiDiLyVNGfZKt/hnIvDM.fV39t/p9Gtkk5cJpNLcXOWfTK75q0Ee', NULL),
(2, 'edgar ', 'bravo', 'edgarbravo@gmail.com', '$2y$10$8QoHY7QGC/Kiqz1rNs0ltO.Bn3iH2Ie8fhApEUH98t9V13qH/PtE2', NULL),
(3, 'carmen', 'sanchez', 'elcetis101@gmail.com', '$2y$10$tUgrIOUqmlFpw0nQ/QVbcuQiPClSjak4Fhe7KtXtZdZ2ofvXxfAOO', NULL),
(4, 'pablo', 'azaid', 'eibrazaid213@gmail.com', '$2y$10$riVsEI8XIhapbL39udKiW.7HZu80a7EgBpP2gY/3jQV76dZTeB91C', NULL),
(6, 'carlos', 'lopez', 'asdasq3123@gmail.com', '$2y$10$ddD/TaRCLAvIpPxxizE/E.LAJXFDFekhGL3s9TNdjOd1ErlzRFkpq', NULL),
(26, 'prueba', 'pueba', 'edgarbravo890@gmail.com', '$2y$10$94vugQP56CNE8qXNIlWoXu/MumHfs1uJuxJV697Wmq1EfK7PvXn1a', '4015f9a675bdc1c177008d11e09d65dc'),
(27, 'edgar ', 'bravo', '123asdq2e@cetis.org', '$2y$10$Ge6litWUW.R4V4iLOkrG1uc8r/rW2PFp04UUp0.YgDlrzRQYA3AX2', '962a82be1cf314268bd0a33442c9154d'),
(28, 'juaasddsad', 'bravo', 'bravosanchez@casd.com', '$2y$10$0Z0m4gkPexuTVGgTtboyXOFvQoeatF.uj2rteyfDMUSzIW21q3RcC', 'a22535e006c6ef0f0ff801580a42ae76'),
(29, 'alumno1', 'prueba', 'prueba1apumno@gmail.com', '$2y$10$mXj80bEWMRHJtZ3NU9IWPOO/TPm7/4qe284maRux9DVs.XD/5bozS', '0d10d1aadf18cb77252f11e1b0d24594'),
(30, 'patty ', 'martinez garcia', 'pattygarcia890@gmail.com', '$2y$10$xMHRvTVhbyILxK9bONttjeju/xt3B2XYLy8kcWlVdAnfGCeQ6pkhi', 'c1af4e5481343bfedce1ef7aa8a81115'),
(31, 'Edgar Eduardo ', 'Bravo Sanchez', 'edgar.bravo-nda2@cetis101.org', '$2y$10$jWTDJvyT6eltf/JwgcOjC.hLnXXxFPsFek6mpCzRlBkcgpd7KWqoa', '336465feda9e45028f756059afcb8a9b');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clase_id` (`clase_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `asistencias`
--
ALTER TABLE `asistencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `asistenciass`
--
ALTER TABLE `asistenciass`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estudiante_id` (`estudiante_id`);

--
-- Indices de la tabla `clases`
--
ALTER TABLE `clases`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo_clase` (`codigo_clase`),
  ADD KEY `maestro_id` (`maestro_id`);

--
-- Indices de la tabla `clase_usuario`
--
ALTER TABLE `clase_usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clase_id` (`clase_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grupo_id` (`grupo_id`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `asistencias`
--
ALTER TABLE `asistencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `asistenciass`
--
ALTER TABLE `asistenciass`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clases`
--
ALTER TABLE `clases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `clase_usuario`
--
ALTER TABLE `clase_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `asistencia_ibfk_1` FOREIGN KEY (`clase_id`) REFERENCES `clases` (`id`),
  ADD CONSTRAINT `asistencia_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `asistencias`
--
ALTER TABLE `asistencias`
  ADD CONSTRAINT `asistencias_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `asistenciass`
--
ALTER TABLE `asistenciass`
  ADD CONSTRAINT `asistenciass_ibfk_1` FOREIGN KEY (`estudiante_id`) REFERENCES `estudiantes` (`id`);

--
-- Filtros para la tabla `clases`
--
ALTER TABLE `clases`
  ADD CONSTRAINT `clases_ibfk_1` FOREIGN KEY (`maestro_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `clase_usuario`
--
ALTER TABLE `clase_usuario`
  ADD CONSTRAINT `clase_usuario_ibfk_1` FOREIGN KEY (`clase_id`) REFERENCES `clases` (`id`),
  ADD CONSTRAINT `clase_usuario_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD CONSTRAINT `estudiantes_ibfk_1` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
