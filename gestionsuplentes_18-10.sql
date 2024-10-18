-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-10-2024 a las 19:39:40
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
(1, 'Perez', 'Juan', 99999999, 234, 'Calle 13', 'nombre@mail.com', '', '', 4, 0),
(2, 'Barrios', 'Julio Ramon', 99999998, 234, 'Calle 13', 'nombre@mail.com', '', '', 1, 0),
(3, 'Super', 'Zona A', 11111111, 345, 'Calle 13', 'agente@mail.com', 'UsuarioZonaA', 'SupervisorA', 2, 0),
(4, 'Super', 'Zona B', 22222222, 345, 'Calle 13', 'agente@mail.com', 'UsuarioZonaB', 'SupervisorB', 2, 0),
(5, 'Super', 'Zona C', 33333333, 345, 'Calle 13', 'agente@mail.com', 'UsuarioZonaC', 'SupervisorC', 2, 0),
(6, 'Super', 'Zona D', 44444444, 345, 'Calle 13', 'agente@mail.com', 'UsuarioZonaD', 'SupervisorD', 2, 0),
(7, 'Super', 'Zona E', 55555555, 345, 'Calle 13', 'agente@mail.com', 'UsuarioZonaE', 'SupervisorE', 2, 0),
(8, 'Super', 'Especial Zona C', 66666666, 345, 'Calle 13', 'agente@mail.com', 'UsuarioEspecialC', 'SupervisorEspC', 2, 0),
(9, 'Super', 'Jóvenes y Adultos', 77777777, 345, 'Calle 13', 'agente@mail.com', 'UsuarioJyA', 'SupervisorJyA', 2, 0),
(10, 'Super', 'Nivel Inicial V', 88888888, 345, 'Calle 13', 'agente@mail.com', 'UsuarioNIV', 'SupervisorNIV', 2, 0),
(11, 'Super', 'Nivel Inicial XVI', 88888889, 345, 'Calle 13', 'agente@mail.com', 'UsuarioNIXVI', 'SupervisorNIXVI', 2, 0),
(12, 'Director', 'Esc 1', 11111111, NULL, NULL, 'agente@director.com', 'Dire1', '12345', 3, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `numeroPlaza` int(11) UNSIGNED NOT NULL,
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

INSERT INTO `cargos` (`numeroPlaza`, `id_NombreCargo`, `id_Grado`, `id_Division`, `id_Turno`, `hsCatedra`, `apellidoDocente`, `nombreDocente`, `dniDocente`, `eliminado`) VALUES
(999999, 12, NULL, NULL, 3, 20, 'Perez', 'Lucas', 21245465, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo_institucion`
--

CREATE TABLE `cargo_institucion` (
  `id_Cargo_Institucion` int(11) UNSIGNED NOT NULL,
  `numeroPlaza` int(11) UNSIGNED NOT NULL,
  `id_Institucion` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cargo_institucion`
--

INSERT INTO `cargo_institucion` (`id_Cargo_Institucion`, `numeroPlaza`, `id_Institucion`) VALUES
(2, 999999, 330),
(3, 999999, 331),
(4, 999999, 332),
(5, 999999, 333);

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
-- Estructura de tabla para la tabla `hssemanal`
--

CREATE TABLE `hssemanal` (
  `id_HsSemanal` int(11) UNSIGNED NOT NULL,
  `id_Jornada` int(11) UNSIGNED NOT NULL,
  `Id_Cargo_Institucion` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `hssemanal`
--

INSERT INTO `hssemanal` (`id_HsSemanal`, `id_Jornada`, `Id_Cargo_Institucion`) VALUES
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
  `id_ZonaSupervison` smallint(6) UNSIGNED NOT NULL,
  `eliminado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `instituciones`
--

INSERT INTO `instituciones` (`id_Institucion`, `id_Tipo`, `cue`, `numero`, `nombre`, `id_Director`, `id_ZonaSupervison`, `eliminado`) VALUES
(328, 1, 3009962, NULL, 'Dirección Departamental de Escuelas dpto. Concordia', 2, 1, 0),
(329, 1, 3003006, NULL, 'Servicio Educativo Domiciliario y Hospitalario', 2, 1, 0),
(330, 2, 3001330, 1, 'Vélez Sarsfield', 12, 6, 0),
(331, 2, 3001861, 2, 'Almafuerte', NULL, 3, 0),
(332, 3, 3001087, 3, 'Domingo Faustino Sarmiento', NULL, 4, 0),
(333, 3, 3001169, 4, 'Manuel José de Lavardén', NULL, 3, 0),
(334, 2, 3001581, 5, 'San José De Calasanz', NULL, 6, 0),
(335, 3, 3000517, 6, 'Gral. San Martín', NULL, 4, 0),
(336, 2, 3000009, 7, 'Cabildo Abierto', NULL, 5, 0),
(337, 3, 3001081, 8, 'Madame Curie', NULL, 2, 0),
(338, 3, 3001859, 9, 'Juan María Gutiérrez', NULL, 6, 0),
(339, 3, 3001097, 10, 'Benito Garat', NULL, 2, 0),
(340, 2, 3001576, 11, 'Gral. Manuel Basavilbaso', NULL, 6, 0),
(341, 2, 3000016, 13, 'Pancho Ramírez', NULL, 4, 0),
(342, 2, 3001575, 14, 'Coronel Antonio Navarro', NULL, 4, 0),
(343, 2, 3001214, 15, 'José E. Rivera', NULL, 3, 0),
(344, 2, 3001860, 15, 'Normal Domingo Faustino Sarmiento', NULL, 3, 0),
(345, 2, 3000007, 16, 'Manuel Pacífico de Antequeda', NULL, 5, 0),
(346, 2, 3001582, 17, 'Dr. Diógenes José de Urquiza', NULL, 2, 0),
(347, 3, 3000168, 18, 'El Aconcagua', NULL, 3, 0),
(348, 2, 3000169, 19, 'Juan Lavalle', NULL, 3, 0),
(349, 2, 3001241, 21, 'Luis Rodriguez', NULL, 2, 0),
(350, 3, 3000166, 22, 'Madre Patria', NULL, 2, 0),
(351, 2, 3000152, 23, 'Hans Cristián Andersen', NULL, 5, 0),
(352, 2, 3000167, 24, 'El Escondido', NULL, 5, 0),
(353, 2, 3001240, 28, 'Thomas Alva Edison', NULL, 2, 0),
(354, 2, 3000171, 30, 'Alina P. de Matheron', NULL, 2, 0),
(355, 2, 3001078, 31, 'El Chimborazo', NULL, 4, 0),
(356, 2, 3000154, 32, 'Benito Juarez', NULL, 3, 0),
(357, 2, 3000013, 33, 'Paso a Paso', NULL, 4, 0),
(358, 3, 3000518, 34, 'Esteban Echeverría', NULL, 5, 0),
(359, 2, 3000153, 36, 'Damián P. Garat', NULL, 5, 0),
(360, 3, 3000155, 38, 'Luis Nicolás Cayetano Palma', NULL, 3, 0),
(361, 2, 3000012, 39, 'José María Paz', NULL, 4, 0),
(362, 3, 3001082, 41, 'Batalla de Chacabuco', NULL, 2, 0),
(363, 2, 3001265, 42, 'General Belgrano', NULL, 2, 0),
(364, 3, 3001092, 43, 'Bernardino Rivadavia', NULL, 5, 0),
(365, 2, 3000026, 44, 'Mariano Moreno', NULL, 3, 0),
(366, 2, 3001080, 46, 'Helena L. De Roffo', NULL, 6, 0),
(367, 2, 3001212, 47, 'Justa Gayoso', NULL, 5, 0),
(368, 2, 3000006, 49, 'Gregoria Pérez', NULL, 6, 0),
(369, 2, 3001175, 51, 'Felipe Gardell', NULL, 4, 0),
(370, 2, 3001170, 52, 'Dos  Naciones', NULL, 5, 0),
(371, 2, 3001176, 53, 'Gral. San Martín', NULL, 3, 0),
(372, 3, 3001329, 54, 'Juan Blasco', NULL, 3, 0),
(373, 2, 3001094, 55, 'Justo José De Urquiza', NULL, 4, 0),
(374, 2, 3000170, 56, 'Ángel Cayetano Bardelli', NULL, 2, 0),
(375, 2, 3001585, 57, 'Belgrano', NULL, 5, 0),
(376, 2, 3000010, 58, 'Colonia De Inmigrantes', NULL, 6, 0),
(377, 2, 3000172, 60, 'Gral. Manuel de Olazábal', NULL, 5, 0),
(378, 3, 3000011, 61, 'Mi Patria Chica', NULL, 6, 0),
(379, 2, 3000014, 62, 'Carlos Villamil', NULL, 4, 0),
(380, 2, 3001077, 63, 'Hernando Arias de Saavedra', NULL, 6, 0),
(381, 2, 3001076, 64, 'Juan Bautista Alberdi', NULL, 6, 0),
(382, 2, 3001218, 65, 'Almirante Guillermo Brown', NULL, 6, 0),
(383, 2, 3000888, 66, 'República Oriental Del Uruguay', NULL, 4, 0),
(384, 2, 3000015, 67, 'Adolfo Guidobono', NULL, 4, 0),
(385, 2, 3001215, 68, 'María Elena Walsh', NULL, 3, 0),
(386, 3, 3001171, 69, 'Malvinas Argentinas', NULL, 6, 0),
(387, 2, 3001178, 70, 'Eva Duarte', NULL, 4, 0),
(388, 3, 3001164, 71, 'Independencia', NULL, 2, 0),
(389, 2, 3001586, 72, 'Trabajador Comunitario', NULL, 2, 0),
(390, 2, 3001165, 73, 'Pancho Ramírez', NULL, 5, 0),
(391, 2, 3002524, 74, 'Gral. Juan José Valle', NULL, 6, 0),
(392, 3, 3003003, 75, '2 de Abril', NULL, 3, 0),
(393, 2, 3003020, 76, 'Teresa de Calcuta', NULL, 5, 0),
(394, 2, 3003170, 77, 'Pte. Néstor Kirchner', NULL, 5, 0),
(395, 2, 3003295, 78, 'Brazos Abiertos', NULL, 2, 0),
(396, 4, 3001272, 1, 'Concordia', NULL, 7, 0),
(397, 4, 3002456, 2, '', NULL, 7, 0),
(398, 4, 3001862, 25, 'María Ana Mac Cotter de Madrazzo', NULL, 7, 0),
(399, 5, 3003171, 6, 'Los Charrúas', NULL, 7, 0),
(400, 8, 3009962, NULL, 'Equipo Orientador Escolar (EOE)', NULL, 7, 0),
(401, 10, 3001173, 6, 'Ntra. Sra. De Fátima', NULL, 8, 0),
(402, 10, 3000508, 7, 'Ntra. Sra. de Pompeya', NULL, 8, 0),
(403, 10, 3001083, 8, 'Marta Ávalo', NULL, 8, 0),
(404, 10, 3002017, 20, 'Néstor Rivero', NULL, 8, 0),
(405, 9, 3000027, 12, 'El Supremo Entrerriano', NULL, 8, 0),
(406, 9, 3001863, 35, 'Almirante Brown', NULL, 8, 0),
(407, 9, 3001267, 45, 'Fray Luis Beltrán', NULL, 8, 0),
(408, 11, 3000029, 3, 'Primeros Pasos', NULL, 9, 0),
(409, 11, 3002202, 7, 'Gurisito Costero', NULL, 10, 0),
(410, 11, 3003025, 13, 'Castillo de Arena', NULL, 9, 0),
(411, 11, 3003024, 14, 'Solcito Litoraleño', NULL, 10, 0),
(412, 11, 3003190, 20, 'Había Una Vez', NULL, 10, 0),
(413, 11, 3003240, 26, 'Patito Sirirí', NULL, 10, 0),
(414, 11, 3003422, 49, 'Tacuarita Azul', NULL, 9, 0),
(415, 11, 3003525, 68, 'Carrito de Ilusión', NULL, 10, 0),
(416, 11, 3003533, 71, 'Burbujas de Colores', NULL, 9, 0),
(417, 6, 3003106, NULL, 'Arco Iris', NULL, 9, 0),
(418, 6, 3002986, NULL, 'Azahares', NULL, 10, 0),
(419, 6, 3003172, NULL, 'Capullito', NULL, 9, 0),
(420, 6, 3003010, NULL, 'Duendelin', NULL, 9, 0),
(421, 6, 3003322, NULL, 'Estación de los Sueños', NULL, 9, 0),
(422, 6, 3002988, NULL, 'Trencito de Colores - Evita', NULL, 10, 0),
(423, 6, 3003105, NULL, 'Frutillitas', NULL, 9, 0),
(424, 6, 3003108, NULL, 'Haditas Y Duendes', NULL, 10, 0),
(425, 6, 3003100, NULL, 'Hormiguita Viajera', NULL, 9, 0),
(426, 6, 3002989, NULL, 'Los Azahares', NULL, 9, 0),
(427, 6, 3003348, NULL, 'Manitos Pintadas', NULL, 10, 0),
(428, 6, 3003044, NULL, 'Miguitas De Amor', NULL, 10, 0),
(429, 6, 3003104, NULL, 'Mitaí Rorí - Capricornio', NULL, 9, 0),
(430, 6, 3003099, NULL, 'Naranjitas', NULL, 9, 0),
(431, 6, 3003101, NULL, 'Payasito', NULL, 9, 0),
(432, 6, 3003102, NULL, 'Pelusita', NULL, 9, 0),
(433, 6, 3002987, NULL, 'Rayito de Sol', NULL, 9, 0),
(434, 6, 3003098, NULL, 'Rincón de Luz', NULL, 9, 0),
(435, 6, 3003103, NULL, 'Ivotí Porá - Santa Rita', NULL, 10, 0),
(436, 7, 3003107, NULL, 'Néstor Carlos Kirchner', NULL, 9, 0);

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
-- Estructura de tabla para la tabla `motivossuplencia`
--

CREATE TABLE `motivossuplencia` (
  `id_MotivoSuplencia` int(11) UNSIGNED NOT NULL,
  `Motivo` varchar(100) NOT NULL,
  `Resolucion` varchar(100) DEFAULT NULL,
  `Articulo` smallint(6) DEFAULT NULL,
  `Insciso` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `motivossuplencia`
--

INSERT INTO `motivossuplencia` (`id_MotivoSuplencia`, `Motivo`, `Resolucion`, `Articulo`, `Insciso`) VALUES
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
-- Estructura de tabla para la tabla `nombrescargos`
--

CREATE TABLE `nombrescargos` (
  `id_NombreCargo` int(11) UNSIGNED NOT NULL,
  `nombreCargo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `nombrescargos`
--

INSERT INTO `nombrescargos` (`id_NombreCargo`, `nombreCargo`) VALUES
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
-- Estructura de tabla para la tabla `solicitudessuplente`
--

CREATE TABLE `solicitudessuplente` (
  `id_SolSuplente` int(11) UNSIGNED NOT NULL,
  `numeroTramite` int(11) UNSIGNED DEFAULT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFin` date NOT NULL,
  `id_MotivoSuplencia` int(11) UNSIGNED NOT NULL,
  `observaciones` varchar(100) DEFAULT NULL,
  `numeroPlaza` int(11) UNSIGNED NOT NULL,
  `eliminado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitudessuplente`
--

INSERT INTO `solicitudessuplente` (`id_SolSuplente`, `numeroTramite`, `fechaInicio`, `fechaFin`, `id_MotivoSuplencia`, `observaciones`, `numeroPlaza`, `eliminado`) VALUES
(1, 1234, '2024-10-18', '2024-10-31', 5, 'Pendiente de aprobacion', 999999, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoinstitucion`
--

CREATE TABLE `tipoinstitucion` (
  `id_Tipo` tinyint(4) UNSIGNED NOT NULL,
  `TipoInstitucion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipoinstitucion`
--

INSERT INTO `tipoinstitucion` (`id_Tipo`, `TipoInstitucion`) VALUES
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
-- Estructura de tabla para la tabla `zonassupervision`
--

CREATE TABLE `zonassupervision` (
  `id_ZonaSupervision` smallint(6) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `id_Supervisor` int(11) UNSIGNED DEFAULT NULL,
  `eliminado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `zonassupervision`
--

INSERT INTO `zonassupervision` (`id_ZonaSupervision`, `nombre`, `id_Supervisor`, `eliminado`) VALUES
(1, 'Dirección Departamental de Escuelas de Concordia', 2, 0),
(2, 'Supervisor Escolar de Zona A', 3, 0),
(3, 'Supervisor Escolar de Zona B', 4, 0),
(4, 'Supervisor Escolar de Zona C', 5, 0),
(5, 'Supervisor Escolar de Zona D', 6, 0),
(6, 'Supervisor Escolar de Zona E', 7, 0),
(7, 'Supervisor Escolar de Enseñanza Especial Zona C', 8, 0),
(8, 'Supervisor Escolar de Jóvenes y Adultos Zona VI', 9, 0),
(9, 'Supervisor Escolar de Nivel Inicial Zona V', 10, 0),
(10, 'Supervisor Escolar de Nivel Inicial Zona XVI', 11, 0);

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
  ADD PRIMARY KEY (`numeroPlaza`),
  ADD UNIQUE KEY `numeroPlaza` (`numeroPlaza`),
  ADD KEY `Cargos_fk2` (`id_Grado`),
  ADD KEY `Cargos_fk3` (`id_Division`),
  ADD KEY `Cargos_fk4` (`id_Turno`),
  ADD KEY `id_nombreCargo` (`id_NombreCargo`);

--
-- Indices de la tabla `cargo_institucion`
--
ALTER TABLE `cargo_institucion`
  ADD PRIMARY KEY (`id_Cargo_Institucion`),
  ADD UNIQUE KEY `id_Cargo_Institucion` (`id_Cargo_Institucion`),
  ADD KEY `Cargo_Institucion_fk1` (`numeroPlaza`),
  ADD KEY `Cargo_Institucion_fk2` (`id_Institucion`);

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
-- Indices de la tabla `grados`
--
ALTER TABLE `grados`
  ADD PRIMARY KEY (`id_Grado`),
  ADD UNIQUE KEY `id_Grado` (`id_Grado`);

--
-- Indices de la tabla `hssemanal`
--
ALTER TABLE `hssemanal`
  ADD PRIMARY KEY (`id_HsSemanal`),
  ADD UNIQUE KEY `id_HsSemanal` (`id_HsSemanal`),
  ADD KEY `HsSemanal_fk1` (`id_Jornada`),
  ADD KEY `HsSemanal_fk2` (`Id_Cargo_Institucion`);

--
-- Indices de la tabla `instituciones`
--
ALTER TABLE `instituciones`
  ADD PRIMARY KEY (`id_Institucion`),
  ADD UNIQUE KEY `id_Institucion` (`id_Institucion`),
  ADD KEY `Instituciones_fk4` (`id_Director`),
  ADD KEY `Instituciones_fk5` (`id_ZonaSupervison`),
  ADD KEY `id_Tipo` (`id_Tipo`);

--
-- Indices de la tabla `jornadas`
--
ALTER TABLE `jornadas`
  ADD PRIMARY KEY (`id_Jornada`),
  ADD UNIQUE KEY `id_Jornada` (`id_Jornada`),
  ADD KEY `Jornadas_fk1` (`id_Dia`);

--
-- Indices de la tabla `motivossuplencia`
--
ALTER TABLE `motivossuplencia`
  ADD PRIMARY KEY (`id_MotivoSuplencia`),
  ADD UNIQUE KEY `id_MotivoSuplencia` (`id_MotivoSuplencia`);

--
-- Indices de la tabla `nombrescargos`
--
ALTER TABLE `nombrescargos`
  ADD PRIMARY KEY (`id_NombreCargo`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_Rol`),
  ADD UNIQUE KEY `id_Rol` (`id_Rol`);

--
-- Indices de la tabla `solicitudessuplente`
--
ALTER TABLE `solicitudessuplente`
  ADD PRIMARY KEY (`id_SolSuplente`),
  ADD UNIQUE KEY `id_SolSuplente` (`id_SolSuplente`),
  ADD KEY `SolicitudesSuplente_fk4` (`id_MotivoSuplencia`),
  ADD KEY `SolicitudesSuplente_fk6` (`numeroPlaza`);

--
-- Indices de la tabla `tipoinstitucion`
--
ALTER TABLE `tipoinstitucion`
  ADD PRIMARY KEY (`id_Tipo`);

--
-- Indices de la tabla `turnos`
--
ALTER TABLE `turnos`
  ADD PRIMARY KEY (`id_Turno`),
  ADD UNIQUE KEY `id_Turno` (`id_Turno`);

--
-- Indices de la tabla `zonassupervision`
--
ALTER TABLE `zonassupervision`
  ADD PRIMARY KEY (`id_ZonaSupervision`),
  ADD UNIQUE KEY `id_ZonaSupervision` (`id_ZonaSupervision`),
  ADD KEY `ZonasSupervision_fk2` (`id_Supervisor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `agentes`
--
ALTER TABLE `agentes`
  MODIFY `id_Agente` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `cargo_institucion`
--
ALTER TABLE `cargo_institucion`
  MODIFY `id_Cargo_Institucion` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- AUTO_INCREMENT de la tabla `grados`
--
ALTER TABLE `grados`
  MODIFY `id_Grado` tinyint(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `hssemanal`
--
ALTER TABLE `hssemanal`
  MODIFY `id_HsSemanal` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `instituciones`
--
ALTER TABLE `instituciones`
  MODIFY `id_Institucion` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=437;

--
-- AUTO_INCREMENT de la tabla `jornadas`
--
ALTER TABLE `jornadas`
  MODIFY `id_Jornada` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `motivossuplencia`
--
ALTER TABLE `motivossuplencia`
  MODIFY `id_MotivoSuplencia` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `nombrescargos`
--
ALTER TABLE `nombrescargos`
  MODIFY `id_NombreCargo` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_Rol` tinyint(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `solicitudessuplente`
--
ALTER TABLE `solicitudessuplente`
  MODIFY `id_SolSuplente` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipoinstitucion`
--
ALTER TABLE `tipoinstitucion`
  MODIFY `id_Tipo` tinyint(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `turnos`
--
ALTER TABLE `turnos`
  MODIFY `id_Turno` tinyint(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `zonassupervision`
--
ALTER TABLE `zonassupervision`
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
  ADD CONSTRAINT `cargos_ibfk_1` FOREIGN KEY (`id_nombreCargo`) REFERENCES `nombrescargos` (`id_NombreCargo`),
  ADD CONSTRAINT `cargos_ibfk_2` FOREIGN KEY (`id_NombreCargo`) REFERENCES `nombrescargos` (`id_NombreCargo`);

--
-- Filtros para la tabla `cargo_institucion`
--
ALTER TABLE `cargo_institucion`
  ADD CONSTRAINT `Cargo_Institucion_fk1` FOREIGN KEY (`numeroPlaza`) REFERENCES `cargos` (`numeroPlaza`),
  ADD CONSTRAINT `Cargo_Institucion_fk2` FOREIGN KEY (`id_Institucion`) REFERENCES `instituciones` (`id_Institucion`);

--
-- Filtros para la tabla `hssemanal`
--
ALTER TABLE `hssemanal`
  ADD CONSTRAINT `HsSemanal_fk1` FOREIGN KEY (`id_Jornada`) REFERENCES `jornadas` (`id_Jornada`),
  ADD CONSTRAINT `HsSemanal_fk2` FOREIGN KEY (`Id_Cargo_Institucion`) REFERENCES `cargo_institucion` (`id_Cargo_Institucion`);

--
-- Filtros para la tabla `instituciones`
--
ALTER TABLE `instituciones`
  ADD CONSTRAINT `Instituciones_fk4` FOREIGN KEY (`id_Director`) REFERENCES `agentes` (`id_Agente`),
  ADD CONSTRAINT `Instituciones_fk5` FOREIGN KEY (`id_ZonaSupervison`) REFERENCES `zonassupervision` (`id_ZonaSupervision`),
  ADD CONSTRAINT `instituciones_ibfk_1` FOREIGN KEY (`id_Tipo`) REFERENCES `tipoinstitucion` (`id_Tipo`);

--
-- Filtros para la tabla `jornadas`
--
ALTER TABLE `jornadas`
  ADD CONSTRAINT `Jornadas_fk1` FOREIGN KEY (`id_Dia`) REFERENCES `dias` (`id_Dia`);

--
-- Filtros para la tabla `solicitudessuplente`
--
ALTER TABLE `solicitudessuplente`
  ADD CONSTRAINT `SolicitudesSuplente_fk4` FOREIGN KEY (`id_MotivoSuplencia`) REFERENCES `motivossuplencia` (`id_MotivoSuplencia`),
  ADD CONSTRAINT `SolicitudesSuplente_fk6` FOREIGN KEY (`numeroPlaza`) REFERENCES `cargos` (`numeroPlaza`);

--
-- Filtros para la tabla `zonassupervision`
--
ALTER TABLE `zonassupervision`
  ADD CONSTRAINT `ZonasSupervision_fk2` FOREIGN KEY (`id_Supervisor`) REFERENCES `agentes` (`id_Agente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
