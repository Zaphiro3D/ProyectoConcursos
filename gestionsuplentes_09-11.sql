-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-11-2024 a las 00:16:00
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
-- Base de datos: `gestionsuplentes`
--
CREATE DATABASE IF NOT EXISTS `gestionsuplentes` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `gestionsuplentes`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agentes`
--

CREATE TABLE `agentes` (
  `id_Agente` int(11) UNSIGNED NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `dni` int(11) UNSIGNED NOT NULL,
  `telefono` int(11) UNSIGNED DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `id_Rol` tinyint(4) UNSIGNED NOT NULL,
  `eliminado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `agentes`
--

INSERT INTO `agentes` (`id_Agente`, `apellido`, `nombre`, `dni`, `telefono`, `direccion`, `email`, `usuario`, `password`, `id_Rol`, `eliminado`) VALUES
(1, 'Perez', 'Juan', 99999999, 234, 'Calle 13', 'admin1@mail.com', 'admin1@mail.com', '$2a$07$tawfdgyaufiusdgopfhgjuHxh67X/ud/qNKkkcc7DuuNrUaR6EIMC', 4, 0),
(2, 'Barrios', 'Julio Ramon', 99999998, 234, 'Calle 13', 'dde.cd@entrerios.edu.ar', 'dde.cd@entrerios.edu', '$2a$07$tawfdgyaufiusdgopfhgjuXclpxb8JA8grL6ZJeR0Hb7MwEZiZY.q', 1, 0),
(3, 'Super', 'Zona A', 11111111, 345, 'Calle 13', 'zonaa@gmail.com', 'zonaa@gmail.com', '$2a$07$tawfdgyaufiusdgopfhgjucAD1l3qGncpCE.vzO1TWzDJoqwI4Chu', 2, 0),
(4, 'Super', 'Zona B', 22222222, 345, 'Calle 13', 'zonab@mail.com', 'zonab@mail.com', '$2a$07$tawfdgyaufiusdgopfhgju30qkohsSHGjv5nszKmSUl/KgGfyQYS2', 2, 0),
(5, 'Super', 'Zona C', 33333333, 345, 'Calle 13', 'zonac@mail.com', 'zonac@mail.com', '$2a$07$tawfdgyaufiusdgopfhgju64SV3BDu19AXWiDv4Xd3SzW2oXi6sWi', 2, 0),
(6, 'Super', 'Zona D', 44444444, 345, 'Calle 13', 'zonad@mail.com', 'zonad@mail.com', '$2a$07$tawfdgyaufiusdgopfhgju2PR7KsFAev68yFr8.eBlDO7acGXUWPO', 2, 0),
(7, 'Super', 'Zona E', 55555555, 345, 'Calle 13', 'zonae@mail.com', 'zonae@mail.com', '$2a$07$tawfdgyaufiusdgopfhgjuPV95o23P6zDse3eYU5YzstbOXBAOvI6', 2, 0),
(8, 'Super', 'Especial Zona C', 66666666, 345, 'Calle 13', 'especialc@mail.com', 'especialc@mail.com', '$2a$07$tawfdgyaufiusdgopfhgjuw6JFRyd3Inr/Kwv5eI3jm97FOV2ObVS', 2, 0),
(9, 'Super', 'Jóvenes y Adultos', 77777777, 345, 'Calle 13', 'adultosvi@mail.com', 'adultosvi@mail.com', '$2a$07$tawfdgyaufiusdgopfhgjuB6EqjwEug/Lqs519lMZZdRqN9Azqbdm', 2, 0),
(10, 'Super', 'Nivel Inicial V', 88888888, 345, 'Calle 13', 'inicialV@mail.com', 'inicialV@mail.com', '$2a$07$tawfdgyaufiusdgopfhgjun.8/d87cpnrYLUzpxrnsL/eJwjH/bV6', 2, 0),
(11, 'Super', 'Nivel Inicial XVI', 88888889, 345, 'Calle 13', 'inicialXVI@mail.com', 'inicialXVI@mail.com', '$2a$07$tawfdgyaufiusdgopfhgju9UKFfPe0eldVSUKFRCEy.J9QIdrB/mK', 2, 0),
(12, 'Director', 'Esc 1', 11111111, NULL, NULL, 'agente1@director.com', 'agente1@director.com', '$2a$07$tawfdgyaufiusdgopfhgju0JVQ9K2kRiUh.cBu0k3Pq3AqpLvUS0C', 3, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `id_Cargo` int(11) UNSIGNED NOT NULL,
  `id_NombreCargo` int(11) UNSIGNED NOT NULL,
  `id_Grado` tinyint(4) UNSIGNED DEFAULT NULL,
  `id_Division` tinyint(4) UNSIGNED DEFAULT NULL,
  `id_Turno` tinyint(4) UNSIGNED DEFAULT NULL,
  `hsCatedra` int(11) UNSIGNED DEFAULT NULL,
  `apellidoDocente` varchar(100) DEFAULT NULL,
  `nombreDocente` varchar(100) DEFAULT NULL,
  `dniDocente` int(11) UNSIGNED DEFAULT NULL,
  `eliminado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cargos`
--

INSERT INTO `cargos` (`id_Cargo`, `id_NombreCargo`, `id_Grado`, `id_Division`, `id_Turno`, `hsCatedra`, `apellidoDocente`, `nombreDocente`, `dniDocente`, `eliminado`) VALUES
(1, 12, NULL, NULL, 3, 20, 'Perez', 'Lucas', 21245465, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dias`
--

CREATE TABLE `dias` (
  `id_Dia` tinyint(4) UNSIGNED NOT NULL,
  `nombre` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dias`
--

INSERT INTO `dias` (`id_Dia`, `nombre`) VALUES
(1, 'Lunes'),
(2, 'Martes'),
(3, 'Miércoles'),
(4, 'Jueves'),
(5, 'Viernes'),
(6, 'Lu a Vi');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `divisiones`
--

CREATE TABLE `divisiones` (
  `id_Division` tinyint(4) UNSIGNED NOT NULL,
  `division` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `divisiones`
--

INSERT INTO `divisiones` (`id_Division`, `division`) VALUES
(1, '\"A\"'),
(2, '\"B\"'),
(3, '\"C\"'),
(4, '\"D\"'),
(5, '\"E\"'),
(6, '\"F\"'),
(7, '\"G\"'),
(8, '\"U\"');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_solicitud`
--

CREATE TABLE `estados_solicitud` (
  `id_EstadoSol` tinyint(4) UNSIGNED NOT NULL,
  `estado` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estados_solicitud`
--

INSERT INTO `estados_solicitud` (`id_EstadoSol`, `estado`) VALUES
(1, 'Borrador'),
(2, 'Pendiente en Supervisión'),
(3, 'Pendiente en Administración'),
(4, 'Rechazado por Supervisión'),
(5, 'Rechazado por Administración'),
(6, 'A Concursar'),
(7, 'Ya Concursado'),
(8, 'Eliminado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grados`
--

CREATE TABLE `grados` (
  `id_Grado` tinyint(4) UNSIGNED NOT NULL,
  `grado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `grados`
--

INSERT INTO `grados` (`id_Grado`, `grado`) VALUES
(1, '1°'),
(2, '2°'),
(3, '3°'),
(4, '4°'),
(5, '5°'),
(6, '6°'),
(7, 'Múltiple'),
(8, 'Módulo I'),
(9, 'Módulo II/III'),
(10, 'Módulo IV'),
(11, 'Plurigrado'),
(12, '1° ciclo'),
(13, '2° ciclo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hs_semanal`
--

CREATE TABLE `hs_semanal` (
  `id_hs_semanal` int(11) UNSIGNED NOT NULL,
  `id_Jornada` int(11) UNSIGNED NOT NULL,
  `numeroPlaza` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `hs_semanal`
--

INSERT INTO `hs_semanal` (`id_hs_semanal`, `id_Jornada`, `numeroPlaza`) VALUES
(1, 1, 2),
(2, 1, 3),
(3, 2, 3),
(4, 3, 4),
(5, 4, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instituciones`
--

CREATE TABLE `instituciones` (
  `id_Institucion` int(11) UNSIGNED NOT NULL,
  `id_Tipo` tinyint(4) UNSIGNED DEFAULT NULL,
  `cue` int(11) UNSIGNED NOT NULL,
  `numero` smallint(6) UNSIGNED DEFAULT NULL,
  `nombre` varchar(100) NOT NULL,
  `id_Director` int(11) UNSIGNED DEFAULT NULL,
  `id_ZonaSupervision` smallint(6) UNSIGNED NOT NULL,
  `eliminado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `instituciones`
--

INSERT INTO `instituciones` (`id_Institucion`, `id_Tipo`, `cue`, `numero`, `nombre`, `id_Director`, `id_ZonaSupervision`, `eliminado`) VALUES
(1, 1, 3009962, NULL, 'Dirección Departamental de Escuelas dpto. Concordia', 2, 1, 0),
(2, 1, 3003006, NULL, 'Servicio Educativo Domiciliario y Hospitalario', 2, 1, 0),
(3, 2, 3001330, 1, 'Vélez Sarsfield', 12, 6, 0),
(4, 2, 3001861, 2, 'Almafuerte', NULL, 3, 0),
(5, 3, 3001087, 3, 'Domingo Faustino Sarmiento', NULL, 4, 0),
(6, 3, 3001169, 4, 'Manuel José de Lavardén', NULL, 3, 0),
(7, 2, 3001581, 5, 'San José De Calasanz', NULL, 6, 0),
(8, 3, 3000517, 6, 'Gral. San Martín', NULL, 4, 0),
(9, 2, 3000009, 7, 'Cabildo Abierto', NULL, 5, 0),
(10, 3, 3001081, 8, 'Madame Curie', NULL, 2, 0),
(11, 3, 3001859, 9, 'Juan María Gutiérrez', NULL, 6, 0),
(12, 3, 3001097, 10, 'Benito Garat', NULL, 2, 0),
(13, 2, 3001576, 11, 'Gral. Manuel Basavilbaso', NULL, 6, 0),
(14, 2, 3000016, 13, 'Pancho Ramírez', NULL, 4, 0),
(15, 2, 3001575, 14, 'Coronel Antonio Navarro', NULL, 4, 0),
(16, 2, 3001214, 15, 'José E. Rivera', NULL, 3, 0),
(17, 2, 3001860, 15, 'Normal Domingo Faustino Sarmiento', NULL, 3, 0),
(18, 2, 3000007, 16, 'Manuel Pacífico de Antequeda', NULL, 5, 0),
(19, 2, 3001582, 17, 'Dr. Diógenes José de Urquiza', NULL, 2, 0),
(20, 3, 3000168, 18, 'El Aconcagua', NULL, 3, 0),
(21, 2, 3000169, 19, 'Juan Lavalle', NULL, 3, 0),
(22, 2, 3001241, 21, 'Luis Rodriguez', NULL, 2, 0),
(23, 3, 3000166, 22, 'Madre Patria', NULL, 2, 0),
(24, 2, 3000152, 23, 'Hans Cristián Andersen', NULL, 5, 0),
(25, 2, 3000167, 24, 'El Escondido', NULL, 5, 0),
(26, 2, 3001240, 28, 'Thomas Alva Edison', NULL, 2, 0),
(27, 2, 3000171, 30, 'Alina P. de Matheron', NULL, 2, 0),
(28, 2, 3001078, 31, 'El Chimborazo', NULL, 4, 0),
(29, 2, 3000154, 32, 'Benito Juarez', NULL, 3, 0),
(30, 2, 3000013, 33, 'Paso a Paso', NULL, 4, 0),
(31, 3, 3000518, 34, 'Esteban Echeverría', NULL, 5, 0),
(32, 2, 3000153, 36, 'Damián P. Garat', NULL, 5, 0),
(33, 3, 3000155, 38, 'Luis Nicolás Cayetano Palma', NULL, 3, 0),
(34, 2, 3000012, 39, 'José María Paz', NULL, 4, 0),
(35, 3, 3001082, 41, 'Batalla de Chacabuco', NULL, 2, 0),
(36, 2, 3001265, 42, 'General Belgrano', NULL, 2, 0),
(37, 3, 3001092, 43, 'Bernardino Rivadavia', NULL, 5, 0),
(38, 2, 3000026, 44, 'Mariano Moreno', NULL, 3, 0),
(39, 2, 3001080, 46, 'Helena L. De Roffo', NULL, 6, 0),
(40, 2, 3001212, 47, 'Justa Gayoso', NULL, 5, 0),
(41, 2, 3000006, 49, 'Gregoria Pérez', NULL, 6, 0),
(42, 2, 3001175, 51, 'Felipe Gardell', NULL, 4, 0),
(43, 2, 3001170, 52, 'Dos  Naciones', NULL, 5, 0),
(44, 2, 3001176, 53, 'Gral. San Martín', NULL, 3, 0),
(45, 3, 3001329, 54, 'Juan Blasco', NULL, 3, 0),
(46, 2, 3001094, 55, 'Justo José De Urquiza', NULL, 4, 0),
(47, 2, 3000170, 56, 'Ángel Cayetano Bardelli', NULL, 2, 0),
(48, 2, 3001585, 57, 'Belgrano', NULL, 5, 0),
(49, 2, 3000010, 58, 'Colonia De Inmigrantes', NULL, 6, 0),
(50, 2, 3000172, 60, 'Gral. Manuel de Olazábal', NULL, 5, 0),
(51, 3, 3000011, 61, 'Mi Patria Chica', NULL, 6, 0),
(52, 2, 3000014, 62, 'Carlos Villamil', NULL, 4, 0),
(53, 2, 3001077, 63, 'Hernando Arias de Saavedra', NULL, 6, 0),
(54, 2, 3001076, 64, 'Juan Bautista Alberdi', NULL, 6, 0),
(55, 2, 3001218, 65, 'Almirante Guillermo Brown', NULL, 6, 0),
(56, 2, 3000888, 66, 'República Oriental Del Uruguay', NULL, 4, 0),
(57, 2, 3000015, 67, 'Adolfo Guidobono', NULL, 4, 0),
(58, 2, 3001215, 68, 'María Elena Walsh', NULL, 3, 0),
(59, 3, 3001171, 69, 'Malvinas Argentinas', NULL, 6, 0),
(60, 2, 3001178, 70, 'Eva Duarte', NULL, 4, 0),
(61, 3, 3001164, 71, 'Independencia', NULL, 2, 0),
(62, 2, 3001586, 72, 'Trabajador Comunitario', NULL, 2, 0),
(63, 2, 3001165, 73, 'Pancho Ramírez', NULL, 5, 0),
(64, 2, 3002524, 74, 'Gral. Juan José Valle', NULL, 6, 0),
(65, 3, 3003003, 75, '2 de Abril', NULL, 3, 0),
(66, 2, 3003020, 76, 'Teresa de Calcuta', NULL, 5, 0),
(67, 2, 3003170, 77, 'Pte. Néstor Kirchner', NULL, 5, 0),
(68, 2, 3003295, 78, 'Brazos Abiertos', NULL, 2, 0),
(69, 4, 3001272, 1, 'Concordia', NULL, 7, 0),
(70, 4, 3002456, 2, '', NULL, 7, 0),
(71, 4, 3001862, 25, 'María Ana Mac Cotter de Madrazzo', NULL, 7, 0),
(72, 5, 3003171, 6, 'Los Charrúas', NULL, 7, 0),
(73, 8, 3009962, NULL, 'Equipo Orientador Escolar (EOE)', NULL, 7, 0),
(74, 10, 3001173, 6, 'Ntra. Sra. De Fátima', NULL, 8, 0),
(75, 10, 3000508, 7, 'Ntra. Sra. de Pompeya', NULL, 8, 0),
(76, 10, 3001083, 8, 'Marta Ávalo', NULL, 8, 0),
(77, 10, 3002017, 20, 'Néstor Rivero', NULL, 8, 0),
(78, 9, 3000027, 12, 'El Supremo Entrerriano', NULL, 8, 0),
(79, 9, 3001863, 35, 'Almirante Brown', NULL, 8, 0),
(80, 9, 3001267, 45, 'Fray Luis Beltrán', NULL, 8, 0),
(81, 11, 3000029, 3, 'Primeros Pasos', NULL, 9, 0),
(82, 11, 3002202, 7, 'Gurisito Costero', NULL, 10, 0),
(83, 11, 3003025, 13, 'Castillo de Arena', NULL, 9, 0),
(84, 11, 3003024, 14, 'Solcito Litoraleño', NULL, 10, 0),
(85, 11, 3003190, 20, 'Había Una Vez', NULL, 10, 0),
(86, 11, 3003240, 26, 'Patito Sirirí', NULL, 10, 0),
(87, 11, 3003422, 49, 'Tacuarita Azul', NULL, 9, 0),
(88, 11, 3003525, 68, 'Carrito de Ilusión', NULL, 10, 0),
(90, 11, 3003533, 71, 'Burbujas de Colores', NULL, 9, 0),
(91, 6, 3003106, NULL, 'Arco Iris', NULL, 9, 0),
(92, 6, 3002986, NULL, 'Azahares', NULL, 10, 0),
(93, 6, 3003172, NULL, 'Capullito', NULL, 9, 0),
(94, 6, 3003010, NULL, 'Duendelin', NULL, 9, 0),
(95, 6, 3003322, NULL, 'Estación de los Sueños', NULL, 9, 0),
(96, 6, 3002988, NULL, 'Trencito de Colores - Evita', NULL, 10, 0),
(97, 6, 3003105, NULL, 'Frutillitas', NULL, 9, 0),
(98, 6, 3003108, NULL, 'Haditas Y Duendes', NULL, 10, 0),
(99, 6, 3003100, NULL, 'Hormiguita Viajera', NULL, 9, 0),
(100, 6, 3002989, NULL, 'Los Azahares', NULL, 9, 0),
(101, 6, 3003348, NULL, 'Manitos Pintadas', NULL, 10, 0),
(102, 6, 3003044, NULL, 'Miguitas De Amor', NULL, 10, 0),
(103, 6, 3003104, NULL, 'Mitaí Rorí - Capricornio', NULL, 9, 0),
(104, 6, 3003099, NULL, 'Naranjitas', NULL, 9, 0),
(105, 6, 3003101, NULL, 'Payasito', NULL, 9, 0),
(106, 6, 3003102, NULL, 'Pelusita', NULL, 9, 0),
(107, 6, 3002987, NULL, 'Rayito de Sol', NULL, 9, 0),
(108, 6, 3003098, NULL, 'Rincón de Luz', NULL, 9, 0),
(109, 6, 3003103, NULL, 'Ivotí Porá - Santa Rita', NULL, 10, 0),
(110, 7, 3003107, NULL, 'Néstor Carlos Kirchner', NULL, 9, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jornadas`
--

CREATE TABLE `jornadas` (
  `id_Jornada` int(11) UNSIGNED NOT NULL,
  `id_Dia` tinyint(4) UNSIGNED NOT NULL,
  `horaInicio` time NOT NULL,
  `horaFin` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `jornadas`
--

INSERT INTO `jornadas` (`id_Jornada`, `id_Dia`, `horaInicio`, `horaFin`) VALUES
(1, 1, '08:00:00', '11:00:00'),
(2, 1, '13:00:00', '15:20:00'),
(3, 2, '08:00:00', '11:15:00'),
(4, 3, '08:00:00', '10:30:00'),
(5, 4, '09:00:00', '11:40:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `motivos_suplencia`
--

CREATE TABLE `motivos_suplencia` (
  `id_MotivoSuplencia` int(11) UNSIGNED NOT NULL,
  `motivo` varchar(100) NOT NULL,
  `resolucion` varchar(100) DEFAULT NULL,
  `articulo` smallint(6) DEFAULT NULL,
  `inciso` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `motivos_suplencia`
--

INSERT INTO `motivos_suplencia` (`id_MotivoSuplencia`, `motivo`, `resolucion`, `articulo`, `inciso`) VALUES
(1, 'Jubilación', '', 0, ''),
(2, 'Renuncia', '', 0, ''),
(3, 'Casos Especiales', '', 9, ''),
(4, 'Licencia Anual Ordinaria (LAO)', '', 11, ''),
(5, 'Enfermedad Corto Tratamiento', '', 12, 'A'),
(6, 'Enfermedad Largo Tratamiento', '', 12, 'B'),
(7, 'Accidente de Trabajo', '', 12, 'C'),
(8, 'Maternidad', '', 13, 'A'),
(9, 'Paternidad', '', 13, 'B'),
(10, 'Lactancia', '', 13, 'C'),
(11, 'Adopción', '', 13, 'D'),
(12, 'Atención de Hijo Menor', '', 13, 'E'),
(13, 'Prof. Educ. Física', '', 13, 'F'),
(14, 'Atención del Grupo Familiar', '', 14, ''),
(15, 'Matrimonio del Agente', '', 16, 'A'),
(16, 'Matrimonio de los hijos', '', 16, 'B'),
(17, 'Exámen Prenupcial', '', 16, 'C'),
(18, 'Duelo', '', 16, 'D'),
(19, 'Donación de Sangre', '', 16, 'E'),
(20, 'Donación de Órganos', '', 16, 'F'),
(21, 'Mesas Examinadoras', '', 16, 'G'),
(22, 'Mudanza', '', 16, 'H'),
(23, 'Razones Personales', '', 16, 'I'),
(24, 'Rendir Exámenes', '', 16, 'J'),
(25, 'Perfeccionamiento Docente', '', 16, 'K'),
(26, 'Actividades de Interés Público', '', 16, 'L'),
(27, 'Licencia Deportiva', '', 16, 'M'),
(28, 'Acompañar Delegaciones Escolares', '', 16, 'N'),
(29, 'Intervención en Concursos', '', 16, 'Ñ'),
(30, 'Razones Gremiales', '', 16, 'O'),
(31, 'Postulación para Cargos Electivos', '', 16, 'P'),
(32, 'Razones Particulares', '', 16, 'Q'),
(33, 'Acompañar al Cónyuge', '', 16, 'R'),
(34, 'Desempeños en Cargos Políticos', '', 16, 'S'),
(35, 'Razones de Interés Pedagógico', '', 16, 'T'),
(36, 'Mayor Jerarquía', '', 16, 'U'),
(37, 'Comisión de Servicio', '', 0, ''),
(38, 'Amonestación', '1271/04', 8, ''),
(39, 'Fenómenos Meteorológicos', '', 5, 'J'),
(40, 'Día Religioso Dec. 1584/10', '', 0, ''),
(41, 'Día Religioso Ley 10224', '', 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nombres_cargos`
--

CREATE TABLE `nombres_cargos` (
  `id_NombreCargo` int(11) UNSIGNED NOT NULL,
  `nombreCargo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `nombres_cargos`
--

INSERT INTO `nombres_cargos` (`id_NombreCargo`, `nombreCargo`) VALUES
(1, 'Director de Radio'),
(2, 'Director'),
(3, 'Vicedirector'),
(4, 'Secretario'),
(5, 'Maestro del Servicio Domiciliario y Hospitalario de Nivel Primario'),
(6, 'Maestro del Servicio Domiciliario y Hospitalario de Nivel Inicial'),
(7, 'Maestro del Servicio Domiciliario y Hospitalario de Educación Especial'),
(8, 'Maestro de Ciclo de Jóvenes y Adultos'),
(9, 'Maestro de Ciclo de Jóvenes y Adultos en Contexto de Privación de la Libertad'),
(10, 'Maestro de Educación Tecnológica'),
(11, 'Maestro de Artes Visuales'),
(12, 'Maestro de Educación Física'),
(13, 'Maestro de Educación Musical'),
(14, 'Maestro de Sección'),
(15, 'Maestro Auxiliar'),
(16, 'Maestro de Sección para discapacidad intelectual'),
(17, 'Maestro de Sección para discapacidad auditiva'),
(18, 'Maestro de Sección para discapacidad visual'),
(19, 'Maestro Orientador para la Inclusión'),
(20, 'Formación Laboral y Ocupacional'),
(21, 'Orientación Vocacional y Ocupacional'),
(22, 'Técnico Auxiliar Asistente/Trabajador Social'),
(23, 'Técnico Auxiliar Psicólogo'),
(24, 'Técnico Auxiliar Psicopedagogo'),
(25, 'Terapista Ocupacional'),
(26, 'Técnico Auxiliar Fonoaudiólogo'),
(27, 'Maestro de Artes Visuales'),
(28, 'Maestro de Educación Física'),
(29, 'Maestro de Educación Musical'),
(30, 'Director de Personal Único'),
(31, 'Bibliotecario'),
(32, 'Maestro Auxiliar'),
(33, 'Maestro de Ciclo'),
(34, 'Maestro de Idioma Inglés'),
(35, 'Complemento Maestro de Ciclo'),
(36, 'Bibliotecario Pedagógico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plazas`
--

CREATE TABLE `plazas` (
  `numeroPlaza` int(11) UNSIGNED NOT NULL,
  `id_Cargo` int(11) UNSIGNED NOT NULL,
  `id_Institucion` int(11) UNSIGNED NOT NULL,
  `sede` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `plazas`
--

INSERT INTO `plazas` (`numeroPlaza`, `id_Cargo`, `id_Institucion`, `sede`) VALUES
(2, 1, 3, 1),
(3, 1, 4, 0),
(4, 1, 5, 0),
(5, 1, 6, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_Rol` tinyint(4) UNSIGNED NOT NULL,
  `rol` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_Rol`, `rol`) VALUES
(1, 'Jefe'),
(2, 'Supervisor'),
(3, 'Director'),
(4, 'Administrativo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes_suplente`
--

CREATE TABLE `solicitudes_suplente` (
  `id_SolSuplente` int(11) UNSIGNED NOT NULL,
  `numeroTramite` int(11) UNSIGNED DEFAULT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFin` date NOT NULL,
  `id_MotivoSuplencia` int(11) UNSIGNED NOT NULL,
  `observaciones` varchar(100) DEFAULT NULL,
  `id_Cargo` int(11) UNSIGNED NOT NULL,
  `id_EstadoSol` tinyint(4) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitudes_suplente`
--

INSERT INTO `solicitudes_suplente` (`id_SolSuplente`, `numeroTramite`, `fechaInicio`, `fechaFin`, `id_MotivoSuplencia`, `observaciones`, `id_Cargo`, `id_EstadoSol`) VALUES
(1, 1234, '2024-10-18', '2024-10-31', 5, 'Pendiente de aprobacion', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_institucion`
--

CREATE TABLE `tipo_institucion` (
  `id_Tipo` tinyint(4) UNSIGNED NOT NULL,
  `tipo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_institucion`
--

INSERT INTO `tipo_institucion` (`id_Tipo`, `tipo`) VALUES
(1, 'Dirección Departamental de Escuelas'),
(2, 'Escuela NEP'),
(3, 'Escuela NINA'),
(4, 'Escuela de Educación Integral'),
(5, 'Centro Educativo Integral'),
(6, 'Jardín Materno Infantil'),
(7, 'Centro Integrador Comunitario'),
(8, 'Equipo de Orientación Escolar (EOE)'),
(9, 'Escuela Primaria de Jóvenes y Adultos'),
(10, 'Centro Comunitario'),
(11, 'Unidad Educativa de Nivel Inicial');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnos`
--

CREATE TABLE `turnos` (
  `id_Turno` tinyint(4) UNSIGNED NOT NULL,
  `turno` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `turnos`
--

INSERT INTO `turnos` (`id_Turno`, `turno`) VALUES
(1, 'Mañana'),
(2, 'Tarde'),
(3, 'Rotativo'),
(4, 'Completo'),
(5, 'Dedicación Exclusiva'),
(6, 'Vespertino'),
(7, 'Noche');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zonas_supervision`
--

CREATE TABLE `zonas_supervision` (
  `id_ZonaSupervision` smallint(6) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `id_Supervisor` int(11) UNSIGNED DEFAULT NULL,
  `eliminado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `zonas_supervision`
--

INSERT INTO `zonas_supervision` (`id_ZonaSupervision`, `nombre`, `id_Supervisor`, `eliminado`) VALUES
(1, 'Dirección Departamental de Escuelas de Concordia', 2, 0),
(2, 'Supervisión Escolar de Zona A', 3, 0),
(3, 'Supervisión Escolar de Zona B', 4, 0),
(4, 'Supervisión Escolar de Zona C', 5, 0),
(5, 'Supervisión Escolar de Zona D', 6, 0),
(6, 'Supervisión Escolar de Zona E', 7, 0),
(7, 'Supervisión Escolar de Enseñanza Especial Zona C', 8, 0),
(8, 'Supervisión Escolar de Jóvenes y Adultos Zona VI', 9, 0),
(9, 'Supervisión Escolar de Nivel Inicial Zona V', 10, 0),
(10, 'Supervisión Escolar de Nivel Inicial Zona XVI', 11, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `agentes`
--
ALTER TABLE `agentes`
  ADD PRIMARY KEY (`id_Agente`),
  ADD UNIQUE KEY `id_Agente` (`id_Agente`),
  ADD KEY `id_Rol` (`id_Rol`);

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id_Cargo`),
  ADD UNIQUE KEY `id_Cargo` (`id_Cargo`),
  ADD UNIQUE KEY `id_Cargo_2` (`id_Cargo`),
  ADD KEY `Cargos_fk2` (`id_Grado`),
  ADD KEY `Cargos_fk3` (`id_Division`),
  ADD KEY `Cargos_fk4` (`id_Turno`),
  ADD KEY `id_nombreCargo` (`id_NombreCargo`);

--
-- Indices de la tabla `dias`
--
ALTER TABLE `dias`
  ADD PRIMARY KEY (`id_Dia`),
  ADD UNIQUE KEY `id_Dia` (`id_Dia`);

--
-- Indices de la tabla `divisiones`
--
ALTER TABLE `divisiones`
  ADD PRIMARY KEY (`id_Division`),
  ADD UNIQUE KEY `id_Division` (`id_Division`);

--
-- Indices de la tabla `estados_solicitud`
--
ALTER TABLE `estados_solicitud`
  ADD PRIMARY KEY (`id_EstadoSol`);

--
-- Indices de la tabla `grados`
--
ALTER TABLE `grados`
  ADD PRIMARY KEY (`id_Grado`),
  ADD UNIQUE KEY `id_Grado` (`id_Grado`);

--
-- Indices de la tabla `hs_semanal`
--
ALTER TABLE `hs_semanal`
  ADD PRIMARY KEY (`id_hs_semanal`),
  ADD UNIQUE KEY `id_hs_semanal` (`id_hs_semanal`),
  ADD KEY `hs_semanal_fk1` (`id_Jornada`),
  ADD KEY `hs_semanal_fk2` (`numeroPlaza`);

--
-- Indices de la tabla `instituciones`
--
ALTER TABLE `instituciones`
  ADD PRIMARY KEY (`id_Institucion`),
  ADD UNIQUE KEY `id_Institucion` (`id_Institucion`),
  ADD KEY `Instituciones_fk4` (`id_Director`),
  ADD KEY `Instituciones_fk5` (`id_ZonaSupervision`),
  ADD KEY `id_Tipo` (`id_Tipo`);

--
-- Indices de la tabla `jornadas`
--
ALTER TABLE `jornadas`
  ADD PRIMARY KEY (`id_Jornada`),
  ADD UNIQUE KEY `id_Jornada` (`id_Jornada`),
  ADD KEY `Jornadas_fk1` (`id_Dia`);

--
-- Indices de la tabla `motivos_suplencia`
--
ALTER TABLE `motivos_suplencia`
  ADD PRIMARY KEY (`id_MotivoSuplencia`),
  ADD UNIQUE KEY `id_MotivoSuplencia` (`id_MotivoSuplencia`);

--
-- Indices de la tabla `nombres_cargos`
--
ALTER TABLE `nombres_cargos`
  ADD PRIMARY KEY (`id_NombreCargo`);

--
-- Indices de la tabla `plazas`
--
ALTER TABLE `plazas`
  ADD PRIMARY KEY (`numeroPlaza`),
  ADD UNIQUE KEY `numeroPlaza` (`numeroPlaza`),
  ADD KEY `plazas_fk1` (`id_Cargo`),
  ADD KEY `plazas_fk2` (`id_Institucion`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_Rol`),
  ADD UNIQUE KEY `id_Rol` (`id_Rol`);

--
-- Indices de la tabla `solicitudes_suplente`
--
ALTER TABLE `solicitudes_suplente`
  ADD PRIMARY KEY (`id_SolSuplente`),
  ADD UNIQUE KEY `id_SolSuplente` (`id_SolSuplente`),
  ADD KEY `solicitudes_suplente_fk4` (`id_MotivoSuplencia`),
  ADD KEY `solicitudes_suplente_fk6` (`id_Cargo`),
  ADD KEY `id_EstadoSol` (`id_EstadoSol`);

--
-- Indices de la tabla `tipo_institucion`
--
ALTER TABLE `tipo_institucion`
  ADD PRIMARY KEY (`id_Tipo`);

--
-- Indices de la tabla `turnos`
--
ALTER TABLE `turnos`
  ADD PRIMARY KEY (`id_Turno`),
  ADD UNIQUE KEY `id_Turno` (`id_Turno`);

--
-- Indices de la tabla `zonas_supervision`
--
ALTER TABLE `zonas_supervision`
  ADD PRIMARY KEY (`id_ZonaSupervision`),
  ADD UNIQUE KEY `id_ZonaSupervision` (`id_ZonaSupervision`),
  ADD KEY `zonas_supervision_fk2` (`id_Supervisor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `agentes`
--
ALTER TABLE `agentes`
  MODIFY `id_Agente` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id_Cargo` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `dias`
--
ALTER TABLE `dias`
  MODIFY `id_Dia` tinyint(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `divisiones`
--
ALTER TABLE `divisiones`
  MODIFY `id_Division` tinyint(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `estados_solicitud`
--
ALTER TABLE `estados_solicitud`
  MODIFY `id_EstadoSol` tinyint(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `grados`
--
ALTER TABLE `grados`
  MODIFY `id_Grado` tinyint(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `hs_semanal`
--
ALTER TABLE `hs_semanal`
  MODIFY `id_hs_semanal` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `instituciones`
--
ALTER TABLE `instituciones`
  MODIFY `id_Institucion` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT de la tabla `jornadas`
--
ALTER TABLE `jornadas`
  MODIFY `id_Jornada` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `motivos_suplencia`
--
ALTER TABLE `motivos_suplencia`
  MODIFY `id_MotivoSuplencia` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `nombres_cargos`
--
ALTER TABLE `nombres_cargos`
  MODIFY `id_NombreCargo` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_Rol` tinyint(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `solicitudes_suplente`
--
ALTER TABLE `solicitudes_suplente`
  MODIFY `id_SolSuplente` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipo_institucion`
--
ALTER TABLE `tipo_institucion`
  MODIFY `id_Tipo` tinyint(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `turnos`
--
ALTER TABLE `turnos`
  MODIFY `id_Turno` tinyint(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `zonas_supervision`
--
ALTER TABLE `zonas_supervision`
  MODIFY `id_ZonaSupervision` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `agentes`
--
ALTER TABLE `agentes`
  ADD CONSTRAINT `Agentes_fk9` FOREIGN KEY (`id_Rol`) REFERENCES `roles` (`id_Rol`);

--
-- Filtros para la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD CONSTRAINT `Cargos_fk2` FOREIGN KEY (`id_Grado`) REFERENCES `grados` (`id_Grado`),
  ADD CONSTRAINT `Cargos_fk3` FOREIGN KEY (`id_Division`) REFERENCES `divisiones` (`id_Division`),
  ADD CONSTRAINT `Cargos_fk4` FOREIGN KEY (`id_Turno`) REFERENCES `turnos` (`id_Turno`),
  ADD CONSTRAINT `cargos_ibfk_1` FOREIGN KEY (`id_NombreCargo`) REFERENCES `nombres_cargos` (`id_NombreCargo`),
  ADD CONSTRAINT `cargos_ibfk_2` FOREIGN KEY (`id_NombreCargo`) REFERENCES `nombres_cargos` (`id_NombreCargo`);

--
-- Filtros para la tabla `hs_semanal`
--
ALTER TABLE `hs_semanal`
  ADD CONSTRAINT `hs_semanal_fk1` FOREIGN KEY (`id_Jornada`) REFERENCES `jornadas` (`id_Jornada`),
  ADD CONSTRAINT `hs_semanal_fk2` FOREIGN KEY (`numeroPlaza`) REFERENCES `plazas` (`numeroPlaza`);

--
-- Filtros para la tabla `instituciones`
--
ALTER TABLE `instituciones`
  ADD CONSTRAINT `Instituciones_fk4` FOREIGN KEY (`id_Director`) REFERENCES `agentes` (`id_Agente`),
  ADD CONSTRAINT `Instituciones_fk5` FOREIGN KEY (`id_ZonaSupervision`) REFERENCES `zonas_supervision` (`id_ZonaSupervision`),
  ADD CONSTRAINT `instituciones_ibfk_1` FOREIGN KEY (`id_Tipo`) REFERENCES `tipo_institucion` (`id_Tipo`);

--
-- Filtros para la tabla `jornadas`
--
ALTER TABLE `jornadas`
  ADD CONSTRAINT `Jornadas_fk1` FOREIGN KEY (`id_Dia`) REFERENCES `dias` (`id_Dia`);

--
-- Filtros para la tabla `plazas`
--
ALTER TABLE `plazas`
  ADD CONSTRAINT `plazas_fk1` FOREIGN KEY (`id_Cargo`) REFERENCES `cargos` (`id_Cargo`),
  ADD CONSTRAINT `plazas_fk2` FOREIGN KEY (`id_Institucion`) REFERENCES `instituciones` (`id_Institucion`);

--
-- Filtros para la tabla `solicitudes_suplente`
--
ALTER TABLE `solicitudes_suplente`
  ADD CONSTRAINT `solicitudes_suplente_fk4` FOREIGN KEY (`id_MotivoSuplencia`) REFERENCES `motivos_suplencia` (`id_MotivoSuplencia`),
  ADD CONSTRAINT `solicitudes_suplente_fk6` FOREIGN KEY (`id_Cargo`) REFERENCES `cargos` (`id_Cargo`),
  ADD CONSTRAINT `solicitudes_suplente_ibfk_1` FOREIGN KEY (`id_EstadoSol`) REFERENCES `estados_solicitud` (`id_EstadoSol`);

--
-- Filtros para la tabla `zonas_supervision`
--
ALTER TABLE `zonas_supervision`
  ADD CONSTRAINT `zonas_supervision_fk2` FOREIGN KEY (`id_Supervisor`) REFERENCES `agentes` (`id_Agente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
