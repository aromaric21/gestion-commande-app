-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 24 mai 2023 à 09:52
-- Version du serveur : 8.0.28
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestioncommandes`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `idarticle` int NOT NULL AUTO_INCREMENT,
  `description` varchar(250) NOT NULL,
  `prix_unitaire` float NOT NULL,
  PRIMARY KEY (`idarticle`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`idarticle`, `description`, `prix_unitaire`) VALUES
(1, 'Ordinateur', 2000),
(2, 'Téléviseur', 3000),
(3, 'Clavier', 60),
(4, 'Souris', 30),
(5, 'Ecouteurs', 80),
(6, 'Clé USB', 40),
(7, 'Unité Centrale', 12000),
(8, 'Imprimante', 3500);

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `idclient` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(20) NOT NULL,
  `ville` varchar(30) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  PRIMARY KEY (`idclient`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`idclient`, `nom`, `ville`, `telephone`) VALUES
(1, 'Sara', 'Amiens', '0614141414'),
(2, 'Nicolas', 'Paris', '0613141414'),
(3, 'Clara', 'Amiens', '0615141414'),
(5, 'Victoire', 'Marseille', '0614121212'),
(7, 'Annique', 'Lens', '0615141406'),
(8, 'Romus', 'Saint-Denis', '0647061011'),
(9, 'Romus', 'Caen', '0647061012'),
(10, 'Chantal', 'Bordeau', '0625171717');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `idcommande` int NOT NULL AUTO_INCREMENT,
  `idclient` int NOT NULL,
  `date` date NOT NULL,
  `vues` int DEFAULT NULL,
  PRIMARY KEY (`idcommande`),
  KEY `idclient` (`idclient`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`idcommande`, `idclient`, `date`, `vues`) VALUES
(1, 1, '2023-04-24', NULL),
(2, 9, '2023-05-07', NULL),
(3, 5, '2023-06-10', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ligne_commande`
--

DROP TABLE IF EXISTS `ligne_commande`;
CREATE TABLE IF NOT EXISTS `ligne_commande` (
  `idarticle` int NOT NULL,
  `idcommande` int NOT NULL,
  `quantité` int NOT NULL,
  KEY `idarticle` (`idarticle`),
  KEY `idcommande` (`idcommande`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `ligne_commande`
--

INSERT INTO `ligne_commande` (`idarticle`, `idcommande`, `quantité`) VALUES
(4, 3, 21),
(4, 3, 21),
(4, 1, 5),
(5, 1, 14),
(7, 2, 27),
(7, 2, 27);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`idclient`) REFERENCES `client` (`idclient`);

--
-- Contraintes pour la table `ligne_commande`
--
ALTER TABLE `ligne_commande`
  ADD CONSTRAINT `ligne_commande_ibfk_1` FOREIGN KEY (`idarticle`) REFERENCES `article` (`idarticle`),
  ADD CONSTRAINT `ligne_commande_ibfk_2` FOREIGN KEY (`idcommande`) REFERENCES `commande` (`idcommande`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
