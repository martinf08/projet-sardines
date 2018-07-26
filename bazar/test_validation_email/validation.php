<?php
/**
 * Created by PhpStorm.
 * User: martin
 * Date: 26/07/18
 * Time: 11:08
 */

function email_validation()
{
    $servername = "";
    $username = "";
    $password = "";
    $dbname = "";
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $code = htmlspecialchars($_GET['code']);
    $req = $conn->prepare('SELECT account_status FROM `user` WHERE account_status = :code');
    $req->bindParam(':code', $code);
    $req->execute();
    if ($req->fetch()['account_status'] != false && $req->fetch()['account_status'] != '1') {
        $reqActivation = $conn->prepare("UPDATE `user` SET account_status= '1' WHERE account_status = :code");
        $reqActivation->bindParam(':code', $code);
        $reqActivation->execute();
        echo 'Compte activé';
    } else if ($req->fetch()['account_status'] == '1') {
        echo 'Compte déjà activé';
    }
    else {
        echo 'erreur';
    }
}

email_validation();