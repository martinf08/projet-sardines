<?php

require_once './model/UserManager.php';
require_once './model/AssetManager.php';
require_once './model/TestManager.php';


function test() {
    /* voir si tout fonctionne ensemble */
    $testManager = new TestManager(); // Création d'un objet
    $type_name = $testManager->getName(2); // Appel d'une fonction de cet objet
    require_once './view/test.php';
}

function getUser($id) {
    $userManager = new UserManager(); // Création d'un objet
    $user = $userManager->getUser($id); // Appel d'une fonction de cet objet

    require_once '../view/account.php';
}

function getAllUsers($id) {
  $userManager = new UserManager(); // Création d'un objet
  $users = $userManager->getAllUsers(); // Appel d'une fonction de cet objet

  require_once '../view/account.php';
}

function insertUser($pseudo, $mail/*, etc. */)
{
    $userManager = new UserManager();

    $queryResult = $userManager->insertUser($pseudo, $mail/*, etc. */);

    if ($queryResult === false) {
        throw new Exception('Impossible d\'ajouter l\'utilisateur !');
    }
    else {
        header('Location: index.php?action=creationcompte&id=' . $postId);
    }
}

function insertAsset($quality, $type/*, etc. */)
{
    $assetManager = new AssetManager();

    $queryResult = $assetManager->insertAsset($quality, $type/*, etc. */);

    if ($queryResult === false) {
        throw new Exception('Impossible d\'ajouter l\'asset !');
    }
    else {
        header('Location: index.php?action=ajout&id=' . $postId);
    }
}