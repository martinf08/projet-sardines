<?php
/**
 * Created by PhpStorm.
 * User: martin
 * Date: 19/07/18
 * Time: 16:15
 */

/**Recuperation de l'id utilisateur et renvois de l'erreur ou email*/

require_once '../class/Config.php';
require_once '../model/Model.php';
require_once '../model/AssetManager.php';
require_once '../functions/functions.php';

/**connection à la base de donnée
 * injection de des pamars de la fonction
 */

$db = new AssetManager();
echo(getUserId($db->dbConnect(), $_POST['userid']));