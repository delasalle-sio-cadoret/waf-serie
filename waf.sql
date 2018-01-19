-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 19 Janvier 2018 à 02:19
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `waf`
--

-- --------------------------------------------------------

--
-- Structure de la table `episode`
--

CREATE TABLE IF NOT EXISTS `episode` (
  `id_episode` int(100) NOT NULL AUTO_INCREMENT,
  `num_episode` int(100) NOT NULL,
  `lien_episode` varchar(100) NOT NULL,
  `id_saison` int(100) NOT NULL,
  PRIMARY KEY (`id_episode`),
  KEY `id_saison` (`id_saison`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `episode`
--

INSERT INTO `episode` (`id_episode`, `num_episode`, `lien_episode`, `id_saison`) VALUES
(1, 1, 'ezgdna2mv8ll', 1),
(2, 2, '4kpwutgos5b4', 1),
(3, 3, 'jb784d73o367', 1),
(4, 4, 'rkw03yneywlp', 1),
(5, 5, 'ii14bmt61buv', 1),
(6, 6, '4s8hc53pmxf2', 1),
(7, 7, 'wte8gly0xg4g', 1),
(8, 8, 'wtuzq9y9nr17', 1),
(9, 9, 'd2vwmdtt2db7', 1),
(10, 10, 'nv1x5569yq3q', 1);

-- --------------------------------------------------------

--
-- Structure de la table `film`
--

CREATE TABLE IF NOT EXISTS `film` (
  `id_film` int(100) NOT NULL AUTO_INCREMENT,
  `nom_film` varchar(100) NOT NULL,
  `date_film` varchar(100) NOT NULL,
  `resume_film` varchar(500) NOT NULL,
  `cover_film` varchar(500) NOT NULL,
  `background_film` varchar(500) NOT NULL,
  `genre_film` varchar(100) NOT NULL,
  `auteur_film` varchar(100) NOT NULL,
  `lien_film` varchar(100) NOT NULL,
  `type_film` varchar(50) NOT NULL,
  PRIMARY KEY (`id_film`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `saison`
--

CREATE TABLE IF NOT EXISTS `saison` (
  `id_saison` int(100) NOT NULL AUTO_INCREMENT,
  `num_saison` int(100) NOT NULL,
  `date_saison` varchar(50) NOT NULL,
  `resume_saison` varchar(500) NOT NULL,
  `cover_saison` varchar(500) NOT NULL,
  `background_saison` varchar(500) NOT NULL,
  `genre_saison` varchar(50) NOT NULL,
  `auteur_saison` varchar(50) NOT NULL,
  `id_serie` int(100) NOT NULL,
  PRIMARY KEY (`id_saison`),
  KEY `id_serie` (`id_serie`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `saison`
--

INSERT INTO `saison` (`id_saison`, `num_saison`, `date_saison`, `resume_saison`, `cover_saison`, `background_saison`, `genre_saison`, `auteur_saison`, `id_serie`) VALUES
(1, 2, '2013', 'Un ex-détenu expert en arts martiaux débarque à Banshee, un petite ville en territoire Amish. Il remplace alors le shérif récemment assassiné.', 'https://media.senscritique.com/media/000017373932/1000/Banshee.jpg', 'https://media.senscritique.com/media/000009597489/1400/Banshee.jpg', 'action', 'Jonathan Tropper', 1),
(2, 3, '2013', 'Un ex-détenu expert en arts martiaux débarque à Banshee, un petite ville en territoire Amish. Il remplace alors le shérif récemment assassiné.', 'http://img15.hostingpics.net/pics/485602Bansheesaison3.jpg', 'http://wallpapersdsc.net/wp-content/uploads/2015/11/3111.jpg', 'action', 'Jonathan Tropper', 1),
(3, 4, '2013', 'Un ex-détenu expert en arts martiaux débarque à Banshee, un petite ville en territoire Amish. Il remplace alors le shérif récemment assassiné.', 'http://www.zone-image.com/uploads/Ebdvp.jpg', 'http://marvelll.fr/wp-content/uploads/2016/05/Banshee-season-4-photo-Ivana-Milicevic.jpg', 'action', 'Jonathan Tropper', 1);

-- --------------------------------------------------------

--
-- Structure de la table `serie`
--

CREATE TABLE IF NOT EXISTS `serie` (
  `id_serie` int(100) NOT NULL AUTO_INCREMENT,
  `nom_serie` varchar(100) NOT NULL,
  PRIMARY KEY (`id_serie`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `serie`
--

INSERT INTO `serie` (`id_serie`, `nom_serie`) VALUES
(1, 'Banshee');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `episode`
--
ALTER TABLE `episode`
  ADD CONSTRAINT `episode_ibfk_1` FOREIGN KEY (`id_saison`) REFERENCES `saison` (`id_saison`);

--
-- Contraintes pour la table `saison`
--
ALTER TABLE `saison`
  ADD CONSTRAINT `saison_ibfk_2` FOREIGN KEY (`id_serie`) REFERENCES `serie` (`id_serie`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
