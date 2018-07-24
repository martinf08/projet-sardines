<?php
require_once 'class/Config.php';

require_once 'controller/Controller.php';

require_once 'model/Model.php';
require_once 'model/UserManager.php';
require_once 'class/Asset.php';
require_once 'model/AssetManager.php';

require_once 'functions/functions.php';
require_once 'class/Router.php';

require_once 'model/TestManager.php';
/*
function getURI() {
    $basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
    $uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
    if (strstr($uri, '?')) $uri = substr($uri, 0, strpos($uri, '?'));
    return $uri = trim($uri, '/');
}
*/
try
{
    # ici, parser l'url en /action/paramètres
    # par exemple /test/2 (2 = l'id qu'on cible)
    /*
    $url = explode('/', getURI());
    $action = $url[0];
    $param = isset($url[1]) && !empty($url[1]) ? $url[1] : NULL;
    $ctrl = new Controller;
    */

    /*
    Route::set('index.php', $action, $ctrl->index());
    Route::set('donner', $action, $ctrl->dropGear());
    Route::set('sardines', $action, $ctrl->sardines());
    Route::set('profil', $action, $ctrl->account());
    Route::set('connexion', $action, $ctrl->logIn());
    Route::set('inscription', $action, $ctrl->signIn());
    Route::set('insertUser', $action, $ctrl->insertUser($_POST));
    Route::set('ajout', $action, $ctrl->newAsset());
    Route::set('insertAsset', $action, $ctrl->insertAsset($_POST));
    Route::set('success', $action, $ctrl->successInsertAsset());
    on oublie ça */

    $router = new Router;

    $router->setRoute('index.php', function() {
      $ctrl->index();
    });

    $router->setRoute('ajout', function() {
      $ctrl->newAsset();
    });

    $router->setRoute('insertAsset', function() {
      $ctrl->insertAsset($_POST);
    });

    print_r($router->getRoutes());
    #$router->execute();

    /*
    if($action == 'donner')
    {
      $ctrl->dropGear();
    }
    else if($action == 'sardines')
    {
      $ctrl->sardines();
    }
    else if($action == 'profil')
    {
      $ctrl->account($id);
    }
    else if($action == 'connexion')
    {
      $ctrl->logIn();
    }
    else if($action == 'inscription')
    {
      $ctrl->signIn();
    }
    else if($action == 'insertUser')
    {
      $ctrl->insertUser($_POST);
    }
    else if($action == 'ajout')
    {
      $ctrl->newAsset();
    }
    else if($action == 'insertAsset')
    {
      $ctrl->insertAsset($_POST);
    }
    else if ($action == 'success') {
        $ctrl->successInsertAsset();
    }
    else if($action == 'index.php')
    {
      $ctrl->index();
    }
    else if($action == 'test')
    {
      if(isset($param)) $ctrl->test($param);
      else $ctrl->test();
    }
    else
    {
      throw new Exception('Cette page n\'existe pas');
      # besoin d'envoyer page d'erreur ici
    }*/
}
catch(Exception $e)
{
  $errorMessage = $e->getMessage();
  echo $errorMessage;
  # require_once 'view/erreur'; cette vue n'existe pas encore
}
