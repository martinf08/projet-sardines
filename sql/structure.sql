-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  mer. 18 juil. 2018 à 15:03
-- Version du serveur :  10.1.34-MariaDB
-- Version de PHP :  7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `sardines`
--

-- --------------------------------------------------------

--
-- Structure de la table `asset`
--

CREATE TABLE `asset` (
  `id_asset` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `description` text,
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `removal_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tag` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'identifiant alphanumérique',
  `id_user` int(11) DEFAULT NULL,
  `id_type` int(11) NOT NULL,
  `id_quality` int(11) NOT NULL,
  `id_staff` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Structure de la table `price_catalog`
--

CREATE TABLE `price_catalog` (
  `id_quality` int(11) NOT NULL,
  `id_type` int(11) NOT NULL,
  `value` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Structure de la table `quality`
--

CREATE TABLE `quality` (
  `id_quality` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `label` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Structure de la table `type`
--

CREATE TABLE `type` (
  `id_type` int(11) NOT NULL,
  `name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nickname` varchar(45) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `avatar` varchar(100) DEFAULT NULL,
  `identifier` varchar(4) NOT NULL,
  `account_creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `password` varchar(32) NOT NULL,
  `account_status` varchar(32) DEFAULT 0 NOT NULL,
  `balance` int(11) NOT NULL DEFAULT 0,
  `admin` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'user est admin ou non',
  `staff` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



--
-- Table structure for table `recovery_password`
--

CREATE TABLE `recovery_password`
(
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `code` varchar(100) NOT NULL,
  `confirm` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Indexes for table `recovery_password`
--

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `asset`
--
ALTER TABLE `asset`
  ADD PRIMARY KEY (`id_asset`),
  ADD KEY `asset_user_FK` (`id_user`),
  ADD KEY `asset_type0_FK` (`id_type`),
  ADD KEY `asset_quality1_FK` (`id_quality`);

--
-- Index pour la table `price_catalog`
--
ALTER TABLE `price_catalog`
  ADD PRIMARY KEY (`id_quality`,`id_type`),
  ADD KEY `price_catalog_type0_FK` (`id_type`);

--
-- Index pour la table `quality`
--
ALTER TABLE `quality`
  ADD PRIMARY KEY (`id_quality`);

--
-- Index pour la table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id_type`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Index pour la table `recovery_password`
--
ALTER TABLE `recovery_password`
ADD PRIMARY KEY(`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--
--
-- AUTO_INCREMENT pour la table `asset`
--
ALTER TABLE `recovery_password`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `asset`
--
ALTER TABLE `asset`
  MODIFY `id_asset` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `quality`
--
ALTER TABLE `quality`
  MODIFY `id_quality` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `type`
--
ALTER TABLE `type`
  MODIFY `id_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `asset`
--
ALTER TABLE `asset`
  ADD CONSTRAINT `asset_quality1_FK` FOREIGN KEY (`id_quality`) REFERENCES `quality` (`id_quality`),
  ADD CONSTRAINT `asset_type0_FK` FOREIGN KEY (`id_type`) REFERENCES `type` (`id_type`),
  ADD CONSTRAINT `asset_user_FK` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Contraintes pour la table `price_catalog`
--
ALTER TABLE `price_catalog`
  ADD CONSTRAINT `price_catalog_quality_FK` FOREIGN KEY (`id_quality`) REFERENCES `quality` (`id_quality`),
  ADD CONSTRAINT `price_catalog_type0_FK` FOREIGN KEY (`id_type`) REFERENCES `type` (`id_type`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
