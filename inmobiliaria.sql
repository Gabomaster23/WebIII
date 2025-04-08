-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-04-2025 a las 06:47:07
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

--
-- Volcado de datos para la tabla `multimedia`
--

INSERT INTO `multimedia` (`id`, `id_propiedad`, `tipo`, `url`, `fecha_subida`) VALUES
(25, 10, 'Imagen', '/WebIII/Inmobiliaria/Casas/10/Principal.jpg', '2025-04-01 03:18:48'),
(26, 10, 'Imagen', '/WebIII/Inmobiliaria/Casas/10/1.jpg', '2025-04-01 03:18:48'),
(27, 10, 'Imagen', '/WebIII/Inmobiliaria/Casas/10/2.jpg', '2025-04-01 03:18:48'),
(28, 10, 'Imagen', '/WebIII/Inmobiliaria/Casas/10/3.jpg', '2025-04-01 03:18:48'),
(29, 10, 'Imagen', '/WebIII/Inmobiliaria/Casas/10/4.jpg', '2025-04-01 03:18:48'),
(40, 13, 'Imagen', '/WebIII/Inmobiliaria/Casas/13/Principal.jpg', '2025-04-01 20:42:26'),
(41, 13, 'Imagen', '/WebIII/Inmobiliaria/Casas/13/1.jpg', '2025-04-01 20:42:26'),
(42, 13, 'Imagen', '/WebIII/Inmobiliaria/Casas/13/2.jpg', '2025-04-01 20:42:26'),
(43, 13, 'Imagen', '/WebIII/Inmobiliaria/Casas/13/3.jpg', '2025-04-01 20:42:26'),
(44, 13, 'Imagen', '/WebIII/Inmobiliaria/Casas/13/4.jpg', '2025-04-01 20:42:26'),
(56, 16, 'Imagen', '/WebIII/Inmobiliaria/Casas/16/Principal.jpg', '2025-04-08 04:08:30'),
(57, 16, 'Imagen', '/WebIII/Inmobiliaria/Casas/16/1.jpg', '2025-04-08 04:08:30'),
(58, 16, 'Imagen', '/WebIII/Inmobiliaria/Casas/16/2.jpg', '2025-04-08 04:08:30'),
(59, 16, 'Imagen', '/WebIII/Inmobiliaria/Casas/16/3.jpg', '2025-04-08 04:08:30'),
(60, 16, 'Imagen', '/WebIII/Inmobiliaria/Casas/16/4.jpg', '2025-04-08 04:08:30');

--
-- Volcado de datos para la tabla `propiedades`
--

INSERT INTO `propiedades` (`id`, `titulo`, `descripcion`, `tipo`, `precio`, `ubicacion`, `ancho`, `largo`, `area`, `num_habitaciones`, `num_banos`, `estacionamiento`, `estado`, `fecha_registro`, `id_usuario`) VALUES
(10, 'Pruebaaaaa', 'smdlkamsdkmalsmlmdk', 'Casa', 1280000.00, 'CDMX, centro', 25.00, 25.00, 625, 4, 2, 1, 'Disponible', '2025-04-01 03:18:48', 1),
(13, 'Nueva', 'epfjskñkñ{aa', 'Edificio', 12.00, 'CDMX, centro', 123.00, 123.00, 11325, 4, 4, 5, 'Disponible', '2025-04-01 20:42:26', 1),
(16, 'Nueva 2', 'Departamento moderno con recamaras en decoracion sencilla, patio y jardin tracero, ideal para una familia de 4 personas', 'Departamento', 1256000.00, 'Gerardo pedraza 8, uriangato', 150.00, 150.00, 3500, 4, 2, 1, 'Disponible', '2025-04-08 04:08:30', 1);

--
-- Volcado de datos para la tabla `solicitudes_contacto`
--

INSERT INTO `solicitudes_contacto` (`id`, `nombre`, `email`, `telefono`, `mensaje`, `fecha`) VALUES
(21, 'Diana Martinez Cornejo', 's21120211@alumnos.itsur.edu.mx', '4433868406', 'dlkdlsmdakl', '2025-04-01 20:18:09'),
(22, 'Diana Martinez Cornejo', 's21120211@alumnos.itsur.edu.mx', '4433868406', ',l,ñsdl,fl', '2025-04-01 20:18:27'),
(23, 'Diana Martinez Cornejo', 's21120211@alumnos.itsur.edu.mx', '4433868406', ',l,ñsdl,fl', '2025-04-01 20:21:53'),
(24, 'Diana Martinez Cornejo', 's21120211@alumnos.itsur.edu.mx', '4433868406', ',l,ñsdl,fl', '2025-04-01 20:22:32'),
(25, 'Diana Martinez Cornejo', 's21120211@alumnos.itsur.edu.mx', '4433868406', ',l,ñsdl,fl', '2025-04-01 20:22:35'),
(26, 'Diana Martinez Cornejo', 's21120211@alumnos.itsur.edu.mx', '4433868406', ',l,ñsdl,fl', '2025-04-01 20:22:40'),
(27, 'Diana Martinez Cornejo', 's21120211@alumnos.itsur.edu.mx', '4433868406', ',l,ñsdl,fl', '2025-04-01 20:23:25'),
(28, 'Diana Martinez Cornejo', 's21120211@alumnos.itsur.edu.mx', '4433868406', ',l,ñsdl,fl', '2025-04-01 20:23:41'),
(29, 'Diana Martinez Cornejo', 's21120211@alumnos.itsur.edu.mx', '4433868406', ',l,ñsdl,fl', '2025-04-01 20:31:48');

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `telefono`, `contrasena`, `tipo`, `fecha_registro`) VALUES
(1, 'Admin Principal', 'admin@inmobiliaria.com', '1234567890', 'admin123', 'admin', '2025-03-23 20:01:05'),
(15, 'Dulce Maria Rodríguez Alcantar', 's21120180@alumnos.itsur.edu.mx', '4451453843', '#ROAD030825m', '', '2025-04-08 01:45:16');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
