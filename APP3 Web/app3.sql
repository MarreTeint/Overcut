-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : sql312.epizy.com
-- Généré le :  sam. 26 fév. 2022 à 09:51
-- Version du serveur :  10.3.27-MariaDB
-- Version de PHP :  7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `epiz_30843661_app3`
--

-- --------------------------------------------------------

--
-- Structure de la table `comptes`
--

CREATE TABLE `comptes` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `role` int(11) NOT NULL COMMENT '1=client 2=admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comptes`
--

INSERT INTO `comptes` (`id`, `pseudo`, `mdp`, `role`) VALUES
(0, 'Pseudo Supprimé', 'supprimé', 1),
(1, 'Martin', '$2y$10$0wBH3oQKO5E67s/99OLi0.QRG72ylWiT83DCm8AyEqcu/3mNPIsuG', 2);

-- --------------------------------------------------------

--
-- Structure de la table `forum`
--

CREATE TABLE `forum` (
  `idfo` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `auteur` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `forum`
--

INSERT INTO `forum` (`idfo`, `nom`, `auteur`) VALUES
(25, 'Bienvenue', 'Martin');

-- --------------------------------------------------------

--
-- Structure de la table `postforum`
--

CREATE TABLE `postforum` (
  `idpost` int(11) NOT NULL,
  `idcompte` int(11) NOT NULL,
  `idforum` int(11) NOT NULL,
  `message` longtext NOT NULL,
  `heure` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `postforum`
--

INSERT INTO `postforum` (`idpost`, `idcompte`, `idforum`, `message`, `heure`) VALUES
(24, 1, 25, 'Bonjour et bienvenue sur mon projet web pour Polytech Paris Saclay', '2022-01-24 18:42:14');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comptes`
--
ALTER TABLE `comptes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pseudo` (`pseudo`);

--
-- Index pour la table `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`idfo`),
  ADD KEY `auteur` (`auteur`);

--
-- Index pour la table `postforum`
--
ALTER TABLE `postforum`
  ADD PRIMARY KEY (`idpost`),
  ADD KEY `fk_idcompte` (`idcompte`),
  ADD KEY `fk_idforum` (`idforum`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comptes`
--
ALTER TABLE `comptes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `forum`
--
ALTER TABLE `forum`
  MODIFY `idfo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `postforum`
--
ALTER TABLE `postforum`
  MODIFY `idpost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `forum`
--
ALTER TABLE `forum`
  ADD CONSTRAINT `forum_ibfk_1` FOREIGN KEY (`auteur`) REFERENCES `comptes` (`pseudo`);

--
-- Contraintes pour la table `postforum`
--
ALTER TABLE `postforum`
  ADD CONSTRAINT `fk_idcompte` FOREIGN KEY (`idcompte`) REFERENCES `comptes` (`id`),
  ADD CONSTRAINT `fk_idforum` FOREIGN KEY (`idforum`) REFERENCES `forum` (`idfo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
