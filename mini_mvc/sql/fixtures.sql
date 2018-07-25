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
