-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-08-2020 a las 23:41:51
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
(1, 1, 20000, '2020-08-19 23:14:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `cli_Id` bigint(20) NOT NULL,
  `cli_Cedula` int(11) NOT NULL,
  `cli_Nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `cli_Celular` bigint(20) NOT NULL,
  `cli_Direccion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `cli_Correo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `cli_Posicion` int(11) NOT NULL,
  `cli_RUTA` bigint(20) NOT NULL,
  `cli_DiaCobro` int(11) NOT NULL,
  `cli_Activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`cli_Id`, `cli_Cedula`, `cli_Nombre`, `cli_Celular`, `cli_Direccion`, `cli_Correo`, `cli_Posicion`, `cli_RUTA`, `cli_DiaCobro`, `cli_Activo`) VALUES
(251, 1090472103, 'ALDAIR JOSE', 3156888647, 'TUCUNARE', 'NOTIENE@NOTIENE.COM', 0, 1, 2, 1),
(252, 1090472104, 'LIGIA SUAREZ', 3156694464, 'SIN DIRECCION', 'NOTIENE@NOTIENE.COM', 0, 1, 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cobro`
--

CREATE TABLE `cobro` (
  `cob_Id` bigint(20) NOT NULL,
  `cob_Codigo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `cob_Nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `cob_Fecha` date NOT NULL,
  `cob_Activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cobro`
--

INSERT INTO `cobro` (`cob_Id`, `cob_Codigo`, `cob_Nombre`, `cob_Fecha`, `cob_Activo`) VALUES
(1, 'COB-001', 'General', '2020-03-24', 1);

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
(11, '01', 'DIARIO', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

CREATE TABLE `modulos` (
  `mod_Id` bigint(20) NOT NULL,
  `mod_Codigo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `mod_Nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `mod_Url` text COLLATE utf8_spanish_ci NOT NULL,
  `mod_Icon` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`mod_Id`, `mod_Codigo`, `mod_Nombre`, `mod_Url`, `mod_Icon`) VALUES
(1, 'MOD-001', 'Abono', 'abonos', 'fas fa-coins'),
(2, 'MOD-002', 'Clientes', 'clientes', 'fas fa-user-friends'),
(3, 'MOD--003', 'Cobro', 'cobro', 'fas fa-layer-group'),
(4, 'MOD-004', 'Forma de Pago', 'forma-pago', 'fas fa-money-check-alt'),
(5, 'MOD-005', 'Perfil', 'perfil', 'fas fa-clipboard-list'),
(6, 'MOD-006', 'Ruta', 'ruta', 'fas fa-map-marked-alt'),
(7, 'MOD-007', 'Usuario', 'usuarios', 'fas fa-user'),
(8, 'MOD-008', 'Prestamos', 'prestamos', 'fas fa-dollar-sign'),
(9, 'MOD-009', 'Reportes', 'reportes', 'fas fa-table');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `operaciones`
--

CREATE TABLE `operaciones` (
  `ope_Id` bigint(20) NOT NULL,
  `ope_Nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `ope_MODULO` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `operaciones`
--

INSERT INTO `operaciones` (`ope_Id`, `ope_Nombre`, `ope_MODULO`) VALUES
(1, 'CREAR', 1),
(2, 'LEER', 1),
(3, 'ACTUALIZAR', 1),
(4, 'BORRAR', 1),
(5, 'CREAR', 2),
(6, 'LEER', 2),
(7, 'ACTUALIZAR', 2),
(8, 'BORRAR', 2),
(9, 'CREAR', 3),
(10, 'LEER', 3),
(11, 'ACTUALIZAR', 3),
(12, 'BORRAR', 3),
(13, 'CREAR', 4),
(14, 'LEER', 4),
(15, 'ACTUALIZAR', 4),
(16, 'BORRAR', 4),
(17, 'CREAR', 5),
(18, 'LEER', 5),
(19, 'ACTUALIZAR', 5),
(20, 'BORRAR', 5),
(21, 'CREAR', 6),
(22, 'LEER', 6),
(23, 'ACTUALIZAR', 6),
(24, 'BORRAR', 6),
(25, 'CREAR', 7),
(26, 'LEER', 7),
(27, 'ACTUALIZAR', 7),
(28, 'BORRAR', 7),
(29, 'CREAR', 8),
(30, 'LEER', 8),
(31, 'ACTUALIZAR', 8),
(32, 'BORRAR', 8),
(33, 'LEER', 9);

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
(2, 'PER-002', 'COBRADOR', 1),
(3, 'PER-003', 'Cliente', 1),
(4, 'PER-004', 'Secretaria', 1),
(5, 'PER-5', 'SUPERVISOR', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil_operaciones`
--

CREATE TABLE `perfil_operaciones` (
  `po_Id` bigint(20) NOT NULL,
  `po_PERFIL` bigint(20) NOT NULL,
  `po_OPERACION` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `perfil_operaciones`
--

INSERT INTO `perfil_operaciones` (`po_Id`, `po_PERFIL`, `po_OPERACION`) VALUES
(34, 2, 5),
(35, 2, 6),
(36, 2, 7),
(38, 2, 29),
(39, 2, 30),
(40, 2, 31),
(42, 2, 1),
(43, 2, 2),
(44, 2, 3),
(742, 1, 1),
(743, 1, 2),
(744, 1, 3),
(745, 1, 4),
(746, 1, 5),
(747, 1, 6),
(748, 1, 7),
(749, 1, 8),
(750, 1, 9),
(751, 1, 10),
(752, 1, 11),
(753, 1, 12),
(754, 1, 13),
(755, 1, 14),
(756, 1, 15),
(757, 1, 16),
(758, 1, 17),
(759, 1, 18),
(760, 1, 19),
(761, 1, 20),
(762, 1, 21),
(763, 1, 22),
(764, 1, 23),
(765, 1, 24),
(766, 1, 25),
(767, 1, 26),
(768, 1, 27),
(769, 1, 28),
(770, 1, 29),
(771, 1, 30),
(772, 1, 31),
(773, 1, 32),
(774, 1, 33);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamo`
--

CREATE TABLE `prestamo` (
  `pre_Id` bigint(20) NOT NULL,
  `pre_Fecha` datetime NOT NULL,
  `pre_CLIENTE` bigint(20) NOT NULL,
  `pre_FormaPago` bigint(20) NOT NULL,
  `pre_Interes` int(3) NOT NULL,
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
(1, '2020-08-19 16:12:51', 251, 11, 10, 25000, 27500, 5, 'SIN OBSERVACIONES', 1);

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
(1, 'RUT-001', 'PRINCIPAL', 1, 1);

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
(1, '13500750', '$2y$10$JyYTC.GYBWnhqVMxFaZ3E.5iGd/4YZf9j7XpBc8S3DtJTrPNN2LkK', 'German Gonzalez', 3134215929, '', 'MZ 3 LOTE 11', 1, '13500750', 1, 1),
(2, '1090472103', '$2y$10$JyYTC.GYBWnhqVMxFaZ3E.5iGd/4YZf9j7XpBc8S3DtJTrPNN2LkK', 'ALDAIR GONZALEZ AMAYA', 3156888647, 'NOTIENE@NOTIENE.COM', 'SIN DIRECCION', 1, '1090472103', 2, 1),
(3, '1090504494', '$2y$10$JyYTC.GYBWnhqVMxFaZ3E.5iGd/4YZf9j7XpBc8S3DtJTrPNN2LkK', 'YURLEY SUAREZ', 3151234567, 'NOTIENE@NOTIENE.COM', '456', 1, '1090504494', 4, 1);

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
-- Indices de la tabla `operaciones`
--
ALTER TABLE `operaciones`
  ADD PRIMARY KEY (`ope_Id`),
  ADD UNIQUE KEY `ope_Id` (`ope_Id`),
  ADD KEY `ope_MODULO` (`ope_MODULO`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`per_Id`),
  ADD UNIQUE KEY `per_Id` (`per_Id`),
  ADD UNIQUE KEY `per_Codigo` (`per_Codigo`);

--
-- Indices de la tabla `perfil_operaciones`
--
ALTER TABLE `perfil_operaciones`
  ADD PRIMARY KEY (`po_Id`),
  ADD UNIQUE KEY `po_Id` (`po_Id`),
  ADD KEY `po_PERFIL` (`po_PERFIL`),
  ADD KEY `po_OPERACION` (`po_OPERACION`);

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
  MODIFY `abo_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `cli_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=253;

--
-- AUTO_INCREMENT de la tabla `cobro`
--
ALTER TABLE `cobro`
  MODIFY `cob_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `formapago`
--
ALTER TABLE `formapago`
  MODIFY `frm_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `modulos`
--
ALTER TABLE `modulos`
  MODIFY `mod_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `operaciones`
--
ALTER TABLE `operaciones`
  MODIFY `ope_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `per_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `perfil_operaciones`
--
ALTER TABLE `perfil_operaciones`
  MODIFY `po_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=775;

--
-- AUTO_INCREMENT de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  MODIFY `pre_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ruta`
--
ALTER TABLE `ruta`
  MODIFY `rut_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usu_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
-- Filtros para la tabla `operaciones`
--
ALTER TABLE `operaciones`
  ADD CONSTRAINT `operaciones_ibfk_1` FOREIGN KEY (`ope_MODULO`) REFERENCES `modulos` (`mod_Id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `perfil_operaciones`
--
ALTER TABLE `perfil_operaciones`
  ADD CONSTRAINT `perfil_operaciones_ibfk_1` FOREIGN KEY (`po_OPERACION`) REFERENCES `operaciones` (`ope_Id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `perfil_operaciones_ibfk_2` FOREIGN KEY (`po_PERFIL`) REFERENCES `perfiles` (`per_Id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD CONSTRAINT `prestamo_ibfk_1` FOREIGN KEY (`pre_USUARIO`) REFERENCES `usuario` (`usu_Id`),
  ADD CONSTRAINT `prestamo_ibfk_2` FOREIGN KEY (`pre_CLIENTE`) REFERENCES `cliente` (`cli_Id`),
  ADD CONSTRAINT `prestamo_ibfk_3` FOREIGN KEY (`pre_FormaPago`) REFERENCES `formapago` (`frm_Id`);

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
-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-08-2020 a las 18:50:17
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `cli_Id` bigint(20) NOT NULL,
  `cli_Cedula` int(11) NOT NULL,
  `cli_Nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `cli_Celular` bigint(20) NOT NULL,
  `cli_Direccion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `cli_Correo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `cli_Posicion` int(11) NOT NULL,
  `cli_RUTA` bigint(20) NOT NULL,
  `cli_DiaCobro` int(11) NOT NULL,
  `cli_Activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cobro`
--

CREATE TABLE `cobro` (
  `cob_Id` bigint(20) NOT NULL,
  `cob_Codigo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `cob_Nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `cob_Fecha` date NOT NULL,
  `cob_Activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


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


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perf_modulos`
--

CREATE TABLE `perf_modulos` (
  `pemod_Id` bigint(20) UNSIGNED NOT NULL,
  `pemod_MODULO` bigint(20) NOT NULL,
  `pemod_PERFIL` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamo`
--

CREATE TABLE `prestamo` (
  `pre_Id` bigint(20) NOT NULL,
  `pre_Fecha` datetime NOT NULL,
  `pre_CLIENTE` bigint(20) NOT NULL,
  `pre_FormaPago` bigint(20) NOT NULL,
  `pre_Interes` int(3) NOT NULL,
  `pre_MontoPrestado` int(11) NOT NULL,
  `pre_MontoInteres` int(11) NOT NULL,
  `pre_Cuotas` int(11) NOT NULL,
  `pre_Observaciones` text COLLATE utf8_spanish_ci NOT NULL,
  `pre_USUARIO` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_usuario`
--

CREATE TABLE `rol_usuario` (
  `rolus_Id` bigint(20) NOT NULL,
  `rolus_ROL` bigint(20) NOT NULL,
  `rolus_USUARIO` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
  MODIFY `abo_Id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `cli_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251;

--
-- AUTO_INCREMENT de la tabla `cobro`
--
ALTER TABLE `cobro`
  MODIFY `cob_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `formapago`
--
ALTER TABLE `formapago`
  MODIFY `frm_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `modulos`
--
ALTER TABLE `modulos`
  MODIFY `mod_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `per_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `perf_modulos`
--
ALTER TABLE `perf_modulos`
  MODIFY `pemod_Id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  MODIFY `pre_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `rol_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `rol_usuario`
--
ALTER TABLE `rol_usuario`
  MODIFY `rolus_Id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ruta`
--
ALTER TABLE `ruta`
  MODIFY `rut_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usu_Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
