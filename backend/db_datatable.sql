/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE DATABASE IF NOT EXISTS `db_datatable` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `db_datatable`;

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telephone` varchar(11) NOT NULL,
  `cpf` char(11) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` bit(1) NOT NULL DEFAULT b'0',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `cpf` (`cpf`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `user` (`id`, `name`, `email`, `telephone`, `cpf`, `password`, `status`, `created_at`) VALUES
	(17, 'Julio', 'julio@gmail.com', '99999999999', '99999999999', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', b'0', '2022-10-19 01:59:23');

CREATE TABLE IF NOT EXISTS `user_token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `token` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id`),
  KEY `FK_user_token_user` (`id_user`),
  CONSTRAINT `FK_user_token_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `user_token` (`id`, `id_user`, `token`, `created_at`, `status`) VALUES
	(1, 17, '92f00d809db125730d8b7df653df61b0', '2022-10-19 01:59:23', b'1');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
