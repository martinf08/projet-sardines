SELECT type.id_type, quality.id_quality, price_catalog.value as result
FROM price_catalog
INNER JOIN quality
ON price_catalog.id_quality = quality.id_quality
INNER JOIN type
ON price_catalog.id_type = type.id_type
WHERE type.id_type = 2 AND quality.id_quality = 2