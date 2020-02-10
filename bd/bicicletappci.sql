-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-02-2020 a las 12:28:37
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bicicletappci`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_piezas_bicicleta`
--

CREATE TABLE `categorias_piezas_bicicleta` (
  `categoria_piezas_bicicleta_id` int(11) NOT NULL COMMENT 'Identificador de las categorias de las piezas de la bicicleta',
  `categoria_piezas_bicicleta_name` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT 'Nombre de la categoria',
  `categoria_piezas_bicicleta_photo` text COLLATE utf8_bin COMMENT 'Foto de la categoria',
  `categoria_piezas_bicicleta_create` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha de creación de la categoria',
  `categoria_piezas_bicicleta_update` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de actualización de la categoria\n',
  `categoria_piezas_status` enum('0','1') COLLATE utf8_bin DEFAULT NULL COMMENT 'Estado de la categoria\n0 = Inhabilitado\n1 = Habilitado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `categorias_piezas_bicicleta`
--

INSERT INTO `categorias_piezas_bicicleta` (`categoria_piezas_bicicleta_id`, `categoria_piezas_bicicleta_name`, `categoria_piezas_bicicleta_photo`, `categoria_piezas_bicicleta_create`, `categoria_piezas_bicicleta_update`, `categoria_piezas_status`) VALUES
(1, 'Pedal', 'uploads/categorias/24_01_20/1579896510_3235253acb1c7d6e6a7d.png', '2019-12-27 13:31:34', '2020-01-24 16:08:32', NULL),
(2, 'Rueda', 'uploads/categorias/24_01_20/1579896473_576b7cc8099af3b5f6e4.png', '2019-12-27 21:53:07', '2020-02-07 19:16:57', NULL),
(3, 'Aciento editado', 'uploads/categorias/07_02_20/1581117443_d88b1c71111da9b509a0.jpg', '2019-12-27 21:53:54', '2020-02-07 19:17:29', NULL),
(4, 'editando', 'uploads/categorias/07_02_20/1581117459_0b015b5f2b960f7d01a8.jpg', '2019-12-27 22:01:42', '2020-02-07 19:17:41', NULL),
(5, 'pruebaeditar', 'uploads/categorias/29_12_19/1577634295_34e17ed39c722c6d6d46.png', '2019-12-27 22:02:05', '2019-12-29 11:44:57', NULL),
(6, 'prueba', 'uploads/categorias/21_01_20/1579608187_b8e8c1c2cae3a02a2706.png', '2020-01-21 08:03:10', NULL, '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foros`
--

CREATE TABLE `foros` (
  `foro_id` int(11) NOT NULL COMMENT 'Identificador del foro',
  `foro_name` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT 'Nombre del foro',
  `foro_file` text COLLATE utf8_bin COMMENT 'Archivo o Foto del foro',
  `foro_create` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha de creación del foro',
  `foro_update` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de actualización del foro',
  `foro_eliminado` enum('0','1') COLLATE utf8_bin DEFAULT NULL COMMENT 'Verifica si el foro esta eliminado o no:\n0 = eliminado\n1 = activo',
  `user_id` int(11) NOT NULL COMMENT 'Id de la tabla user\nEsto es para saber quien fue el usuario que creo determinado foro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `foros`
--

INSERT INTO `foros` (`foro_id`, `foro_name`, `foro_file`, `foro_create`, `foro_update`, `foro_eliminado`, `user_id`) VALUES
(1, 'Foro editado desde App', 'uploads/foros/03_02_20/1580780797_0a444f3ab541a92e41dd.jpg', '2020-02-02 11:03:41', '2020-02-03 21:49:58', '1', 1),
(2, 'Otro foro mas', 'uploads/foros/02_02_20/1580671744_8b1c1fe0a795bb7e00a4.jpg', '2020-02-02 15:29:06', '2020-02-03 21:51:31', '0', 1),
(3, 'Foro de producción', 'uploads/foros/03_02_20/1580762605_0894626fa22f35f0108c.jpg', '2020-02-02 16:06:40', '2020-02-08 23:20:47', '1', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes_pieza_bicicleta`
--

CREATE TABLE `imagenes_pieza_bicicleta` (
  `imagen_pieza_bicicleta_id` int(11) NOT NULL COMMENT 'Identificador de la imagen de la pieza',
  `imagen_pieza_bicicleta_file` text COLLATE utf8_bin COMMENT 'Foto de la pieza de la bicicleta',
  `imagen_pieza_bicicleta_tipo` enum('0','1') COLLATE utf8_bin DEFAULT '0' COMMENT 'si es 0 la imagen es secundaria, si es 1 es principal',
  `imagen_pieza_bicicleta_create` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha de creación de la imagen',
  `imagen_pieza_bicicleta_update` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de actualización de la imagen',
  `pieza_bicicleta_id` int(11) NOT NULL COMMENT 'Id de la pieza de la bicicleta'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `imagenes_pieza_bicicleta`
--

INSERT INTO `imagenes_pieza_bicicleta` (`imagen_pieza_bicicleta_id`, `imagen_pieza_bicicleta_file`, `imagen_pieza_bicicleta_tipo`, `imagen_pieza_bicicleta_create`, `imagen_pieza_bicicleta_update`, `pieza_bicicleta_id`) VALUES
(1, 'uploads/piezas/02_02_20/1580657023_ee65cfea0e6948c14c75.png', '1', '2020-02-02 11:23:46', '2020-02-05 20:07:06', 1),
(3, 'uploads/piezas/03_02_20/1580777272_650196ca2b6e789e162c.png', '0', '2020-02-03 20:47:55', '2020-02-06 19:33:43', 2),
(10, 'uploads/piezas/05_02_20/1580933370_fb1c34dd46bf3ce731ec.jpg', '0', '2020-02-05 16:09:36', '2020-02-05 21:30:57', 2),
(12, 'uploads/piezas/05_02_20/1580934314_c0a707fefc13283345ed.jpg', '1', '2020-02-05 16:25:16', '2020-02-06 19:33:43', 2),
(13, 'uploads/piezas/05_02_20/1580934335_bf36d61d347942489dd8.jpg', '0', '2020-02-05 16:25:38', '2020-02-05 20:06:55', 1),
(14, 'uploads/piezas/05_02_20/1580934335_03301726e143c9989d4e.jpg', '0', '2020-02-05 16:25:38', NULL, 1),
(15, 'uploads/piezas/05_02_20/1580934335_447a0f637627272dd9f0.jpg', '0', '2020-02-05 16:25:38', '2020-02-05 20:07:06', 1),
(16, 'uploads/piezas/05_02_20/1580947613_a709207e1abd4f71640c.jpg', '0', '2020-02-05 20:06:55', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes_foro`
--

CREATE TABLE `mensajes_foro` (
  `mensaje_foro_id` int(11) NOT NULL COMMENT 'Identificador del mensaje del foro',
  `mensaje_foro_mens` text COLLATE utf8_bin COMMENT 'Mensaje del foro',
  `mensaje_foro_file` text COLLATE utf8_bin COMMENT 'Archivo del foro',
  `mensaje_foro_create` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha de creación del mensaje del foro',
  `mensaje_eliminado` enum('0','1') COLLATE utf8_bin DEFAULT NULL COMMENT 'Verifica si el mensaje esta eliminado o no:\n0 = eliminado\n1 = activo',
  `foro_id` int(11) NOT NULL COMMENT 'Id de la tabla foros',
  `user_id` int(11) NOT NULL COMMENT 'Id de la tabla users'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `mensajes_foro`
--

INSERT INTO `mensajes_foro` (`mensaje_foro_id`, `mensaje_foro_mens`, `mensaje_foro_file`, `mensaje_foro_create`, `mensaje_eliminado`, `foro_id`, `user_id`) VALUES
(1, 'Hola', NULL, '2020-02-02 11:04:00', '1', 1, 1),
(2, 'como estas hoy', NULL, '2020-02-02 11:04:10', '1', 1, 1),
(3, NULL, 'uploads/foros/02_02_20/1580655858_e965c4b96a906e1768c0.png', '2020-02-02 11:04:18', '1', 1, 1),
(4, NULL, 'uploads/foros/02_02_20/1580655880_6f80be304034dd62720d.jpg', '2020-02-02 11:04:40', '1', 1, 1),
(5, NULL, 'uploads/foros/02_02_20/1580660045_a91f137b8ee69f2fbff3.jpg', '2020-02-02 12:14:05', '1', 1, 1),
(6, NULL, 'uploads/foros/02_02_20/1580660063_2e3ff340bed3df9b6c53.jpg', '2020-02-02 12:14:23', '1', 1, 1),
(7, 'Juan', NULL, '2020-02-02 12:14:32', '1', 1, 1),
(8, NULL, 'uploads/foros/02_02_20/1580660462_8b2df153474e4dedcd0c.png', '2020-02-02 12:21:02', '1', 1, 3),
(9, 'hello', NULL, '2020-02-02 12:21:07', '1', 1, 3),
(10, 'Jdd', NULL, '2020-02-02 12:21:12', '1', 1, 1),
(11, NULL, 'uploads/foros/02_02_20/1580660493_71e0a1403cb35f27158f.jpg', '2020-02-02 12:21:33', '1', 1, 1),
(12, 'fasfds', NULL, '2020-02-02 12:21:56', '1', 1, 1),
(13, NULL, 'uploads/foros/02_02_20/1580661601_6eaef4e82d4a5c12da49.png', '2020-02-02 12:40:01', '1', 1, 3),
(14, NULL, 'uploads/foros/02_02_20/1580671772_34920eea47bf02c47515.jpg', '2020-02-02 15:29:32', '1', 1, 1),
(15, 'Hola', NULL, '2020-02-02 15:29:40', '1', 1, 1),
(16, NULL, 'uploads/foros/02_02_20/1580671803_0857297b3bedb9a4b348.jpg', '2020-02-02 15:30:03', '1', 1, 1),
(17, 'Hola', NULL, '2020-02-02 16:06:55', '1', 3, 3),
(18, NULL, 'uploads/foros/02_02_20/1580674025_bf49872bdc870658aae6.jpg', '2020-02-02 16:07:05', '1', 3, 3),
(19, 'hola ms', NULL, '2020-02-02 16:07:29', '1', 3, 1),
(20, NULL, 'uploads/foros/02_02_20/1580674061_cc118967542e42a4140a.png', '2020-02-02 16:07:41', '1', 3, 1),
(21, 'Jajaj', NULL, '2020-02-02 16:07:49', '1', 3, 3),
(22, 'df', NULL, '2020-02-02 21:02:21', '1', 1, 1),
(23, NULL, 'uploads/foros/02_02_20/1580691747_ae4425578bcb05ce58a2.png', '2020-02-02 21:02:27', '1', 1, 1),
(24, 'Msksns', NULL, '2020-02-03 14:31:40', '1', 2, 3),
(25, NULL, 'uploads/foros/03_02_20/1580754719_1e95432d63a03fadd6ba.jpg', '2020-02-03 14:31:59', '1', 2, 3),
(26, NULL, 'uploads/foros/03_02_20/1580754742_6448a5bc8b1caa3b8243.jpg', '2020-02-03 14:32:22', '1', 2, 3),
(27, 'Más nada', NULL, '2020-02-03 15:32:15', '1', 3, 3),
(28, 'dsf', NULL, '2020-02-03 19:18:44', '1', 3, 1),
(29, NULL, 'uploads/foros/03_02_20/1580771941_44111379eb4c34080d28.jpg', '2020-02-03 19:19:01', '1', 3, 3),
(30, 'Jsjs', NULL, '2020-02-03 19:21:18', '1', 1, 1),
(31, NULL, 'uploads/foros/03_02_20/1580772104_790f2746c4b66ad7377e.jpg', '2020-02-03 19:21:44', '1', 1, 1),
(32, 'Hka', NULL, '2020-02-03 20:42:08', '1', 2, 1),
(33, NULL, 'uploads/foros/03_02_20/1580779764_b50e785530a9a235d881.jpg', '2020-02-03 21:29:24', '1', 2, 1),
(34, 'Hola', NULL, '2020-02-05 19:12:52', '1', 3, 3),
(35, 'Hola', NULL, '2020-02-05 19:13:12', '1', 3, 3),
(36, 'jkh', NULL, '2020-02-05 19:13:18', '1', 3, 1),
(37, NULL, 'uploads/foros/05_02_20/1580944403_5aaa7d97999c12825e9c.jpg', '2020-02-05 19:13:23', '1', 3, 1),
(38, NULL, 'uploads/foros/05_02_20/1580944433_43540e930ff29159c982.jpg', '2020-02-05 19:13:53', '1', 3, 3),
(39, 'Hola', NULL, '2020-02-06 19:56:32', '1', 3, 3),
(40, NULL, 'uploads/foros/06_02_20/1581033415_c47570c20aaa9a3d66e9.jpg', '2020-02-06 19:56:55', '1', 3, 3),
(41, NULL, 'uploads/foros/07_02_20/1581100181_82e128a4e6476bf6d6e5.jpg', '2020-02-07 14:29:41', '1', 1, 1),
(42, 'sadf', NULL, '2020-02-07 14:29:45', '1', 1, 1),
(43, 'Hola mucho', NULL, '2020-02-08 23:19:07', '1', 3, 3),
(44, 'Hola', NULL, '2020-02-08 23:42:47', '1', 3, 3),
(45, '????????????????', NULL, '2020-02-09 00:42:03', '1', 1, 3),
(46, 'Hola', NULL, '2020-02-09 05:09:38', '1', 3, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `niveles_quiz`
--

CREATE TABLE `niveles_quiz` (
  `nivel_quiz_id` int(11) NOT NULL COMMENT 'Identificador del nivel del quiz',
  `nivel_quiz_nivel` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT 'Nivel del quiz',
  `nivel_quiz_status` enum('0','1') COLLATE utf8_bin NOT NULL COMMENT 'si esta en 0 es porque esta inactivo, si esta en 1 es porque esta activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `niveles_quiz`
--

INSERT INTO `niveles_quiz` (`nivel_quiz_id`, `nivel_quiz_nivel`, `nivel_quiz_status`) VALUES
(1, 'Nivel 1', '1'),
(2, 'Nivel 2', '1'),
(3, 'Nivel 3', '1'),
(4, 'Nivel 4', '0'),
(12, 'Nivel 5', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `piezas_bicicleta`
--

CREATE TABLE `piezas_bicicleta` (
  `pieza_bicicleta_id` int(11) NOT NULL COMMENT 'Identificador de la pieza de la bicicleta',
  `pieza_bicicleta_name` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT 'Nombre de la pieza de la bicicleta',
  `pieza_bicicleta_description` text COLLATE utf8_bin COMMENT 'Descripción de la pieza de la bicicleta',
  `pieza_bicicleta_create` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha de creación de la pieza',
  `pieza_bicicleta_update` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de actualización de la pieza',
  `pieza_bicicleta_status` enum('0','1') COLLATE utf8_bin DEFAULT NULL COMMENT 'Estado de la pieza de la bicicleta\n0 = Inhabilitado\n1 = habilitado',
  `categoria_piezas_bicicleta_id` int(11) NOT NULL COMMENT 'Id de la tabla categorias_piezas_bicicleta\n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `piezas_bicicleta`
--

INSERT INTO `piezas_bicicleta` (`pieza_bicicleta_id`, `pieza_bicicleta_name`, `pieza_bicicleta_description`, `pieza_bicicleta_create`, `pieza_bicicleta_update`, `pieza_bicicleta_status`, `categoria_piezas_bicicleta_id`) VALUES
(1, 'Pedal nuevo dsa', 'pedal asd asdlfkj l sdj', '2020-02-02 11:23:46', '2020-02-05 16:26:09', '1', 5),
(2, 'rueda pieza nueva', 'DESCRIPCION', '2020-02-03 20:47:55', '2020-02-06 19:33:52', '0', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `quiz_bicicletas`
--

CREATE TABLE `quiz_bicicletas` (
  `quiz_bicicleta_id` int(11) NOT NULL COMMENT 'Identificador del quiz',
  `quiz_bicicleta_pregunta` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT 'Pregunta del quiz',
  `quiz_bicicleta_file` text COLLATE utf8_bin COMMENT 'Foto o Archivo de la pregunta',
  `quiz_bicicleta_create` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha de creación de la pregunta del quiz',
  `quiz_bicicleta_update` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de actualización de la pregunta del quiz',
  `nivel_quiz_id` int(11) NOT NULL COMMENT 'Id de la tabla niveles_quiz'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `quiz_bicicletas`
--

INSERT INTO `quiz_bicicletas` (`quiz_bicicleta_id`, `quiz_bicicleta_pregunta`, `quiz_bicicleta_file`, `quiz_bicicleta_create`, `quiz_bicicleta_update`, `nivel_quiz_id`) VALUES
(1, 'pregunta 1', 'uploads/quiz_preguntas/21_01_20/1579633939_a59c764b0e7023b32bf5.png', '2020-01-21 15:12:28', NULL, 1),
(3, 'pregunta 3 new', '', '2020-02-01 21:31:23', '2020-02-07 14:24:07', 3),
(4, 'pregunta 3', 'uploads/quiz_preguntas/06_02_20/1581034580_3230da80a58fa985a7fc.jpeg', '2020-02-06 20:16:23', NULL, 2),
(5, 'pregunta 4', 'uploads/quiz_preguntas/06_02_20/1581034580_3230da80a58fa985a7fc.jpeg', '2020-02-06 20:16:35', '2020-02-09 02:58:05', 2),
(6, 'pregunta editada', 'uploads/quiz_preguntas/07_02_20/1581100101_a3e61c4cba99c9632fe8.jpg', '2020-02-07 14:26:22', '2020-02-09 02:58:19', 2),
(7, 'pregunta nueva', 'uploads/quiz_preguntas/07_02_20/1581100135_0e4597ac2557336dd854.jpg', '2020-02-07 14:29:06', NULL, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas_quiz`
--

CREATE TABLE `respuestas_quiz` (
  `respuesta_quiz_id` int(11) NOT NULL COMMENT 'Identificador de la respuesta del quiz',
  `respuesta_quiz_resp` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT 'Respuesta del quiz',
  `respuesta_quiz_correcta` enum('0','1') COLLATE utf8_bin DEFAULT NULL COMMENT 'Verifica si la respuesta es la correcta:\n0 = Incorrecta\n1 = Correcta',
  `respuesta_quiz_tipo` varchar(50) COLLATE utf8_bin NOT NULL COMMENT 'Tipo de respuesta',
  `quiz_bicicleta_id` int(11) NOT NULL COMMENT 'Id de la tabla quiz_bicicletas'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `respuestas_quiz`
--

INSERT INTO `respuestas_quiz` (`respuesta_quiz_id`, `respuesta_quiz_resp`, `respuesta_quiz_correcta`, `respuesta_quiz_tipo`, `quiz_bicicleta_id`) VALUES
(1, '1', '0', 'unica', 1),
(6, 'respuesta 1', '0', 'multiple', 3),
(7, 'respuesta 2', '0', 'multiple', 3),
(8, 'respuesta 3', '1', 'multiple', 3),
(9, 'respuesta 4', '0', 'multiple', 3),
(10, NULL, '1', 'unica', 4),
(11, NULL, '0', 'unica', 5),
(12, '0', '1', 'unica', 6),
(13, 'respuesta', '0', 'multiple', 7),
(14, 'lajs as', '0', 'multiple', 7),
(15, 'lkjsadf ', '0', 'multiple', 7),
(16, 'lkjasdf', '1', 'multiple', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL COMMENT 'Identificador del Usuario',
  `user_name` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT 'Nombre del usuario',
  `user_email` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT 'Correo del usuario',
  `user_password` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT 'Contraseña del usuario',
  `user_remenber_password` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT 'Hash para recordar contraseña ',
  `user_photo` text COLLATE utf8_bin COMMENT 'Foto del usuario',
  `user_phone` text COLLATE utf8_bin COMMENT 'Telefono del usuario',
  `user_push_token` text COLLATE utf8_bin COMMENT 'Token del usuario',
  `user_type` enum('0','1') COLLATE utf8_bin DEFAULT '0' COMMENT 'Tipo de usuario:\n0=General\n1=Administrador',
  `user_status` enum('0','1') COLLATE utf8_bin DEFAULT '1' COMMENT 'Estado del usuario:\n0= Inactivo\n1= Activo',
  `user_create` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha de creación del usuario',
  `user_update` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de actualización del usuario',
  `user_code_verificacion` varchar(45) COLLATE utf8_bin NOT NULL COMMENT 'Codigo para verificar el correo enviado al usuario y poder restaurar la contraseña'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`, `user_remenber_password`, `user_photo`, `user_phone`, `user_push_token`, `user_type`, `user_status`, `user_create`, `user_update`, `user_code_verificacion`) VALUES
(1, 'Juan David', '97juandcm11@gmail.com', '$2y$10$BE6yVwNBEuojZGSJiuuTUeNNo2Nsf/ei4niQoLWkKiuqsWWADTiL.', NULL, 'uploads/foto_usuario/03_02_20/1580780438_abf551a25605b3b8c26c.jpg', '(105) 406-5465', 'ExponentPushToken[niuxBTAFWicT8HHuNE3mMl]', '1', '1', '2019-12-19 13:13:15', '2020-02-09 03:39:13', '4521'),
(2, 'miguel', 'a@a.a', '$2y$10$12liCa4KtVyfnFFv2qqfcuw8S3nUzN6xILTwhgix9y0grDdotf4TO', NULL, 'uploads/foto_usuario/22_12_19/1576988607_e45972668c4f124fdf82.png', '(343) 453-4534', NULL, '1', '0', '2019-12-21 10:38:35', '2020-02-02 15:05:25', ''),
(3, 'nombremejor', 'email@email.com', '$2y$10$12liCa4KtVyfnFFv2qqfcuw8S3nUzN6xILTwhgix9y0grDdotf4TO', NULL, 'uploads/foto_usuario/29_01_20/1580340597_f581385addbc73c55ce9.png', '489948', NULL, '1', '1', '2019-12-30 11:55:52', '2020-02-09 05:09:16', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_quiz`
--

CREATE TABLE `user_quiz` (
  `user_quiz_id` int(11) NOT NULL COMMENT 'Identificador del usuario y quiz que se realizo\n',
  `user_quiz_puntaje` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT 'Puntaje del usuario en el quiz',
  `user_quiz_create` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha de realización del Quiz',
  `respuesta_quiz_id` int(11) NOT NULL COMMENT 'Id de la tabla respuestas_quiz\n',
  `user_id` int(11) NOT NULL COMMENT 'Id del usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias_piezas_bicicleta`
--
ALTER TABLE `categorias_piezas_bicicleta`
  ADD PRIMARY KEY (`categoria_piezas_bicicleta_id`);

--
-- Indices de la tabla `foros`
--
ALTER TABLE `foros`
  ADD PRIMARY KEY (`foro_id`),
  ADD KEY `fk_foros_users_idx` (`user_id`);

--
-- Indices de la tabla `imagenes_pieza_bicicleta`
--
ALTER TABLE `imagenes_pieza_bicicleta`
  ADD PRIMARY KEY (`imagen_pieza_bicicleta_id`),
  ADD KEY `fk_imagenes_pieza_bicicleta_piezas_bicicleta1_idx` (`pieza_bicicleta_id`);

--
-- Indices de la tabla `mensajes_foro`
--
ALTER TABLE `mensajes_foro`
  ADD PRIMARY KEY (`mensaje_foro_id`),
  ADD KEY `fk_mensajes_foro_foros1_idx` (`foro_id`),
  ADD KEY `fk_mensajes_foro_users1_idx` (`user_id`);

--
-- Indices de la tabla `niveles_quiz`
--
ALTER TABLE `niveles_quiz`
  ADD PRIMARY KEY (`nivel_quiz_id`);

--
-- Indices de la tabla `piezas_bicicleta`
--
ALTER TABLE `piezas_bicicleta`
  ADD PRIMARY KEY (`pieza_bicicleta_id`),
  ADD KEY `fk_piezas_bicicleta_categorias_piezas_bicicleta1_idx` (`categoria_piezas_bicicleta_id`);

--
-- Indices de la tabla `quiz_bicicletas`
--
ALTER TABLE `quiz_bicicletas`
  ADD PRIMARY KEY (`quiz_bicicleta_id`),
  ADD KEY `fk_quiz_bicicletas_niveles_quiz1_idx` (`nivel_quiz_id`);

--
-- Indices de la tabla `respuestas_quiz`
--
ALTER TABLE `respuestas_quiz`
  ADD PRIMARY KEY (`respuesta_quiz_id`),
  ADD KEY `fk_respuestas_quiz_quiz_bicicletas1_idx` (`quiz_bicicleta_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indices de la tabla `user_quiz`
--
ALTER TABLE `user_quiz`
  ADD PRIMARY KEY (`user_quiz_id`),
  ADD KEY `fk_user_quiz_respuestas_quiz1_idx` (`respuesta_quiz_id`),
  ADD KEY `fk_user_quiz_users1_idx` (`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias_piezas_bicicleta`
--
ALTER TABLE `categorias_piezas_bicicleta`
  MODIFY `categoria_piezas_bicicleta_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de las categorias de las piezas de la bicicleta', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `foros`
--
ALTER TABLE `foros`
  MODIFY `foro_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del foro', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `imagenes_pieza_bicicleta`
--
ALTER TABLE `imagenes_pieza_bicicleta`
  MODIFY `imagen_pieza_bicicleta_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la imagen de la pieza', AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `mensajes_foro`
--
ALTER TABLE `mensajes_foro`
  MODIFY `mensaje_foro_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del mensaje del foro', AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `niveles_quiz`
--
ALTER TABLE `niveles_quiz`
  MODIFY `nivel_quiz_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del nivel del quiz', AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `piezas_bicicleta`
--
ALTER TABLE `piezas_bicicleta`
  MODIFY `pieza_bicicleta_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la pieza de la bicicleta', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `quiz_bicicletas`
--
ALTER TABLE `quiz_bicicletas`
  MODIFY `quiz_bicicleta_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del quiz', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `respuestas_quiz`
--
ALTER TABLE `respuestas_quiz`
  MODIFY `respuesta_quiz_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la respuesta del quiz', AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del Usuario', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `user_quiz`
--
ALTER TABLE `user_quiz`
  MODIFY `user_quiz_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del usuario y quiz que se realizo\n';

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `foros`
--
ALTER TABLE `foros`
  ADD CONSTRAINT `fk_foros_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `imagenes_pieza_bicicleta`
--
ALTER TABLE `imagenes_pieza_bicicleta`
  ADD CONSTRAINT `fk_imagenes_pieza_bicicleta_piezas_bicicleta1` FOREIGN KEY (`pieza_bicicleta_id`) REFERENCES `piezas_bicicleta` (`pieza_bicicleta_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `mensajes_foro`
--
ALTER TABLE `mensajes_foro`
  ADD CONSTRAINT `fk_mensajes_foro_foros1` FOREIGN KEY (`foro_id`) REFERENCES `foros` (`foro_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_mensajes_foro_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `piezas_bicicleta`
--
ALTER TABLE `piezas_bicicleta`
  ADD CONSTRAINT `fk_piezas_bicicleta_categorias_piezas_bicicleta1` FOREIGN KEY (`categoria_piezas_bicicleta_id`) REFERENCES `categorias_piezas_bicicleta` (`categoria_piezas_bicicleta_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `quiz_bicicletas`
--
ALTER TABLE `quiz_bicicletas`
  ADD CONSTRAINT `fk_quiz_bicicletas_niveles_quiz1` FOREIGN KEY (`nivel_quiz_id`) REFERENCES `niveles_quiz` (`nivel_quiz_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `respuestas_quiz`
--
ALTER TABLE `respuestas_quiz`
  ADD CONSTRAINT `fk_respuestas_quiz_quiz_bicicletas1` FOREIGN KEY (`quiz_bicicleta_id`) REFERENCES `quiz_bicicletas` (`quiz_bicicleta_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `user_quiz`
--
ALTER TABLE `user_quiz`
  ADD CONSTRAINT `fk_user_quiz_respuestas_quiz1` FOREIGN KEY (`respuesta_quiz_id`) REFERENCES `respuestas_quiz` (`respuesta_quiz_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_quiz_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
