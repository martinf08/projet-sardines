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
  (1, 1, 2),
  (1, 2, 1),
  (1, 3, 1),
  (1, 4, 1),
  (2, 1, 5),
  (2, 2, 2),
  (2, 3, 2),
  (2, 4, 2),
  (3, 1, 10),
  (3, 2, 5),
  (3, 3, 5),
  (3, 4, 5);

--
-- Fake users
-- Passwords = test@test.fr -> testtest ; staff@staff.fr -> staffstaff ; admin@admin.fr -> adminadmin
--

INSERT INTO `user` (`id_user`, `nickname`, `email`, `avatar`, `identifier`, `account_creation_date`, `last_login`, `password`, `account_status`, `balance`, `admin`, `staff`) VALUES
(1, 'Testeur', 'test@test.fr', NULL, 'v5d6', '2018-07-31 14:42:21', '2018-07-31 14:42:09', '05a671c66aefea124cc08b76ea6d30bb', '0', 0, 0, 0),
(2, 'im-a-staffmaaaan', 'staff@staff.fr', NULL, 't03s', '2018-07-31 14:43:10', '2018-07-31 14:42:37', '65b240be59a308af3e840efb5bea320b', '0', 0, 0, 1),
(3, 'Adm1nistrat0R', 'admin@admin.fr', NULL, 'sr33', '2018-07-31 14:43:55', '2018-07-31 14:43:34', 'f6fdffe48c908deb0f4c3bd36c032e72', '0', 0, 1, 1);