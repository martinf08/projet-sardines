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
            return '<p>Email : '. $reponse .'</p>';
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


function getMenu(){
       $html = '<div id="menu">';
        $html .='<div id="close"><!-- fermeture du menu -->';
        $html .='<div class="cross"></div>';
        $html .="</div>";
        $html .='<div id="display-user">';
        $html .='<?php if(isset($_SESSION["user"]) AND !empty($_SESSION["user"])): ?>';
        $html .='<p id="pseudo" class="bold"><?php echo $_SESSION["user"]->getNickname(); ?></p>';
        $html .='<p id="mail"><?php echo $_SESSION["user"]->getEmail(); ?></p>';
        $html .='<p id="user-id" class="bold">ID : <?php echo strtoupper($_SESSION["user"]->getIdentifier()); ?></p>';
        $html .="<p id='sardines-balance'>J'ai <span class='bold'>";
        $html .='<?php echo $_SESSION["user"]->getBalance(); ?>';
        $html .="</span> sardines</p>";
        $html .="<?php endif; ?>";
        $html .="</div>";
        $html .="<?php include_once 'inc/_menu.php';?>";
        $html .='<div id="triangle-bottomlef"></div>';
        $html .='<div id="triangle-bottomright"></div>';
        $html .="</div>";
        return $html;
}
function getBermenu(){
        $html ='<div id="open"> <!-- le burger pour ouvrir le menu -->';
        $html .='<div class="bar"></div>';
        $html .='<div class="bar"></div>';
        $html .='<div class="bar"></div>';
        $html .="</div>";
        return $html;
}