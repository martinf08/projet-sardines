<?php

class Controller
{
    /**
     * E2 - 
     * $vars: cette variable permet de stocker temporairement des données 
     *        destinées à  la vue
     */
    private $vars = array(); 

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
    public function logView(){
        require_once './view/connexion.php';
    }
    public function logIn()
    {

        if($_POST['email']!="" || $_POST['password']!=""){

            $userManager = new UserManager(); // Création d'un objet
            $user = new User($_POST); 
            $reponse = $userManager->logIn($user);
            if($reponse){
                $_SESSION['islog']=true;
                header('Location: index');
            }else{
                $_SESSION['islog']=false;
                 
                 echo('Identifiant ou mot de passe incorrect');
                 //header('Location: connexion');
               
            }
        }else{
            throw new Exception('Veuillez remplir tous les champs obligatoires pour vous connecter');
         
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
            if (!empty($post['beneficiary']) && !empty($post['idtype']) && !empty($post['idquality']) && !empty($post['description']) && !empty($post['idstaff'])) {
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

    /** E2
     * Cette fonction va nous permettre de de rendre dynamiquement des vues 
     * et des données au templete.
     * la vue doit être passé en paramètre
     */
    public function render($view)
    {
        extract($this->vars);
        if (file_exists($view)) {
            ob_start();
            require($view);
            $content_for_layout = ob_get_clean();
            require_once 'view/template.php';
        }
        else {
            $this->e404("la vue demandé d'existe pas");
        }
        
    }

    /**
     * E2:
     * cette fonction permet de stocker temporairement des données 
     * destinées à  la vue dans la variable $vars
     * exemple : $this->set('user',$user);
     * utilisation dans la vue --> <?php echo $user->id_user ?>
     */
    public function set ($key, $value=null)
    {
        if(is_array($key)){
            $this->vars +=$key;
        }else{
            $this->vars[$key] =$value;
        }
        
        return $this;
    }








}
