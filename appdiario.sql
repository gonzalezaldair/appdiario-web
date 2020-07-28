-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-07-2020 a las 22:21:19
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `appdiario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `abono`
--

CREATE TABLE `abono` (
  `abo_Id` bigint(20) NOT NULL,
  `abo_PRESTAMO` bigint(20) NOT NULL,
  `abo_Monto` int(11) NOT NULL,
  `abo_Fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `abono`
--

INSERT INTO `abono` (`abo_Id`, `abo_PRESTAMO`, `abo_Monto`, `abo_Fecha`) VALUES
(1, 1, 50000, '2020-03-27 19:42:51'),
(2, 1, 10000, '2020-03-26 19:45:05'),
(3, 2, 5500, '2020-03-23 19:45:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `cli_Id` bigint(20) NOT NULL,
  `cli_Cedula` int(11) NOT NULL,
  `cli_Nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `cli_Celular` int(11) NOT NULL,
  `cli_Direccion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `cli_Correo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `cli_Posicion` int(11) NOT NULL,
  `cli_RUTA` bigint(20) NOT NULL,
  `cli_DiaCobro` int(11) NOT NULL,
  `cli_Activo` char(1) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`cli_Id`, `cli_Cedula`, `cli_Nombre`, `cli_Celular`, `cli_Direccion`, `cli_Correo`, `cli_Posicion`, `cli_RUTA`, `cli_DiaCobro`, `cli_Activo`) VALUES
(1, 661815876, 'Auxiliar de Sistemas', 2083206122, 'AV 5 # 8-40', '', 267248840, 1, 3, '1'),
(2, 871636695, 'MORENO ACOSTA MARIE SIBONEY', 1699691819, 'no tiene', '', 418181072, 1, 4, '1'),
(3, 444497249, 'Sala Zona Industrial', 2147483647, 'zona industrial', 'sala@penalosa.com.co', 178554151, 1, 2, '1'),
(18, 829935798, 'CEPEDA CORDON RUFINO ASTOLFO', 1359360414, 'KDX 3B LOTE 4 SAN ISIDRO ANILLO VIAL OCCIDENTAL', '', 20906334, 1, 5, '1'),
(33, 553081321, 'CASTRO SERNA DIANA CAROLINA', 1294025243, 'MZ 26 LT 24 BRR PALMERAS PARTE ALTA', '', 442794675, 1, 6, '1'),
(52, 553369398, 'CARRILLO MENDOZA DIEGO FERNANDO', 1740355693, 'CL 8A 9E 12 BRR LA RIVIERA', '', 34430438, 1, 2, '1'),
(64, 929772574, 'JAIMES PAOLA', 1849641305, 'MA PENALOSA', '', 589864891, 1, 2, '1'),
(79, 329484830, 'PEREZ SANCHEZ LEIDY KARINA', 1162066058, 'AV 5 7 34 BRR LATINO', '', 354983347, 1, 3, '1'),
(85, 630279566, 'PAEZ CELIS VIANY MARCELA', 1177177445, 'CL 14 21 04 BRR NUEVO HORIZONTE', 'ferrematerialesyisan@hotmail.com', 731145613, 1, 4, '1'),
(91, 137954598, 'Zambrano Ascanio Martha Katalina', 1090862395, 'Av 12 Cl 24 01 Br Bellavista', 'donmartillo24@gmail.com', 759932777, 1, 6, '1'),
(93, 454566937, 'AMAYA ORTIZ WILLIAN ANTONIO', 1854677996, 'CL 47 10 50 CAMILO DAZA', 'yamileguizagonzalez@gmail.com', 430750866, 1, 7, '1'),
(97, 555335561, 'RESTREPO JAUREGUI LIGIA LOREY', 1852315564, 'CL 13 18 34 BRR VALLESTER', 'graciliano_florez@hotmail.com', 132949409, 1, 5, '1'),
(98, 855781257, 'SOTO SUAREZ ADRIANA', 1168120873, 'CR 9 14 52 BRR LA PALMITA', 'adrianasoto160887@gmail.com', 230352304, 1, 4, '1'),
(103, 203522425, 'BAYONA HEIDER', 1869859574, 'CL 35 24 02 BRR BELEN', '', 889861163, 1, 1, '1'),
(111, 459572255, 'BAYONA ZAPATA NELSON ENRIQUE', 1559335787, 'AV 29 19 55 BRR RUDESINDO SOTO', '', 142609214, 1, 2, '1'),
(117, 300271974, 'BERNAL TELLEZ JHON FERNANDO', 1409792458, 'AV 24  26 12  LAS COLINAS BRR NUEVO', 'ferchobernal88@gmail.com', 292925223, 1, 6, '1'),
(118, 51092740, 'MORENO CESPEDES ANGELA DEL VALLE', 1145661679, 'CL 16 0 74 BRR AEROPUERO', '', 110152315, 1, 3, '1'),
(125, 888231123, 'PARRA GARCIA CRISTHIAN ALEXIS', 1032218635, 'CL 18 16 02 LA LIBERTAD', '', 997765135, 1, 2, '1'),
(132, 706853808, 'PABUENCE  EVER', 1599351449, 'AV 5 27 75 PATIO CENTRO', '', 407299249, 1, 7, '1'),
(133, 543725264, 'MENDOZA RANGEL YAMILE ANDREA', 2002020866, '', 'yamilemendozarangel@gmail.com', 575066566, 1, 4, '1'),
(140, 699939899, 'QUINTERO LEMUS VIVIANA YARISA', 1889017149, 'CL 18  23  72  BRR SIMON BOLIVAR', 'quinteroviviana56@gamil.com', 339108434, 1, 3, '1'),
(161, 858856641, 'RIOBO QUINTERO NOELI', 1169104339, 'CL 12 10 32 BRR EL PARAMO', '', 655810308, 1, 1, '1'),
(175, 62484902, 'RODRIGUEZ ESTUPI?AN JESUS MARIA', 1494522396, 'CL 5  8 16  BRR LIBERTADORES', 'hoteleldoradodetibu@hotmail.com', 954324009, 1, 6, '1'),
(181, 383589345, 'JARAMILLO QUINTERO CARLOS ROBERTO', 1170946150, 'AV 4 5 113 BRR SAN LUIS', '', 763464554, 1, 5, '1'),
(192, 920344871, 'COLMENARES OSSA RAUL ANTONIO', 1971789776, 'AV 0  2N   21 P 2 ED ANDALUCIA', '', 849155152, 1, 2, '1'),
(197, 724839757, 'FLORES ROQUE JULIO', 2004074328, 'AV 5 28 42 BUENOS AIRES', '', 979148675, 1, 4, '1'),
(199, 954550770, 'GOMEZ FLOREZ JOSE ADRIANO', 1440758337, 'CL 22 0C 21 BRR EL ROSAL', '', 406486111, 1, 7, '1'),
(200, 223244565, 'BENITEZ CRUCES JOSE LIBORIO', 1562075174, 'CL23  26-20 BRR BELEN', '', 999798504, 1, 3, '1'),
(219, 275574297, 'PEREZ AMADOR EUSEBIO RAFAEL', 1287297003, 'CL 21 A 1 25 GIRA LUNA BRR BLANCO', '', 865331191, 1, 4, '1'),
(235, 761527018, 'LEAL SAUL RAMON', 1063679981, 'KDX 200 9 LOTE 2 PINAR DEL RIO', '', 396329103, 1, 4, '1'),
(236, 587828063, 'GALEANO SANTIAGO', 1643606560, 'MZ 3 LOTE 34 CLARET 4 ETAPA', '', 154134907, 1, 1, '1'),
(237, 575764393, 'JULIO OSCAR EMILIO', 1841623691, 'AV 11  N 50 BRR MARIA PAZ', '', 246781141, 1, 6, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cobro`
--

CREATE TABLE `cobro` (
  `cob_Id` bigint(20) NOT NULL,
  `cob_Codigo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `cob_Nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `cob_Fecha` date NOT NULL,
  `cob_Activo` char(1) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cobro`
--

INSERT INTO `cobro` (`cob_Id`, `cob_Codigo`, `cob_Nombre`, `cob_Fecha`, `cob_Activo`) VALUES
(1, 'COB-001', 'General', '2020-03-24', 'Y');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formapago`
--

CREATE TABLE `formapago` (
  `frm_Id` bigint(20) NOT NULL,
  `frm_Codigo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `frm_Nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `frm_Activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `formapago`
--

INSERT INTO `formapago` (`frm_Id`, `frm_Codigo`, `frm_Nombre`, `frm_Activo`) VALUES
(1, 'FRM-001', 'Diario', 1),
(2, 'FRM-002', 'Semanal', 1),
(3, 'FRM-003', 'Quincenal', 1),
(4, 'FRM-004', 'Mensual', 1),
(5, 'FRM-5', 'PAGO CONTADO', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

CREATE TABLE `modulos` (
  `mod_Id` bigint(20) NOT NULL,
  `mod_Codigo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `mod_Nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `mod_Url` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`mod_Id`, `mod_Codigo`, `mod_Nombre`, `mod_Url`) VALUES
(1, 'MOD-001', 'Abono', 'abonos'),
(2, 'MOD-002', 'Clientes', 'clientes'),
(3, 'MOD--003', 'Cobro', 'cobro'),
(4, 'MOD-004', 'Forma de Pago', 'forma-pago'),
(5, 'MOD-005', 'Rol', 'rol'),
(6, 'MOD-006', 'Ruta', 'ruta'),
(7, 'MOD-007', 'Usuario', 'usuarios'),
(8, 'MOD-008', 'Prestamos', 'prestamos'),
(9, 'MOD-009', 'Reportes', 'reportes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `per_Id` bigint(20) NOT NULL,
  `per_Codigo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `per_Nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `per_Activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`per_Id`, `per_Codigo`, `per_Nombre`, `per_Activo`) VALUES
(1, 'PER-001', 'Administrador', 1),
(2, 'PER-002', 'Cobrador', 1),
(3, 'PER-003', 'Cliente', 1),
(4, 'PER-004', 'Secretaria', 1),
(5, 'PER-5', 'Supervisor', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perf_modulos`
--

CREATE TABLE `perf_modulos` (
  `pemod_Id` bigint(20) UNSIGNED NOT NULL,
  `pemod_MODULO` bigint(20) NOT NULL,
  `pemod_PERFIL` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `perf_modulos`
--

INSERT INTO `perf_modulos` (`pemod_Id`, `pemod_MODULO`, `pemod_PERFIL`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 1),
(7, 7, 1),
(8, 8, 1),
(9, 9, 1),
(10, 1, 2),
(11, 2, 2),
(12, 8, 2),
(13, 3, 3),
(14, 4, 3),
(15, 6, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamo`
--

CREATE TABLE `prestamo` (
  `pre_Id` bigint(20) NOT NULL,
  `pre_Fecha` date NOT NULL,
  `pre_CLIENTE` bigint(20) NOT NULL,
  `pre_FormaPago` bigint(20) NOT NULL,
  `pre_Interes` int(2) NOT NULL,
  `pre_MontoPrestado` int(11) NOT NULL,
  `pre_MontoInteres` int(11) NOT NULL,
  `pre_Cuotas` int(11) NOT NULL,
  `pre_Observaciones` text COLLATE utf8_spanish_ci NOT NULL,
  `pre_USUARIO` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `prestamo`
--

INSERT INTO `prestamo` (`pre_Id`, `pre_Fecha`, `pre_CLIENTE`, `pre_FormaPago`, `pre_Interes`, `pre_MontoPrestado`, `pre_MontoInteres`, `pre_Cuotas`, `pre_Observaciones`, `pre_USUARIO`) VALUES
(1, '2020-01-03', 1, 1, 32, 105879, 139760, 30, '', 2),
(2, '2020-02-04', 2, 2, 31, 106343, 139309, 4, '', 1),
(3, '2020-03-25', 3, 4, 27, 177293, 225162, 1, '', 2),
(4, '2020-02-10', 18, 1, 37, 170986, 234251, 30, '', 2),
(5, '2020-02-09', 33, 1, 38, 186656, 257585, 30, '', 2),
(6, '2020-02-24', 52, 4, 36, 145174, 197437, 1, '', 2),
(7, '2020-02-28', 64, 4, 30, 102892, 133760, 1, '', 2),
(8, '2020-02-04', 79, 2, 20, 173797, 208556, 4, '', 1),
(9, '2020-02-24', 85, 3, 31, 156963, 205622, 2, '', 2),
(10, '2020-02-23', 91, 2, 26, 159259, 200666, 4, '', 1),
(11, '2020-02-23', 93, 3, 20, 125151, 150181, 2, '', 2),
(12, '2020-02-23', 97, 4, 22, 176931, 215856, 1, '', 2),
(13, '2020-02-25', 98, 3, 27, 115401, 146559, 2, '', 1),
(14, '2020-02-25', 103, 4, 32, 132189, 174489, 1, '', 2),
(15, '2020-02-26', 111, 3, 23, 156448, 192431, 2, '', 2),
(16, '2020-02-26', 117, 4, 38, 125984, 173858, 1, '', 2),
(17, '2020-02-26', 118, 2, 31, 197564, 258809, 4, '', 2),
(18, '2020-02-26', 125, 1, 20, 133312, 159974, 30, '', 2),
(19, '2020-02-27', 132, 1, 20, 179520, 215424, 30, '', 1),
(20, '2020-02-27', 133, 2, 25, 157076, 196345, 4, '', 2),
(21, '2020-02-27', 140, 2, 28, 113818, 145687, 4, '', 2),
(22, '2020-02-27', 161, 3, 37, 159296, 218236, 2, '', 1),
(23, '2020-02-27', 175, 1, 39, 140061, 194685, 30, '', 2),
(24, '2020-02-28', 181, 3, 37, 139785, 191505, 2, '', 2),
(25, '2020-02-28', 192, 3, 29, 156057, 201314, 2, '', 2),
(26, '2020-02-19', 197, 2, 26, 131313, 165454, 4, '', 1),
(27, '2020-02-19', 199, 3, 34, 135738, 181889, 2, '', 1),
(28, '2020-02-18', 200, 4, 21, 158994, 192383, 1, '', 1),
(29, '2020-02-17', 219, 3, 36, 147459, 200544, 2, '', 1),
(30, '2020-02-18', 235, 2, 29, 140210, 180871, 4, '', 2),
(31, '2020-02-17', 236, 4, 35, 183339, 247508, 1, '', 2),
(32, '2020-02-13', 237, 3, 24, 103842, 128764, 2, '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `rol_Id` bigint(20) NOT NULL,
  `rol_Codigo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `rol_Nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `rol_MODULO` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`rol_Id`, `rol_Codigo`, `rol_Nombre`, `rol_MODULO`) VALUES
(1, 'ROL-001', 'Crear', 1),
(2, 'ROL-002', 'Actualizar', 1),
(3, 'ROL-003', 'Leer', 1),
(4, 'ROL-004', 'Borrar', 1),
(5, 'ROL-005', 'Crear', 2),
(6, 'ROL-006', 'Actualizar', 2),
(7, 'ROL-007', 'Leer', 2),
(8, 'ROL-008', 'Borrar', 2),
(9, 'ROL-009', 'Crear', 3),
(10, 'ROL-010', 'Actualizar', 3),
(11, 'ROL-011', 'Leer', 3),
(12, 'ROL-012', 'Borrar', 3),
(13, 'ROL-013', 'Crear', 4),
(14, 'ROL-014', 'Actualizar', 4),
(15, 'ROL-015', 'Leer', 4),
(16, 'ROL-016', 'Borrar', 4),
(17, 'ROL-017', 'Crear', 5),
(18, 'ROL-018', 'Actualizar', 5),
(19, 'ROL-019', 'Leer', 5),
(20, 'ROL-020', 'Borrar', 5),
(21, 'ROL-021', 'Crear', 6),
(22, 'ROL-022', 'Actualizar', 6),
(23, 'ROL-023', 'Leer', 6),
(24, 'ROL-024', 'Borrar', 6),
(25, 'ROL-025', 'Crear', 7),
(26, 'ROL-026', 'Actualizar', 7),
(27, 'ROL-027', 'Leer', 7),
(28, 'ROL-028', 'Borrar', 7),
(29, 'ROL-029', 'Crear', 8),
(30, 'ROL-030', 'Actualizar', 8),
(31, 'ROL-031', 'Leer', 8),
(32, 'ROL-032', 'Borrar', 8),
(33, 'ROL-033', 'Crear', 9),
(34, 'ROL-034', 'Actualizar', 9),
(35, 'ROL-035', 'Leer', 9),
(36, 'ROL-036', 'Borrar', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_usuario`
--

CREATE TABLE `rol_usuario` (
  `rolus_Id` bigint(20) NOT NULL,
  `rolus_ROL` bigint(20) NOT NULL,
  `rolus_USUARIO` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `rol_usuario`
--

INSERT INTO `rol_usuario` (`rolus_Id`, `rolus_ROL`, `rolus_USUARIO`) VALUES
(1, 1, 1),
(2, 5, 1),
(3, 26, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ruta`
--

CREATE TABLE `ruta` (
  `rut_Id` bigint(20) NOT NULL,
  `rut_Codigo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `rut_Nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `rut_COBRO` bigint(20) NOT NULL,
  `rut_Activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ruta`
--

INSERT INTO `ruta` (`rut_Id`, `rut_Codigo`, `rut_Nombre`, `rut_COBRO`, `rut_Activo`) VALUES
(1, 'RUT-001', 'Principal', 1, 1),
(2, 'RUT-2', 'Ruta VILLA', 1, 1),
(3, 'RUT-3', 'Ruta Patios', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usu_Id` bigint(20) NOT NULL,
  `usu_Login` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `usu_Password` text COLLATE utf8_spanish_ci NOT NULL,
  `usu_Nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `usu_Celular` bigint(20) NOT NULL,
  `usu_Correo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `usu_Direccion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `usu_RUTA` bigint(20) NOT NULL,
  `usu_Cedula` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `usu_Perfil` bigint(20) NOT NULL,
  `usu_Activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usu_Id`, `usu_Login`, `usu_Password`, `usu_Nombre`, `usu_Celular`, `usu_Correo`, `usu_Direccion`, `usu_RUTA`, `usu_Cedula`, `usu_Perfil`, `usu_Activo`) VALUES
(1, '13500750', '', 'German Gonzalez', 3134215929, '', 'MZ 3 LOTE 11', 1, '13500750', 1, 1),
(2, '1090472103', '', 'Aldair Gonzalez', 3156888647, '', '', 1, '1090472103', 2, 1),
(3, '1090504494', '', 'Yurley Suarez', 3151234567, '', '', 1, '1090504494', 4, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `abono`
--
ALTER TABLE `abono`
  ADD PRIMARY KEY (`abo_Id`),
  ADD UNIQUE KEY `abo_Id` (`abo_Id`),
  ADD KEY `abo_PRESTAMO` (`abo_PRESTAMO`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cli_Id`),
  ADD UNIQUE KEY `cli_Id` (`cli_Id`),
  ADD UNIQUE KEY `cli_Cedula` (`cli_Cedula`),
  ADD UNIQUE KEY `cli_Celular` (`cli_Celular`),
  ADD KEY `cli_RUTA` (`cli_RUTA`);

--
-- Indices de la tabla `cobro`
--
ALTER TABLE `cobro`
  ADD PRIMARY KEY (`cob_Id`),
  ADD UNIQUE KEY `cob_Id` (`cob_Id`);

--
-- Indices de la tabla `formapago`
--
ALTER TABLE `formapago`
  ADD PRIMARY KEY (`frm_Id`),
  ADD UNIQUE KEY `frm_Id` (`frm_Id`),
  ADD UNIQUE KEY `frm_Codigo` (`frm_Codigo`);

--
-- Indices de la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`mod_Id`),
  ADD UNIQUE KEY `mod_Id` (`mod_Id`),
  ADD UNIQUE KEY `mod_Codigo` (`mod_Codigo`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`per_Id`),
  ADD UNIQUE KEY `per_Id` (`per_Id`),
  ADD UNIQUE KEY `per_Codigo` (`per_Codigo`);

--
-- Indices de la tabla `perf_modulos`
--
ALTER TABLE `perf_modulos`
  ADD PRIMARY KEY (`pemod_Id`),
  ADD UNIQUE KEY `pemod_Id` (`pemod_Id`),
  ADD KEY `pemod_MODULO` (`pemod_MODULO`),
  ADD KEY `pemod_PERFIL` (`pemod_PERFIL`);

--
-- Indices de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD PRIMARY KEY (`pre_Id`),
  ADD UNIQUE KEY `pre_Id` (`pre_Id`),
  ADD KEY `pre_CLIENTE` (`pre_CLIENTE`),
  ADD KEY `pre_FormaPago` (`pre_FormaPago`),
  ADD KEY `pre_USUARIO` (`pre_USUARIO`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`rol_Id`),
  ADD UNIQUE KEY `rol_Id` (`rol_Id`),
  ADD UNIQUE KEY `rol_Codigo` (`rol_Codigo`),
  ADD KEY `rol_MODULO` (`rol_MODULO`);

--
-- Indices de la tabla `rol_usuario`
--
ALTER TABLE `rol_usuario`
  ADD PRIMARY KEY (`rolus_Id`),
  ADD UNIQUE KEY `rolus_Id` (`rolus_Id`),
  ADD KEY `rolus_ROL` (`rolus_ROL`),
  ADD KEY `rolus_USUARIO` (`rolus_USUARIO`);

--
-- Indices de la tabla `ruta`
--
ALTER TABLE `ruta`
  ADD PRIMARY KEY (`rut_Id`),
  ADD UNIQUE KEY `rut_Id` (`rut_Id`),
  ADD UNIQUE KEY `rut_Codigo` (`rut_Codigo`),
  ADD KEY `rut_COBRO` (`rut_COBRO`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usu_Id`),
  ADD UNIQUE KEY `usu_Id` (`usu_Id`),
  ADD UNIQUE KEY `usu_Login` (`usu_Login`),
  ADD UNIQUE KEY `usu_Cedula` (`usu_Cedula`),
  ADD UNIQUE KEY `usu_Celular` (`usu_Celular`),
  ADD KEY `usu_RUTA` (`usu_RUTA`),
  ADD KEY `usu_Perfil` (`usu_Perfil`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `abono`
--
ALTER TABLE `abono`
  MODIFY `abo_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `cli_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=242;

--
-- AUTO_INCREMENT de la tabla `cobro`
--
ALTER TABLE `cobro`
  MODIFY `cob_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `formapago`
--
ALTER TABLE `formapago`
  MODIFY `frm_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `modulos`
--
ALTER TABLE `modulos`
  MODIFY `mod_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `per_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `perf_modulos`
--
ALTER TABLE `perf_modulos`
  MODIFY `pemod_Id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  MODIFY `pre_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `rol_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `rol_usuario`
--
ALTER TABLE `rol_usuario`
  MODIFY `rolus_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ruta`
--
ALTER TABLE `ruta`
  MODIFY `rut_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usu_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `abono`
--
ALTER TABLE `abono`
  ADD CONSTRAINT `abono_ibfk_1` FOREIGN KEY (`abo_PRESTAMO`) REFERENCES `prestamo` (`pre_Id`);

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`cli_RUTA`) REFERENCES `ruta` (`rut_Id`);

--
-- Filtros para la tabla `perf_modulos`
--
ALTER TABLE `perf_modulos`
  ADD CONSTRAINT `perf_modulos_ibfk_1` FOREIGN KEY (`pemod_MODULO`) REFERENCES `modulos` (`mod_Id`),
  ADD CONSTRAINT `perf_modulos_ibfk_2` FOREIGN KEY (`pemod_PERFIL`) REFERENCES `perfiles` (`per_Id`);

--
-- Filtros para la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD CONSTRAINT `prestamo_ibfk_1` FOREIGN KEY (`pre_USUARIO`) REFERENCES `usuario` (`usu_Id`),
  ADD CONSTRAINT `prestamo_ibfk_2` FOREIGN KEY (`pre_CLIENTE`) REFERENCES `cliente` (`cli_Id`),
  ADD CONSTRAINT `prestamo_ibfk_3` FOREIGN KEY (`pre_FormaPago`) REFERENCES `formapago` (`frm_Id`);

--
-- Filtros para la tabla `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `roles_ibfk_1` FOREIGN KEY (`rol_MODULO`) REFERENCES `modulos` (`mod_Id`);

--
-- Filtros para la tabla `rol_usuario`
--
ALTER TABLE `rol_usuario`
  ADD CONSTRAINT `rol_usuario_ibfk_1` FOREIGN KEY (`rolus_ROL`) REFERENCES `roles` (`rol_Id`),
  ADD CONSTRAINT `rol_usuario_ibfk_2` FOREIGN KEY (`rolus_USUARIO`) REFERENCES `usuario` (`usu_Id`);

--
-- Filtros para la tabla `ruta`
--
ALTER TABLE `ruta`
  ADD CONSTRAINT `ruta_ibfk_1` FOREIGN KEY (`rut_COBRO`) REFERENCES `cobro` (`cob_Id`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`usu_Perfil`) REFERENCES `perfiles` (`per_Id`),
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`usu_RUTA`) REFERENCES `ruta` (`rut_Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
