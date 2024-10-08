-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-10-2024 a las 21:04:34
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agentes`
--

CREATE TABLE `agentes` (
  `id_Agente` int(11) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `dni` int(11) NOT NULL,
  `telefono` bigint(20) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `id_Rol` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `agentes`
--

INSERT INTO `agentes` (`id_Agente`, `apellido`, `nombre`, `dni`, `telefono`, `direccion`, `email`, `usuario`, `password`, `id_Rol`) VALUES
(1, 'Perez', 'Juan', 99999999, 234, 'Calle 13', 'nombre@mail.com', '', '', 4),
(2, 'Barrios', 'Julio Ramon', 99999998, 234, 'Calle 13', 'nombre@mail.com', '', '', 1),
(3, 'Super', 'Zona A', 11111111, 345, 'Calle 13', 'agente@mail.com', 'UsuarioZonaA', 'SupervisorA', 2),
(4, 'Super', 'Zona B', 22222222, 345, 'Calle 13', 'agente@mail.com', 'UsuarioZonaB', 'SupervisorB', 2),
(5, 'Super', 'Zona C', 33333333, 345, 'Calle 13', 'agente@mail.com', 'UsuarioZonaC', 'SupervisorC', 2),
(6, 'Super', 'Zona D', 44444444, 345, 'Calle 13', 'agente@mail.com', 'UsuarioZonaD', 'SupervisorD', 2),
(7, 'Super', 'Zona E', 55555555, 345, 'Calle 13', 'agente@mail.com', 'UsuarioZonaE', 'SupervisorE', 2),
(8, 'Super', 'Especial Zona C', 66666666, 345, 'Calle 13', 'agente@mail.com', 'UsuarioEspecialC', 'SupervisorEspC', 2),
(9, 'Super', 'Jóvenes y Adultos', 77777777, 345, 'Calle 13', 'agente@mail.com', 'UsuarioJyA', 'SupervisorJyA', 2),
(10, 'Super', 'Nivel Inicial V', 88888888, 345, 'Calle 13', 'agente@mail.com', 'UsuarioNIV', 'SupervisorNIV', 2),
(11, 'Super', 'Nivel Inicial XVI', 88888889, 345, 'Calle 13', 'agente@mail.com', 'UsuarioNIXVI', 'SupervisorNIXVI', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `numeroPlaza` int(11) NOT NULL,
  `nombreCargo` varchar(100) NOT NULL,
  `id_Grado` tinyint(4) DEFAULT NULL,
  `id_Division` tinyint(4) DEFAULT NULL,
  `id_Turno` tinyint(4) DEFAULT NULL,
  `hsCatedra` int(11) NOT NULL,
  `apellidoDocente` varchar(100) DEFAULT NULL,
  `nombreDocente` varchar(100) DEFAULT NULL,
  `dniDocente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo_institucion`
--

CREATE TABLE `cargo_institucion` (
  `id_Cargo_Institucion` int(11) NOT NULL,
  `numeroPlaza` int(11) NOT NULL,
  `id_Institucion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dias`
--

CREATE TABLE `dias` (
  `id_Dia` tinyint(4) NOT NULL,
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
  `id_Division` tinyint(4) NOT NULL,
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
  `id_Grado` tinyint(4) NOT NULL,
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
  `id_HsSemanal` int(11) NOT NULL,
  `id_Jornada` int(11) NOT NULL,
  `Id_Cargo_Institucion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instituciones`
--

CREATE TABLE `instituciones` (
  `id_Institucion` int(11) NOT NULL,
  `cue` int(11) NOT NULL,
  `numero` smallint(6) DEFAULT NULL,
  `nombre` varchar(100) NOT NULL,
  `id_Director` int(11) NOT NULL,
  `id_ZonaSupervison` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jornadas`
--

CREATE TABLE `jornadas` (
  `id_Jornada` int(11) NOT NULL,
  `id_Dia` tinyint(4) NOT NULL,
  `horaInicio` time NOT NULL,
  `horaFin` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `motivossuplencia`
--

CREATE TABLE `motivossuplencia` (
  `id_MotivoSuplencia` int(11) NOT NULL,
  `Motivo` varchar(100) NOT NULL,
  `Resolucion` varchar(100) NOT NULL,
  `Articulo` smallint(6) DEFAULT NULL,
  `Insciso` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `motivossuplencia`
--

INSERT INTO `motivossuplencia` (`id_MotivoSuplencia`, `Motivo`, `Resolucion`, `Articulo`, `Insciso`) VALUES
(1, 'Baja - Renuncia', '', NULL, ''),
(2, 'Baja - Jubilación', '', NULL, ''),
(3, 'Baja - Otro', '', NULL, ''),
(4, 'Afectación', '', NULL, ''),
(5, 'Adscripción', '', NULL, ''),
(6, 'Sumario Administrativo', '', NULL, ''),
(7, 'Casos Especiales', '', 9, ''),
(8, 'Licencia Anual Ordinaria (LAO)', '', 11, ''),
(9, 'Enfermedad Corto Tratamiento', '', 12, 'A'),
(10, 'Enfermedad Largo Tratamiento', '', 12, 'B'),
(11, 'Accidente de Trabajo', '', 12, 'C'),
(12, 'Incapacidad', '', 12, 'D'),
(13, 'Maternidad', '', 13, 'A'),
(14, 'Paternidad', '', 13, 'B'),
(15, 'Lactancia', '', 13, 'C'),
(16, 'Adopción', '', 13, 'D'),
(17, 'Atención de Hijo Menor', '', 13, 'E'),
(18, 'Prof. Educ. Física', '', 13, 'F'),
(19, 'Atención del Grupo Familiar', '', 14, ''),
(20, 'Matrimonio del Agente', '', 16, 'A'),
(21, 'Matrimonio de los hijos', '', 16, 'B'),
(22, 'Exámen Prenupcial', '', 16, 'C'),
(23, 'Duelo', '', 16, 'D'),
(24, 'Donación de Sangre', '', 16, 'E'),
(25, 'Donación de Órganos', '', 16, 'F'),
(26, 'Mesas Examinadoras', '', 16, 'G'),
(27, 'Mudanza', '', 16, 'H'),
(28, 'Razones Personales', '', 16, 'I'),
(29, 'Rendir Exámenes', '', 16, 'J'),
(30, 'Perfeccionamiento Docente', '', 16, 'K'),
(31, 'Actividades de Interés Público', '', 16, 'L'),
(32, 'Licencia Deportiva', '', 16, 'M'),
(33, 'Acompañar Delegaciones Escolares', '', 16, 'N'),
(34, 'Intervención en Concursos', '', 16, 'Ñ'),
(35, 'Razones Gremiales', '', 16, 'O'),
(36, 'Postulación para Cargos Electivos', '', 16, 'P'),
(37, 'Razones Particulares', '', 16, 'Q'),
(38, 'Acompañar al Cónyuge', '', 16, 'R'),
(39, 'Desempeños en Cargos Políticos', '', 16, 'S'),
(40, 'Razones de Interés Pedagógico', '', 16, 'T'),
(41, 'Mayor Jerarquía', '', 16, 'U'),
(42, 'Comisión de Servicio', '', NULL, ''),
(43, 'Amonestación', '1271/04', 8, ''),
(44, 'Fenómenos Meteorológicos', '', 5, 'J'),
(45, 'Día Religioso Dec. 1584/10', '', NULL, ''),
(46, 'Día Religioso Ley 10224', '', NULL, ''),
(47, 'Otro - Aclarar en Observaciones', '', NULL, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_Rol` tinyint(4) NOT NULL,
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
  `id_SolSuplente` int(11) NOT NULL,
  `numeroTramite` int(11) DEFAULT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFin` date NOT NULL,
  `id_MotivoSuplencia` int(11) NOT NULL,
  `observaciones` varchar(100) DEFAULT NULL,
  `numeroPlaza` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnos`
--

CREATE TABLE `turnos` (
  `id_Turno` tinyint(4) NOT NULL,
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
  `id_ZonaSupervision` smallint(6) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `id_Supervisor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `zonassupervision`
--

INSERT INTO `zonassupervision` (`id_ZonaSupervision`, `nombre`, `id_Supervisor`) VALUES
(1, 'Dirección Departamental de Escuelas de Concordia', 2),
(2, 'Supervisor Escolar de Zona A', 3),
(3, 'Supervisor Escolar de Zona B', 4),
(4, 'Supervisor Escolar de Zona C', 5),
(5, 'Supervisor Escolar de Zona D', 6),
(6, 'Supervisor Escolar de Zona E', 7),
(7, 'Supervisor Escolar de Enseñanza Especial Zona C', 8),
(8, 'Supervisor Escolar de Jóvenes y Adultos Zona VI', 9),
(9, 'Supervisor Escolar de Nivel Inicial Zona V', 10),
(10, 'Supervisor Escolar de Nivel Inicial Zona XVI', 11);

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
  ADD KEY `Cargos_fk4` (`id_Turno`);

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
  ADD KEY `Instituciones_fk5` (`id_ZonaSupervison`);

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
  MODIFY `id_Agente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `numeroPlaza` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cargo_institucion`
--
ALTER TABLE `cargo_institucion`
  MODIFY `id_Cargo_Institucion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `dias`
--
ALTER TABLE `dias`
  MODIFY `id_Dia` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `divisiones`
--
ALTER TABLE `divisiones`
  MODIFY `id_Division` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `grados`
--
ALTER TABLE `grados`
  MODIFY `id_Grado` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `hssemanal`
--
ALTER TABLE `hssemanal`
  MODIFY `id_HsSemanal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `instituciones`
--
ALTER TABLE `instituciones`
  MODIFY `id_Institucion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jornadas`
--
ALTER TABLE `jornadas`
  MODIFY `id_Jornada` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `motivossuplencia`
--
ALTER TABLE `motivossuplencia`
  MODIFY `id_MotivoSuplencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_Rol` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `solicitudessuplente`
--
ALTER TABLE `solicitudessuplente`
  MODIFY `id_SolSuplente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `turnos`
--
ALTER TABLE `turnos`
  MODIFY `id_Turno` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `zonassupervision`
--
ALTER TABLE `zonassupervision`
  MODIFY `id_ZonaSupervision` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  ADD CONSTRAINT `Cargos_fk4` FOREIGN KEY (`id_Turno`) REFERENCES `turnos` (`id_Turno`);

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
  ADD CONSTRAINT `Instituciones_fk5` FOREIGN KEY (`id_ZonaSupervison`) REFERENCES `zonassupervision` (`id_ZonaSupervision`);

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
