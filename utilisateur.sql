/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE `utilisateur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `pdp` varchar(255) DEFAULT NULL,
  `date_connexion` datetime DEFAULT NULL,
  `date_creation` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

INSERT INTO `utilisateur` (`id`, `pseudo`, `email`, `password`, `pdp`, `date_connexion`, `date_creation`) VALUES
(1, 'Asasa', 'anaismechenane75@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$NmpJTkN1UzA1NGF0Y0xBdQ$wWU68ANIgqz1WrL0kM+DTdw7h/Lp0HyYA1Lsr6KYSoA', 'https://th.bing.com/th/id/OIP.OE8G_hsblGXLBww_k_bdAgHaE8?pid=ImgDet&rs=1', '2022-12-20 17:38:46', '2022-12-18 19:28:08');
INSERT INTO `utilisateur` (`id`, `pseudo`, `email`, `password`, `pdp`, `date_connexion`, `date_creation`) VALUES
(2, 'Sarde', 'anaismechne75@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$UTFYaWcyMTVjR09DRTZ2TQ$O/1NPlIqrBPetiIsiasG264qRmljLaz4ktUmGYRrg3Y', 'https://th.bing.com/th/id/OIP.OE8G_hsblGXLBww_k_bdAgHaE8?pid=ImgDet&rs=1', '2022-12-18 19:29:57', '2022-12-18 19:29:57');
INSERT INTO `utilisateur` (`id`, `pseudo`, `email`, `password`, `pdp`, `date_connexion`, `date_creation`) VALUES
(3, 'Test', 'enzodeniau2003@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$UjFEVUhYemlKZzBIZmhzbQ$xdry/9dPcfgXsTQUXcDo56dQJFze8azN4+oWnpU2bAE', NULL, '2022-12-18 22:37:35', '2022-12-18 22:37:35');
INSERT INTO `utilisateur` (`id`, `pseudo`, `email`, `password`, `pdp`, `date_connexion`, `date_creation`) VALUES
(4, 'Test25', 'dolleka3@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$LzJjajNZMTVzQ2t2UEtFTA$wz65IGYOkFocTAtsYS5Z9/FCnUA/GMYcHhU6Uvy9UW8', 'https://cabar.asia/wp-content/uploads/2018/05/NOLX8216.jpg', '2022-12-18 22:53:02', '2022-12-18 22:52:45');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;