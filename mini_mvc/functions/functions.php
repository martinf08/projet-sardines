<?php 

function getValueAjax($db,$type, $quality) {
      $sql = $db->prepare('SELECT price_catalog.value 
                                  FROM price_catalog 
                                  INNER JOIN quality ON price_catalog.id_quality = quality.id_quality 
                                  INNER JOIN type on price_catalog.id_type = type.id_type 
                                  WHERE quality.id_quality = :id_quality AND type.id_type = :id_type ');
      $sql->bindParam(':id_quality', $quality);
      $sql->bindParam(':id_type', $type);
      $sql->execute();

      return $sql->fetch()['value'];
    }
