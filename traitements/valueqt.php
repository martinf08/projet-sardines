<?php
/**
 * Dans ce fichier on va récuperer la value de l'asset 
 * en fonction de sa qté et don son type
 */

require_once '../class/Config.php';
require_once '../model/Model.php';
require_once '../model/AssetManager.php';
require_once '../functions/functions.php';
 
 /**connection à la base de donnée
  * injection de des pamars de la fonction
 */
   
    $db = new AssetManager();
    echo(getValueAjax($db->dbConnect(),$_POST['type'], $_POST['quality']));

?>