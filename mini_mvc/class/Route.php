<?php
/* ne sera pas utilisé mais mis de côté pour l'instant */
class Route
{
    public static $validRoutes = array();

    public static function set($route, $action, $callback) {
        self::$validRoutes[] = $route;

        if ($route == $action) $callback->__invoke();
        else throw new Exception('Route non trouvée.');
    }
}