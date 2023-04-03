/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE `albums` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `Url_POSTER` varchar(255) NOT NULL,
  `utilisateur_id` int NOT NULL,
  `Public` int DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `utilisateur_id` (`utilisateur_id`),
  CONSTRAINT `albums_ibfk_1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;

INSERT INTO `albums` (`id`, `title`, `Url_POSTER`, `utilisateur_id`, `Public`) VALUES
(1, 'Romance', 'https://th.bing.com/th/id/OIP.Jyjq_TLtFWrAWKP1hNkSCwHaE8?w=268&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7', 1, NULL);
INSERT INTO `albums` (`id`, `title`, `Url_POSTER`, `utilisateur_id`, `Public`) VALUES
(2, 'Romance', 'https://th.bing.com/th/id/OIP.Jyjq_TLtFWrAWKP1hNkSCwHaE8?w=268&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7', 1, NULL);
INSERT INTO `albums` (`id`, `title`, `Url_POSTER`, `utilisateur_id`, `Public`) VALUES
(3, 'Romance', 'https://th.bing.com/th/id/OIP.Jyjq_TLtFWrAWKP1hNkSCwHaE8?w=268&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7', 1, NULL);
INSERT INTO `albums` (`id`, `title`, `Url_POSTER`, `utilisateur_id`, `Public`) VALUES
(4, 'Romance', 'https://th.bing.com/th/id/OIP.Jyjq_TLtFWrAWKP1hNkSCwHaE8?w=268&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7', 1, NULL),
(5, 'Romance', 'https://th.bing.com/th/id/OIP.Jyjq_TLtFWrAWKP1hNkSCwHaE8?w=268&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7', 1, 0),
(6, 'Technique', 'https://th.bing.com/th/id/OIP.Jyjq_TLtFWrAWKP1hNkSCwHaE8?w=268&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7', 6, 0),
(7, 'Liste d\'envie', 'url', 7, 0),
(8, 'Visionné', 'url', 7, 0),
(9, 'Liste d\'envie', 'url', 8, 0),
(10, 'Visionné', 'url', 8, 0),
(11, 'Romance', 'https://th.bing.com/th/id/OIP.Jyjq_TLtFWrAWKP1hNkSCwHaE8?w=268&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7', 8, 0),
(12, 'Technique', 'https://th.bing.com/th/id/OIP.Jyjq_TLtFWrAWKP1hNkSCwHaE8?w=268&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7', 8, 0),
(13, 'Technique', 'https://th.bing.com/th/id/OIP.Jyjq_TLtFWrAWKP1hNkSCwHaE8?w=268&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7', 8, 0),
(14, 'Technique', 'https://th.bing.com/th/id/OIP.Jyjq_TLtFWrAWKP1hNkSCwHaE8?w=268&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7', 8, 0),
(15, 'Technique', 'https://th.bing.com/th/id/OIP.Jyjq_TLtFWrAWKP1hNkSCwHaE8?w=268&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7', 8, 0),
(16, 'Technique', 'https://th.bing.com/th/id/OIP.Jyjq_TLtFWrAWKP1hNkSCwHaE8?w=268&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7', 8, 0),
(17, 'Technique', 'https://th.bing.com/th/id/OIP.Jyjq_TLtFWrAWKP1hNkSCwHaE8?w=268&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7', 8, 0),
(18, 'Technique', 'https://th.bing.com/th/id/OIP.Jyjq_TLtFWrAWKP1hNkSCwHaE8?w=268&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7', 8, 1),
(19, 'Test', 'https://th.bing.com/th/id/OIP.Jyjq_TLtFWrAWKP1hNkSCwHaE8?w=268&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7', 8, 1),
(20, 'Test', 'https://th.bing.com/th/id/OIP.Jyjq_TLtFWrAWKP1hNkSCwHaE8?w=268&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7', 8, 0),
(21, 'Liste d\'envie', 'url', 9, 0),
(22, 'Visionné', 'url', 9, 0),
(23, 'Romance', 'https://th.bing.com/th/id/OIP.Jyjq_TLtFWrAWKP1hNkSCwHaE8?w=268&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7', 7, 1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;