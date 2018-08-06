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
require_once '../model/UserManager.php';
require_once '../functions/functions.php';
require_once '../class/User.php';

session_start(); # nécessaire pour accéder au user

/**connection à la base de donnée
 * injection de des pamars de la fonction
 */

if (isset($_SESSION['user'])) {
    if ($_SESSION['user']->getStaff()) {
        $db = new UserManager();
        echo(getUserId($db->dbConnect(), $_POST['userid']));
    } else {
        echo 'erreur d\'identification';
    }
} else {
    echo 'Connectez-vous !';
}
