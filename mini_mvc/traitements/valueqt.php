<?php
/**
 * Dans ce fichier on va récuperer la value de l'asset 
 * en fonction de sa qté et don son type
 */
    require_once './model/model.php';
    require_once './function/functions.php';

 
 /**connection à la base de donnée
  * injection de des pamars de la fonction
 */
   
    $db = new dbConnect();
    echo(getValueAjax( $db,$type, $quality));

?>