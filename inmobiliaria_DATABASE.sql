-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-05-2025 a las 21:43:58
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
-- Base de datos: `inmobiliaria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `multimedia`
--

CREATE TABLE `multimedia` (
  `id` int(11) NOT NULL,
  `id_propiedad` int(11) NOT NULL,
  `tipo` enum('Imagen','Video') NOT NULL,
  `url` varchar(255) NOT NULL,
  `fecha_subida` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `multimedia`
--

INSERT INTO `multimedia` (`id`, `id_propiedad`, `tipo`, `url`, `fecha_subida`) VALUES
(25, 10, 'Imagen', '/WebIII/Inmobiliaria/Casas/10/Principal.jpg', '2025-04-01 03:18:48'),
(26, 10, 'Imagen', '/WebIII/Inmobiliaria/Casas/10/1.jpg', '2025-04-01 03:18:48'),
(27, 10, 'Imagen', '/WebIII/Inmobiliaria/Casas/10/2.jpg', '2025-04-01 03:18:48'),
(28, 10, 'Imagen', '/WebIII/Inmobiliaria/Casas/10/3.jpg', '2025-04-01 03:18:48'),
(40, 13, 'Imagen', '/WebIII/Inmobiliaria/Casas/13/Principal.jpg', '2025-04-01 20:42:26'),
(41, 13, 'Imagen', '/WebIII/Inmobiliaria/Casas/13/1.jpg', '2025-04-01 20:42:26'),
(42, 13, 'Imagen', '/WebIII/Inmobiliaria/Casas/13/2.jpg', '2025-04-01 20:42:26'),
(43, 13, 'Imagen', '/WebIII/Inmobiliaria/Casas/13/3.jpg', '2025-04-01 20:42:26'),
(44, 13, 'Imagen', '/WebIII/Inmobiliaria/Casas/13/4.jpg', '2025-04-01 20:42:26'),
(56, 16, 'Imagen', '/WebIII/Inmobiliaria/Casas/16/Principal.jpg', '2025-04-08 04:08:30'),
(57, 16, 'Imagen', '/WebIII/Inmobiliaria/Casas/16/1.jpg', '2025-04-08 04:08:30'),
(58, 16, 'Imagen', '/WebIII/Inmobiliaria/Casas/16/2.jpg', '2025-04-08 04:08:30'),
(59, 16, 'Imagen', '/WebIII/Inmobiliaria/Casas/16/3.jpg', '2025-04-08 04:08:30'),
(60, 16, 'Imagen', '/WebIII/Inmobiliaria/Casas/16/4.jpg', '2025-04-08 04:08:30'),
(71, 22, 'Imagen', '/WebIII/Inmobiliaria/Casas/22/Principal.jpg', '2025-04-09 14:39:14'),
(72, 22, 'Imagen', '/WebIII/Inmobiliaria/Casas/22/1.jpg', '2025-04-09 14:39:14'),
(73, 22, 'Imagen', '/WebIII/Inmobiliaria/Casas/22/2.jpg', '2025-04-09 14:39:14'),
(74, 22, 'Imagen', '/WebIII/Inmobiliaria/Casas/22/3.jpg', '2025-04-09 14:39:14'),
(75, 22, 'Imagen', '/WebIII/Inmobiliaria/Casas/22/4.jpeg', '2025-04-09 14:39:14'),
(76, 10, 'Imagen', '/WebIII/Inmobiliaria/Casas/10/76.png', NULL),
(77, 23, 'Imagen', '/WebIII/Inmobiliaria/Casas/23/Principal.jpg', '2025-05-12 03:47:23'),
(78, 23, 'Imagen', '/WebIII/Inmobiliaria/Casas/23/1.jpg', '2025-05-12 03:47:23'),
(79, 23, 'Imagen', '/WebIII/Inmobiliaria/Casas/23/2.jpg', '2025-05-12 03:47:23'),
(80, 23, 'Imagen', '/WebIII/Inmobiliaria/Casas/23/3.jpg', '2025-05-12 03:47:23'),
(81, 23, 'Imagen', '/WebIII/Inmobiliaria/Casas/23/4.jpg', '2025-05-12 03:47:23'),
(82, 23, 'Imagen', '/WebIII/Inmobiliaria/Casas/23/5.jpeg', '2025-05-12 03:47:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propiedades`
--

CREATE TABLE `propiedades` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `ubicacion` varchar(255) DEFAULT NULL,
  `ancho` decimal(10,2) DEFAULT NULL,
  `largo` decimal(10,2) DEFAULT NULL,
  `area` float DEFAULT NULL,
  `num_habitaciones` int(11) DEFAULT NULL,
  `num_banos` int(11) DEFAULT NULL,
  `estacionamiento` int(11) DEFAULT NULL,
  `estado` enum('Disponible','Vendido','Rentado') DEFAULT NULL,
  `fecha_registro` timestamp NULL DEFAULT current_timestamp(),
  `id_usuario` int(11) DEFAULT NULL,
  `descuento` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `propiedades`
--

INSERT INTO `propiedades` (`id`, `titulo`, `descripcion`, `tipo`, `precio`, `ubicacion`, `ancho`, `largo`, `area`, `num_habitaciones`, `num_banos`, `estacionamiento`, `estado`, `fecha_registro`, `id_usuario`, `descuento`) VALUES
(10, 'Pruebaaaaa', 'smdlkamsdkmalsmlmdk', 'Casa', 1280000.00, 'CDMX, centro', -10.00, 25.00, 625, 4, 2, 1, 'Disponible', '2025-04-01 03:18:48', 1, 40000.00),
(13, 'Nueva', 'epfjskñkñ{aa', 'Edificio', 12000000.00, 'CDMX, centro', 123.00, 123.00, 11325, 1, 4, 5, 'Vendido', '2025-04-01 20:42:26', 1, NULL),
(16, 'Nueva 2', 'Departamento moderno con recamaras en decoracion sencilla, patio y jardin tracero, ideal para una familia de 4 personas', 'Departamento', 1256000.00, 'Gerardo pedraza 8, uriangato', 150.00, 150.00, 3500, 4, 2, 1, 'Vendido', '2025-04-08 04:08:30', 1, NULL),
(22, 'Residencial Las palmas', 'dasndjansdjanknncjsnkcna', 'Bodega', 15000000.00, 'CDMX, centro', 20.00, 12.00, 12, 4, 2, 5, 'Vendido', '2025-04-09 14:39:14', 1, NULL),
(23, 'Residencial Nuevo', 'Residencial grande con jardin entre otros ', 'Casa', 15600000.00, 'CDMX, centro', 20.00, 12.00, 12, 4, 2, 5, 'Disponible', '2025-05-12 03:47:23', 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes_contacto`
--

CREATE TABLE `solicitudes_contacto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `mensaje` text NOT NULL,
  `fecha` timestamp NULL DEFAULT current_timestamp(),
  `respondido` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitudes_contacto`
--

INSERT INTO `solicitudes_contacto` (`id`, `nombre`, `email`, `telefono`, `mensaje`, `fecha`, `respondido`) VALUES
(21, 'Diana Martinez Cornejo', 's21120211@alumnos.itsur.edu.mx', '4433868406', 'dlkdlsmdakl', '2025-04-01 20:18:09', 1),
(22, 'Diana Martinez Cornejo', 's21120211@alumnos.itsur.edu.mx', '4433868406', ',l,ñsdl,fl', '2025-04-01 20:18:27', 1),
(23, 'Diana Martinez Cornejo', 's21120211@alumnos.itsur.edu.mx', '4433868406', ',l,ñsdl,fl', '2025-04-01 20:21:53', 1),
(24, 'Diana Martinez Cornejo', 's21120211@alumnos.itsur.edu.mx', '4433868406', ',l,ñsdl,fl', '2025-04-01 20:22:32', 1),
(25, 'Diana Martinez Cornejo', 's21120211@alumnos.itsur.edu.mx', '4433868406', ',l,ñsdl,fl', '2025-04-01 20:22:35', 1),
(26, 'Diana Martinez Cornejo', 's21120211@alumnos.itsur.edu.mx', '4433868406', ',l,ñsdl,fl', '2025-04-01 20:22:40', 1),
(27, 'Diana Martinez Cornejo', 's21120211@alumnos.itsur.edu.mx', '4433868406', ',l,ñsdl,fl', '2025-04-01 20:23:25', 1),
(28, 'Diana Martinez Cornejo', 's21120211@alumnos.itsur.edu.mx', '4433868406', ',l,ñsdl,fl', '2025-04-01 20:23:41', 1),
(29, 'Diana Martinez Cornejo', 's21120211@alumnos.itsur.edu.mx', '4433868406', ',l,ñsdl,fl', '2025-04-01 20:31:48', 1),
(30, 'Dulce Maria Rodríguez Alcantar', 's21120180@alumnos.itsur.edu.mx', '4451453843', 'Hola', '2025-04-09 02:21:22', 0),
(31, 'Dulce Maria Rodríguez Alcantar', 's21120180@alumnos.itsur.edu.mx', '4451453843', 'Hola', '2025-04-09 05:45:27', 0),
(32, 'Gabriel Garcia', 's21120180@alumnos.itsur.edu.mx', '4451453843', 'Hola', '2025-04-09 14:37:36', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes_contacto_user`
--

CREATE TABLE `solicitudes_contacto_user` (
  `id` int(11) NOT NULL,
  `id_propiedad` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` timestamp NULL DEFAULT current_timestamp(),
  `respondido` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitudes_contacto_user`
--

INSERT INTO `solicitudes_contacto_user` (`id`, `id_propiedad`, `id_usuario`, `fecha`, `respondido`) VALUES
(1, 16, 15, '2025-04-09 03:16:58', 1),
(2, 16, 15, '2025-04-09 03:18:44', 1),
(3, 16, 15, '2025-04-09 03:21:14', 1),
(4, 16, 15, '2025-04-09 03:21:18', 1),
(5, 16, 15, '2025-04-09 03:21:21', 1),
(6, 16, 15, '2025-04-09 03:22:20', 1),
(7, 16, 15, '2025-04-09 03:25:35', 1),
(8, 16, 15, '2025-04-09 03:26:01', 1),
(9, 16, 15, '2025-04-09 03:29:42', 1),
(10, 16, 15, '2025-04-09 03:49:47', 1),
(11, 16, 15, '2025-04-09 05:44:59', 0),
(12, 16, 15, '2025-04-09 14:04:58', 0),
(13, 10, 16, '2025-04-09 14:34:58', 0),
(14, 10, 16, '2025-04-09 14:35:22', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `contrasena` varchar(255) NOT NULL,
  `tipo` enum('admin','cliente') NOT NULL,
  `fecha_registro` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `telefono`, `contrasena`, `tipo`, `fecha_registro`) VALUES
(1, 'Admin Principal', 'admin@inmobiliaria.com', '1234567890', 'admin123', 'admin', '2025-03-23 20:01:05'),
(15, 'Dulce Maria Rodríguez Alcantar', 's21120180@alumnos.itsur.edu.mx', '4451453843', '#ROAD030825m', '', '2025-04-08 01:45:16'),
(16, 'Diana Martinez Cornejo', 's21120211@alumnos.itsur.edu.mx', '4433868406', 'Diana1234#', '', '2025-04-09 14:32:59');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `multimedia`
--
ALTER TABLE `multimedia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_propiedad` (`id_propiedad`);

--
-- Indices de la tabla `propiedades`
--
ALTER TABLE `propiedades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `solicitudes_contacto`
--
ALTER TABLE `solicitudes_contacto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `solicitudes_contacto_user`
--
ALTER TABLE `solicitudes_contacto_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_propiedad` (`id_propiedad`),
  ADD KEY `id_usuario` (`id_usuario`);

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
-- AUTO_INCREMENT de la tabla `multimedia`
--
ALTER TABLE `multimedia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT de la tabla `propiedades`
--
ALTER TABLE `propiedades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `solicitudes_contacto`
--
ALTER TABLE `solicitudes_contacto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `solicitudes_contacto_user`
--
ALTER TABLE `solicitudes_contacto_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `multimedia`
--
ALTER TABLE `multimedia`
  ADD CONSTRAINT `multimedia_ibfk_1` FOREIGN KEY (`id_propiedad`) REFERENCES `propiedades` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `propiedades`
--
ALTER TABLE `propiedades`
  ADD CONSTRAINT `propiedades_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `solicitudes_contacto_user`
--
ALTER TABLE `solicitudes_contacto_user`
  ADD CONSTRAINT `solicitudes_contacto_user_ibfk_1` FOREIGN KEY (`id_propiedad`) REFERENCES `propiedades` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `solicitudes_contacto_user_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
