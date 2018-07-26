<?php

function getValueAjax($db, $type, $quality)
{
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

function getUserId($db, $id)
{
    if (isset($id) && !empty($id)) {
        $id = htmlspecialchars($id);
        $sql = $db->prepare('SELECT email FROM `user` WHERE identifier = :id');
        $sql->bindParam(':id', $id);
        $sql->execute();
       $reponse = $sql->fetch()['email'];
        if ($reponse != NULL) {
            return '<p>Email :'. $reponse .'</p>';
        }
        return '<p>Cet utilisateur n\'existe pas</p>';
    }
}

function debug($var) {
	$debug = debug_backtrace();
	echo '<p>&nbsp;</p><p><a href="#" onclick="$(this).parent().next(\'ol\').slideToggle(); return false;"><strong>' . $debug[0]['file'] . ' </strong> l.' . $debug[0]['line'] . '</a></p>';
	echo '<ol style="display:none;">';
	foreach ($debug as $k => $v) {
		if ($k > 0) {
			echo '<li><strong>' . $v['file'] . '</strong> l.' . $v['line'] . '</li>';
		}
	}
	echo '</ol>';
	echo '<pre>';
	print_r($var);
	echo '<pre>';		
}