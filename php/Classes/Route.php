<?php
/*
*
* Page de la production finale
* toute page n'ayant pas ce message sera considérée comme page de test
*
*/

class Route {
  public static $validRoutes = array();

  public static function set($route, $function) {
    self::$validRoutes[] = $route;

    if($_GET['url'] == $route) {
      /* parser l'URL */

      $function->__invoke();
    }
  }
}