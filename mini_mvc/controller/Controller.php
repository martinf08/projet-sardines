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

    public function account($identifier)
    {
        if (isset($identifier)) {
            $userManager = new UserManager();
            $user = new User($userManager->getUser($identifier));
            
            require_once './view/profil.php';
        } else {
            header('Location: index');
        }     
    }

    public function accountUpdate()
    {
        $userManager = new UserManager();
        
        # requête

        if($reponse) {
            $identifier = $_SESSION['user']['identifier'];
            header("Location: account/$identifier");
        } else {
        
            throw new Exception('Échec de modification du champ !');
        }
    }

    #-------------
    #  CONNEXION
    #-------------
    public function logIn()
    {
        $userManager = new UserManager(); // Création d'un objet
        $user = new User($_POST); 
        $reponse = $userManager->logIn($user);
        if($reponse){
            header('Location: index');
             echo"connexion ok";
        }else{
            //echo "404";
            require_once './view/connexion.php';
        }
        
    }

    #------------------------------
    #  INSCRIPTION (vue et ajout)
    #------------------------------
    public function signIn()
    {
        require_once './view/inscription.php';

    }

    public function insertUser()
    {

        $userManager = new UserManager(); // Création d'un objet
        $user = new User($_POST); 
        $reponse = $userManager->insertUser($user);

        if($reponse) {
              header('Location: connexion');
        } else {
         
             throw new Exception('Impossible d\'ajouter l\'utilisateur !');
        }
    }

    public function emailValidation() {
        $userManager = new UserManager();
        $userManager->email_validation();
        require_once './view/validation.php';
        if ($userManager->email_validation()) {
            echo 'Compte validé';
        }
        else {
            echo 'Erreur lors de la validation';
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

        if (isset($types) && isset($qualities)) {

            require_once('./view/ajout.php');

        } else {
            throw new Exception('Problème sur la récupération des tables type et qualite');
        }
    }


    public function insertAsset()
    {
        $post = $_POST;
        $assetManager = new AssetManager();
        if (isset($post)) {

            if (!empty($post['beneficiary']) && !empty($post['idtype']) && !empty($post['idquality']) && !empty($post['description'])) {
                if (empty($post['iduser']) && $post['beneficiary'] == 'withBeneficiary') {
                    throw  new Exception('Le champ du bénéficiaire est vide');
                } else {
                    $asset = new Asset($post);
                    $assetManager->insertAsset($asset);
                    session_start();
                    $_SESSION['lastAsset'] = $asset;

                    header('location:success');
                }

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

    #--------------
    #  ERREUR 404
    #--------------
    public function notFound() {
        echo 'ici, la vue pour page non trouvée';
    }

}
