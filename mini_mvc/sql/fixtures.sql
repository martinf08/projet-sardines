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
-- Password admin = admin, password staff = staff, password testeur = test
--

INSERT INTO `user` (`id_user`, `nickname`, `email`, `avatar`, `identifier`, `account_creation_date`, `last_login`, `password`, `account_status`, `balance`, `admin`, `staff`) VALUES
(1, NULL, 'testeur@test.fr', NULL, 'f60g', '2018-07-27 13:35:10', '2018-07-27 13:35:10', '098f6bcd4621d373cade4e832627b4f6', '0', 0, 0, 0),
(2, NULL, 'staff@test.fr', NULL, '6p6b', '2018-07-27 13:36:35', '2018-07-27 13:35:43', '1253208465b1efa876f982d8a9e73eef', '0', 0, 0, 1),
(3, NULL, 'admin@test.fr', NULL, '8uu9', '2018-07-27 13:36:51', '2018-07-27 13:36:51', '21232f297a57a5a743894a0e4a801fc3', '0', 0, 1, 0);
