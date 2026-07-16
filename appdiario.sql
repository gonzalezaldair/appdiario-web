-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-07-2026 a las 22:43:42
-- Versión del servidor: 10.6.7-MariaDB
-- Versión de PHP: 8.2.12
SET
  SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET
  time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;

/*!40101 SET NAMES utf8mb4 */
;

--
-- Base de datos: `appdiario`
--
DELIMITER $ $ --
-- Procedimientos
--
CREATE DEFINER = `root` @`localhost` PROCEDURE `sp_reporte_caja` (IN `pFechaInicio` DATE, IN `pFechaFin` DATE) BEGIN
SELECT
  /* Préstamos entregados */
  IFNULL(
    (
      SELECT
        SUM(pre_MontoPrestado)
      FROM
        prestamo
      WHERE
        (
          pFechaInicio IS NULL
          AND pFechaFin IS NULL
        )
        OR (
          pFechaInicio IS NULL
          AND pFechaFin IS NOT NULL
          AND pre_Fecha <= CONCAT(pFechaFin, ' 23:59:59')
        )
        OR (
          pFechaInicio IS NOT NULL
          AND pFechaFin IS NOT NULL
          AND pre_Fecha BETWEEN CONCAT(pFechaInicio, ' 00:00:00')
          AND CONCAT(pFechaFin, ' 23:59:59')
        )
    ),
    0
  ) AS PRESTAMOS,
  /* Intereses generados */
  IFNULL(
    (
      SELECT
        SUM(pre_MontoInteres - pre_MontoPrestado)
      FROM
        prestamo
      WHERE
        (
          pFechaInicio IS NULL
          AND pFechaFin IS NULL
        )
        OR (
          pFechaInicio IS NULL
          AND pFechaFin IS NOT NULL
          AND pre_Fecha <= CONCAT(pFechaFin, ' 23:59:59')
        )
        OR (
          pFechaInicio IS NOT NULL
          AND pFechaFin IS NOT NULL
          AND pre_Fecha BETWEEN CONCAT(pFechaInicio, ' 00:00:00')
          AND CONCAT(pFechaFin, ' 23:59:59')
        )
    ),
    0
  ) AS INTERESES,
  /* Movimientos */
  IFNULL(
    (
      SELECT
        SUM(mov_Monto)
      FROM
        movimiento_caja
      WHERE
        mov_Tipo = 'SALDO_INICIAL'
        AND (
          (
            pFechaInicio IS NULL
            AND pFechaFin IS NULL
          )
          OR (
            pFechaInicio IS NULL
            AND mov_Fecha <= CONCAT(pFechaFin, ' 23:59:59')
          )
          OR (
            pFechaInicio IS NOT NULL
            AND mov_Fecha BETWEEN CONCAT(pFechaInicio, ' 00:00:00')
            AND CONCAT(pFechaFin, ' 23:59:59')
          )
        )
    ),
    0
  ) AS SALDO_INICIAL,
  IFNULL(
    (
      SELECT
        SUM(mov_Monto)
      FROM
        movimiento_caja
      WHERE
        mov_Tipo = 'INYECCION_CAPITAL'
        AND (
          (
            pFechaInicio IS NULL
            AND pFechaFin IS NULL
          )
          OR (
            pFechaInicio IS NULL
            AND mov_Fecha <= CONCAT(pFechaFin, ' 23:59:59')
          )
          OR (
            pFechaInicio IS NOT NULL
            AND mov_Fecha BETWEEN CONCAT(pFechaInicio, ' 00:00:00')
            AND CONCAT(pFechaFin, ' 23:59:59')
          )
        )
    ),
    0
  ) AS INYECCION_CAPITAL,
  IFNULL(
    (
      SELECT
        SUM(mov_Monto)
      FROM
        movimiento_caja
      WHERE
        mov_Tipo = 'ABONO'
        AND (
          (
            pFechaInicio IS NULL
            AND pFechaFin IS NULL
          )
          OR (
            pFechaInicio IS NULL
            AND mov_Fecha <= CONCAT(pFechaFin, ' 23:59:59')
          )
          OR (
            pFechaInicio IS NOT NULL
            AND mov_Fecha BETWEEN CONCAT(pFechaInicio, ' 00:00:00')
            AND CONCAT(pFechaFin, ' 23:59:59')
          )
        )
    ),
    0
  ) AS ABONOS,
  IFNULL(
    (
      SELECT
        SUM(mov_Monto)
      FROM
        movimiento_caja
      WHERE
        mov_Tipo = 'GASTO'
        AND (
          (
            pFechaInicio IS NULL
            AND pFechaFin IS NULL
          )
          OR (
            pFechaInicio IS NULL
            AND mov_Fecha <= CONCAT(pFechaFin, ' 23:59:59')
          )
          OR (
            pFechaInicio IS NOT NULL
            AND mov_Fecha BETWEEN CONCAT(pFechaInicio, ' 00:00:00')
            AND CONCAT(pFechaFin, ' 23:59:59')
          )
        )
    ),
    0
  ) AS GASTOS,
  IFNULL(
    (
      SELECT
        SUM(mov_Monto)
      FROM
        movimiento_caja
      WHERE
        mov_Tipo = 'RETIRO'
        AND (
          (
            pFechaInicio IS NULL
            AND pFechaFin IS NULL
          )
          OR (
            pFechaInicio IS NULL
            AND mov_Fecha <= CONCAT(pFechaFin, ' 23:59:59')
          )
          OR (
            pFechaInicio IS NOT NULL
            AND mov_Fecha BETWEEN CONCAT(pFechaInicio, ' 00:00:00')
            AND CONCAT(pFechaFin, ' 23:59:59')
          )
        )
    ),
    0
  ) AS RETIROS,
  IFNULL(
    (
      SELECT
        SUM(mov_Monto)
      FROM
        movimiento_caja
      WHERE
        mov_Tipo = 'AJUSTE'
        AND (
          (
            pFechaInicio IS NULL
            AND pFechaFin IS NULL
          )
          OR (
            pFechaInicio IS NULL
            AND mov_Fecha <= CONCAT(pFechaFin, ' 23:59:59')
          )
          OR (
            pFechaInicio IS NOT NULL
            AND mov_Fecha BETWEEN CONCAT(pFechaInicio, ' 00:00:00')
            AND CONCAT(pFechaFin, ' 23:59:59')
          )
        )
    ),
    0
  ) AS AJUSTES;

END $ $ DELIMITER;

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `abono`
--
CREATE TABLE `abono` (
  `abo_Id` bigint(20) NOT NULL,
  `abo_PRESTAMO` bigint(20) NOT NULL,
  `abo_Monto` int(11) NOT NULL,
  `abo_Fecha` datetime NOT NULL,
  `abo_Cancelado` enum('N', 'Y') COLLATE utf8mb3_spanish_ci NOT NULL DEFAULT 'N',
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb3 COLLATE = utf8mb3_spanish_ci;

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `cliente`
--
CREATE TABLE `cliente` (
  `cli_Id` bigint(20) NOT NULL,
  `cli_Cedula` int(11) NOT NULL,
  `cli_Nombre` varchar(50) COLLATE utf8mb3_spanish_ci NOT NULL,
  `cli_Celular` bigint(20) NOT NULL,
  `cli_Direccion` varchar(50) COLLATE utf8mb3_spanish_ci NOT NULL,
  `cli_Correo` varchar(50) COLLATE utf8mb3_spanish_ci NOT NULL,
  `cli_Posicion` int(11) NOT NULL,
  `cli_DiaCobro` int(11) NOT NULL,
  `cli_Activo` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb3 COLLATE = utf8mb3_spanish_ci;

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `formapago`
--
CREATE TABLE `formapago` (
  `frm_Id` bigint(20) NOT NULL,
  `frm_Nombre` varchar(50) COLLATE utf8mb3_spanish_ci NOT NULL,
  `frm_Activo` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb3 COLLATE = utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `formapago`
--
INSERT INTO
  `formapago` (
    `frm_Id`,
    `frm_Nombre`,
    `frm_Activo`,
    `created_by`,
    `created_at`,
    `updated_at`,
    `updated_by`
  )
VALUES
  (
    11,
    'DIARIO',
    1,
    0,
    '2026-07-16 15:54:48',
    NULL,
    NULL
  ),
  (
    12,
    'MENSUAL',
    1,
    0,
    '2026-07-16 15:54:48',
    NULL,
    NULL
  ),
  (
    15,
    'QUICENAL',
    1,
    0,
    '2026-07-16 15:57:03',
    NULL,
    1
  ),
  (
    16,
    'SEMANAL',
    1,
    1,
    '2026-07-16 19:03:32',
    NULL,
    NULL
  );

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `gasto`
--
CREATE TABLE `gasto` (
  `gas_Id` bigint(20) UNSIGNED NOT NULL,
  `gas_Monto` decimal(10, 0) NOT NULL,
  `gas_Fecha` datetime NOT NULL,
  `gas_Tipo` varchar(50) NOT NULL,
  `gas_Cancelado` enum('Y', 'N') NOT NULL DEFAULT 'N',
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `modulos`
--
CREATE TABLE `modulos` (
  `mod_Id` bigint(20) NOT NULL,
  `mod_Nombre` varchar(50) COLLATE utf8mb3_spanish_ci NOT NULL,
  `mod_Url` text COLLATE utf8mb3_spanish_ci NOT NULL,
  `mod_Icon` text COLLATE utf8mb3_spanish_ci NOT NULL,
  `mod_Activo` enum('N', 'Y') COLLATE utf8mb3_spanish_ci NOT NULL DEFAULT 'Y'
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb3 COLLATE = utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `modulos`
--
INSERT INTO
  `modulos` (
    `mod_Id`,
    `mod_Nombre`,
    `mod_Url`,
    `mod_Icon`,
    `mod_Activo`
  )
VALUES
  (1, 'Abono', 'abonos', 'fas fa-coins', 'Y'),
  (
    2,
    'Clientes',
    'clientes',
    'fas fa-user-friends',
    'Y'
  ),
  (3, 'Cobro', 'cobro', 'fas fa-layer-group', 'N'),
  (
    4,
    'Forma de Pago',
    'forma-pago',
    'fas fa-money-check-alt',
    'Y'
  ),
  (
    5,
    'Perfil',
    'perfil',
    'fas fa-clipboard-list',
    'Y'
  ),
  (6, 'Ruta', 'ruta', 'fas fa-map-marked-alt', 'N'),
  (7, 'Usuario', 'usuarios', 'fas fa-user', 'Y'),
  (
    8,
    'Prestamos',
    'prestamos',
    'fas fa-dollar-sign',
    'Y'
  ),
  (9, 'Reportes', 'reportes', 'fas fa-table', 'Y'),
  (10, 'Caja', 'cajas', 'fas fa-wallet', 'N'),
  (11, 'Gastos', 'gastos', 'fas fa-money-bill', 'Y'),
  (
    12,
    'Movimientos caja',
    'movimientos-caja',
    'fas fa-wallet',
    'Y'
  );

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `movimiento_caja`
--
CREATE TABLE `movimiento_caja` (
  `mov_Id` bigint(20) UNSIGNED NOT NULL,
  `mov_Fecha` datetime NOT NULL,
  `mov_Tipo` enum(
    'SALDO_INICIAL',
    'INYECCION_CAPITAL',
    'PRESTAMO',
    'ABONO',
    'GASTO',
    'RETIRO',
    'AJUSTE'
  ) NOT NULL,
  `mov_Monto` decimal(18, 2) NOT NULL,
  `mov_Referencia` bigint(20) DEFAULT NULL,
  `mov_Observacion` text DEFAULT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `operaciones`
--
CREATE TABLE `operaciones` (
  `ope_Id` bigint(20) NOT NULL,
  `ope_Nombre` text COLLATE utf8mb3_spanish_ci NOT NULL,
  `ope_MODULO` bigint(20) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb3 COLLATE = utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `operaciones`
--
INSERT INTO
  `operaciones` (`ope_Id`, `ope_Nombre`, `ope_MODULO`)
VALUES
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
  (33, 'LEER', 9),
  (34, 'CREAR', 10),
  (35, 'LEER', 10),
  (36, 'ACTUALIZAR', 10),
  (37, 'BORRAR', 10),
  (38, 'CREAR', 11),
  (39, 'LEER', 11),
  (40, 'ACTUALIZAR', 11),
  (41, 'BORRAR', 11),
  (42, 'CREAR', 12),
  (43, 'LEER', 12),
  (44, 'ACTUALIZAR', 12),
  (45, 'BORRAR', 12);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `perfiles`
--
CREATE TABLE `perfiles` (
  `per_Id` bigint(20) NOT NULL,
  `per_Codigo` varchar(50) COLLATE utf8mb3_spanish_ci NOT NULL,
  `per_Nombre` varchar(50) COLLATE utf8mb3_spanish_ci NOT NULL,
  `per_Activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb3 COLLATE = utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `perfiles`
--
INSERT INTO
  `perfiles` (
    `per_Id`,
    `per_Codigo`,
    `per_Nombre`,
    `per_Activo`
  )
VALUES
  (1, 'PER-001', 'Administrador', 1),
  (2, 'PER-002', 'COBRADOR', 1),
  (3, 'PER-003', 'Cliente', 1),
  (4, 'PER-004', 'Secretaria', 1),
  (5, 'PER-5', 'SUPERVISOR', 1),
  (10, 'PER-6', 'PRUEBA', 1);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `perfil_operaciones`
--
CREATE TABLE `perfil_operaciones` (
  `po_Id` bigint(20) NOT NULL,
  `po_PERFIL` bigint(20) NOT NULL,
  `po_OPERACION` bigint(20) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb3 COLLATE = utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `perfil_operaciones`
--
INSERT INTO
  `perfil_operaciones` (`po_Id`, `po_PERFIL`, `po_OPERACION`)
VALUES
  (34, 2, 5),
  (35, 2, 6),
  (36, 2, 7),
  (38, 2, 29),
  (39, 2, 30),
  (40, 2, 31),
  (42, 2, 1),
  (43, 2, 2),
  (44, 2, 3),
  (987, 1, 1),
  (988, 1, 2),
  (989, 1, 3),
  (990, 1, 4),
  (991, 1, 5),
  (992, 1, 6),
  (993, 1, 7),
  (994, 1, 8),
  (995, 1, 9),
  (996, 1, 10),
  (997, 1, 11),
  (998, 1, 12),
  (999, 1, 13),
  (1000, 1, 14),
  (1001, 1, 15),
  (1002, 1, 16),
  (1003, 1, 17),
  (1004, 1, 18),
  (1005, 1, 19),
  (1006, 1, 20),
  (1007, 1, 21),
  (1008, 1, 22),
  (1009, 1, 23),
  (1010, 1, 24),
  (1011, 1, 25),
  (1012, 1, 26),
  (1013, 1, 27),
  (1014, 1, 28),
  (1015, 1, 29),
  (1016, 1, 30),
  (1017, 1, 31),
  (1018, 1, 32),
  (1019, 1, 33),
  (1020, 1, 34),
  (1021, 1, 35),
  (1022, 1, 36),
  (1023, 1, 37),
  (1024, 1, 38),
  (1025, 1, 39),
  (1026, 1, 40),
  (1027, 1, 41),
  (1028, 1, 42),
  (1029, 1, 43),
  (1030, 1, 44),
  (1031, 1, 45);

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
  `pre_Observaciones` text COLLATE utf8mb3_spanish_ci NOT NULL,
  `pre_Cancelado` enum('N', 'Y') COLLATE utf8mb3_spanish_ci NOT NULL DEFAULT 'N',
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb3 COLLATE = utf8mb3_spanish_ci;

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `usuario`
--
CREATE TABLE `usuario` (
  `usu_Id` bigint(20) NOT NULL,
  `usu_Login` varchar(50) COLLATE utf8mb3_spanish_ci NOT NULL,
  `usu_Password` text COLLATE utf8mb3_spanish_ci NOT NULL,
  `usu_Nombre` varchar(50) COLLATE utf8mb3_spanish_ci NOT NULL,
  `usu_Celular` bigint(20) NOT NULL,
  `usu_Correo` varchar(50) COLLATE utf8mb3_spanish_ci NOT NULL,
  `usu_Direccion` varchar(50) COLLATE utf8mb3_spanish_ci NOT NULL,
  `usu_Cedula` varchar(50) COLLATE utf8mb3_spanish_ci NOT NULL,
  `usu_Perfil` bigint(20) NOT NULL,
  `usu_Activo` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb3 COLLATE = utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--
INSERT INTO
  `usuario` (
    `usu_Id`,
    `usu_Login`,
    `usu_Password`,
    `usu_Nombre`,
    `usu_Celular`,
    `usu_Correo`,
    `usu_Direccion`,
    `usu_Cedula`,
    `usu_Perfil`,
    `usu_Activo`,
    `created_by`,
    `created_at`,
    `updated_at`,
    `updated_by`
  )
VALUES
  (
    1,
    '',
    '$2y$10$JyYTC.GYBWnhqVMxFaZ3E.5iGd/4YZf9j7XpBc8S3DtJTrPNN2LkK',
    'German Gonzalez',
    3134215929,
    '',
    'MZ 3 LOTE 11',
    '',
    1,
    1,
    0,
    '2026-07-16 13:49:52',
    NULL,
    NULL
  ),
  (
    2,
    '',
    '$2y$10$JyYTC.GYBWnhqVMxFaZ3E.5iGd/4YZf9j7XpBc8S3DtJTrPNN2LkK',
    'ALDAIR GONZALEZ AMAYA',
    3156888647,
    'NOTIENE@NOTIENE.COM',
    'SIN DIRECCION',
    '',
    2,
    1,
    0,
    '2026-07-16 13:49:52',
    NULL,
    NULL
  ),
  (
    3,
    '',
    '$2y$10$JyYTC.GYBWnhqVMxFaZ3E.5iGd/4YZf9j7XpBc8S3DtJTrPNN2LkK',
    'YURLEY SUAREZ',
    3151234567,
    'NOTIENE@NOTIENE.COM',
    '456',
    '',
    4,
    1,
    0,
    '2026-07-16 13:49:52',
    NULL,
    NULL
  );

--
-- Índices para tablas volcadas
--
--
-- Indices de la tabla `abono`
--
ALTER TABLE
  `abono`
ADD
  PRIMARY KEY (`abo_Id`),
ADD
  UNIQUE KEY `abo_Id` (`abo_Id`),
ADD
  KEY `abo_PRESTAMO` (`abo_PRESTAMO`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE
  `cliente`
ADD
  PRIMARY KEY (`cli_Id`),
ADD
  UNIQUE KEY `cli_Id` (`cli_Id`),
ADD
  UNIQUE KEY `cli_Cedula` (`cli_Cedula`),
ADD
  UNIQUE KEY `cli_Celular` (`cli_Celular`);

--
-- Indices de la tabla `formapago`
--
ALTER TABLE
  `formapago`
ADD
  PRIMARY KEY (`frm_Id`),
ADD
  UNIQUE KEY `frm_Id` (`frm_Id`);

--
-- Indices de la tabla `gasto`
--
ALTER TABLE
  `gasto`
ADD
  PRIMARY KEY (`gas_Id`),
ADD
  UNIQUE KEY `gas_Id` (`gas_Id`);

--
-- Indices de la tabla `modulos`
--
ALTER TABLE
  `modulos`
ADD
  PRIMARY KEY (`mod_Id`),
ADD
  UNIQUE KEY `mod_Id` (`mod_Id`);

--
-- Indices de la tabla `movimiento_caja`
--
ALTER TABLE
  `movimiento_caja`
ADD
  PRIMARY KEY (`mov_Id`);

--
-- Indices de la tabla `operaciones`
--
ALTER TABLE
  `operaciones`
ADD
  PRIMARY KEY (`ope_Id`),
ADD
  UNIQUE KEY `ope_Id` (`ope_Id`),
ADD
  KEY `ope_MODULO` (`ope_MODULO`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE
  `perfiles`
ADD
  PRIMARY KEY (`per_Id`),
ADD
  UNIQUE KEY `per_Id` (`per_Id`),
ADD
  UNIQUE KEY `per_Codigo` (`per_Codigo`);

--
-- Indices de la tabla `perfil_operaciones`
--
ALTER TABLE
  `perfil_operaciones`
ADD
  PRIMARY KEY (`po_Id`),
ADD
  UNIQUE KEY `po_Id` (`po_Id`),
ADD
  KEY `po_PERFIL` (`po_PERFIL`),
ADD
  KEY `po_OPERACION` (`po_OPERACION`);

--
-- Indices de la tabla `prestamo`
--
ALTER TABLE
  `prestamo`
ADD
  PRIMARY KEY (`pre_Id`),
ADD
  UNIQUE KEY `pre_Id` (`pre_Id`),
ADD
  KEY `pre_CLIENTE` (`pre_CLIENTE`),
ADD
  KEY `pre_FormaPago` (`pre_FormaPago`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE
  `usuario`
ADD
  PRIMARY KEY (`usu_Id`),
ADD
  UNIQUE KEY `usu_Id` (`usu_Id`),
ADD
  UNIQUE KEY `usu_Login` (`usu_Login`),
ADD
  UNIQUE KEY `usu_Cedula` (`usu_Cedula`),
ADD
  UNIQUE KEY `usu_Celular` (`usu_Celular`),
ADD
  KEY `usu_Perfil` (`usu_Perfil`);

--
-- AUTO_INCREMENT de las tablas volcadas
--
--
-- AUTO_INCREMENT de la tabla `abono`
--
ALTER TABLE
  `abono`
MODIFY
  `abo_Id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE
  `cliente`
MODIFY
  `cli_Id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `formapago`
--
ALTER TABLE
  `formapago`
MODIFY
  `frm_Id` bigint(20) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 17;

--
-- AUTO_INCREMENT de la tabla `gasto`
--
ALTER TABLE
  `gasto`
MODIFY
  `gas_Id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `modulos`
--
ALTER TABLE
  `modulos`
MODIFY
  `mod_Id` bigint(20) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 13;

--
-- AUTO_INCREMENT de la tabla `movimiento_caja`
--
ALTER TABLE
  `movimiento_caja`
MODIFY
  `mov_Id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `operaciones`
--
ALTER TABLE
  `operaciones`
MODIFY
  `ope_Id` bigint(20) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 46;

--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE
  `perfiles`
MODIFY
  `per_Id` bigint(20) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 11;

--
-- AUTO_INCREMENT de la tabla `perfil_operaciones`
--
ALTER TABLE
  `perfil_operaciones`
MODIFY
  `po_Id` bigint(20) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 1032;

--
-- AUTO_INCREMENT de la tabla `prestamo`
--
ALTER TABLE
  `prestamo`
MODIFY
  `pre_Id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE
  `usuario`
MODIFY
  `usu_Id` bigint(20) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 12;

--
-- Restricciones para tablas volcadas
--
--
-- Filtros para la tabla `abono`
--
ALTER TABLE
  `abono`
ADD
  CONSTRAINT `abono_ibfk_1` FOREIGN KEY (`abo_PRESTAMO`) REFERENCES `prestamo` (`pre_Id`);

--
-- Filtros para la tabla `operaciones`
--
ALTER TABLE
  `operaciones`
ADD
  CONSTRAINT `operaciones_ibfk_1` FOREIGN KEY (`ope_MODULO`) REFERENCES `modulos` (`mod_Id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `prestamo`
--
ALTER TABLE
  `prestamo`
ADD
  CONSTRAINT `prestamo_ibfk_2` FOREIGN KEY (`pre_CLIENTE`) REFERENCES `cliente` (`cli_Id`),
ADD
  CONSTRAINT `prestamo_ibfk_3` FOREIGN KEY (`pre_FormaPago`) REFERENCES `formapago` (`frm_Id`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE
  `usuario`
ADD
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`usu_Perfil`) REFERENCES `perfiles` (`per_Id`);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;