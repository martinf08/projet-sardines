<?php
require_once '../mini_mvc/class/Config.php';
require_once '../mini_mvc/controller/Controller.php';
require_once '../mini_mvc/model/Model.php';
//require_once 'model/UserManager.php';
require_once '../mini_mvc/class/Asset.php';
require_once '../mini_mvc/model/AssetManager.php';
require_once '../mini_mvc/functions/functions.php';

require_once 'model/TestManager.php';

$ctrl = new Controller; 

if(isset($_GET['url'])) {
  # ici, parser l'url en /action/paramètres
  # par exemple /test/2 (2 = l'id qu'on cible)
  $url = explode('/', $_GET['url']);
  $action = $url[0];
  # j'ai écris le rewrite de manière à ce que '/paramètre' soit facultatif, donc il faut contrôler son existence
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
    echo "page d'erreur";
  }
}



