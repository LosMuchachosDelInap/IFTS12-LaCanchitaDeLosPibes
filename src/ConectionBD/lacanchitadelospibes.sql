-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-05-2025 a las 01:48:20
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
-- Base de datos: `lacanchitadelospibes`
--
CRAEATE DATABASE `lacanchitadelospibes`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cancha`
 USE `lacanchitadelospibes`;

CREATE TABLE `cancha` (
  `id_cancha` int(4) NOT NULL,
  `nombreCancha` varchar(20) NOT NULL,
  `idUpdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `idCreate` timestamp NOT NULL DEFAULT current_timestamp(),
  `habilitado` int(11) NOT NULL DEFAULT 1,
  `cancelado` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cancha`
--

INSERT INTO `cancha` (`id_cancha`, `nombreCancha`, `idUpdate`, `idCreate`, `habilitado`, `cancelado`) VALUES
(1, 'monumental', '2025-05-04 20:03:13', '2025-05-04 20:03:13', 1, 0),
(2, 'bombonera', '2025-05-04 20:03:13', '2025-05-04 20:03:13', 1, 0),
(3, 'monumental', '2025-05-04 20:03:28', '2025-05-04 20:03:28', 1, 0),
(4, 'bombonera', '2025-05-04 20:03:28', '2025-05-04 20:03:28', 1, 0),
(5, 'gasometro', '2025-05-04 20:05:32', '2025-05-04 20:05:32', 1, 0),
(6, 'gasometro', '2025-05-04 20:05:56', '2025-05-04 20:05:56', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id_empleado` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `habilitado` int(11) NOT NULL DEFAULT 1,
  `cancelado` int(11) NOT NULL DEFAULT 0,
  `idCreate` timestamp NOT NULL DEFAULT current_timestamp(),
  `idUpdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id_empleado`, `id_rol`, `id_persona`, `id_usuario`, `habilitado`, `cancelado`, `idCreate`, `idUpdate`) VALUES
(1, 1, 4, 1, 1, 0, '2025-05-15 23:04:25', '2025-05-15 23:04:25'),
(2, 1, 5, 2, 1, 0, '2025-05-15 23:09:28', '2025-05-15 23:09:28'),
(3, 3, 6, 3, 1, 0, '2025-05-15 23:44:42', '2025-05-15 23:44:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fecha`
--

CREATE TABLE `fecha` (
  `id_fecha` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `idCreate` timestamp NOT NULL DEFAULT current_timestamp(),
  `idUpdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `habiltado` int(11) NOT NULL DEFAULT 1,
  `cancelado` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE `horario` (
  `id_horario` int(11) NOT NULL,
  `horario` time NOT NULL,
  `idCreate` timestamp NOT NULL DEFAULT current_timestamp(),
  `idUpdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `habiltado` int(11) NOT NULL DEFAULT 1,
  `cancelado` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id_persona` int(11) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `edad` varchar(3) NOT NULL,
  `dni` varchar(10) NOT NULL,
  `telefono` varchar(11) NOT NULL,
  `habilitado` int(1) NOT NULL DEFAULT 1,
  `cancelado` int(1) NOT NULL DEFAULT 0,
  `idCreate` timestamp NOT NULL DEFAULT current_timestamp(),
  `idUpdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id_persona`, `apellido`, `nombre`, `edad`, `dni`, `telefono`, `habilitado`, `cancelado`, `idCreate`, `idUpdate`) VALUES
(1, '', '', '', '', '', 1, 0, '2025-05-15 22:51:26', '2025-05-15 22:51:26'),
(2, '', '', '', '', '', 1, 0, '2025-05-15 22:52:19', '2025-05-15 22:52:19'),
(3, '', '', '', '', '', 1, 0, '2025-05-15 23:02:26', '2025-05-15 23:02:26'),
(4, '', '', '', '', '', 1, 0, '2025-05-15 23:04:24', '2025-05-15 23:04:24'),
(5, 'mino', 'seba', '46', '26589756', '1156321455', 1, 0, '2025-05-15 23:09:28', '2025-05-15 23:09:28'),
(6, 'mino', 'seba', '56', '25879023', '3354658955', 1, 0, '2025-05-15 23:44:42', '2025-05-15 23:44:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `precio`
--

CREATE TABLE `precio` (
  `id_precio` int(6) NOT NULL,
  `idCreate` timestamp NOT NULL DEFAULT current_timestamp(),
  `idUpdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `habiltado` int(11) NOT NULL DEFAULT 1,
  `cancelado` int(11) NOT NULL DEFAULT 0,
  `precio` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE `reserva` (
  `id_reserva` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_cancha` int(11) NOT NULL,
  `id_fecha` int(11) NOT NULL,
  `id_precio` int(11) NOT NULL,
  `id_horario` int(11) NOT NULL,
  `idCreate` timestamp NOT NULL DEFAULT current_timestamp(),
  `idUpdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `habilitado` int(11) NOT NULL DEFAULT 1,
  `cancelado` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_roles` int(11) NOT NULL,
  `idCreate` timestamp NOT NULL DEFAULT current_timestamp(),
  `idUpdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `habilitado` int(11) NOT NULL DEFAULT 1,
  `cancelado` int(11) NOT NULL DEFAULT 0,
  `rol` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_roles`, `idCreate`, `idUpdate`, `habilitado`, `cancelado`, `rol`) VALUES
(1, '2025-05-15 00:54:58', '2025-05-15 00:54:58', 1, 0, 'Dueño'),
(2, '2025-05-15 01:04:06', '2025-05-15 01:04:06', 1, 0, 'Adminstrativo'),
(3, '0000-00-00 00:00:00', '2025-05-15 01:06:18', 1, 0, 'Bar'),
(4, '2025-05-15 01:05:25', '2025-05-15 01:05:25', 1, 0, 'Alquiler'),
(5, '0000-00-00 00:00:00', '2025-05-15 01:07:47', 1, 0, 'Estacionamiento');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(4) NOT NULL,
  `email` varchar(20) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `idUpdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `idCreate` timestamp NOT NULL DEFAULT current_timestamp(),
  `habilitado` int(11) NOT NULL DEFAULT 1,
  `cancelado` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `email`, `clave`, `id_persona`, `idUpdate`, `idCreate`, `habilitado`, `cancelado`) VALUES
(1, '', '$2y$10$R', 4, '2025-05-15 23:04:25', '2025-05-15 23:04:25', 1, 0),
(2, 'sebastianminotti@gma', '$2y$10$l', 5, '2025-05-15 23:09:28', '2025-05-15 23:09:28', 1, 0),
(3, 'ifts12@gmail.com', '$2y$10$9mNLL2PTd1EdRdXMtnZRRuw.iI6/sxpOF2tcURI3iYgQQLE8hGH82', 6, '2025-05-15 23:44:42', '2025-05-15 23:44:42', 1, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cancha`
--
ALTER TABLE `cancha`
  ADD PRIMARY KEY (`id_cancha`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id_empleado`),
  ADD KEY `id_rol` (`id_rol`,`id_persona`,`id_usuario`),
  ADD KEY `id_persona` (`id_persona`);

--
-- Indices de la tabla `fecha`
--
ALTER TABLE `fecha`
  ADD PRIMARY KEY (`id_fecha`);

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`id_horario`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id_persona`);

--
-- Indices de la tabla `precio`
--
ALTER TABLE `precio`
  ADD PRIMARY KEY (`id_precio`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_cancha` (`id_cancha`),
  ADD KEY `id_fecha` (`id_fecha`),
  ADD KEY `id_precio` (`id_precio`),
  ADD KEY `id_horario` (`id_horario`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_roles`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_persona` (`id_persona`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cancha`
--
ALTER TABLE `cancha`
  MODIFY `id_cancha` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `fecha`
--
ALTER TABLE `fecha`
  MODIFY `id_fecha` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `horario`
--
ALTER TABLE `horario`
  MODIFY `id_horario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `precio`
--
ALTER TABLE `precio`
  MODIFY `id_precio` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_roles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_roles`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `empleado_ibfk_2` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `reserva_ibfk_1` FOREIGN KEY (`id_fecha`) REFERENCES `fecha` (`id_fecha`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reserva_ibfk_2` FOREIGN KEY (`id_precio`) REFERENCES `precio` (`id_precio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reserva_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reserva_ibfk_4` FOREIGN KEY (`id_horario`) REFERENCES `horario` (`id_horario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reserva_ibfk_5` FOREIGN KEY (`id_cancha`) REFERENCES `cancha` (`id_cancha`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
