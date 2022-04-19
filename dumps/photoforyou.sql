-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 15, 2022 at 09:48 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `photoforyou`
--
CREATE DATABASE IF NOT EXISTS `photoforyou` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `photoforyou`;

DELIMITER $$
--
-- Functions
--
DROP FUNCTION IF EXISTS `client_sans_credit`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `client_sans_credit` () RETURNS INT(11) BEGIN
DECLARE credit int;
SELECT DISTINCT count(*) INTO credit FROM users WHERE credit = 0 AND categorie = 1;
RETURN credit;
END$$

DROP FUNCTION IF EXISTS `InitCap`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `InitCap` (`a` VARCHAR(45)) RETURNS VARCHAR(45) CHARSET utf8 BEGIN

RETURN ( concat(upper(substr(a,1,1)),lower(substr(a,2,length(a)-1))) );
END$$

DROP FUNCTION IF EXISTS `nombre_photo`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `nombre_photo` (`a` INT) RETURNS INT(11) BEGIN
DECLARE nbrphoto int;
SELECT count(*) INTO nbrphoto FROM photo WHERE iduser=a;
RETURN nbrphoto;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `acheter`
--

DROP TABLE IF EXISTS `acheter`;
CREATE TABLE IF NOT EXISTS `acheter` (
  `idphoto` int(11) NOT NULL,
  `idacheter` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) NOT NULL,
  PRIMARY KEY (`idacheter`,`idphoto`,`iduser`),
  UNIQUE KEY `idphoto_UNIQUE` (`idphoto`),
  KEY `iduser` (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `acheter`
--

INSERT INTO `acheter` (`idphoto`, `idacheter`, `iduser`) VALUES
(11, 17, 12),
(13, 18, 15);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `idMenu` int(11) NOT NULL,
  `nomMenu` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `URL` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `Habilitation` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`idMenu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`idMenu`, `nomMenu`, `URL`, `Habilitation`) VALUES
(1, 'Espace Photographe', NULL, 'P'),
(2, 'Album', '', 'CPAV'),
(3, 'Admin', NULL, 'A'),
(11, 'Vendre photo', 'vendre-photo.php', 'P'),
(12, 'Créer un tags', 'ajouter-tags.php', 'P'),
(21, 'Voir Album', 'album.php', 'CPAV'),
(31, 'Gérer Utilisateurs', 'gerer-utilisateur.php', 'A'),
(33, 'Gérer Tags', 'gerer-tags.php', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

DROP TABLE IF EXISTS `photo`;
CREATE TABLE IF NOT EXISTS `photo` (
  `idphoto` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `photolargeur` int(11) DEFAULT NULL,
  `photolongueur` int(11) DEFAULT NULL,
  `nomimage` varchar(70) CHARACTER SET latin1 DEFAULT NULL,
  `prix` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `datePub` datetime DEFAULT NULL,
  `poids` float DEFAULT NULL,
  `iduser` int(11) DEFAULT NULL,
  `idtags` int(11) DEFAULT NULL,
  PRIMARY KEY (`idphoto`),
  KEY `iduser` (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `photo`
--

INSERT INTO `photo` (`idphoto`, `libelle`, `photolargeur`, `photolongueur`, `nomimage`, `prix`, `datePub`, `poids`, `iduser`, `idtags`) VALUES
(3, 'Shibuya - Japan at night', NULL, NULL, 'Shibuya-Japan_jezael-melgoza-alY6_OpdwRQ-unsplash.jpg', '250', '2022-03-18 08:14:39', 361994, 4, 1),
(4, 'Japanese Temple', NULL, NULL, 'japan_2x.jpg', '250', '2022-03-18 08:14:58', 262010, 4, 1),
(5, 'Japanese Red Temple', NULL, NULL, '88.jpg', '250', '2022-03-18 08:15:18', 429403, 4, 1),
(6, 'Finland Lake', NULL, NULL, '5aa8ee5e1e00008e0b7ae9d8.jpeg', '250', '2022-03-18 08:15:30', 622167, 4, 1),
(10, 'Eifel Tower - Paris', NULL, NULL, 'v5qs.jpg', '250', '2022-03-18 08:37:43', 234620, 4, 1),
(11, 'Ours', NULL, NULL, 'z3aELMTpmy64OtTkiTj8.jpg', '250', '2022-03-21 15:27:32', 471211, 4, 3),
(12, 'test', NULL, NULL, '4q0mgDd2BJ91w5VAzJ5m.jpg', '900', '2022-03-22 13:09:00', 72514, 4, 3),
(13, 'test', NULL, NULL, 'KeH0IpQQ7NqwFm1OoNPC.jpg', '10', '2022-04-04 14:39:48', 31043, 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
  `idtags` int(11) NOT NULL AUTO_INCREMENT,
  `libelleTags` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `activeTags` int(11) DEFAULT NULL,
  `iduserTags` int(11) DEFAULT NULL,
  PRIMARY KEY (`idtags`),
  KEY `tags_ibfk_1` (`iduserTags`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`idtags`, `libelleTags`, `activeTags`, `iduserTags`) VALUES
(1, 'Paysage', 1, 1),
(2, 'Portrait', 1, 1),
(3, 'Animaux', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `iduser` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) CHARACTER SET latin1 NOT NULL,
  `prenom` varchar(45) CHARACTER SET latin1 NOT NULL,
  `email` varchar(45) CHARACTER SET latin1 NOT NULL,
  `mdp` varchar(128) CHARACTER SET latin1 NOT NULL,
  `dateNaiss` date NOT NULL,
  `credit` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `categorie` int(11) NOT NULL,
  `photoUser` varchar(100) CHARACTER SET latin1 NOT NULL DEFAULT 'profil.jpg',
  `telUser` char(10) CHARACTER SET latin1 DEFAULT NULL,
  `adressUser` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `siteUser` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `siret` varchar(14) DEFAULT NULL,
  PRIMARY KEY (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`iduser`, `nom`, `prenom`, `email`, `mdp`, `dateNaiss`, `credit`, `active`, `categorie`, `photoUser`, `telUser`, `adressUser`, `siteUser`, `siret`) VALUES
(1, 'Test', 'Test', 'admin@admin.com', 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec', '1988-11-01', 9999, 1, 7, 'kingcroc.jpg', '0786735357', '1 Place du Cinsault', 'test', NULL),
(4, 'Baie', 'Michel', 'michel.baie@gmail.com', 'df6b9fb15cfdbb7527be5a8a6e39f39e572c8ddb943fbc79a943438e9d3d85ebfc2ccf9e0eccd9346026c0b6876e0e01556fe56f135582c05fbdbb505d46755a', '1988-11-29', 260, 1, 3, 'michelbaie.jpg', '0786735357', NULL, '', NULL),
(12, 'Monrocq', 'Ugo', 'ugo.monrocq@gmail.com', '50a84d539ec7f4cd8662378b77cacc124eb75504ac35b2da608c7dcb5c8574ee614ee975cde76bbfddaf0c61b5bd038ce3b278df4c639343a71463fd71c7aa06', '2002-07-09', 1480, 1, 1, 'profil.jpg', NULL, NULL, NULL, NULL),
(15, 'Cauquil', 'Emmanuel', 'manucoq11@gmail.com', 'f3ce367289c96b272bb1312378f92f727b2c7bb03ffa4c621ddda4ece75706fe3e9519bc82663e777f4cce8fdfdd56df9b718210c1e62a2cbb6f4d88fe290149', '2022-04-19', 490, 1, 1, 'profil.jpg', '0786735357', NULL, 'ygusdhdsiqui.fr', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `acheter`
--
ALTER TABLE `acheter`
  ADD CONSTRAINT `acheter_ibfk_1` FOREIGN KEY (`iduser`) REFERENCES `users` (`iduser`),
  ADD CONSTRAINT `acheter_ibfk_2` FOREIGN KEY (`idphoto`) REFERENCES `photo` (`idphoto`);

--
-- Constraints for table `tags`
--
ALTER TABLE `tags`
  ADD CONSTRAINT `tags_ibfk_1` FOREIGN KEY (`iduserTags`) REFERENCES `users` (`iduser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
