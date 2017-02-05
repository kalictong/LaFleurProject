-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Serveur: 127.0.0.1
-- Généré le : Mer 30 Mai 2012 à 21:49
-- Version du serveur: 5.1.54
-- Version de PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `lafleur_bdd`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `pdt_ref` varchar(50) COLLATE latin1_bin NOT NULL,
  `pdt_designation` varchar(500) COLLATE latin1_bin NOT NULL,
  `pdt_prix` int(11) NOT NULL,
  `pdt_categorie` varchar(50) COLLATE latin1_bin NOT NULL,
  PRIMARY KEY (`pdt_ref`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Contenu de la table `article`
--

INSERT INTO `article` (`pdt_ref`, `pdt_designation`, `pdt_prix`, `pdt_categorie`) VALUES
('m01', 'Plante verte de salon ou bureau', 5, 'mas'),
('m02', 'Fougere depolluante', 6, 'mas'),
('m03', 'Depolluant par excellence', 15, 'mas'),
('r01', 'Bouquet de rose orange', 23, 'ros'),
('r02', 'Ravissant bouquet de roses rose', 26, 'ros'),
('r03', 'Sublime bouquet de rose multicolore', 24, 'ros'),
('b02', 'Olivier', 29, 'bul'),
('b01', 'Petit arbre fruitier decoratif', 25, 'bul');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `pdt_categorie` varchar(50) COLLATE latin1_bin NOT NULL,
  `categ_libelle` varchar(100) COLLATE latin1_bin NOT NULL,
  PRIMARY KEY (`pdt_categorie`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`pdt_categorie`, `categ_libelle`) VALUES
('bul', 'bulbes'),
('mas', 'massifs'),
('ros', 'rosiers');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `nro_client` int(11) NOT NULL AUTO_INCREMENT,
  `ins_email` varchar(150) COLLATE latin1_bin NOT NULL,
  `ins_nom` varchar(50) COLLATE latin1_bin NOT NULL,
  `ins_prenom` varchar(50) COLLATE latin1_bin NOT NULL,
  `ins_adresse` varchar(150) COLLATE latin1_bin NOT NULL,
  `ins_CP` int(5) NOT NULL,
  `ins_ville` varchar(50) COLLATE latin1_bin NOT NULL,
  `pass` varchar(250) COLLATE latin1_bin NOT NULL,
  PRIMARY KEY (`nro_client`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_bin AUTO_INCREMENT=3 ;

--
-- Contenu de la table `client`
--

INSERT INTO `client` (`nro_client`, `ins_email`, `ins_nom`, `ins_prenom`, `ins_adresse`, `ins_CP`, `ins_ville`, `pass`) VALUES
(1, 'mehdi.megrous@gmail.com', 'MEGROUS', 'Mehdi', '44 rue du coulmier', 55100, 'Verdun', '098f6bcd4621d373cade4e832627b4f6'),
(2, 'jason_benedetti@gmail.com', 'Benedetti', 'Jason', '80 grande rue', 54000, 'Nancy', '900150983cd24fb0d6963f7d28e17f72');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE IF NOT EXISTS `commande` (
  `nro_commande` varchar(50) COLLATE latin1_bin NOT NULL,
  `date_commande` datetime NOT NULL,
  `nro_client` int(11) NOT NULL,
  PRIMARY KEY (`nro_commande`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Contenu de la table `commande`
--

INSERT INTO `commande` (`nro_commande`, `date_commande`, `nro_client`) VALUES
('4fc502ab1ca1e', '2012-05-29 00:00:00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `ligne_commande`
--

CREATE TABLE IF NOT EXISTS `ligne_commande` (
  `nro_commande` varchar(50) COLLATE latin1_bin NOT NULL,
  `pdt_ref` varchar(50) COLLATE latin1_bin NOT NULL,
  `prix_fixe` int(11) NOT NULL,
  `qte_commande` int(11) NOT NULL,
  PRIMARY KEY (`nro_commande`,`pdt_ref`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Contenu de la table `ligne_commande`
--

INSERT INTO `ligne_commande` (`nro_commande`, `pdt_ref`, `prix_fixe`, `qte_commande`) VALUES
('4fc502ab1ca1e', 'm01', 5, 1),
('4fc502ab1ca1e', 'r01', 23, 2);
