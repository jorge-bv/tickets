-- Valentina Studio --
-- MySQL dump --
-- ---------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
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


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- ---------------------------------------------------------


-- Dump data of "hd_etapas" --------------------------------
INSERT INTO `hd_etapas`(`id`,`nombre`,`create`,`update`) VALUES ( '10', 'Inicio', '2015-09-24 11:09:41', NULL );
INSERT INTO `hd_etapas`(`id`,`nombre`,`create`,`update`) VALUES ( '20', 'Proceso', '2015-09-24 11:09:47', NULL );
INSERT INTO `hd_etapas`(`id`,`nombre`,`create`,`update`) VALUES ( '30', 'Termino', '2015-09-24 11:09:53', NULL );
-- ---------------------------------------------------------


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- ---------------------------------------------------------


