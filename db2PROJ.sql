-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 10 juin 2020 à 20:28
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `db2PROJ`
--

-- --------------------------------------------------------

--
-- Structure de la table `answers`
--

DROP TABLE IF EXISTS `answers`;
CREATE TABLE IF NOT EXISTS `answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `survey` text DEFAULT NULL,
  `username` text DEFAULT NULL,
  `date_sent` timestamp NOT NULL DEFAULT current_timestamp(),
  `answer` text DEFAULT NULL,
  `answers` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `text` text DEFAULT NULL,
  `radio` text DEFAULT NULL,
  `checkbox` text DEFAULT NULL,
  `done` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `answers`
--

INSERT INTO `answers` (`id`, `survey`, `username`, `date_sent`, `answer`, `answers`, `text`, `radio`, `checkbox`, `done`) VALUES
(33, 'Satisfaction_survey', 'JohnSmith', '2020-06-03 12:31:03', 'What are the promotion prospects for your position?=I don\'t know yet; Is your work interesting?=No;Is your job difficult?=Yes;During a typical week, do you often feel stressed at work?=No;Are you paid well for the work you provide?=Yes;To what extent are your opinions regarding work taken into account by your employees?=A little;Does your manager regularly entrust you with tasks that make you develop professionally?=Often;What is the probability that you are looking for another job outside the company?=25%;', NULL, NULL, NULL, NULL, ''),
(48, 'Satisfaction_survey', 'JohnSmithe', '2020-06-04 15:56:41', NULL, NULL, 'What are the promotion prospects for your position?=content1;tg gros porc=content2;dernier test=content3;', 'Is your work interesting?=No;Is your job difficult?=No;During a typical week, do you often feel stressed at work?=No;Are you paid well for the work you provide?=Yes;To what extent are your opinions regarding work taken into account by your employees?=A little;Does your manager regularly entrust you with tasks that make you develop professionally?=Never;', 'What is the probability that you are looking for another job outside the company?=0%,25%;khortkphlrtg=cnksnc,nkgolk;', ''),
(63, 'Satisfaction_survey', 'JohnSmith42', '2020-06-07 17:51:53', NULL, '\r\n	{\r\n		\"Question\": \"What are the promotion prospects for your position?\",\r\n		\"Answer\": \"john smith\"\r\n	},\r\n	{\r\n		\"Question\": \"Is your work interesting?\",\r\n		\"Answer\": \"Yes\"\r\n	},\r\n	{\r\n		\"Question\": \"Is your job difficult?\",\r\n		\"Answer\": \"No\"\r\n	},\r\n	{\r\n		\"Question\": \"During a typical week, do you often feel stressed at work?\",\r\n		\"Answer\": \"No\"\r\n	},\r\n	{\r\n		\"Question\": \"Are you paid well for the work you provide?\",\r\n		\"Answer\": \"No\"\r\n	},\r\n	{\r\n		\"Question\": \"To what extent are your opinions regarding work taken into account by your employees?\",\r\n		\"Answer\": \"Well\"\r\n	},\r\n	{\r\n		\"Question\": \"Does your manager regularly entrust you with tasks that make you develop professionally?\",\r\n		\"Answer\": \"Never\"\r\n	},\r\n	{\r\n		\"Question\": \"What is the probability that you are looking for another job outside the company?\",\r\n		\"Answer\": \"25%,50%,75%\"\r\n	}', NULL, NULL, NULL, 'completed'),
(62, 'Satisfaction_survey', 'oscar', '2020-06-05 15:12:52', NULL, '\r\n	{\r\n		\"Question\": \"What are the promotion prospects for your position?\",\r\n		\"Answer\": \"htrhtr\"\r\n	},\r\n	{\r\n		\"Question\": \"Is your work interesting?\",\r\n		\"Answer\": \"Yes\"\r\n	},\r\n	{\r\n		\"Question\": \"Is your job difficult?\",\r\n		\"Answer\": \"Yes\"\r\n	},\r\n	{\r\n		\"Question\": \"During a typical week, do you often feel stressed at work?\",\r\n		\"Answer\": \"No\"\r\n	},\r\n	{\r\n		\"Question\": \"Are you paid well for the work you provide?\",\r\n		\"Answer\": \"Yes\"\r\n	},\r\n	{\r\n		\"Question\": \"To what extent are your opinions regarding work taken into account by your employees?\",\r\n		\"Answer\": \"Well\"\r\n	},\r\n	{\r\n		\"Question\": \"Does your manager regularly entrust you with tasks that make you develop professionally?\",\r\n		\"Answer\": \"Often\"\r\n	},\r\n	{\r\n		\"Question\": \"What is the probability that you are looking for another job outside the company?\",\r\n		\"Answer\": \"50%,75%\"\r\n	}', NULL, NULL, NULL, 'completed'),
(64, 'Satisfaction_survey', 'Stacy0779', '2020-06-09 12:58:31', NULL, '\r\n	{\r\n		\"Question\": \"What are the promotion prospects for your position?\",\r\n		\"Answer\": \"I don\'t know\"\r\n	},\r\n	{\r\n		\"Question\": \"Is your work interesting?\",\r\n		\"Answer\": \"No\"\r\n	},\r\n	{\r\n		\"Question\": \"Is your job difficult?\",\r\n		\"Answer\": \"No\"\r\n	},\r\n	{\r\n		\"Question\": \"During a typical week, do you often feel stressed at work?\",\r\n		\"Answer\": \"No\"\r\n	},\r\n	{\r\n		\"Question\": \"Are you paid well for the work you provide?\",\r\n		\"Answer\": \"Yes\"\r\n	},\r\n	{\r\n		\"Question\": \"To what extent are your opinions regarding work taken into account by your employees?\",\r\n		\"Answer\": \"A little\"\r\n	},\r\n	{\r\n		\"Question\": \"Does your manager regularly entrust you with tasks that make you develop professionally?\",\r\n		\"Answer\": \"Always\"\r\n	},\r\n	{\r\n		\"Question\": \"What is the probability that you are looking for another job outside the company?\",\r\n		\"Answer\": \"50%,100%\"\r\n	}\r\n', NULL, NULL, NULL, 'completed'),
(65, 'Satisfaction_survey', 'Gerald_D', '2020-06-09 17:05:22', NULL, '\r\n	{\r\n		\"Question\": \"What are the promotion prospects for your position?\",\r\n		\"Answer\": \"Gerald_D\"\r\n	},\r\n	{\r\n		\"Question\": \"Is your work interesting?\",\r\n		\"Answer\": \"No\"\r\n	},\r\n	{\r\n		\"Question\": \"Is your job difficult?\",\r\n		\"Answer\": \"Yes\"\r\n	},\r\n	{\r\n		\"Question\": \"During a typical week, do you often feel stressed at work?\",\r\n		\"Answer\": \"Yes\"\r\n	},\r\n	{\r\n		\"Question\": \"Are you paid well for the work you provide?\",\r\n		\"Answer\": \"Yes\"\r\n	},\r\n	{\r\n		\"Question\": \"To what extent are your opinions regarding work taken into account by your employees?\",\r\n		\"Answer\": \"Very well\"\r\n	},\r\n	{\r\n		\"Question\": \"Does your manager regularly entrust you with tasks that make you develop professionally?\",\r\n		\"Answer\": \"Never\"\r\n	},\r\n	{\r\n		\"Question\": \"What is the probability that you are looking for another job outside the company?\",\r\n		\"Answer\": \"0%,50%\"\r\n	}\r\n', NULL, NULL, NULL, 'completed');

-- --------------------------------------------------------

--
-- Structure de la table `les_animaux_du_mexique`
--

DROP TABLE IF EXISTS `les_animaux_du_mexique`;
CREATE TABLE IF NOT EXISTS `les_animaux_du_mexique` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `radio` text DEFAULT NULL,
  `checkbox` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `les_animaux_du_mexique`
--

INSERT INTO `les_animaux_du_mexique` (`id`, `title`, `content`, `radio`, `checkbox`, `image`, `status`) VALUES
(1, 'What is the name of this Pepe?', 'Hint: what emoji is he doing?', NULL, NULL, 'images/shared/3DPepeSmirkT.png', 'current'),
(2, 'Which breed of lion does he belong to?', NULL, 'Katanga;Abyssinian;Kalahari', NULL, 'images/shared/2018-03-21_1816.png', 'current'),
(3, 'Which fruit does this emoji look like?', NULL, NULL, 'Apple;Tomato;Pear', 'images/shared/greenpear.png', 'current');

-- --------------------------------------------------------

--
-- Structure de la table `satisfaction_survey`
--

DROP TABLE IF EXISTS `satisfaction_survey`;
CREATE TABLE IF NOT EXISTS `satisfaction_survey` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `radio` text DEFAULT NULL,
  `checkbox` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `satisfaction_survey`
--

INSERT INTO `satisfaction_survey` (`id`, `title`, `content`, `radio`, `checkbox`, `image`, `status`) VALUES
(3, 'Is your work interesting?', NULL, 'Yes;No', NULL, 'images/shared/work.png', 'current'),
(4, 'Is your job difficult?', NULL, 'Yes;No', NULL, '', 'current'),
(7, 'Are you paid well for the work you provide?', NULL, 'Yes;No', NULL, '', 'current'),
(6, 'During a typical week, do you often feel stressed at work?', NULL, 'Yes;No', NULL, '', 'current'),
(11, 'Does your manager regularly entrust you with tasks that make you develop professionally?', NULL, 'Never;Often;Always', NULL, '', 'current'),
(10, 'To what extent are your opinions regarding work taken into account by your employees?', NULL, 'A little;Well;Very well', NULL, '', 'current'),
(12, 'What are the promotion prospects for your position?', '', NULL, NULL, '', 'current'),
(13, 'What is the probability that you are looking for another job outside the company?', NULL, NULL, '0%;25%;50%;75%;100%', '', 'current'),
(20, 'grgrzrzggr', NULL, 'grzgrzrgzr', NULL, '', 'current');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `mySurveys` varchar(255) NOT NULL,
  `sharedSurveys` varchar(255) NOT NULL,
  `noShare` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `email`, `password`, `mySurveys`, `sharedSurveys`, `noShare`) VALUES
(1, 'root', 'root', 'root', 'onlinesurvey@bigbrother.com', 'J~·zdt¡d\' :´šùÓž`ºŽ«}¸s…b‚;Õ­', '', 'Les_animaux_du_Mexique,Satisfaction_survey', ''),
(3, 'Oscar', 'Di Lenarda', 'oscar', 'oscar.dilenarda@supinfo.com', 'îaHå0áˆÌÌs%¥§‘', 'Les_animaux_du_Mexique', 'Satisfaction_survey', ''),
(4, 'Francois', 'Leclercq', 'francois', 'francois.leclercq@supinfo.com', '&«êågûÚ@Õ7ÓW*v', 'Satisfaction_survey', 'Les_animaux_du_Mexique', ''),
(5, 'John', 'Smith', 'JohnSmith42', 'johnsmith42@example.com', '¨æ¯ˆ» ¨ÅÙúãóêtõ ', '', 'Satisfaction_survey', ''),
(9, 'Gerald', 'Davis', 'Gerald_D', 'gerald.davis@example.com', 'd”£¾t?´†¡Ÿ†¬Ãó', '', 'Satisfaction_survey', ''),
(8, 'Stacy', 'Friedman', 'Stacy0779', 'stacy.friedman@example.com', '\rù%Q¹b×!+ã+³.0H', '', 'Satisfaction_survey', ''),
(10, 'Chris', 'Buck', 'ChrisBuck0526', 'chris.buck@example.com', '–9¼3›g{YÝCÌÞ«', '', 'Satisfaction_survey', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
