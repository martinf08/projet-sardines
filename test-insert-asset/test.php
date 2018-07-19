<?php
/**
 * Created by PhpStorm.
 * User: martin
 * Date: 17/07/18
 * Time: 16:04
 */

function autoload_class($class)
{
    include $class . '.php';
}

spl_autoload_register('autoload_class');

$asset = new Asset([
    'value' => 5,
    'description' => null,
    'iduser' => 2,
    'idtype' => 1,
    'idquality' => 1,
    'idstaff' => 3,
]);
$db = new ConnectDb();
$asset->setRandomTag();
$assetManager = new AssetManager($db);
//$assetManager->getValueAjax(2,3);
//$assetManager->insertAsset($asset);