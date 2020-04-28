-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 27 avr. 2020 à 17:49
-- Version du serveur :  5.7.26
-- Version de PHP :  7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `peinture`
--

-- --------------------------------------------------------

--
-- Structure de la table `etat_message`
--

DROP TABLE IF EXISTS `etat_message`;
CREATE TABLE IF NOT EXISTS `etat_message` (
  `id` int(11) NOT NULL,
  `etat` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `etat_message`
--

INSERT INTO `etat_message` (`id`, `etat`) VALUES
(1, 'PubliÃ©'),
(2, 'Non_PubliÃ©');

-- --------------------------------------------------------

--
-- Structure de la table `livredor_message`
--

DROP TABLE IF EXISTS `livredor_message`;
CREATE TABLE IF NOT EXISTS `livredor_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Pseudo` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `note` int(2) NOT NULL,
  `message` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `idEtat_message` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idEtat_message` (`idEtat_message`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `livredor_message`
--

INSERT INTO `livredor_message` (`id`, `Pseudo`, `email`, `note`, `message`, `date`, `idEtat_message`) VALUES
(7, 'Anonyme5', 'kevin.brunel@live.fr2', 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis mauris ex, gravida ut leo eu, rhoncus porta orci. Fusce vitae rutrum nulla.', '2020-04-21', 1),
(8, 'Anonyme4', 'test@tet.fr', 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis mauris ex, gravida ut leo eu, rhoncus porta orci. Fusce vitae rutrum nulla.©', '2020-04-23', 1),
(9, 'Anonyme3', 'kevin.brunel@test.fr', 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis mauris ex, gravida ut leo eu, rhoncus porta orci. Fusce vitae rutrum nulla.', '2020-04-23', 2),
(10, 'Anonyme2', 'kevin.brunel@live.fr3', 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis mauris ex, gravida ut leo eu, rhoncus porta orci. Fusce vitae rutrum nulla.', '2020-04-23', 1),
(11, 'Anonyme', 'anonyme@test.fr', 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis mauris ex, gravida ut leo eu, rhoncus porta orci. Fusce vitae rutrum nulla.', '2020-04-27', 1);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id`, `libelle`) VALUES
(1, 'Admin'),
(2, 'Client');

-- --------------------------------------------------------

--
-- Structure de la table `tableau`
--

DROP TABLE IF EXISTS `tableau`;
CREATE TABLE IF NOT EXISTS `tableau` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `photo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `tableau`
--

INSERT INTO `tableau` (`id`, `titre`, `description`, `date`, `photo`) VALUES
(32, 'ROMAN ROMANÃ©', 'Roman', '2020-04-21', '56174878_2392527614316421_5309257456839294976_n.jpg'),
(33, 'netnd', 'Lion', '2020-04-21', 'BO671_106.jpg'),
(34, 'ntend', 'Femme', '2020-04-15', '71NXk7_59PL._AC_SX450_.jpg'),
(35, 'Les Girafes', 'Girafes', '2020-04-21', '00163e6f_f163_1ed9_91e1_6af0f832192b.jpg'),
(38, 'gtr', 'Violet', '2020-04-17', 'tableau_bleu_violet_resor.jpg'),
(40, 'vrevrt', 'cerf', '2020-04-18', 'tableau_deco_tete_de_cerf_origami.jpg'),
(41, 'rev', 'brtz', '2020-04-24', '55719207_2392540307648485_6577066192698081280_n.jpg'),
(42, 'ezvs', 'rtzfv', '2020-04-24', '55940016_2392529027649613_7779035188738129920_n.jpg'),
(43, 'greagert', 'gertzgreg', '2020-04-24', '56371041_2392531764316006_1487500517822169088_n.jpg'),
(44, 'Main Coon', 'TrÃ©s beau chat !', '2020-04-27', '55719207_2392540307648485_6577066192698081280_n.jpg'),
(45, 'Main Coon 2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis mauris ex, gravida ut leo eu, rhoncus porta orci. Fusce vitae rutrum nulla.', '2020-04-27', '78170389_2602364176666096_6325355498262495232_n.jpg'),
(46, 'Main Coon 3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis mauris ex, gravida ut leo eu, rhoncus porta orci. Fusce vitae rutrum nulla.', '2020-04-27', '79688724_2602364276666086_7718784283703246848_n.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(150) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `cp` varchar(5) NOT NULL,
  `ville` varchar(30) NOT NULL,
  `idRole` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `extension` varchar(255) NOT NULL,
  `taille` varchar(255) NOT NULL,
  `nomoriginal` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idRole` (`idRole`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `email`, `mdp`, `nom`, `prenom`, `cp`, `ville`, `idRole`, `photo`, `date`, `extension`, `taille`, `nomoriginal`) VALUES
(2, 'roman.broy@hotmail.com', '$2y$10$C6cx3z/yFqFoQxgqSwlDB.62NVy2SKWO1qiS1K6DZTOOhTMXNIxFa', 'BROY', 'Roman', '62217', 'beaurains', 1, '', '2020-04-18 00:00:00', '', '', '');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `livredor_message`
--
ALTER TABLE `livredor_message`
  ADD CONSTRAINT `livredor_message_ibfk_1` FOREIGN KEY (`idEtat_message`) REFERENCES `etat_message` (`id`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`idRole`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
