INSERT INTO `asset`(`value`,`description`, `entry_date`, `removal_date`, `tag`, `id_user`, `id_type`, `id_quality`, `id_staff`)
SELECT price_catalog.value as result, null,NOW(),null,'123456',2,1,3,1247
FROM price_catalog
INNER JOIN quality
ON price_catalog.id_quality = quality.id_quality
INNER JOIN type
ON price_catalog.id_type = type.id_type
WHERE type.id_type = 1 AND quality.id_qualty = 3