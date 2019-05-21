-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-05-2018 a las 08:02:22
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
CREATE DATABASE IF NOT EXISTS `cefaiweb` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `cefaiweb`;
DROP TABLE IF EXISTS `pasantia`;
DROP TABLE IF EXISTS `correlativa`;
DROP TABLE IF EXISTS `horario_cursado`;
DROP TABLE IF EXISTS `dia_semana`;
DROP TABLE IF EXISTS `materia`;
DROP TABLE IF EXISTS `carrera`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera`
--
CREATE TABLE pasantia (
  id int(11) NOT NULL,
  titulo varchar(255) NOT NULL,
  tarea varchar(255) NOT NULL,
  requisito text,
  ubicacion varchar(255) NOT NULL,
  fecha_inicio date NOT NULL,
  fecha_fin date NOT NULL,
  fecha_limite date DEFAULT NULL,
  id_estado int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pasantia`
--

INSERT INTO `pasantia` (`id`, `titulo`, `texto`, `id_estado`, `fecha_inicio`, `fecha_fin`, `fecha_limite`, `tarea`, `requisito`, `ubicacion`) VALUES
(1, 'Programacion', NULL, 1, '2018-05-31', '2018-06-08', '2018-06-08', 'programar', 'Saber programar', 'Neuquen'),
(2, 'asdas', NULL, 1, '2018-06-23', '2018-06-15', '2018-06-21', 'asdas', 'asdasd', 'adasdas');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pasantia`
--
ALTER TABLE `pasantia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_estado` (`id_estado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pasantia`
--
ALTER TABLE `pasantia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pasantia`
--
ALTER TABLE `pasantia`
  ADD CONSTRAINT `pasantia_ibfk_1` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

CREATE TABLE `carrera` (
  `id` int(11) NOT NULL,
  `nombre` varchar(125) NOT NULL,
  `url` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `carrera`:
--

--
-- Volcado de datos para la tabla `carrera`
--

INSERT INTO `carrera` (`id`, `nombre`, `url`) VALUES
(1, 'Técnicatura Universitaria en Desarrollo Web', 'http://faiweb.uncoma.edu.ar/index.php/51-academica/carreras-fai/3-tecnicatura'),
(2, 'Técnicatura Universitaria en Administración de Sistemas y Software Libre', 'http://faiweb.uncoma.edu.ar/index.php/51-academica/carreras-fai/1-tec-software-libre'),
(3, 'Profesorado en Informática', 'http://faiweb.uncoma.edu.ar/index.php/51-academica/carreras-fai/15-profesorado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `correlativa`
--
CREATE TABLE `correlativa` (
  `id` int(11) NOT NULL,
  `materia_id` int(11) NOT NULL,
  `cursada_id` int(11) NOT NULL,
  `aprobada_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELACIONES PARA LA TABLA `correlativa`:
--   `materia_id`
--       `materia` -> `id`
--   `cursada_id`
--       `materia` -> `id`
--   `aprobada_id`
--       `materia` -> `id`
--

--
-- Volcado de datos para la tabla `correlativa`
--
INSERT INTO `correlativa` (`id`, `materia_id`, `cursada_id`, `aprobada_id`) VALUES
(1, 11, 6, 7),
(2, 12, 5, 6),
(3, 17, 16, 16),
(4, 17, 15, 15),
(5, 18, 11, 9),
(6, 18, 13, 12);
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `dia_semana`
--
CREATE TABLE `dia_semana` (
  `id` int(11) NOT NULL,
  `nombre` varchar(125) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
--
-- RELACIONES PARA LA TABLA `dia_semana`:
--
--
-- Volcado de datos para la tabla `dia_semana`
--
INSERT INTO `dia_semana` (`id`, `nombre`) VALUES
(1, 'Lunes'),
(2, 'Martes'),
(3, 'Miercoles'),
(4, 'Jueves'),
(5, 'Viernes'),
(6, 'Sabado'),
(7, 'Domingo');
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `horario_cursado`
--
CREATE TABLE `horario_cursado` (
  `id` int(11) NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `aula` varchar(80) NOT NULL,
  `id_materia` int(11) NOT NULL,
  `id_dia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
--
-- RELACIONES PARA LA TABLA `horario_cursado`:
--   `id_materia`
--       `materia` -> `id`
--   `id_dia`
--       `dia_semana` -> `id`
--
--
-- Volcado de datos para la tabla `horario_cursado`
--
INSERT INTO `horario_cursado` (`id`, `hora_inicio`, `hora_fin`, `aula`, `id_materia`, `id_dia`) VALUES
(3, '15:00:00', '18:00:00', '106', 10, 2),
(4, '13:00:00', '15:30:00', '105', 5, 4);
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `materia`
--
CREATE TABLE `materia` (
  `id` int(11) NOT NULL,
  `nombre` varchar(256) NOT NULL,
  `id_carrera` int(11) NOT NULL,
  `anio_cursada` int(11) NOT NULL,
  `periodo` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
--
-- RELACIONES PARA LA TABLA `materia`:
--   `id_carrera`
--       `carrera` -> `id`
--
--
-- Volcado de datos para la tabla `materia`
--
INSERT INTO `materia` (`id`, `nombre`, `id_carrera`, `anio_cursada`, `periodo`) VALUES
(5, 'Pedagogía', 3, 1, 'Primer Cuatrimestre'),
(6, 'Resolución de Problemas y Algoritmos', 3, 1, 'Primer Cuatrimestre'),
(7, 'Elementos de Álgebra', 3, 1, 'Primer Cuatrimestre'),
(8, ' Introducción a la Computación', 3, 1, 'Primer Cuatrimestre'),
(9, 'Modelos y Sistemas de Información', 3, 1, 'Primer Cuatrimestre'),
(10, ' Elementos de Teoría de la Computación', 3, 1, 'Segundo Cuatrimestre'),
(11, 'Desarrollo de Algoritmos', 3, 1, 'Segundo Cuatrimestre'),
(12, 'Modelado de Datos', 3, 1, 'Segundo Cuatrimestre'),
(13, 'Psicología I', 3, 1, 'Segundo Cuatrimestre'),
(15, 'Mátematica General', 1, 1, 'Segundo Cuatrimestre'),
(16, 'Inglés', 1, 1, 'Segundo Cuatrimestre'),
(17, 'Base de Datos', 1, 1, 'Primer Cuatrimestre'),
(18, 'una materia', 3, 2, 'Primer Cuatrimestre');
--
-- Índices para tablas volcadas
--
--
-- Indices de la tabla `carrera`
--
ALTER TABLE `carrera`
  ADD PRIMARY KEY (`id`);
--
-- Indices de la tabla `correlativa`
--
ALTER TABLE `correlativa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `materia_id` (`materia_id`),
  ADD KEY `cursada_id` (`cursada_id`),
  ADD KEY `aprobada_id` (`aprobada_id`);
--
-- Indices de la tabla `dia_semana`
--
ALTER TABLE `dia_semana`
  ADD PRIMARY KEY (`id`);
--
-- Indices de la tabla `horario_cursado`
--
ALTER TABLE `horario_cursado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_materia` (`id_materia`),
  ADD KEY `id_dia` (`id_dia`);
--
-- Indices de la tabla `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_carrera` (`id_carrera`);
--
-- AUTO_INCREMENT de las tablas volcadas
--
--
-- AUTO_INCREMENT de la tabla `carrera`
--
ALTER TABLE `carrera`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `correlativa`
--
ALTER TABLE `correlativa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `dia_semana`
--
ALTER TABLE `dia_semana`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `horario_cursado`
--
ALTER TABLE `horario_cursado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `materia`
--
ALTER TABLE `materia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- Restricciones para tablas volcadas
--
--
-- Filtros para la tabla `correlativa`
--
ALTER TABLE `correlativa`
  ADD CONSTRAINT `correlativa_ibfk_1` FOREIGN KEY (`materia_id`) REFERENCES `materia` (`id`),
  ADD CONSTRAINT `correlativa_ibfk_2` FOREIGN KEY (`cursada_id`) REFERENCES `materia` (`id`),
  ADD CONSTRAINT `correlativa_ibfk_3` FOREIGN KEY (`aprobada_id`) REFERENCES `materia` (`id`);
--
-- Filtros para la tabla `horario_cursado`
--
ALTER TABLE `horario_cursado`
  ADD CONSTRAINT `horario_cursado_ibfk_1` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`id`),
  ADD CONSTRAINT `horario_cursado_ibfk_2` FOREIGN KEY (`id_dia`) REFERENCES `dia_semana` (`id`);
--
-- Filtros para la tabla `materia`
--
ALTER TABLE `materia`
  ADD CONSTRAINT `materia_ibfk_1` FOREIGN KEY (`id_carrera`) REFERENCES `carrera` (`id`);
COMMIT;