--
-- Déchargement des données de la table `type`
--

INSERT INTO `type` (`id_type`, `name`) VALUES
  (1, 'tente'),
  (2, 'sac de couchage'),
  (3, 'chaise'),
  (4, 'matelas');

--
-- Déchargement des données de la table `quality`
--

INSERT INTO `quality` (`id_quality`, `level`, `label`) VALUES
  (1, 0, 'mauvaise'),
  (2, 1, 'bonne'),
  (3, 2, 'excellente');

--
-- Déchargement des données de la table `price_catalog`
--

INSERT INTO `price_catalog` (`id_quality`, `id_type`, `value`) VALUES
  (1, 1, 5),
  (1, 2, 2),
  (1, 3, 2),
  (1, 4, 4),
  (2, 1, 10),
  (2, 2, 5),
  (2, 3, 4),
  (2, 4, 6),
  (3, 1, 20),
  (3, 2, 10),
  (3, 3, 8),
  (3, 4, 12);

--
-- Fake users
-- Passwords = test@test.fr -> testtest ; staff@staff.fr -> staffstaff ; admin@admin.fr -> adminadmin
--

INSERT INTO `user` (`id_user`, `nickname`, `email`, `avatar`, `identifier`, `account_creation_date`, `last_login`, `password`, `terms`, `account_status`, `balance`, `admin`, `staff`) VALUES
(1, 'Testeur', 'test@test.fr', NULL, 'v5d6', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '05a671c66aefea124cc08b76ea6d30bb', '1','1', 0, 0, 0),
(2, 'im-a-staffmaaaan', 'staff@staff.fr', NULL, 't03s', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '65b240be59a308af3e840efb5bea320b', '1', '1', 0, 0, 1),
(3, 'Adm1nistrat0R', 'admin@admin.fr', NULL, 'sr33', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, 'f6fdffe48c908deb0f4c3bd36c032e72', '1', '1', 0, 1, 1);

--
-- Ghost user (compte équivalant à un ajout sans bénéficiaire)
--
INSERT INTO `user` (`nickname`, `email`, `identifier`, `account_creation_date`, `last_login`, `password`, `terms`, `account_status`, `balance`, `admin`, `staff`) 
VALUES ('ghost', 'cabaretvert@hackardennes.fr', '0000', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '09d50722cde279a0c3f48a3849ee1b1f', '1', '1', 0, 0, 0);