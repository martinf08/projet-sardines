<?php
# dans ce fichier, chaque fonction est en fait une route, ou une action (opération pour récupérer/envoyer des données + vue)

require_once './model/UserManager.php';
require_once './model/AssetManager.php';
require_once './model/TestManager.php';

class Controller {

    public function test($id = NULL) {
        # voir si le complexe controller.php - test.php - Manager.php et TestManager.php fonctionnent ensemble
        $testManager = new TestManager();
    
        if(isset($id)) {
            $type_name = $testManager->getName($id);
        } else {
            $type_name['name'] = 'aucun argument passé';
        }
        
        # on balance la vue demandée par le router par un require pour qu'elle dispose de la variable type_name
        require_once './view/test.php'; 
    }
    
    
    # exemples (non fonctionnels) de fonctions dont on aura besoin pour les sardines
    # cette partie peut être ignorée
    
    public function getUser($id) {
        $userManager = new UserManager(); // Création d'un objet
        $user = $userManager->getUser($id); // Appel d'une fonction de cet objet
    
        require_once '../view/account.php';
    }
    
    public function getAllUsers($id) {
      $userManager = new UserManager(); // Création d'un objet
      $users = $userManager->getAllUsers(); // Appel d'une fonction de cet objet
    
      require_once '../view/account.php';
    }
    
    public function insertUser($pseudo, $mail/*, etc. */)
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
    
    public function insertAsset($quality, $type/*, etc. */)
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

}
