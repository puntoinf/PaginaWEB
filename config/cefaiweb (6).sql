-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-05-2018 a las 22:32:17
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cefaiweb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo`
--

CREATE TABLE `archivo` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `titulo` varchar(125) DEFAULT NULL,
  `descripcion` text,
  `ruta` varchar(256) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `revisado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera`
--

CREATE TABLE `carrera` (
  `id` int(11) NOT NULL,
  `nombre` varchar(125) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_foro`
--

CREATE TABLE `categoria_foro` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(125) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categoria_foro`
--

INSERT INTO `categoria_foro` (`id`, `descripcion`) VALUES
(1, 'Consulta'),
(2, 'Parcial'),
(3, 'Final'),
(4, 'Cursado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `id` int(11) NOT NULL,
  `id_noticia` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `comentario` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `correlativa`
--

CREATE TABLE `correlativa` (
  `id` int(11) NOT NULL,
  `id_elegida` int(11) NOT NULL,
  `id_requerida` int(11) NOT NULL,
  `elegidanombre` varchar(125) DEFAULT NULL,
  `requeridanombre` varchar(125) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id` int(11) NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `descripcion` varchar(125) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id`, `id_tipo`, `descripcion`) VALUES
(1, 1, 'Abierto'),
(2, 1, 'Cerrado'),
(3, 1, 'Resuelto'),
(4, 3, 'Abierto'),
(5, 3, 'Cerrado'),
(6, 4, 'Autorizado'),
(7, 4, 'Pendiente'),
(8, 4, 'Rechazado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE `evento` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(125) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `lugar` varchar(100) DEFAULT NULL,
  `desde` datetime DEFAULT NULL,
  `hasta` datetime DEFAULT NULL,
  `es_feriado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foro`
--

CREATE TABLE `foro` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `titulo` varchar(125) DEFAULT NULL,
  `texto` text,
  `fecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `foro`
--

INSERT INTO `foro` (`id`, `id_usuario`, `id_estado`, `id_categoria`, `titulo`, `texto`, `fecha`) VALUES
(1, 1, 1, 1, 'Final Algebra', 'Hola buen dia, Queria consultar en que aula se tomara el final de \"Elementos de algebra\" del dia 12/12/17', '2017-12-12 13:12:11'),
(2, 7, 2, 2, 'parcial RPyA', 'Queria preguntar si alguien tiene algun simulagro de parcial de años anteriores', '2017-06-21 05:12:06'),
(3, 6, 3, 4, 'Cursado ingles', '¿Que dias se cursa ingles tecnico?', '2017-03-08 11:12:47'),
(4, 4, 1, 1, 'Boleto Estudiantil', '¿Donde se puede hacer el tramite para el boleto estudiantil?.Gracias por su ayuda', '2018-02-21 11:18:16'),
(5, 6, 3, 4, 'Cursado Poo', '¿Que dias se cursa programacion orientada a objetos?', '2017-02-08 12:13:47'),
(6, 4, 1, 1, 'Reintegro', '¿Donde se puede hacer el tramite para el reintegro de dinero?.Saludos', '2018-05-21 12:11:16'),
(7, 7, 1, 4, 'asdfasd', 'asdfasdf', '2018-05-28 04:04:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario_cursado`
--

CREATE TABLE `horario_cursado` (
  `id` int(11) NOT NULL,
  `hora` time DEFAULT NULL,
  `aula` int(11) NOT NULL,
  `id_materia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(125) DEFAULT NULL,
  `descripcion` varchar(125) DEFAULT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia`
--

CREATE TABLE `materia` (
  `id` int(11) NOT NULL,
  `nombre` varchar(256) DEFAULT NULL,
  `id_carrera` int(11) NOT NULL,
  `anio_cursada` date DEFAULT NULL,
  `periodo` varchar(125) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE `mensaje` (
  `id` int(11) NOT NULL,
  `id_chat` varchar(11) DEFAULT NULL,
  `id_usuario_remitente` int(11) NOT NULL,
  `id_usuario_destino` int(11) NOT NULL,
  `texto` text,
  `fecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mensaje`
--

INSERT INTO `mensaje` (`id`, `id_chat`, `id_usuario_remitente`, `id_usuario_destino`, `texto`, `fecha`) VALUES
(1, '1_2', 1, 2, 'Hola', '2018-05-21 11:31:35'),
(2, '1_2', 2, 1, 'Hola, todo bien?', '2018-05-21 11:35:34'),
(3, '1_2', 1, 2, 'see', '2018-05-21 11:39:17'),
(4, '1_3', 3, 1, 'wachin', '2018-05-21 05:18:27'),
(5, '1_3', 1, 3, 'wachan', '2018-05-21 09:17:15'),
(6, '2_3', 2, 3, 'esto no lo tiene que ver el 1', '2018-05-21 06:31:48'),
(7, '2_3', 3, 2, 'esto tampoco 1', '2018-05-21 14:42:00'),
(8, '1_2', 1, 2, 'asdasd', '2018-05-27 22:39:11'),
(9, '1_2', 1, 2, 'asdasd', '2018-05-27 23:06:36'),
(10, '1_3', 1, 3, 'fsdfsdf', '2018-05-27 23:07:23'),
(11, '1_5', 1, 5, 'ad', '2018-05-28 00:15:35'),
(12, '1_2', 1, 2, 'asdasd', '2018-05-28 00:18:38'),
(13, '1_7', 1, 7, 'asd', '2018-05-28 00:22:30'),
(14, '1_3', 1, 3, 'asdasd', '2018-05-28 00:23:34'),
(15, '1_5', 1, 5, 'asdasd', '2018-05-28 00:24:52'),
(16, '1_2', 1, 2, 'jhgjhgkjh\n', '2018-05-28 00:29:23'),
(17, '1_7', 1, 7, 'njbjhb', '2018-05-28 00:29:49'),
(18, '1_2', 1, 2, 'asdasd', '2018-05-28 00:31:25'),
(19, '1_5', 1, 5, 'asdasd', '2018-05-28 00:31:31'),
(20, '1_2', 3, 2, 'asdasd', '2018-05-28 00:32:16'),
(21, '1_5', 7, 5, 'DFSDF', '2018-05-28 00:32:44'),
(22, '1_3', 7, 3, 'asdasd', '2018-05-28 00:34:25'),
(23, '1_7', 7, 7, 'asdasd', '2018-05-28 00:34:32'),
(24, '5_7', 7, 5, 'asdas', '2018-05-28 00:48:20'),
(25, '5_7', 7, 5, 'asd', '2018-05-28 00:50:17'),
(26, '1_3', 1, 3, 'asd', '2018-05-28 00:51:44'),
(27, '3_7', 7, 3, 'asdasda', '2018-05-28 00:52:05'),
(28, '5_7', 7, 5, 'asdasd', '2018-05-28 00:52:20'),
(29, '5_7', 7, 5, 'asdasdasd', '2018-05-28 00:52:43'),
(30, '5_7', 7, 5, 'asdasdasd', '2018-05-28 00:52:55'),
(31, '4_7', 7, 4, 'asdasd', '2018-05-28 00:53:03'),
(32, '2_7', 7, 2, 'asdasd', '2018-05-28 00:53:14'),
(33, '1_5', 1, 5, 'asdasd', '2018-05-28 00:53:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticia`
--

CREATE TABLE `noticia` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `titulo` varchar(150) DEFAULT NULL,
  `texto` text,
  `fecha` datetime DEFAULT NULL,
  `copete` varchar(150) DEFAULT NULL,
  `imagen` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pasantia`
--

CREATE TABLE `pasantia` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `texto` text,
  `id_estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propuesta`
--

CREATE TABLE `propuesta` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `titulo` varchar(125) DEFAULT NULL,
  `descripcion` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuesta`
--

CREATE TABLE `respuesta` (
  `id` int(11) NOT NULL,
  `id_comentario` int(11) NOT NULL,
  `respuesta` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuesta_foro`
--

CREATE TABLE `respuesta_foro` (
  `id` int(11) NOT NULL,
  `id_foro` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `texto` text,
  `fecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `respuesta_foro`
--

INSERT INTO `respuesta_foro` (`id`, `id_foro`, `id_usuario`, `texto`, `fecha`) VALUES
(1, 6, 3, 'hola', '2018-05-24 01:45:39'),
(2, 6, 3, 'asdasd', '2018-05-27 09:19:22'),
(3, 6, 3, 'asdasdasdasd', '2018-05-27 09:19:29'),
(4, 6, 3, 'asdasdasdasdberto', '2018-05-27 09:19:34'),
(5, 7, 7, 'asdfasdf', '2018-05-28 04:05:04'),
(6, 7, 7, 'asdfasdf', '2018-05-28 04:06:02'),
(7, 1, 3, 'asdasd', '2018-05-28 05:11:17'),
(8, 1, 3, 'asdasd', '2018-05-28 05:16:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(125) DEFAULT NULL,
  `permiso_rol` varchar(125) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `descripcion`, `permiso_rol`) VALUES
(1, 'Administrador de Base de Datos', '{\"f\":\"r-w\",\"n\":\"r-w\",\"p\":\"r-w\",\"i\":\"r-w\",\"u\":\"r-w\",\"c\":\"r-w\",\"m\":\"r-w\",\"e\":\"r-w\"}'),
(2, 'Administrador de Bienestar', '{\"i\":\"r-w\"}'),
(3, 'Administrador Academico', '{\"f\":\"r-w\",\"p\":\"r-w\",\"c\":\"r-w\",\"m\":\"r-w\"}'),
(4, 'Administrador de Prensa y Discusion', '{\"n\":\"r-w\",\"p\":\"r-w\",\"c\":\"r-w\",\"e\":\"r-w\"}'),
(5, 'Usuario', '{}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suscripcion_foro`
--

CREATE TABLE `suscripcion_foro` (
  `id` int(11) NOT NULL,
  `id_foro` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `suscripcion_foro`
--

INSERT INTO `suscripcion_foro` (`id`, `id_foro`, `id_usuario`) VALUES
(1, 6, 3),
(2, 4, 3),
(3, 2, 3),
(4, 7, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suscripcion_noticia`
--

CREATE TABLE `suscripcion_noticia` (
  `id` int(11) NOT NULL,
  `id_noticia` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

CREATE TABLE `tipo` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(125) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo`
--

INSERT INTO `tipo` (`id`, `descripcion`) VALUES
(1, 'Foro'),
(2, 'Noticia'),
(3, 'Pasantia'),
(4, 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  `legajo` varchar(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(125) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `authKey` varchar(250) DEFAULT NULL,
  `idrol` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `legajo`, `email`, `password`, `imagen`, `authKey`, `idrol`, `id_estado`) VALUES
(1, 'santiago', 'bravo', 'fai2323', 'santiagoBravo@gmail.com', '26148d621ef74844918af182d63976b6', 'archivos/usuario/1.png', '1111kuhd3', 1, 6),
(2, 'Ricardo', 'Arriagada', 'fai111', 'ricardoarriagada@gmail.com', 'db26ee047a4c86fbd2fba73503feccb6', 'archivos/usuario/2.jpg', '1111kuhd3', 2, 6),
(3, 'Ámbar', 'Perez', 'fai2211', 'ambarperez@gmail.com', '62c428533830d84fd8bc77bf402512fc', 'archivos/usuario/2.jpg', '1111kuhd3', 2, 6),
(4, 'Agustin', 'Ponce', 'fai3212', 'agustinponce@gmail.com', '62c428533830d84fd8bc77bf402512fc', 'archivos/usuario/3.png', '1111kuhd3', 3, 6),
(5, 'Sol', 'Lopez', 'fai1232', 'sollopez@gmail.com', '54a2bf8c09ace67d3513aaa1aa7aa0f3', 'archivos/usuario/2.jpg', '1111kuhd3', 4, 6),
(6, 'Azul', 'Gómez', 'fai2933', 'azulgomez@gmail.com', '4e42f7dd43ecbfe104de58610557c5ba', 'archivos/usuario/1.png', '1111kuhd3', 5, 6),
(7, 'Mateo', 'Navarro', 'fai8323', 'mateonavarro@gmail.com', '412566367c67448b599d1b7666f8ccfc', 'archivos/usuario/3.png', '1111kuhd3', 5, 6),
(39, 'Universidad', 'del Comahue', NULL, 'mauro.sosa@est.fi.uncoma.edu.ar', '7815696ecbf1c96e6894b779456d330e', NULL, 'LLwVsGaI5Z', 5, 7);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `archivo`
--
ALTER TABLE `archivo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `carrera`
--
ALTER TABLE `carrera`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categoria_foro`
--
ALTER TABLE `categoria_foro`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_noticia` (`id_noticia`);

--
-- Indices de la tabla `correlativa`
--
ALTER TABLE `correlativa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_elegida` (`id_elegida`),
  ADD KEY `id_requerida` (`id_requerida`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tipo` (`id_tipo`);

--
-- Indices de la tabla `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `foro`
--
ALTER TABLE `foro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_estado` (`id_estado`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `horario_cursado`
--
ALTER TABLE `horario_cursado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_materia` (`id_materia`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_carrera` (`id_carrera`);

--
-- Indices de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario_remitente` (`id_usuario_remitente`),
  ADD KEY `id_usuario_destino` (`id_usuario_destino`);

--
-- Indices de la tabla `noticia`
--
ALTER TABLE `noticia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_estado` (`id_estado`);

--
-- Indices de la tabla `pasantia`
--
ALTER TABLE `pasantia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_estado` (`id_estado`);

--
-- Indices de la tabla `propuesta`
--
ALTER TABLE `propuesta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_comentario` (`id_comentario`);

--
-- Indices de la tabla `respuesta_foro`
--
ALTER TABLE `respuesta_foro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_foro` (`id_foro`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `suscripcion_foro`
--
ALTER TABLE `suscripcion_foro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_foro` (`id_foro`);

--
-- Indices de la tabla `suscripcion_noticia`
--
ALTER TABLE `suscripcion_noticia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_noticia` (`id_noticia`);

--
-- Indices de la tabla `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_estado` (`id_estado`),
  ADD KEY `idrol` (`idrol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `archivo`
--
ALTER TABLE `archivo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `carrera`
--
ALTER TABLE `carrera`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categoria_foro`
--
ALTER TABLE `categoria_foro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `correlativa`
--
ALTER TABLE `correlativa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `evento`
--
ALTER TABLE `evento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `foro`
--
ALTER TABLE `foro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `horario_cursado`
--
ALTER TABLE `horario_cursado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `materia`
--
ALTER TABLE `materia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `noticia`
--
ALTER TABLE `noticia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pasantia`
--
ALTER TABLE `pasantia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `propuesta`
--
ALTER TABLE `propuesta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `respuesta_foro`
--
ALTER TABLE `respuesta_foro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `suscripcion_foro`
--
ALTER TABLE `suscripcion_foro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `suscripcion_noticia`
--
ALTER TABLE `suscripcion_noticia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo`
--
ALTER TABLE `tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `archivo`
--
ALTER TABLE `archivo`
  ADD CONSTRAINT `archivo_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comentario_ibfk_2` FOREIGN KEY (`id_noticia`) REFERENCES `noticia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `correlativa`
--
ALTER TABLE `correlativa`
  ADD CONSTRAINT `correlativa_ibfk_1` FOREIGN KEY (`id_elegida`) REFERENCES `materia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `correlativa_ibfk_2` FOREIGN KEY (`id_requerida`) REFERENCES `materia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `estado`
--
ALTER TABLE `estado`
  ADD CONSTRAINT `estado_ibfk_1` FOREIGN KEY (`id_tipo`) REFERENCES `tipo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `evento`
--
ALTER TABLE `evento`
  ADD CONSTRAINT `evento_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `foro`
--
ALTER TABLE `foro`
  ADD CONSTRAINT `foro_ibfk_1` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foro_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foro_ibfk_3` FOREIGN KEY (`id_categoria`) REFERENCES `categoria_foro` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `horario_cursado`
--
ALTER TABLE `horario_cursado`
  ADD CONSTRAINT `horario_cursado_ibfk_1` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `inventario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `materia`
--
ALTER TABLE `materia`
  ADD CONSTRAINT `materia_ibfk_1` FOREIGN KEY (`id_carrera`) REFERENCES `carrera` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD CONSTRAINT `mensaje_ibfk_1` FOREIGN KEY (`id_usuario_remitente`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mensaje_ibfk_2` FOREIGN KEY (`id_usuario_destino`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `noticia`
--
ALTER TABLE `noticia`
  ADD CONSTRAINT `noticia_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `noticia_ibfk_2` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pasantia`
--
ALTER TABLE `pasantia`
  ADD CONSTRAINT `pasantia_ibfk_1` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `propuesta`
--
ALTER TABLE `propuesta`
  ADD CONSTRAINT `propuesta_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD CONSTRAINT `respuesta_ibfk_1` FOREIGN KEY (`id_comentario`) REFERENCES `comentario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `respuesta_foro`
--
ALTER TABLE `respuesta_foro`
  ADD CONSTRAINT `respuesta_foro_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `respuesta_foro_ibfk_2` FOREIGN KEY (`id_foro`) REFERENCES `foro` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `suscripcion_foro`
--
ALTER TABLE `suscripcion_foro`
  ADD CONSTRAINT `suscripcion_foro_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `suscripcion_foro_ibfk_2` FOREIGN KEY (`id_foro`) REFERENCES `foro` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `suscripcion_noticia`
--
ALTER TABLE `suscripcion_noticia`
  ADD CONSTRAINT `suscripcion_noticia_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `suscripcion_noticia_ibfk_2` FOREIGN KEY (`id_noticia`) REFERENCES `noticia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`idrol`) REFERENCES `rol` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
