#--------------------------------------------------------------------------------------------
# Script pour initialiser les valeurs prérequises (les asset types, les quality level etc.)
#--------------------------------------------------------------------------------------------

# Les types
INSERT INTO type (name)
VALUES ('tent');
INSERT INTO type (name)
VALUES ('sleeping bag');
INSERT INTO type (name)
VALUES ('chair');
INSERT INTO type (name)
VALUES ('mattress');

# Les qualités
INSERT INTO quality (level, label)
VALUES (0, 'mauvais');
INSERT INTO quality (level, label)
VALUES (1, 'bon');
INSERT INTO quality (level, label)
VALUES (2, 'excellent');

# Les valeurs
# mauvais
INSERT INTO price_catalog (id_quality, id_type, value)
VALUES (1, 1, 5);
INSERT INTO price_catalog (id_quality, id_type, value)
VALUES (1, 2, 5);
INSERT INTO price_catalog (id_quality, id_type, value)
VALUES (1, 3, 5);
INSERT INTO price_catalog (id_quality, id_type, value)
VALUES (1, 4, 5);
# bon
INSERT INTO price_catalog (id_quality, id_type, value)
VALUES (2, 1, 5);
INSERT INTO price_catalog (id_quality, id_type, value)
VALUES (2, 2, 5);
INSERT INTO price_catalog (id_quality, id_type, value)
VALUES (2, 3, 5);
INSERT INTO price_catalog (id_quality, id_type, value)
VALUES (2, 4, 5);
#excellent
INSERT INTO price_catalog (id_quality, id_type, value)
VALUES (3, 1, 5);
INSERT INTO price_catalog (id_quality, id_type, value)
VALUES (3, 2, 5);
INSERT INTO price_catalog (id_quality, id_type, value)
VALUES (3, 3, 5);
INSERT INTO price_catalog (id_quality, id_type, value)
VALUES (3, 4, 5);