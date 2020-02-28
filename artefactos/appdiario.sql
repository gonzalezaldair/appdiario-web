-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-02-2020 a las 22:46:24
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.1.28

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
  `cli_Celular` int(11) NOT NULL,
  `cli_Direccion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `cli_Correo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `cli_Posicion` int(11) NOT NULL,
  `cli_RUTA` bigint(20) NOT NULL,
  `cli_DiaCorbo` int(11) NOT NULL,
  `cli_Activo` char(1) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'Y'
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
  `cob_Activo` char(1) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formapago`
--

CREATE TABLE `formapago` (
  `frm_Id` bigint(20) NOT NULL,
  `frm_Codigo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `frm_Nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL
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
  `per_Nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL
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
  `pre_Fecha` date NOT NULL,
  `pre_CLIENTE` bigint(20) NOT NULL,
  `pre_FormaPago` bigint(20) NOT NULL,
  `pre_Interes` int(2) NOT NULL,
  `pre_MontoPrestado` int(11) NOT NULL,
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
  `rut_COBRO` bigint(20) NOT NULL
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
  `usu_Celular` int(11) NOT NULL,
  `usu_Correo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `usu_Direccion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `usu_RUTA` bigint(20) NOT NULL,
  `usu_Cedula` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `usu_Perfil` bigint(20) NOT NULL
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
  MODIFY `cli_Id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cobro`
--
ALTER TABLE `cobro`
  MODIFY `cob_Id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `formapago`
--
ALTER TABLE `formapago`
  MODIFY `frm_Id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `modulos`
--
ALTER TABLE `modulos`
  MODIFY `mod_Id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `per_Id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `perf_modulos`
--
ALTER TABLE `perf_modulos`
  MODIFY `pemod_Id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  MODIFY `pre_Id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `rol_Id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol_usuario`
--
ALTER TABLE `rol_usuario`
  MODIFY `rolus_Id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ruta`
--
ALTER TABLE `ruta`
  MODIFY `rut_Id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usu_Id` bigint(20) NOT NULL AUTO_INCREMENT;

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
