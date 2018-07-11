<?php
/*
*
* Page de la production finale
* toute page n'ayant pas ce message sera considérée comme page de test
*
*/

class Controller {
  /* cherche et affiche la vue
  * devrait être hérité par AssetController et UserController
  */
  public static function renderView($viewName) {
    require_once "./php/views/$viewName.php";
  }

  /*  
  public static function loadModel() {
    require_once "./php/Models/Model.php";
    return $model= new Model;
    $model->test();
  }*/
}