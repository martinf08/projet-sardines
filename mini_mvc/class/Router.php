<?php

class Router
{
    private $_routes = array();
    private $_ctrl;

    public function __construct() {
        $this->_ctrl = new Controller;
    }

    public function setRoute($route, $callback) {
        array_push($this->_routes, array('action'=>$route, 'callback'=>$callback));
        # on peut éventuellement demander une regexp en troisième paramètre
        # pour savoir quel genre de paramètre la route autorise à son callback
    }

    public function execute() {
        # ici, parser l'url en /action/paramètres
        # par exemple /test/2 (2 = l'id qu'on cible)
        $url = explode('/', $this->getURI());
        $action = $url[0];
        $param = isset($url[1]) && !empty($url[1]) ? $url[1] : NULL;

        foreach ($this->_routes as $route) {
            # voir si l'action existe dans _routes et appeler son callback
            if (array_search($action, $route)) {
                call_user_func(array($this->_ctrl, $route['callback']), $param);
            }
        }
    }

    private function getURI() {
        # retire le /var/www/html/
        $basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
        $uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
        # supprime les '?' de l'url
        if (strstr($uri, '?')) $uri = substr($uri, 0, strpos($uri, '?'));

        return $uri = trim($uri, '/');
    }
}