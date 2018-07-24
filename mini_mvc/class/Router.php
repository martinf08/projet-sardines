<?php

class Router
{
    protected $_routes = array();
    #protected $_action;
    #protected $_param;

    /*
    public function __construct($url = null) {
        $basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
        $url = substr($_SERVER['REQUEST_URI'], strlen($basepath));
        if (strstr($url, '?')) $url = substr($url, 0, strpos($url, '?'));
        $url = trim($url, '/');

        $url = explode('/', getURI());
        $this->_action = $url[0];
        $this->_param = isset($url[1]) && !empty($url[1]) ? $url[1] : NULL;
    }
    */

    public function setRoute($route, $callback) {
        array_push($this->_routes, array('action'=>$route, 'callback'=>$callback));
    }

    /* pour tester */
    public function getRoutes() {
        #return $this->_routes;
        return array_search('ajout', $this->_routes); # j'ai arrêté là, ça affiche rien, sûrement parce que c'est un tableau à deux niveaux
    }

    public function execute() {
        # ici, parser l'url en /action/paramètres
        # par exemple /test/2 (2 = l'id qu'on cible)
        $url = explode('/', getURI());
        $action = $url[0];
        $param = isset($url[1]) && !empty($url[1]) ? $url[1] : NULL;

        if (in_array($action, $this->_routes)) {
            echo 'route trouvée, on lance le callback avec ses params s\'il y en a';
            # ici trouver dans _routes le bon callback
        } else {
            echo 'route non trouvée, on lance la page 404';
        }
    }

    private function getURI() {
        $basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
        $uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
        if (strstr($uri, '?')) $uri = substr($uri, 0, strpos($uri, '?'));
        return $uri = trim($uri, '/');
    }
}