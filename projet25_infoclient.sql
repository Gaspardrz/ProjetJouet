-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : dim. 27 avr. 2025 à 18:23
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
-- Base de données : `projet25_infoclient`
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
-- Structure de la table `cartes`
--

CREATE TABLE `cartes` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  `prix` decimal(10,2) NOT NULL DEFAULT '0.00',
  `categorie` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `cartes`
--

INSERT INTO `cartes` (`id`, `titre`, `description`, `image`, `prix`, `categorie`) VALUES
(1, 'Amphinobi', 'Carte rare Amphinobi, parfaite pour les collectionneurs Pokémon.', '../../images/cartes/amphinobi.jpg', '12.99', 'Cartes'),
(2, 'Arceus', 'Carte légendaire Arceus, symbole de création dans Pokémon.', '../../images/cartes/arceus.jpg', '15.99', 'Cartes'),
(3, 'Dialga VSTAR', 'Carte puissante Dialga VSTAR, maîtrisez le temps.', '../../images/cartes/dialgavstar.jpg', '18.99', 'Cartes'),
(4, 'Florizarre', 'Carte Florizarre, Pokémon emblématique de Kanto.', '../../images/cartes/florizare.jpg', '13.99', 'Cartes'),
(5, 'Giratina', 'Giratina, maître du Monde Distorsion.', '../../images/cartes/giratina.jpg', '17.99', 'Cartes'),
(6, 'Koraidon', 'Carte exclusive Koraidon de la neuvième génération.', '../../images/cartes/koraidon.jpg', '14.99', 'Cartes'),
(7, 'Mewtwo VSTAR', 'Affrontez avec la carte ultra-puissante Mewtwo VSTAR.', '../../images/cartes/mewtowvstar.jpg', '19.99', 'Cartes'),
(8, 'Miraidon', 'Miraidon, Pokémon futuriste légendaire.', '../../images/cartes/miraidon.jpg', '14.49', 'Cartes'),
(9, 'Necrozma', 'Necrozma, le Pokémon prisme mystérieux.', '../../images/cartes/necrozma.jpg', '13.49', 'Cartes'),
(10, 'Nocatli', 'Découvrez Nocatli, carte originale de la dernière série.', '../../images/cartes/nocatli.jpg', '11.99', 'Cartes'),
(11, 'Pikachu VMAX', 'L’adorable Pikachu en version VMAX dynamaxée !', '../../images/cartes/pikachuvmax.jpg', '21.99', 'Cartes'),
(12, 'Pyroli VMAX', 'Pyroli VMAX, déchaînez les flammes !', '../../images/cartes/pyrolivmax.jpg', '16.99', 'Cartes'),
(13, 'Rayquaza', 'Rayquaza, Pokémon dragon céleste.', '../../images/cartes/rayquaza.jpg', '20.99', 'Cartes'),
(14, 'Tortank EX', 'Le retour du puissant Tortank en version EX.', '../../images/cartes/tortankex.jpg', '14.99', 'Cartes');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `MailCLien` varchar(255) DEFAULT NULL,
  `MdpClient` varchar(255) DEFAULT NULL,
  `Nom` varchar(255) NOT NULL,
  `Prénom` varchar(255) NOT NULL,
  `photoProfil` varchar(255) DEFAULT NULL,
  `banni` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Données info client';

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`MailCLien`, `MdpClient`, `Nom`, `Prénom`, `photoProfil`, `banni`) VALUES
('exemplemaile@gmail.com', '$2y$10$59kCPfx2qpujIQmjrkO2S.YIpgD3PUF.V5UiiKCrWcIFZ7atRZS5e', 'bearnd', 'MICHEL', '/projet jouer - Copie (2)/ProjetJouet/uploads/680e6746f2e6b_67b57ec4ef209.jpg', 0),
('exemplemaile@gmail.com', '$2y$10$59kCPfx2qpujIQmjrkO2S.YIpgD3PUF.V5UiiKCrWcIFZ7atRZS5e', 'bearnd', 'MICHEL', '/projet jouer - Copie (2)/ProjetJouet/uploads/680e6746f2e6b_67b57ec4ef209.jpg', 0),
('exemplemaile@gmail.com', '$2y$10$59kCPfx2qpujIQmjrkO2S.YIpgD3PUF.V5UiiKCrWcIFZ7atRZS5e', 'bearnd', 'MICHEL', '/projet jouer - Copie (2)/ProjetJouet/uploads/680e6746f2e6b_67b57ec4ef209.jpg', 0),
('eamzrh@gmail.com', '$2y$10$bN9yBAaziwyXS3XU85fKCeIeBB7LxhfTOpOikxPmdycKtzwRZfuoG', 'Priem', 'Charles', NULL, 0),
('eamzrh12O@gmail.com', '$2y$10$cCBfxFTOJyI/JfuAi.AtQuw0Cg2pZvg4i4oeHbq4LH6zJdrE5ZR.W', 'Priem', 'Charles', NULL, 0),
('13132323z@gmail.com', '$2y$10$wdtOKe9CUFdfs6PBmdZgcOAO32BMj8vdLfcJGe6thBcqWe8v4J18m', 'Priem', 'Charles', NULL, 0),
('13132323z@gmail.com', '$2y$10$tpiTaV6DM2fR7dU24lebwutFizUUJQyMsU0ojE/je36wvkWq0ynhy', 'Priem', 'Charles', NULL, 0),
('13132323z@gmail.com', '$2y$10$TXddT2zYDTaNV3AakwCVoOL0SY/ItKgZi8i9EQ9mMOGJmsuTy3bP2', 'Priem', 'Charles', NULL, 0),
('13132323z@gmail.com', '$2y$10$JNG.0a39PRAbsLdjYciMQ.cAynjNT56Bc2fjS1Dy1vwp.LD2IIAhG', 'Priem', 'Charles', NULL, 0),
('13132323z@gmail.com', '$2y$10$3EG9Lj1f7eZZIuvldL2/.uzE8z0M3Y7wzuplnWeX4K.MkRGuWOA9W', 'Priem', 'Charles', NULL, 0),
('adaDAEEZEzada@gmail.com', '$2y$10$XlDbkP0EgZsvOZBIwcqL8.skEfhcrO6pU5eUksTCz1XgIMI0FOYsW', 'Priem', 'Charles', NULL, 1),
('ADADZ1E@gmail.com', '$2y$10$J8kGTg041cNDVCyq1zQ5ZeDPgxGcro1KVQkjNk1oZeEHxdXG6jteq', 'Priem', 'Charles', NULL, 0),
('eamzrhdadO@gmail.com', '$2y$10$1m294nM7PxfO8IB3014EsuZkAclOHivy9wbj1/6Sws9APXYP41T/i', 'Pfe', 'Charles', NULL, 0),
('adaDAEEZEzada@gmail.com', '$2y$10$XxT6D0Ix3bSNELJtLZAhPuEhCmOgZ3O.9cSFvOWUc2im350uzQnRu', 'Priem', 'Charles', NULL, 1),
('adaDAEEZEzada-163@gmail.com', '$2y$10$dNl7TsojeJQth/UeN.DiH..9.nyRApq6uvJK5mHvLa2Srao56UNMm', 'Priem', 'Charles', NULL, 0),
('zfzf1323-1AA@gmail.com', '$2y$10$mm3QpamlGaM/qCRov8x4Mu7zdy35aTJJFiuP7DIeC44VFRlLfJ9JK', 'fzf', 'zff', NULL, 1),
('eamzrr13AZZE1---1h@gmail.com', '$2y$10$seo5GPM0w8nFvftzkaV/1OqAWSAukkfWXB5cK1iL3e525RthyZ7Rq', 'fzf', 'fzfz', NULL, 0),
('eamzrr13AZZE1---1h@gmail.com', '$2y$10$o254cyzAWEzuubyowGvh3elYp.cgBVcy6fA9r6Uq1jSv.ed2DmjY.', 'fzf', 'fzfz', NULL, 0),
('eamzrr13AZZE1---1h@gmail.com', '$2y$10$sb/49BH5vNpMFRlZzXHsjOcjh8b.1CDeBY8Y9AudOghoaX2CzFfM6', 'fzf', 'fzfz', NULL, 0),
('eamzrr13AZZE1---11h@gmail.com', '$2y$10$wc4Wj4.PCcpQxtI3RSeLceSbw2CmDEiXh2ucvcdK81fJRwbLCvHj2', 'ddzf', 'zff', NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `figurines`
--

CREATE TABLE `figurines` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text,
  `prix` decimal(10,2) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `figurines`
--

INSERT INTO `figurines` (`id`, `nom`, `description`, `prix`, `image_path`) VALUES
(1, 'Alien', 'Figurine de la créature mythique du film Alien.', '29.99', '../../images/figurine/alien.jpg'),
(2, 'For Honor', 'Figurine de guerrier inspirée du jeu For Honor.', '34.99', '../../images/figurine/forhonor.jpg'),
(3, 'Goku Enfant', 'Figurine de Goku petit dans Dragon Ball.', '24.99', '../../images/figurine/goku-enfant.jpg'),
(4, 'Gundam', 'Robot emblématique Gundam pour les fans de mecha.', '49.99', '../../images/figurine/gundam.jpg'),
(5, 'Jinx', 'Figurine de Jinx du jeu League of Legends.', '39.99', '../../images/figurine/jinx.jpg'),
(6, 'Luffy', 'Figurine de Monkey D. Luffy de One Piece.', '27.99', '../../images/figurine/luffy.jpg'),
(7, 'Metal Sonic', 'Figurine du rival de Sonic, Metal Sonic.', '22.99', '../../images/figurine/metalsonic.jpg'),
(8, 'Nier Automata', 'Figurine de 2B du jeu Nier: Automata.', '44.99', '../../images/figurine/nierautomata.jpg'),
(9, 'Sanji', 'Figurine du cuisinier Sanji de One Piece.', '26.99', '../../images/figurine/sanji.jpg'),
(10, 'Zoro', 'Figurine du sabreur Zoro de One Piece.', '28.99', '../../images/figurine/zoro.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `jeuxvideos`
--

CREATE TABLE `jeuxvideos` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text,
  `prix` decimal(10,2) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `jeuxvideos`
--

INSERT INTO `jeuxvideos` (`id`, `nom`, `description`, `prix`, `image_path`) VALUES
(1, 'Dragon Ball', 'Jeu vidéo inspiré de l\'univers Dragon Ball.', '59.99', '../../images/jeuxvideos/Dragon-Ball.jpg'),
(2, 'FC25', 'Nouvelle édition du jeu de football FC25.', '69.99', '../../images/jeuxvideos/FC25.jpg'),
(3, 'Harry Potter', 'Jeu d\'aventure magique dans l\'univers Harry Potter.', '54.99', '../../images/jeuxvideos/harry potter.jpg'),
(4, 'Ladybug', 'Jeu basé sur les aventures de Miraculous Ladybug.', '39.99', '../../images/jeuxvideos/ladybug.jpg'),
(5, 'LEGO Star Wars', 'Jeu épique LEGO dans l\'univers Star Wars.', '49.99', '../../images/jeuxvideos/LEGO-Star-Wars.jpg'),
(6, 'NBA 2K25', 'Dernière édition du célèbre jeu de basket NBA 2K.', '69.99', '../../images/jeuxvideos/NBA-2K25.jpg'),
(7, 'Park Beyond', 'Construisez votre propre parc d\'attractions.', '44.99', '../../images/jeuxvideos/Park-Beyond.jpg'),
(8, 'Ratchet & Clank', 'Aventures intergalactiques avec Ratchet et Clank.', '59.99', '../../images/jeuxvideos/ratchete.jpg'),
(9, 'Sonic', 'Rejoignez Sonic dans de nouvelles aventures ultra-rapides.', '49.99', '../../images/jeuxvideos/sonic.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `minivoitures`
--

CREATE TABLE `minivoitures` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text,
  `prix` decimal(10,2) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `minivoitures`
--

INSERT INTO `minivoitures` (`id`, `nom`, `description`, `prix`, `image_path`) VALUES
(1, 'Pack Bburago', 'Collection de mini voitures de la marque Bburago.', '29.99', '../../images/mini voiture/bburago pack.jpg'),
(2, 'Bburago', 'Miniature de voiture réaliste par Bburago.', '14.99', '../../images/mini voiture/bburago.jpg'),
(3, 'Voiture Bleue', 'Petite voiture de course couleur bleue.', '9.99', '../../images/mini voiture/bleu.jpg'),
(4, 'Cars', 'Modèle issu du célèbre film Cars.', '12.99', '../../images/mini voiture/cars.jpg'),
(5, 'Doc Hudson', 'La légende de Radiator Springs.', '11.99', '../../images/mini voiture/dochudson.jpg'),
(6, 'Ferrari', 'Miniature officielle Ferrari ultra détaillée.', '24.99', '../../images/mini voiture/ferrari.jpg'),
(7, 'Ford GT', 'Réplique miniature de la Ford GT.', '22.99', '../../images/mini voiture/fordGT.jpg'),
(8, 'Hot Wheels', 'Voiture de collection Hot Wheels.', '7.99', '../../images/mini voiture/hotwheels.jpg'),
(9, 'Majorette', 'Mini voiture de la célèbre marque Majorette.', '8.99', '../../images/mini voiture/majorette.jpg'),
(10, 'Voiture Rallye', 'Miniature d\'une voiture de rallye tout-terrain.', '13.99', '../../images/mini voiture/voiturerally.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `nerf`
--

CREATE TABLE `nerf` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text,
  `prix` decimal(10,2) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `nerf`
--

INSERT INTO `nerf` (`id`, `nom`, `description`, `prix`, `image_path`) VALUES
(1, 'Pack 24 Fléchettes', 'Recharge de 24 fléchettes Nerf officielles.', '7.99', '../../images/nerf/24flechettes.jpg'),
(2, 'Nerf Bleu 3', 'Blaster Nerf compact de couleur bleue.', '14.99', '../../images/nerf/bleu3.jpg'),
(3, 'Double Punch', 'Blaster double coup pour plus d\'impact.', '29.99', '../../images/nerf/doublepunch.jpg'),
(4, 'Easy Play', 'Nerf facile d\'utilisation pour les débutants.', '19.99', '../../images/nerf/easyplay.jpg'),
(5, 'Nerf Pro', 'Version professionnelle haute précision.', '49.99', '../../images/nerf/nerfpro.jpg'),
(6, 'Raptorstrike', 'Blaster de sniper Nerf ultra précis.', '39.99', '../../images/nerf/raptorstrike.jpg'),
(7, 'Red Team', 'Blaster de l\'équipe rouge pour les batailles.', '24.99', '../../images/nerf/redteam.jpg'),
(8, 'Rival Blanc', 'Nerf Rival édition blanche.', '34.99', '../../images/nerf/rivalblanc.jpg'),
(9, 'Rival Bleu', 'Nerf Rival édition bleue.', '34.99', '../../images/nerf/rivalbleu.jpg'),
(10, 'Strike', 'Blaster classique Strike.', '21.99', '../../images/nerf/strike.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `id` int(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `produit_id` int(255) NOT NULL,
  `categorie` varchar(255) NOT NULL,
  `quantite` int(255) NOT NULL DEFAULT '1'
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
-- Index pour la table `cartes`
--
ALTER TABLE `cartes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `figurines`
--
ALTER TABLE `figurines`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `jeuxvideos`
--
ALTER TABLE `jeuxvideos`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `minivoitures`
--
ALTER TABLE `minivoitures`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `nerf`
--
ALTER TABLE `nerf`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `cartes`
--
ALTER TABLE `cartes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `figurines`
--
ALTER TABLE `figurines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `jeuxvideos`
--
ALTER TABLE `jeuxvideos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `minivoitures`
--
ALTER TABLE `minivoitures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `nerf`
--
ALTER TABLE `nerf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
