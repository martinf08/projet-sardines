<?php
/**
 * Dans ce fichier on va récuperer la value de l'asset 
 * en fonction de sa qté et don son type
 */

require_once '../class/Config.php';
require_once '../model/Model.php';
require_once '../model/AssetManager.php';
require_once '../functions/functions.php';
require_once '../class/User.php';

session_start(); # nécessaire pour accéder au user
 
 /**connection à la base de donnée
  * injection de des pamars de la fonction
 */

if (isset($_SESSION['user'])) {
    if ($_SESSION['user']->getStaff()) {
        $db = new AssetManager();
        echo(getValueAjax($db->dbConnect(),$_POST['type'], $_POST['quality']));
    } else {
        echo 'erreur d\'identification';
    }
} else {
    echo 'Connectez-vous !';
}
    