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

--
-- Déchargement des données de la table `asset`
--

INSERT INTO `asset` (`id_asset`, `value`, `description`, `entry_date`, `removal_date`, `tag`, `id_user`, `id_type`, `id_quality`, `id_staff`) VALUES
(6, 5, NULL, '2018-07-17 12:17:53', '2018-07-17 12:17:53', 123456, 2, 1, 3, 1247),
(7, 5, NULL, '2018-07-17 12:20:22', '2018-07-17 12:20:22', 123456, 2, 1, 3, 1247),
(8, 5, NULL, '2018-07-17 12:26:20', '2018-07-17 12:26:20', 123456, 2, 1, 3, 1247),
(9, 0, NULL, '2018-07-17 14:45:47', '0000-00-00 00:00:00', 001234, 2, 1, 1, 3),
(10, 0, NULL, '2018-07-18 12:23:36', '0000-00-00 00:00:00', 644447, 2, 1, 1, 3),
(11, 5, NULL, '2018-07-18 12:41:50', '0000-00-00 00:00:00', 711154, 2, 1, 1, 3),
(12, 5, NULL, '2018-07-18 12:59:33', '0000-00-00 00:00:00', 922321, 2, 1, 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `price_catalog`
--

CREATE TABLE `price_catalog` (
  `id_quality` int(11) NOT NULL,
  `id_type` int(11) NOT NULL,
  `value` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `price_catalog`
--

INSERT INTO `price_catalog` (`id_quality`, `id_type`, `value`) VALUES
(1, 1, 5),
(1, 2, 5),
(1, 3, 5),
(1, 4, 5),
(2, 1, 5),
(2, 2, 5),
(2, 3, 5),
(2, 4, 5),
(3, 1, 5),
(3, 2, 5),
(3, 3, 5),
(3, 4, 5);

-- --------------------------------------------------------

--
-- Structure de la table `quality`
--

CREATE TABLE `quality` (
  `id_quality` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `label` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `quality`
--

INSERT INTO `quality` (`id_quality`, `level`, `label`) VALUES
(1, 0, 'mauvais'),
(2, 1, 'bon'),
(3, 2, 'excellent');

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

CREATE TABLE `type` (
  `id_type` int(11) NOT NULL,
  `name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `type`
--

INSERT INTO `type` (`id_type`, `name`) VALUES
(1, 'tent'),
(2, 'sleeping bag'),
(3, 'chair'),
(4, 'mattress');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nickname` varchar(45) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `avatar` varchar(100) DEFAULT NULL,
  `identifier` varchar(4) NOT NULL,
  `account_creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_login` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `password` varchar(32) NOT NULL,
  `account_status` varchar(1) NOT NULL,
  `balance` int(11) NOT NULL,
  `admin` tinyint(1) NOT NULL COMMENT 'user est admin ou non',
  `staff` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `nickname`, `email`, `avatar`, `identifier`, `account_creation_date`, `last_login`, `password`, `account_status`, `balance`, `admin`, `staff`) VALUES
(2, 'xxx-Dark-Sasuke-xxx', 'darksasuke@troll.fr', NULL, '1234', '2018-07-16 13:28:55', '2018-07-16 13:28:55', '098f6bcd4621d373cade4e832627b4f6', '1', 10, 0, 0),
(3, 'Jean-Marie', 'jeanmarie02@troll.com', NULL, '1235', '2018-07-16 13:34:10', '2018-07-16 13:34:10', 'ad0234829205b9033196ba818f7a872b', '1', 0, 0, 1),
(4, 'wenceslas', 'wenceslas18@troll.net', NULL, '1236', '2018-07-16 13:38:04', '2018-07-16 13:38:04', '8ad8757baa8564dc136c1e07507f4a98', '1', 50, 0, 0),
(5, 'bienni', 'bienni@troll.net', NULL, '1247', '2018-07-16 14:03:37', '2018-07-16 13:41:05', '05a671c66aefea124cc08b76ea6d30bb', '1', 200, 1, 0);

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
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

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
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
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
  ADD CONSTRAINT `asset_user_FK` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

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
