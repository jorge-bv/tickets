-- Valentina Studio --
-- MySQL dump --
-- ---------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
-- ---------------------------------------------------------


-- CREATE TABLE "base" -------------------------------------
CREATE TABLE `base` ( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`create` Timestamp NULL DEFAULT CURRENT_TIMESTAMP,
	`update` DateTime NULL,
	PRIMARY KEY ( `id` ) )
ENGINE = InnoDB
AUTO_INCREMENT = 1;
-- ---------------------------------------------------------


-- CREATE TABLE "hd_agentes" -------------------------------
CREATE TABLE `hd_agentes` ( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`nombre` VarChar( 245 ) NULL,
	`rut` VarChar( 45 ) NULL,
	`correo` VarChar( 45 ) NULL,
	`password` VarChar( 145 ) NULL,
	`telefono` VarChar( 45 ) NULL,
	`activo` TinyInt( 1 ) NULL DEFAULT '1',
	`remember_token` VarChar( 245 ) NULL,
	`create` Timestamp NULL DEFAULT CURRENT_TIMESTAMP,
	`update` DateTime NULL,
	PRIMARY KEY ( `id` ) )
ENGINE = InnoDB
AUTO_INCREMENT = 5;
-- ---------------------------------------------------------


-- CREATE TABLE "hd_backoffices" ---------------------------
CREATE TABLE `hd_backoffices` ( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`nombre` VarChar( 245 ) NULL,
	`rut` VarChar( 45 ) NULL,
	`correo` VarChar( 45 ) NULL,
	`password` VarChar( 145 ) NULL,
	`telefono` VarChar( 45 ) NULL,
	`activo` TinyInt( 1 ) NULL DEFAULT '1',
	`remember_token` VarChar( 245 ) NULL,
	`create` Timestamp NULL DEFAULT CURRENT_TIMESTAMP,
	`update` DateTime NULL,
	PRIMARY KEY ( `id` ) )
ENGINE = InnoDB
AUTO_INCREMENT = 2;
-- ---------------------------------------------------------


-- CREATE TABLE "hd_bitacora" ------------------------------
CREATE TABLE `hd_bitacora` ( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`solicitudes_id` Int( 11 ) NOT NULL,
	`descripcion` VarChar( 145 ) NULL,
	`create` Timestamp NULL DEFAULT CURRENT_TIMESTAMP,
	`update` DateTime NULL,
	`estados_id` Int( 11 ) NULL,
	PRIMARY KEY ( `id` ) )
ENGINE = InnoDB
AUTO_INCREMENT = 17;
-- ---------------------------------------------------------


-- CREATE TABLE "hd_clientes" ------------------------------
CREATE TABLE `hd_clientes` ( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`empresas_id` Int( 11 ) NOT NULL,
	`nombre` VarChar( 245 ) NULL,
	`rut` VarChar( 45 ) NULL,
	`correo` VarChar( 45 ) NULL,
	`password` VarChar( 145 ) NULL,
	`telefono` VarChar( 45 ) NULL,
	`activo` TinyInt( 1 ) NULL DEFAULT '1',
	`remember_token` VarChar( 245 ) NULL,
	`create` Timestamp NULL DEFAULT CURRENT_TIMESTAMP,
	`update` DateTime NULL,
	PRIMARY KEY ( `id` ) )
ENGINE = InnoDB
AUTO_INCREMENT = 9;
-- ---------------------------------------------------------


-- CREATE TABLE "hd_comentarios" ---------------------------
CREATE TABLE `hd_comentarios` ( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`solicitudes_id` Int( 11 ) NOT NULL,
	`clientes_id` Int( 11 ) NULL,
	`agentes_id` Int( 11 ) NULL,
	`descripcion` VarChar( 245 ) NULL,
	`create` Timestamp NULL DEFAULT CURRENT_TIMESTAMP,
	`update` DateTime NULL,
	PRIMARY KEY ( `id` ) )
ENGINE = InnoDB
AUTO_INCREMENT = 7;
-- ---------------------------------------------------------


-- CREATE TABLE "hd_empresas" ------------------------------
CREATE TABLE `hd_empresas` ( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`nombre` VarChar( 45 ) NULL,
	`razon_social` VarChar( 145 ) NULL,
	`rut` VarChar( 45 ) NULL,
	`logo` VarChar( 245 ) NULL,
	`update` DateTime NULL,
	`create` Timestamp NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY ( `id` ) )
ENGINE = InnoDB
AUTO_INCREMENT = 4;
-- ---------------------------------------------------------


-- CREATE TABLE "hd_estados" -------------------------------
CREATE TABLE `hd_estados` ( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`nombre` VarChar( 145 ) NULL,
	`activo` TinyInt( 1 ) NULL,
	`create` Timestamp NULL DEFAULT CURRENT_TIMESTAMP,
	`update` DateTime NULL,
	`etapas_id` Int( 11 ) NOT NULL,
	PRIMARY KEY ( `id` ) )
ENGINE = InnoDB
AUTO_INCREMENT = 302;
-- ---------------------------------------------------------


-- CREATE TABLE "hd_etapas" --------------------------------
CREATE TABLE `hd_etapas` ( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`nombre` VarChar( 45 ) NULL,
	`create` Timestamp NULL DEFAULT CURRENT_TIMESTAMP,
	`update` DateTime NULL,
	PRIMARY KEY ( `id` ) )
ENGINE = InnoDB
AUTO_INCREMENT = 31;
-- ---------------------------------------------------------


-- CREATE TABLE "hd_productos" -----------------------------
CREATE TABLE `hd_productos` ( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`nombre` VarChar( 145 ) NULL,
	`create` Timestamp NULL DEFAULT CURRENT_TIMESTAMP,
	`update` DateTime NULL,
	PRIMARY KEY ( `id` ) )
ENGINE = InnoDB
AUTO_INCREMENT = 4;
-- ---------------------------------------------------------


-- CREATE TABLE "hd_productos_empresas" --------------------
CREATE TABLE `hd_productos_empresas` ( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`productos_id` Int( 11 ) NOT NULL,
	`empresas_id` Int( 11 ) NOT NULL,
	`create` Timestamp NULL DEFAULT CURRENT_TIMESTAMP,
	`update` DateTime NULL,
	PRIMARY KEY ( `id` ) )
ENGINE = InnoDB
AUTO_INCREMENT = 24;
-- ---------------------------------------------------------


-- CREATE TABLE "hd_solicitudes" ---------------------------
CREATE TABLE `hd_solicitudes` ( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`empresas_id` Int( 11 ) NOT NULL,
	`clientes_id` Int( 11 ) NOT NULL,
	`agentes_id` Int( 11 ) NULL,
	`etapas_id` Int( 11 ) NOT NULL COMMENT '10 inicio, 20 proceso, 30 termino',
	`estados_id` Int( 11 ) NOT NULL COMMENT 'To do:  100-Creada, 101-Recepcionada
doing: 200-Rechazada, 201-En proceso
Done: 300-Terminada ',
	`tipo_id` Int( 11 ) NULL,
	`productos_id` Int( 11 ) NOT NULL,
	`correlativo` Int( 11 ) NULL,
	`titulo` VarChar( 250 ) NULL,
	`descripcion` MediumText NULL,
	`observacion_tecnica` MediumText NULL,
	`motivo_rechazo` MediumText NULL,
	`img_1` VarChar( 145 ) NULL,
	`img_2` VarChar( 145 ) NULL,
	`img_3` VarChar( 145 ) NULL,
	`create` Timestamp NULL DEFAULT CURRENT_TIMESTAMP,
	`update` DateTime NULL,
	PRIMARY KEY ( `id` ) )
ENGINE = InnoDB
AUTO_INCREMENT = 1;
-- ---------------------------------------------------------


-- CREATE TABLE "hd_tipo" ----------------------------------
CREATE TABLE `hd_tipo` ( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`nombre` VarChar( 145 ) NULL,
	`update` DateTime NULL,
	`create` Timestamp NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY ( `id` ) )
ENGINE = InnoDB
AUTO_INCREMENT = 1;
-- ---------------------------------------------------------


-- Dump data of "base" -------------------------------------
-- ---------------------------------------------------------


-- Dump data of "hd_agentes" -------------------------------
INSERT INTO `hd_agentes`(`id`,`nombre`,`rut`,`correo`,`password`,`telefono`,`activo`,`remember_token`,`create`,`update`) VALUES ( '1', 'Juan Perez', '2-7', 'agente@correo.cl', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '', '1', 'b0cf706be4807f7bfde3623b149e55829c81dba8', '2015-09-23 17:14:01', NULL );
INSERT INTO `hd_agentes`(`id`,`nombre`,`rut`,`correo`,`password`,`telefono`,`activo`,`remember_token`,`create`,`update`) VALUES ( '4', 'Mao', '1111', 'mmeliqueo@hitch.cl', 'c0d2272637245e540d75da260b50e1708566f2da', '123123', '1', 'cd6662eca4bdce06f59f3f4796a21f1d39fd22c2', '2015-10-15 12:30:30', NULL );
-- ---------------------------------------------------------


-- Dump data of "hd_backoffices" ---------------------------
INSERT INTO `hd_backoffices`(`id`,`nombre`,`rut`,`correo`,`password`,`telefono`,`activo`,`remember_token`,`create`,`update`) VALUES ( '1', 'John Smith', '1-9', 'admin@correo.cl', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', NULL, '1', '6a3dcf0fb4fa58a475a61e190a46aebb203d0876', '2015-10-14 16:06:07', NULL );
-- ---------------------------------------------------------


-- Dump data of "hd_bitacora" ------------------------------
-- ---------------------------------------------------------


-- Dump data of "hd_clientes" ------------------------------
INSERT INTO `hd_clientes`(`id`,`empresas_id`,`nombre`,`rut`,`correo`,`password`,`telefono`,`activo`,`remember_token`,`create`,`update`) VALUES ( '2', '3', 'Pepe Pelota', '1-9', 'cliente@correo.cl', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '445566-66', '1', '37400bcb4ed966231afcc70d5db2ab3b15fc3298', '2015-09-23 16:57:29', NULL );
INSERT INTO `hd_clientes`(`id`,`empresas_id`,`nombre`,`rut`,`correo`,`password`,`telefono`,`activo`,`remember_token`,`create`,`update`) VALUES ( '8', '2', 'ascasc', '12', 'cliente2@correo.cl', 'f34f8d211f5bae1302138e1ba74c4eded1530c10', '33444-444', '1', 'a39663535a207d4acb503bad4dd527a1a2294dea', '2015-10-15 12:35:51', NULL );
-- ---------------------------------------------------------


-- Dump data of "hd_comentarios" ---------------------------
-- ---------------------------------------------------------


-- Dump data of "hd_empresas" ------------------------------
INSERT INTO `hd_empresas`(`id`,`nombre`,`razon_social`,`rut`,`logo`,`update`,`create`) VALUES ( '1', 'Recmetal', 'Recmatal SA', '11111111-1', NULL, NULL, '2015-09-23 16:57:00' );
INSERT INTO `hd_empresas`(`id`,`nombre`,`razon_social`,`rut`,`logo`,`update`,`create`) VALUES ( '2', 'Las Nieves', NULL, '1-9', NULL, NULL, '2015-10-14 16:46:02' );
INSERT INTO `hd_empresas`(`id`,`nombre`,`razon_social`,`rut`,`logo`,`update`,`create`) VALUES ( '3', 'Las cruces', NULL, '121212-3', '0435778001444928139-gallery.png', NULL, '2015-10-15 12:03:10' );
-- ---------------------------------------------------------


-- Dump data of "hd_estados" -------------------------------
INSERT INTO `hd_estados`(`id`,`nombre`,`activo`,`create`,`update`,`etapas_id`) VALUES ( '100', 'Sin procesar', '1', '2015-09-24 11:11:25', NULL, '10' );
INSERT INTO `hd_estados`(`id`,`nombre`,`activo`,`create`,`update`,`etapas_id`) VALUES ( '200', 'Recepcionada', '1', '2015-09-24 11:11:25', NULL, '20' );
INSERT INTO `hd_estados`(`id`,`nombre`,`activo`,`create`,`update`,`etapas_id`) VALUES ( '210', 'En proceso', '1', '2015-09-24 11:11:25', NULL, '20' );
INSERT INTO `hd_estados`(`id`,`nombre`,`activo`,`create`,`update`,`etapas_id`) VALUES ( '220', 'Rechazada sin comentario', '1', '2015-09-24 11:11:25', NULL, '20' );
INSERT INTO `hd_estados`(`id`,`nombre`,`activo`,`create`,`update`,`etapas_id`) VALUES ( '221', 'Rechazada', '1', '2015-09-24 11:11:25', NULL, '20' );
INSERT INTO `hd_estados`(`id`,`nombre`,`activo`,`create`,`update`,`etapas_id`) VALUES ( '230', 'Rechazo No conforme', '1', '2015-10-15 17:52:32', NULL, '20' );
INSERT INTO `hd_estados`(`id`,`nombre`,`activo`,`create`,`update`,`etapas_id`) VALUES ( '240', 'Rechazo Conforme', '1', '2015-10-15 17:52:32', NULL, '20' );
INSERT INTO `hd_estados`(`id`,`nombre`,`activo`,`create`,`update`,`etapas_id`) VALUES ( '250', 'Proceso terminado', '1', '2015-09-24 11:11:25', NULL, '20' );
INSERT INTO `hd_estados`(`id`,`nombre`,`activo`,`create`,`update`,`etapas_id`) VALUES ( '260', 'Proceso rechazado', '1', '2015-09-24 11:11:25', NULL, '20' );
INSERT INTO `hd_estados`(`id`,`nombre`,`activo`,`create`,`update`,`etapas_id`) VALUES ( '300', 'Terminada', '1', '2015-09-24 11:11:25', NULL, '30' );
-- ---------------------------------------------------------


-- Dump data of "hd_etapas" --------------------------------
INSERT INTO `hd_etapas`(`id`,`nombre`,`create`,`update`) VALUES ( '10', 'Inicio', '2015-09-24 11:09:41', NULL );
INSERT INTO `hd_etapas`(`id`,`nombre`,`create`,`update`) VALUES ( '20', 'Proceso', '2015-09-24 11:09:47', NULL );
INSERT INTO `hd_etapas`(`id`,`nombre`,`create`,`update`) VALUES ( '30', 'Termino', '2015-09-24 11:09:53', NULL );
-- ---------------------------------------------------------


-- Dump data of "hd_productos" -----------------------------
-- ---------------------------------------------------------


-- Dump data of "hd_productos_empresas" --------------------
-- ---------------------------------------------------------


-- Dump data of "hd_solicitudes" ---------------------------
-- ---------------------------------------------------------


-- Dump data of "hd_tipo" ----------------------------------
-- ---------------------------------------------------------


-- CREATE INDEX "fk_hd_bitacora_hd_estados1_idx" -----------
CREATE INDEX `fk_hd_bitacora_hd_estados1_idx` USING BTREE ON `hd_bitacora`( `estados_id` );
-- ---------------------------------------------------------


-- CREATE INDEX "fk_hd_bitacora_hd_solicitudes1_idx" -------
CREATE INDEX `fk_hd_bitacora_hd_solicitudes1_idx` USING BTREE ON `hd_bitacora`( `solicitudes_id` );
-- ---------------------------------------------------------


-- CREATE INDEX "fk_hd_clientes_hd_empresas1_idx" ----------
CREATE INDEX `fk_hd_clientes_hd_empresas1_idx` USING BTREE ON `hd_clientes`( `empresas_id` );
-- ---------------------------------------------------------


-- CREATE INDEX "fk_hd_comentarios_hd_agentes1_idx" --------
CREATE INDEX `fk_hd_comentarios_hd_agentes1_idx` USING BTREE ON `hd_comentarios`( `agentes_id` );
-- ---------------------------------------------------------


-- CREATE INDEX "fk_hd_comentarios_hd_clientes1_idx" -------
CREATE INDEX `fk_hd_comentarios_hd_clientes1_idx` USING BTREE ON `hd_comentarios`( `clientes_id` );
-- ---------------------------------------------------------


-- CREATE INDEX "fk_hd_comentarios_hd_solicitudes1_idx" ----
CREATE INDEX `fk_hd_comentarios_hd_solicitudes1_idx` USING BTREE ON `hd_comentarios`( `solicitudes_id` );
-- ---------------------------------------------------------


-- CREATE INDEX "fk_hd_estados_hd_etapas1_idx" -------------
CREATE INDEX `fk_hd_estados_hd_etapas1_idx` USING BTREE ON `hd_estados`( `etapas_id` );
-- ---------------------------------------------------------


-- CREATE INDEX "fk_hd_productos_empresas_hd_empresas1_idx" 
CREATE INDEX `fk_hd_productos_empresas_hd_empresas1_idx` USING BTREE ON `hd_productos_empresas`( `empresas_id` );
-- ---------------------------------------------------------


-- CREATE INDEX "fk_hd_productos_empresas_hd_productos_idx" 
CREATE INDEX `fk_hd_productos_empresas_hd_productos_idx` USING BTREE ON `hd_productos_empresas`( `productos_id` );
-- ---------------------------------------------------------


-- CREATE INDEX "fk_hd_solicitudes_hd_agentes1_idx" --------
CREATE INDEX `fk_hd_solicitudes_hd_agentes1_idx` USING BTREE ON `hd_solicitudes`( `agentes_id` );
-- ---------------------------------------------------------


-- CREATE INDEX "fk_hd_solicitudes_hd_clientes1_idx" -------
CREATE INDEX `fk_hd_solicitudes_hd_clientes1_idx` USING BTREE ON `hd_solicitudes`( `clientes_id` );
-- ---------------------------------------------------------


-- CREATE INDEX "fk_hd_solicitudes_hd_empresas1_idx" -------
CREATE INDEX `fk_hd_solicitudes_hd_empresas1_idx` USING BTREE ON `hd_solicitudes`( `empresas_id` );
-- ---------------------------------------------------------


-- CREATE INDEX "fk_hd_solicitudes_hd_estados1_idx" --------
CREATE INDEX `fk_hd_solicitudes_hd_estados1_idx` USING BTREE ON `hd_solicitudes`( `estados_id` );
-- ---------------------------------------------------------


-- CREATE INDEX "fk_hd_solicitudes_hd_etapas1_idx" ---------
CREATE INDEX `fk_hd_solicitudes_hd_etapas1_idx` USING BTREE ON `hd_solicitudes`( `etapas_id` );
-- ---------------------------------------------------------


-- CREATE INDEX "fk_hd_solicitudes_hd_productos1_idx" ------
CREATE INDEX `fk_hd_solicitudes_hd_productos1_idx` USING BTREE ON `hd_solicitudes`( `productos_id` );
-- ---------------------------------------------------------


-- CREATE INDEX "fk_hd_solicitudes_hd_tipo1_idx" -----------
CREATE INDEX `fk_hd_solicitudes_hd_tipo1_idx` USING BTREE ON `hd_solicitudes`( `tipo_id` );
-- ---------------------------------------------------------


-- CREATE LINK "fk_hd_bitacora_hd_solicitudes1" ------------
ALTER TABLE `hd_bitacora`
	ADD CONSTRAINT `fk_hd_bitacora_hd_solicitudes1` FOREIGN KEY ( `solicitudes_id` )
	REFERENCES `hd_solicitudes`( `id` )
	ON DELETE No Action
	ON UPDATE No Action;
-- ---------------------------------------------------------


-- CREATE LINK "fk_hd_clientes_hd_empresas1" ---------------
ALTER TABLE `hd_clientes`
	ADD CONSTRAINT `fk_hd_clientes_hd_empresas1` FOREIGN KEY ( `empresas_id` )
	REFERENCES `hd_empresas`( `id` )
	ON DELETE No Action
	ON UPDATE No Action;
-- ---------------------------------------------------------


-- CREATE LINK "fk_hd_comentarios_hd_agentes1" -------------
ALTER TABLE `hd_comentarios`
	ADD CONSTRAINT `fk_hd_comentarios_hd_agentes1` FOREIGN KEY ( `agentes_id` )
	REFERENCES `hd_agentes`( `id` )
	ON DELETE No Action
	ON UPDATE No Action;
-- ---------------------------------------------------------


-- CREATE LINK "fk_hd_comentarios_hd_clientes1" ------------
ALTER TABLE `hd_comentarios`
	ADD CONSTRAINT `fk_hd_comentarios_hd_clientes1` FOREIGN KEY ( `clientes_id` )
	REFERENCES `hd_clientes`( `id` )
	ON DELETE No Action
	ON UPDATE No Action;
-- ---------------------------------------------------------


-- CREATE LINK "fk_hd_comentarios_hd_solicitudes1" ---------
ALTER TABLE `hd_comentarios`
	ADD CONSTRAINT `fk_hd_comentarios_hd_solicitudes1` FOREIGN KEY ( `solicitudes_id` )
	REFERENCES `hd_solicitudes`( `id` )
	ON DELETE No Action
	ON UPDATE No Action;
-- ---------------------------------------------------------


-- CREATE LINK "fk_hd_estados_hd_etapas1" ------------------
ALTER TABLE `hd_estados`
	ADD CONSTRAINT `fk_hd_estados_hd_etapas1` FOREIGN KEY ( `etapas_id` )
	REFERENCES `hd_etapas`( `id` )
	ON DELETE No Action
	ON UPDATE No Action;
-- ---------------------------------------------------------


-- CREATE LINK "fk_hd_productos_empresas_hd_empresas1" -----
ALTER TABLE `hd_productos_empresas`
	ADD CONSTRAINT `fk_hd_productos_empresas_hd_empresas1` FOREIGN KEY ( `empresas_id` )
	REFERENCES `hd_empresas`( `id` )
	ON DELETE No Action
	ON UPDATE No Action;
-- ---------------------------------------------------------


-- CREATE LINK "fk_hd_productos_empresas_hd_productos" -----
ALTER TABLE `hd_productos_empresas`
	ADD CONSTRAINT `fk_hd_productos_empresas_hd_productos` FOREIGN KEY ( `productos_id` )
	REFERENCES `hd_productos`( `id` )
	ON DELETE No Action
	ON UPDATE No Action;
-- ---------------------------------------------------------


-- CREATE LINK "fk_hd_solicitudes_hd_agentes1" -------------
ALTER TABLE `hd_solicitudes`
	ADD CONSTRAINT `fk_hd_solicitudes_hd_agentes1` FOREIGN KEY ( `agentes_id` )
	REFERENCES `hd_agentes`( `id` )
	ON DELETE No Action
	ON UPDATE No Action;
-- ---------------------------------------------------------


-- CREATE LINK "fk_hd_solicitudes_hd_clientes1" ------------
ALTER TABLE `hd_solicitudes`
	ADD CONSTRAINT `fk_hd_solicitudes_hd_clientes1` FOREIGN KEY ( `clientes_id` )
	REFERENCES `hd_clientes`( `id` )
	ON DELETE No Action
	ON UPDATE No Action;
-- ---------------------------------------------------------


-- CREATE LINK "fk_hd_solicitudes_hd_empresas1" ------------
ALTER TABLE `hd_solicitudes`
	ADD CONSTRAINT `fk_hd_solicitudes_hd_empresas1` FOREIGN KEY ( `empresas_id` )
	REFERENCES `hd_empresas`( `id` )
	ON DELETE No Action
	ON UPDATE No Action;
-- ---------------------------------------------------------


-- CREATE LINK "fk_hd_solicitudes_hd_estados1" -------------
ALTER TABLE `hd_solicitudes`
	ADD CONSTRAINT `fk_hd_solicitudes_hd_estados1` FOREIGN KEY ( `estados_id` )
	REFERENCES `hd_estados`( `id` )
	ON DELETE No Action
	ON UPDATE No Action;
-- ---------------------------------------------------------


-- CREATE LINK "fk_hd_solicitudes_hd_etapas1" --------------
ALTER TABLE `hd_solicitudes`
	ADD CONSTRAINT `fk_hd_solicitudes_hd_etapas1` FOREIGN KEY ( `etapas_id` )
	REFERENCES `hd_etapas`( `id` )
	ON DELETE No Action
	ON UPDATE No Action;
-- ---------------------------------------------------------


-- CREATE LINK "fk_hd_solicitudes_hd_productos1" -----------
ALTER TABLE `hd_solicitudes`
	ADD CONSTRAINT `fk_hd_solicitudes_hd_productos1` FOREIGN KEY ( `productos_id` )
	REFERENCES `hd_productos`( `id` )
	ON DELETE No Action
	ON UPDATE No Action;
-- ---------------------------------------------------------


-- CREATE LINK "fk_hd_solicitudes_hd_tipo1" ----------------
ALTER TABLE `hd_solicitudes`
	ADD CONSTRAINT `fk_hd_solicitudes_hd_tipo1` FOREIGN KEY ( `tipo_id` )
	REFERENCES `hd_tipo`( `id` )
	ON DELETE No Action
	ON UPDATE No Action;
-- ---------------------------------------------------------


-- CREATE LINK "fk_hd_bitacora_hd_estados1" ----------------
ALTER TABLE `hd_bitacora`
	ADD CONSTRAINT `fk_hd_bitacora_hd_estados1` FOREIGN KEY ( `estados_id` )
	REFERENCES `hd_estados`( `id` )
	ON DELETE No Action
	ON UPDATE No Action;
-- ---------------------------------------------------------


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- ---------------------------------------------------------


