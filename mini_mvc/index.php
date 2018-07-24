<?php
require_once 'class/Config.php';
require_once 'controller/Controller.php';
require_once 'model/Model.php';
require_once 'model/UserManager.php';
require_once 'class/Asset.php';
require_once 'model/AssetManager.php';
require_once 'functions/functions.php';

require_once 'model/TestManager.php';

$ctrl = new Controller;

function getURI() {
    $basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
    $uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
    if (strstr($uri, '?')) $uri = substr($uri, 0, strpos($uri, '?'));
    return $uri = trim($uri, '/');
}

try
{
    # ici, parser l'url en /action/paramètres
    # par exemple /test/2 (2 = l'id qu'on cible)
    $url = explode('/', getURI());
    $action = $url[0];
    $param = isset($url[1]) && !empty($url[1]) ? $url[1] : NULL;

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
    }
}
catch(Exception $e)
{
  $errorMessage = $e->getMessage();
  echo $errorMessage;
  # require_once 'view/erreur'; cette vue n'existe pas encore
}
