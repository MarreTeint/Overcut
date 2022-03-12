-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 12, 2022 at 03:08 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app3`
--

-- --------------------------------------------------------

--
-- Table structure for table `comptes`
--

CREATE TABLE `comptes` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `role` int(11) NOT NULL COMMENT '1=client 2=admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comptes`
--

INSERT INTO `comptes` (`id`, `pseudo`, `mdp`, `role`) VALUES
(0, 'Pseudo Supprimé', 'supprimé', 1),
(1, 'Martin', '$2y$10$0wBH3oQKO5E67s/99OLi0.QRG72ylWiT83DCm8AyEqcu/3mNPIsuG', 2);

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

CREATE TABLE `forum` (
  `idfo` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `auteur` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `forum`
--

INSERT INTO `forum` (`idfo`, `nom`, `auteur`) VALUES
(25, 'Bienvenue', 'Martin'),
(26, 'test', 'Martin');

-- --------------------------------------------------------

--
-- Table structure for table `postforum`
--

CREATE TABLE `postforum` (
  `idpost` int(11) NOT NULL,
  `idcompte` int(11) NOT NULL,
  `idforum` int(11) NOT NULL,
  `message` longtext NOT NULL,
  `heure` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `postforum`
--

INSERT INTO `postforum` (`idpost`, `idcompte`, `idforum`, `message`, `heure`) VALUES
(24, 1, 25, 'Bonjour et bienvenue sur mon projet web pour Polytech Paris Saclay', '2022-01-24 18:42:14'),
(25, 1, 26, 'test', '2022-02-26 15:54:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comptes`
--
ALTER TABLE `comptes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pseudo` (`pseudo`);

--
-- Indexes for table `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`idfo`),
  ADD KEY `auteur` (`auteur`);

--
-- Indexes for table `postforum`
--
ALTER TABLE `postforum`
  ADD PRIMARY KEY (`idpost`),
  ADD KEY `fk_idcompte` (`idcompte`),
  ADD KEY `fk_idforum` (`idforum`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comptes`
--
ALTER TABLE `comptes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `forum`
--
ALTER TABLE `forum`
  MODIFY `idfo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `postforum`
--
ALTER TABLE `postforum`
  MODIFY `idpost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `forum`
--
ALTER TABLE `forum`
  ADD CONSTRAINT `forum_ibfk_1` FOREIGN KEY (`auteur`) REFERENCES `comptes` (`pseudo`);

--
-- Constraints for table `postforum`
--
ALTER TABLE `postforum`
  ADD CONSTRAINT `fk_idcompte` FOREIGN KEY (`idcompte`) REFERENCES `comptes` (`id`),
  ADD CONSTRAINT `fk_idforum` FOREIGN KEY (`idforum`) REFERENCES `forum` (`idfo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
