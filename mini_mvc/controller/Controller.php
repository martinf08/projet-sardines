<?php

class Controller
{

    public function test($id = NULL)
    {
        # voir si le complexe Controller.php - test.php - Manager.php et TestManager.php fonctionnent ensemble
        $testManager = new TestManager();

        if (isset($id)) {

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

        $queryResult = $userManager->insertUser();

        if ($queryResult === false) {
            throw new Exception('Impossible d\'ajouter l\'utilisateur !');
        } else {
            header('Location: ./view/index.php');
        }
    }


    #-------------------------
    #  ASSETS (vue et ajout)
    #-------------------------
    public function newAsset()
    {
        $assetManager = new AssetManager();
        # passer ici les valeurs des champs des radios pour la vue
        $types = $assetManager->getAll('type');
        $qualities = $assetManager->getAll('quality');

        if(isset($types) && isset($qualities)) {

            require_once('./view/ajout.php');

        } else {
            throw new Exception('Problème sur la récupération des tables type et qualite');
        }
    }


    public function insertAsset($post)
    {
        $assetManager = new AssetManager();
        if (isset($post)) {
            if (!empty($post['beneficiaire']) && !empty($post['iduser']) && !empty($post['idtype']) && !empty($post['idquality']) && !empty($post['description']) && !empty($post['idstaff'] && !empty($post['value']))) {
                $asset = new Asset($post);
                $asset->setIdUser(2); # à corriger, il faudra d'abord récupérer cet id en ajax avant validation
                $assetManager->insertAsset($asset);
                session_start();
                $_SESSION['lastAsset'] = $asset;
                header('location:success');
            } else {
                throw new Exception('Certains champs (ou tous) sont vides.');
            }
        } else {
            throw new Exception('Erreur monumentale.');
        }

        # require_once './view/ajout.php'; plus utile depuis que les throw sont installés, c'était pour débugger

        # en vrai on préférera rediriger avec header('Location: newAsset');
        # pour ne pas se retrouver avec "/insertAsset" dans l'url
        # mais cette redirection peut se faire au niveau du manager

    }

    public function successInsertAsset()
    {

        require_once('./view/success.php');
    }

}
