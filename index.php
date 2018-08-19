<?php

define('ROOT',dirname(__FILE__));
define('DS', DIRECTORY_SEPARATOR);
define('BASE_URL',dirname($_SERVER['SCRIPT_NAME']));
define('PUBLIC_URL', BASE_URL.DS);

require_once 'functions/functions.php';
require_once 'class/Config.php';
require_once 'controller/Controller.php';

require_once 'model/Model.php';
require_once 'model/UserManager.php';
require_once 'model/AssetManager.php';

require_once 'class/User.php';
require_once 'class/Asset.php';

require_once 'class/Router.php';

session_start();
try
{
    $router = new Router;

    $router->setRoute('', 'index');
    $router->setRoute('index', 'index');
    $router->setRoute('index.php', 'index');
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
    $router->setRoute('stand', 'instructionsView');
    $router->setRoute('forget', 'passForget');
    $router->setRoute('accountUpdate', 'accountUpdate');
    $router->setRoute('bienvenue', 'welcome');
    $router->setRoute('erreur', 'error');
    $router->setRoute('mentions-legales', 'mentions');
    $router->setRoute('emailValidation', 'sendEmailValidation');
    $router->setRoute('emailActivation', 'getEmailValidation');

    $router->execute();
}
catch(Exception $e)
{
  $_SESSION['error_msg'] = $e->getMessage();
  header('Location: ' . Config::$root . 'erreur');
}
