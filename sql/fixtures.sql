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
-- Password = test
--


INSERT INTO `user`(`nickname`, `email`, `avatar`, `identifier`, `account_creation_date`, `last_login`, `password`, `account_status`, `balance`, `admin`, `staff`) VALUES ('xxx-Dark-Sasuke-xxx','darksasuke@troll.fr',null,'ea69',NOW(),NOW(),'098f6bcd4621d373cade4e832627b4f6',1,0,0,0);
INSERT INTO `user`(`nickname`, `email`, `avatar`, `identifier`, `account_creation_date`, `last_login`, `password`, `account_status`, `balance`, `admin`, `staff`) VALUES ('Jean-Marie','jeanmarie02@troll.com',null,'3t6x',NOW(),NOW(),'098f6bcd4621d373cade4e832627b4f6',1,0,0,1);
INSERT INTO `user`(`nickname`, `email`, `avatar`, `identifier`, `account_creation_date`, `last_login`, `password`, `account_status`, `balance`, `admin`, `staff`) VALUES ('wenceslas','wenceslas18@troll.net',null,'b55l',NOW(),NOW(),'098f6bcd4621d373cade4e832627b4f6',1,0,0,0);
INSERT INTO `user`(`nickname`, `email`, `avatar`, `identifier`, `account_creation_date`, `last_login`, `password`, `account_status`, `balance`, `admin`, `staff`) VALUES ('bienni','bienni@troll.net',null,'bb08',NOW(),NOW(),'098f6bcd4621d373cade4e832627b4f6',1,0,1,1);