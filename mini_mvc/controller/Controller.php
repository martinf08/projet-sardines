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

    public function accountUpdate() # PAS ENCORE CODÉ
    {
        if(isset($_POST['submit-account'])) { # vérifie que le submit ayant le name convenu sur la vue profil existe
            $userManager = new UserManager();
        
            # requête

            if($reponse) {
                $identifier = $_SESSION['user']['identifier'];
                header("Location: account/$identifier");
            } else {
            
                throw new Exception('Échec de modification du champ !');
            }
        } else { # sinon l'user n'a rien à faire là
            header('Location: index');
        }
    }

    #-------------
    #  CONNEXION
    #-------------

    public function logView(){
     
         $this->set('title','Connexion');
         $this->render('./view/connexion.php');
    }

    public function logIn()
    {
        if (isset($_POST['email'])) { # est-ce que l'user est passé par le formulaire de logView ? sinon redirection
            if($_POST['email']!="" || $_POST['password']!=""){

                $userManager = new UserManager(); // Création d'un objet
                $user = new User($_POST); 
                $reponse = $userManager->logIn($user);
            
                if ($reponse){
                    $_SESSION['islog']=true;
                  
                    $this->set('title','Les Sardines');
                    $this->render('./view/index.php');
                } else {
                    $_SESSION['islog']=false;
                    
                    echo('Identifiant ou mot de passe incorrect');
                    //header('Location: connexion');
                
                }
            } else {
                throw new Exception('Veuillez remplir tous les champs obligatoires pour vous connecter');

            }
        } else {
            header('Location: index');
        }
        
    }

    public function logOut()
    {
        $_SESSION['user']="";
        $_SESSION['islog']= 0;
        $this->set('title','index');
        $this->render('./view/index.php');
    }

    #------------------------------
    #  INSCRIPTION (vue et ajout)
    #------------------------------
    public function signIn()
    {
        session_destroy();
        $this->set('title','inscription');
        $this->render('./view/inscription.php');
    }

    public function insertUser()
    {
        if (isset($_POST['submit-signin'])) { # accès interdit si on est pas passé par le submit-signin
            if ($_POST['email']!="" && $_POST['password']!="" && $_POST['confirmPassword']!=""){
                $userManager = new UserManager(); // Création d'un objet
                $user = new User($_POST); 
                $reponse = $userManager->insertUser($user);
    
                if ($reponse) {
                    $this->set('title','Connexion');
                    $this->render('./view/connexion.php');
                  
                } else {
                    throw new Exception('Impossible d\'ajouter l\'utilisateur !');
                }
            } else {
                 throw new Exception('Impossible d\'ajouter l\'utilisateur !');
            }
        } else {
            header('Location: index');
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
        if (isset($_SESSION['user'])) { # contrôle du droit d'accès
            if ($_SESSION['user']->getStaff() OR $_SESSION['user']->getAdmin()) {
                $assetManager = new AssetManager();
                # passer ici les valeurs des champs des radios pour la vue
                $types = $assetManager->getAll('type');
                $qualities = $assetManager->getAll('quality');

                if (isset($types) && isset($qualities)) {

                    require_once('./view/ajout.php');

                } else {
                    throw new Exception('Problème sur la récupération des tables type et qualite');
                }
            } else {
                header('Location: index');
            }
        } else {
            header('Location: index');
        }
    }


    public function insertAsset()
    {
        if (isset($_SESSION['user'])) { # contrôler que la méthode est accédée uniquement par un staff ou admin
            if ($_SESSION['user']->getStaff() OR $_SESSION['user']->getAdmin()) {
                if (isset($_POST['submit-asset'])) { # vérifie qu'on accède bien à insertAsset suite à un submit
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
                } else {
                    header('Location: index');
                }
            } else {
                header('Location: index');
            }
        } else {
            header('Location: index');
        }
        

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
        
        if (file_exists($view)) {
            extract($this->vars);
            ob_start();
            require($view);
            $content = ob_get_clean();
            require_once 'view/template.php';
        }
        else {
            throw new Exception("la vue demandé d'existe pas");
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
