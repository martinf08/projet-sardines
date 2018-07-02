<?php
/**
 * Created by PhpStorm.
 * User: utilisateur
 * Date: 29/06/18
 * Time: 16:08
 */

function autoload_class($class) {
    include $class . '.php';
}
spl_autoload_register('autoload_class');
$hash_validation = md5(uniqid(rand(), true));
echo '<a href="validation.php?url=' . $hash_validation . '"><button>Valider le compte</button></a>';
require('validation.php');

function email_validation() {
    $conn = new ConnectDB();
    $sql = "SELECT * FROM user";
    if ($result = mysqli_query($conn, $sql)) {
       return $result;
    }
}
