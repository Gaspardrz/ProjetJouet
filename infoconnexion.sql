-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 25 avr. 2025 à 13:37
-- Version du serveur : 5.7.24
-- Version de PHP : 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `infoconnexion`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `MailCLien` varchar(255) DEFAULT NULL,
  `MdpClient` varchar(255) DEFAULT NULL,
  `Nom` varchar(255) NOT NULL,
  `Prénom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Données info client';

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`MailCLien`, `MdpClient`, `Nom`, `Prénom`) VALUES
('exemplemail@gmail.com', '$2y$10$59kCPfx2qpujIQmjrkO2S.YIpgD3PUF.V5UiiKCrWcIFZ7atRZS5e', 'Dupont', 'Jean'),
('exemplemail@gmail.com', '$2y$10$59kCPfx2qpujIQmjrkO2S.YIpgD3PUF.V5UiiKCrWcIFZ7atRZS5e', 'Dupont', 'Jean'),
('exemplemail@gmail.com', '$2y$10$59kCPfx2qpujIQmjrkO2S.YIpgD3PUF.V5UiiKCrWcIFZ7atRZS5e', 'Dupont', 'Jean');

-- --------------------------------------------------------

--
-- Structure de la table `créationcompte`
--

CREATE TABLE `créationcompte` (
  `Mail` varchar(255) NOT NULL,
  `MDP` varchar(255) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Prénom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
