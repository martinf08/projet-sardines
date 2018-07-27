<?php


require_once 'class/Config.php';
require_once 'controller/Controller.php';

require_once 'functions/functions.php';
require_once 'model/Model.php';
require_once 'model/UserManager.php';
require_once 'model/AssetManager.php';

require 'class/User.php';
require_once 'class/Asset.php';

require_once 'class/Router.php';

require_once 'model/TestManager.php';
session_start();
try
{
    $router = new Router;

    $router->setRoute('', 'index');
    $router->setRoute('insertUser', 'insertUser');
    $router->setRoute('ajout', 'newAsset');
    $router->setRoute('insertAsset', 'insertAsset');
    $router->setRoute('success', 'successInsertAsset');
    $router->setRoute('inscription', 'signIn');
    $router->setRoute('connexion', 'logView');
    $router->setRoute('log', 'logIn');
    $router->setRoute('exit', 'logOut');
    $router->setRoute('profil', 'account');
    $router->setRoute('sardines', 'sardines');
    $router->setRoute('donner', 'dropGear');
  

    $router->execute();
}
catch(Exception $e)
{
  $errorMessage = $e->getMessage();
  echo $errorMessage;
  # require_once 'view/erreur'; cette vue n'existe pas encore
}
