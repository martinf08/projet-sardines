<?php

class Controller {

    public function test($id = NULL) 
    {
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
    
    
    #-------------------------------------------------------
    #               CONTROLLER LES SARDINES
    #-------------------------------------------------------
    
    #---------
    #  INDEX
    #---------
    public function index() 
    {
        require_once './view/index.php';
    }

    #----------
    #  DONNER
    #----------
    public function dropGear() 
    {
        require_once './view/donner.php';
    }

    #-----------
    #  SARDINES
    #-----------
    public function sardines() 
    {
        require_once './view/sardines.php';
    }

    #----------
    #  PROFIL
    #----------
    public function account($id) 
    {
        $userManager = new UserManager(); // Création d'un objet
        $user = $userManager->getUser($id); // Appel d'une fonction de cet objet
    
        require_once './view/profil.php';
    }
    
    #-------------
    #  CONNEXION
    #-------------
    public function logIn() 
    {
      
        require_once './view/connexion.php';
    }

    #------------------------------
    #  INSCRIPTION (vue et ajout)
    #------------------------------
    public function signIn()
    {

        require_once './view/inscription.php';

    }

    public function insertUser($post)
    {

      
        $userManager = new UserManager();
       
        $queryResult = $userManager->insertUser($post);
         
       /*if ($queryResult === false) {
            throw new Exception('Impossible d\'ajouter l\'utilisateur !');
        }
        else {
            header('Location: ./view/index.php');
        }*/
    }

    #-------------------------
    #  ASSETS (vue et ajout)
    #-------------------------
    public function newAsset() 
    {
        require_once('./view/ajout.php');
    }
    
    public function insertAsset($post)
    {
        $assetManager = new AssetManager();

        if (isset($post)){
            if(!empty($post['beneficiaire']) && !empty($post['iduser']) && !empty($post['idtype']) && !empty($post['idquality']) && !empty($post['description']) && !empty($post['idstaff'] && !empty($post['value']))) {
                $asset = new Asset($post);
                $asset->setIdUser(2);
                $result = $assetManager->insertAsset($asset);
            } else{
                $result = "Il faut remplir tous les champs";
            }
        } else {
            $result = "Il faut remplir le formulaire !";
        }

        require_once './view/ajout.php';

        # en vrai on préférera rediriger avec header('Location: newAsset');
        # pour ne pas se retrouver avec "/insertAsset" dans l'url
        # mais cette redirection peut se faire au niveau du manager

    }

}
