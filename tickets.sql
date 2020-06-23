-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-03-2020 a las 15:28:23
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tickets`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `base`
--

CREATE TABLE `base` (
  `id` int(11) NOT NULL,
  `create` timestamp NULL DEFAULT current_timestamp(),
  `update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hd_agentes`
--

CREATE TABLE `hd_agentes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(245) COLLATE utf8_bin DEFAULT NULL,
  `rut` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `correo` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(145) COLLATE utf8_bin DEFAULT NULL,
  `telefono` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `activo` tinyint(1) DEFAULT 1,
  `remember_token` varchar(245) COLLATE utf8_bin DEFAULT NULL,
  `create` timestamp NULL DEFAULT current_timestamp(),
  `update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `hd_agentes`
--

INSERT INTO `hd_agentes` (`id`, `nombre`, `rut`, `correo`, `password`, `telefono`, `activo`, `remember_token`, `create`, `update`) VALUES
(212, 'jorge', '222222', 'resik.jb@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '29456202', 1, 'd27f1f29bb7c9444bcb27fba5477543659932105', '2020-01-31 12:31:55', NULL),
(213, 'Miguel Maliqueo', '11111111-2', 'soporte@hitch.cl', '5e607e1564b94cbc6a8cd6badf2c0b735ea84c37', '', 1, NULL, '2020-02-13 14:42:59', NULL),
(214, 'duoc', '111111', 'duoc@duoc.cl', '54842764b7800bacfb37d4c519d4a7430f5da0a2', '29456202', 1, NULL, '2020-03-20 14:24:21', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hd_backoffices`
--

CREATE TABLE `hd_backoffices` (
  `id` int(11) NOT NULL,
  `nombre` varchar(245) COLLATE utf8_bin DEFAULT NULL,
  `rut` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `correo` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(145) COLLATE utf8_bin DEFAULT NULL,
  `telefono` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `activo` tinyint(1) DEFAULT 1,
  `remember_token` varchar(245) COLLATE utf8_bin DEFAULT NULL,
  `create` timestamp NULL DEFAULT current_timestamp(),
  `update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `hd_backoffices`
--

INSERT INTO `hd_backoffices` (`id`, `nombre`, `rut`, `correo`, `password`, `telefono`, `activo`, `remember_token`, `create`, `update`) VALUES
(1, 'John Smith', '1-9', 'admin@correo.cl', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', NULL, 1, '6a3dcf0fb4fa58a475a61e190a46aebb203d0876', '2015-10-14 19:06:07', NULL),
(5, 'juan', '222222', 'resik.jb@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '29456202', 1, '4aa5ae50bace4d5100cad49f2bca713dbd1595c1', '2020-01-16 12:39:53', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hd_bitacora`
--

CREATE TABLE `hd_bitacora` (
  `id` int(11) NOT NULL,
  `solicitudes_id` int(11) NOT NULL,
  `descripcion` varchar(145) COLLATE utf8_bin DEFAULT NULL,
  `create` timestamp NULL DEFAULT current_timestamp(),
  `update` datetime DEFAULT NULL,
  `estados_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hd_clientes`
--

CREATE TABLE `hd_clientes` (
  `id` int(11) NOT NULL,
  `empresas_id` int(11) NOT NULL,
  `nombre` varchar(245) COLLATE utf8_bin DEFAULT NULL,
  `rut` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `correo` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(145) COLLATE utf8_bin DEFAULT NULL,
  `telefono` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `activo` tinyint(1) DEFAULT 1,
  `remember_token` varchar(245) COLLATE utf8_bin DEFAULT NULL,
  `create` timestamp NULL DEFAULT current_timestamp(),
  `update` datetime DEFAULT NULL,
  `tipo` char(1) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `hd_clientes`
--

INSERT INTO `hd_clientes` (`id`, `empresas_id`, `nombre`, `rut`, `correo`, `password`, `telefono`, `activo`, `remember_token`, `create`, `update`, `tipo`) VALUES
(215, 8, 'Jorge', '222222', 'bravov.jo@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '29456202', 1, 'd96a578358cfe9a8fb712f8b108721cc244dd935', '2020-01-30 15:54:44', NULL, '1'),
(220, 12, '', '', '', '0e96fcd8be249f099ba696b83f69d92d1a78a221', '', 1, NULL, '2020-02-06 17:19:35', NULL, '1'),
(222, 8, 'juan', '222222', 'resik.jb@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '29456202', 1, '8e471590c5d5f82da74c1de76aff066e6428b797', '2020-02-07 13:59:45', NULL, '2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hd_comentarios`
--

CREATE TABLE `hd_comentarios` (
  `id` int(11) NOT NULL,
  `solicitudes_id` int(11) NOT NULL,
  `clientes_id` int(11) DEFAULT NULL,
  `agentes_id` int(11) DEFAULT NULL,
  `descripcion` varchar(245) COLLATE utf8_bin DEFAULT NULL,
  `create` timestamp NULL DEFAULT current_timestamp(),
  `update` datetime DEFAULT NULL,
  `img_1` varchar(300) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hd_empresas`
--

CREATE TABLE `hd_empresas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `razon_social` varchar(145) COLLATE utf8_bin DEFAULT NULL,
  `rut` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `logo` varchar(245) COLLATE utf8_bin DEFAULT NULL,
  `update` datetime DEFAULT NULL,
  `create` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `hd_empresas`
--

INSERT INTO `hd_empresas` (`id`, `nombre`, `razon_social`, `rut`, `logo`, `update`, `create`) VALUES
(8, 'Blotech Spa', NULL, '1111', '0809857001581084009-gallery.jpg', NULL, '2020-01-23 12:55:41'),
(10, 'w', NULL, 'w', NULL, NULL, '2020-01-31 16:22:19'),
(11, 'juan', NULL, '222222', '0338494001580491231-gallery.jpg', NULL, '2020-01-31 16:31:04'),
(12, '', NULL, '', NULL, NULL, '2020-02-06 17:19:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hd_estados`
--

CREATE TABLE `hd_estados` (
  `id` int(11) NOT NULL,
  `nombre` varchar(145) COLLATE utf8_bin DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `create` timestamp NULL DEFAULT current_timestamp(),
  `update` datetime DEFAULT NULL,
  `etapas_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `hd_estados`
--

INSERT INTO `hd_estados` (`id`, `nombre`, `activo`, `create`, `update`, `etapas_id`) VALUES
(100, 'Sin procesar', 1, '2015-09-24 15:11:25', NULL, 10),
(200, 'Recepcionada', 1, '2015-09-24 15:11:25', NULL, 20),
(210, 'En proceso', 1, '2015-09-24 15:11:25', NULL, 20),
(220, 'Rechazada sin comentario', 1, '2015-09-24 15:11:25', NULL, 20),
(221, 'Rechazada', 1, '2015-09-24 15:11:25', NULL, 20),
(230, 'Rechazo No conforme', 1, '2015-10-15 20:52:32', NULL, 20),
(240, 'Rechazo Conforme', 1, '2015-10-15 20:52:32', NULL, 20),
(250, 'Proceso terminado', 1, '2015-09-24 15:11:25', NULL, 20),
(260, 'Proceso rechazado', 1, '2015-09-24 15:11:25', NULL, 20),
(300, 'Terminada', 1, '2015-09-24 15:11:25', NULL, 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hd_etapas`
--

CREATE TABLE `hd_etapas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `create` timestamp NULL DEFAULT current_timestamp(),
  `update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `hd_etapas`
--

INSERT INTO `hd_etapas` (`id`, `nombre`, `create`, `update`) VALUES
(10, 'Inicio', '2015-09-24 15:09:41', NULL),
(20, 'Proceso', '2015-09-24 15:09:47', NULL),
(30, 'Termino', '2015-09-24 15:09:53', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hd_productos`
--

CREATE TABLE `hd_productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(145) COLLATE utf8_bin DEFAULT NULL,
  `create` timestamp NULL DEFAULT current_timestamp(),
  `update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `hd_productos`
--

INSERT INTO `hd_productos` (`id`, `nombre`, `create`, `update`) VALUES
(8, 'sap', '2020-01-30 15:58:34', NULL),
(9, 'soporte', '2020-02-04 13:45:04', NULL),
(10, 'network', '2020-02-04 13:45:13', NULL),
(11, '', '2020-02-06 17:23:49', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hd_productos_empresas`
--

CREATE TABLE `hd_productos_empresas` (
  `id` int(11) NOT NULL,
  `productos_id` int(11) NOT NULL,
  `empresas_id` int(11) NOT NULL,
  `create` timestamp NULL DEFAULT current_timestamp(),
  `update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `hd_productos_empresas`
--

INSERT INTO `hd_productos_empresas` (`id`, `productos_id`, `empresas_id`, `create`, `update`) VALUES
(58, 8, 11, '2020-02-04 13:45:39', NULL),
(59, 9, 11, '2020-02-04 13:45:39', NULL),
(60, 10, 11, '2020-02-04 13:45:39', NULL),
(61, 9, 10, '2020-02-04 13:45:46', NULL),
(62, 8, 8, '2020-02-07 14:00:10', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hd_solicitudes`
--

CREATE TABLE `hd_solicitudes` (
  `id` int(11) NOT NULL,
  `empresas_id` int(11) NOT NULL,
  `clientes_id` int(11) NOT NULL,
  `agentes_id` int(11) DEFAULT NULL,
  `etapas_id` int(11) NOT NULL COMMENT '10 inicio, 20 proceso, 30 termino',
  `estados_id` int(11) NOT NULL COMMENT 'To do:  100-Creada, 101-Recepcionada\ndoing: 200-Rechazada, 201-En proceso\nDone: 300-Terminada ',
  `tipo_id` int(11) DEFAULT NULL,
  `productos_id` int(11) NOT NULL,
  `correlativo` int(11) DEFAULT NULL,
  `titulo` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `descripcion` mediumtext COLLATE utf8_bin DEFAULT NULL,
  `observacion_tecnica` mediumtext COLLATE utf8_bin DEFAULT NULL,
  `motivo_rechazo` mediumtext COLLATE utf8_bin DEFAULT NULL,
  `img_1` varchar(145) COLLATE utf8_bin DEFAULT NULL,
  `img_2` varchar(145) COLLATE utf8_bin DEFAULT NULL,
  `img_3` varchar(145) COLLATE utf8_bin DEFAULT NULL,
  `create` timestamp NULL DEFAULT current_timestamp(),
  `update` datetime DEFAULT NULL,
  `id_correo` varchar(30) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `hd_solicitudes`
--

INSERT INTO `hd_solicitudes` (`id`, `empresas_id`, `clientes_id`, `agentes_id`, `etapas_id`, `estados_id`, `tipo_id`, `productos_id`, `correlativo`, `titulo`, `descripcion`, `observacion_tecnica`, `motivo_rechazo`, `img_1`, `img_2`, `img_3`, `create`, `update`, `id_correo`) VALUES
(801, 12, 220, 213, 10, 100, NULL, 11, 1, 'prueba', NULL, NULL, NULL, NULL, NULL, NULL, '2020-03-19 14:14:01', NULL, '170f2ed715f43f28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hd_tipo`
--

CREATE TABLE `hd_tipo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(145) COLLATE utf8_bin DEFAULT NULL,
  `update` datetime DEFAULT NULL,
  `create` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `base`
--
ALTER TABLE `base`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `hd_agentes`
--
ALTER TABLE `hd_agentes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `hd_backoffices`
--
ALTER TABLE `hd_backoffices`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `hd_bitacora`
--
ALTER TABLE `hd_bitacora`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_hd_bitacora_hd_estados1_idx` (`estados_id`) USING BTREE,
  ADD KEY `fk_hd_bitacora_hd_solicitudes1_idx` (`solicitudes_id`) USING BTREE;

--
-- Indices de la tabla `hd_clientes`
--
ALTER TABLE `hd_clientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_hd_clientes_hd_empresas1_idx` (`empresas_id`) USING BTREE;

--
-- Indices de la tabla `hd_comentarios`
--
ALTER TABLE `hd_comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_hd_comentarios_hd_agentes1_idx` (`agentes_id`) USING BTREE,
  ADD KEY `fk_hd_comentarios_hd_clientes1_idx` (`clientes_id`) USING BTREE,
  ADD KEY `fk_hd_comentarios_hd_solicitudes1_idx` (`solicitudes_id`) USING BTREE;

--
-- Indices de la tabla `hd_empresas`
--
ALTER TABLE `hd_empresas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `hd_estados`
--
ALTER TABLE `hd_estados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_hd_estados_hd_etapas1_idx` (`etapas_id`) USING BTREE;

--
-- Indices de la tabla `hd_etapas`
--
ALTER TABLE `hd_etapas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `hd_productos`
--
ALTER TABLE `hd_productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `hd_productos_empresas`
--
ALTER TABLE `hd_productos_empresas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_hd_productos_empresas_hd_empresas1_idx` (`empresas_id`) USING BTREE,
  ADD KEY `fk_hd_productos_empresas_hd_productos_idx` (`productos_id`) USING BTREE;

--
-- Indices de la tabla `hd_solicitudes`
--
ALTER TABLE `hd_solicitudes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_hd_solicitudes_hd_agentes1_idx` (`agentes_id`) USING BTREE,
  ADD KEY `fk_hd_solicitudes_hd_clientes1_idx` (`clientes_id`) USING BTREE,
  ADD KEY `fk_hd_solicitudes_hd_empresas1_idx` (`empresas_id`) USING BTREE,
  ADD KEY `fk_hd_solicitudes_hd_estados1_idx` (`estados_id`) USING BTREE,
  ADD KEY `fk_hd_solicitudes_hd_etapas1_idx` (`etapas_id`) USING BTREE,
  ADD KEY `fk_hd_solicitudes_hd_productos1_idx` (`productos_id`) USING BTREE,
  ADD KEY `fk_hd_solicitudes_hd_tipo1_idx` (`tipo_id`) USING BTREE;

--
-- Indices de la tabla `hd_tipo`
--
ALTER TABLE `hd_tipo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `base`
--
ALTER TABLE `base`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `hd_agentes`
--
ALTER TABLE `hd_agentes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- AUTO_INCREMENT de la tabla `hd_backoffices`
--
ALTER TABLE `hd_backoffices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `hd_bitacora`
--
ALTER TABLE `hd_bitacora`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=474;

--
-- AUTO_INCREMENT de la tabla `hd_clientes`
--
ALTER TABLE `hd_clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=223;

--
-- AUTO_INCREMENT de la tabla `hd_comentarios`
--
ALTER TABLE `hd_comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de la tabla `hd_empresas`
--
ALTER TABLE `hd_empresas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `hd_estados`
--
ALTER TABLE `hd_estados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=302;

--
-- AUTO_INCREMENT de la tabla `hd_etapas`
--
ALTER TABLE `hd_etapas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `hd_productos`
--
ALTER TABLE `hd_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `hd_productos_empresas`
--
ALTER TABLE `hd_productos_empresas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de la tabla `hd_solicitudes`
--
ALTER TABLE `hd_solicitudes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=802;

--
-- AUTO_INCREMENT de la tabla `hd_tipo`
--
ALTER TABLE `hd_tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `hd_bitacora`
--
ALTER TABLE `hd_bitacora`
  ADD CONSTRAINT `fk_hd_bitacora_hd_estados1` FOREIGN KEY (`estados_id`) REFERENCES `hd_estados` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_hd_bitacora_hd_solicitudes1` FOREIGN KEY (`solicitudes_id`) REFERENCES `hd_solicitudes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `hd_clientes`
--
ALTER TABLE `hd_clientes`
  ADD CONSTRAINT `fk_hd_clientes_hd_empresas1` FOREIGN KEY (`empresas_id`) REFERENCES `hd_empresas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `hd_comentarios`
--
ALTER TABLE `hd_comentarios`
  ADD CONSTRAINT `fk_hd_comentarios_hd_agentes1` FOREIGN KEY (`agentes_id`) REFERENCES `hd_agentes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_hd_comentarios_hd_clientes1` FOREIGN KEY (`clientes_id`) REFERENCES `hd_clientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_hd_comentarios_hd_solicitudes1` FOREIGN KEY (`solicitudes_id`) REFERENCES `hd_solicitudes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `hd_estados`
--
ALTER TABLE `hd_estados`
  ADD CONSTRAINT `fk_hd_estados_hd_etapas1` FOREIGN KEY (`etapas_id`) REFERENCES `hd_etapas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `hd_productos_empresas`
--
ALTER TABLE `hd_productos_empresas`
  ADD CONSTRAINT `fk_hd_productos_empresas_hd_empresas1` FOREIGN KEY (`empresas_id`) REFERENCES `hd_empresas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_hd_productos_empresas_hd_productos` FOREIGN KEY (`productos_id`) REFERENCES `hd_productos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `hd_solicitudes`
--
ALTER TABLE `hd_solicitudes`
  ADD CONSTRAINT `fk_hd_solicitudes_hd_agentes1` FOREIGN KEY (`agentes_id`) REFERENCES `hd_agentes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_hd_solicitudes_hd_clientes1` FOREIGN KEY (`clientes_id`) REFERENCES `hd_clientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_hd_solicitudes_hd_empresas1` FOREIGN KEY (`empresas_id`) REFERENCES `hd_empresas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_hd_solicitudes_hd_estados1` FOREIGN KEY (`estados_id`) REFERENCES `hd_estados` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_hd_solicitudes_hd_etapas1` FOREIGN KEY (`etapas_id`) REFERENCES `hd_etapas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_hd_solicitudes_hd_productos1` FOREIGN KEY (`productos_id`) REFERENCES `hd_productos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_hd_solicitudes_hd_tipo1` FOREIGN KEY (`tipo_id`) REFERENCES `hd_tipo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
