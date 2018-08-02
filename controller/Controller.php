<?php

class Controller
{
    /**
     * E2 -
     * $vars: cette variable permet de stocker temporairement des données
     *        destinées à  la vue
     */
    private $vars = array();
    private $rendered = false;

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
        $this->set('title', 'Les Sardines');
        $this->set('css', 'donner');
        $this->render(ROOT.DS.'view/donner.php');
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
            if (strtolower($identifier) == strtolower($_SESSION['user']->getIdentifier())) {
                $userManager = new UserManager();
                $user = new User($userManager->getUser($identifier));

                require_once './view/profil.php';
            } else {
                header('Location: '.PUBLIC_URL);
            }

        } else {
            header('Location: '.PUBLIC_URL);
        }
    }

    public function accountUpdate()
    {
        if (isset($_POST['submit-account'])) { # vérifie que le submit ayant le name convenu sur la vue profil existe

            $userManager = new UserManager();
            if (strtolower($userManager->getEmailUserByIdentifier($_SESSION['user'])) == strtolower($_SESSION['user']->getEmail())) {
                if (isset($_POST['pseudo_account']) && !empty($_POST['pseudo_account'])) {
                    if (strtolower($userManager->getEmailUser($_SESSION['user'])) == strtolower($_SESSION['user']->getEmail())) {
                        $regex = "#[A-Za-z0-9àèìòùÀÈÌÒÙáéíóúýÁÉÍÓÚÝâêîôûÂÊÎÔÛãñõÃÑÕäëïöüÿÄËÏÖÜŸçÇßØøÅåÆæœ\-\_]{3,25}#";
                        if (preg_match($regex, $_POST['pseudo_account'])) {
                            $_SESSION['user']->setNickname($_POST['pseudo_account']);
                            $userManager->updatePseudo($_SESSION['user']);
                            header('Location: profil/' . $_SESSION['user']->getIdentifier());
                        }
                    }
                }
            }
        } else {
            header('Location: '.PUBLIC_URL);
        }
    }

    #-------------
    #  CONNEXION
    #-------------

    public function logView()
    {
        $this->set('title', 'Connexion');
        $this->set('css', 'tooltip');
        $this->set('connexion_css', 'connexion');
        

        $this->render(ROOT.DS.'view/connexion.php');
    }

    public function passForget($request = null)
    {
        $error = "";
        $code_recover = false;
        $model = new UserManager();
        $email = "";

        $this->set('title','Mot de passe oublié');
        if (!isset($_POST['email_recuperation'])) {

        } else {
            if (isset($_POST['recover_submit'], $_POST['email_recuperation'])) {

                if (!empty($_POST['email_recuperation'])) {
                    $email = htmlspecialchars($_POST['email_recuperation']);
                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        //check if the email exit
                        $user = $model->UserChecker($email);
                  
                        if ($user) {
  
                            $code = "";
                            $sending_code = "";
                            for ($i = 0; $i < 8; $i++) {
                                $sending_code .= mt_rand(0, 9);
                            }
                            $code .= md5($sending_code);
                            $pre = $model->dbConnect()->prepare("SELECT id FROM recovery_password WHERE email = :email");
                            $pre->execute(array(':email' => $email));
                            $reponse = $pre->fetch(PDO::FETCH_ASSOC);
                         
                            if ($reponse['id'] > 0) {
                                $pre = $model->dbConnect()->prepare("UPDATE recovery_password SET code = :code WHERE email =:email");
                                $pre->execute(array(':code' => $code, ':email' => $email));
                            } else {
                                $pre = $model->dbConnect()->prepare("INSERT INTO recovery_password(code,email) VALUES (?,?)");

                                $pre->execute(array($code, $email));
                            }


                            $to = $email;
                            $subject = "Récupération de mot de passe";
                            $link = PUBLIC_URL."forget".DS. $sending_code;
                            $message = '<br>Cliquez <a href="' . $link . '">ici</a> pour modifier votre mot de passe NB ceci est un test<br><br>';

                            // Always set content-type when sending HTML email
                            $headers = "MIME-Version: 1.0" . "\r\n";
                            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                            $headers .= "content-Transfer-Encoding: 8bit";
                            // More headers
                            $headers .= 'From:"eudes"eudes<@ici08.fr>' . "\r\n";


                            if (mail($to, $subject, $message, $headers)) {
                                echo "méssage envoyé";
                            } else {
                               $this->set('message',$message);
                            }
                            //header(location );
                        } else {
                            $error = "Cette adresse email n'est pas enregistrée";

                        }

                    } else {
                        $error = "Adresse email non valide";
                    }
                } else {
                    $error = "Veuillez entrer votre adresse email";
                }
            }

        }


        if (isset($request)) {

            try {

                $code = md5(htmlspecialchars($request));
                $pre = $model->dbConnect()->prepare("SELECT * FROM recovery_password WHERE code =:code");
                $pre->bindParam(':code', $code);
                $pre->execute();
                $reponse = $pre->fetch(PDO::FETCH_ASSOC);

                if ($reponse) {
                    $_SESSION['email'] = $reponse['email'];
                    $pre = $model->dbConnect()->prepare("UPDATE recovery_password SET confirm = 1  WHERE email = ?");
                    $pre->execute(array($email));
                } else {
                    $error = "Modification de mot de passe impossible";
                }
                $code_recover = true;
                $this->set('title','Réinitialisation du mot de passe');

            } catch (Exception $e) {
                debug($e);
            }

        }

         

        if (isset($_POST['submitNewpassword'])) {
            if (isset($_POST['newPasseword'], $_POST['confirmNewpasseword'])) {

                $newPasseword = htmlspecialchars($_POST['newPasseword']);
                $confirmNewpasseword = htmlspecialchars($_POST['confirmNewpasseword']);

                if (!empty($newPasseword) AND !empty($confirmNewpasseword)) {
                    if ($newPasseword === $confirmNewpasseword) {
                        $newPasseword = md5($newPasseword);
                        //update

                        $pre = $model->dbConnect()->prepare("UPDATE user SET password= ? WHERE email = ?");

                        $pre->execute(array($newPasseword, $_SESSION['email']));

                        $pre = $model->dbConnect()->prepare("DELETE FROM recovery_password WHERE email = :email");
                        $pre->execute(array(':email' => $_SESSION['email']));
                        $_SESSION['email'] = "";
                        
                        header("location: ".PUBLIC_URL."connexion");

                    } else {
                        $error = "Vos deux mots de passe ne sont pas identiques";
                    }
                } else {
                    $error = "Veuiller remplir tous les champs";
                }

            } else {
                $error = "Veuiller remplir tous les champs";
            }
            if($error === "Veuiller remplir tous les champs"){
                $code_recover = true;
            }
        }
            
      
        $this->set('forgot_css','forgotpassword');
        $this->set('errors',$error);
        $this->set('code_recover',$code_recover);

        $this->render('view'.DS.'forgotpassword.php');
    }
    public function logIn()
    {
        if (isset($_POST['email'])) { # est-ce que l'user est passé par le formulaire de logView ? sinon redirection
            if ($_POST['email'] != "" || $_POST['password'] != "") {

                $userManager = new UserManager();
                $user = new User($_POST);
                $reponse = $userManager->logIn($user);

                if ($reponse) {
                    $_SESSION['islog'] = true;

                    $this->set('title', 'Les Sardines');
                    $this->set('css', 'donner');
                    $this->render('view/donner.php');
                } else {
                    $_SESSION['islog'] = false;
                    throw new Exception('Identifiant ou mot de passe incorrect.');
                }
            } else {
                throw new Exception('Veuillez remplir tous les champs obligatoires pour vous connecter.');
            }
        } else {
            header('Location: '.PUBLIC_URL);
        }
    }

    public function logOut()
    {
        $_SESSION['user'] = "";
        $_SESSION['islog'] = 0;

        header('Location: '.PUBLIC_URL);
    }

    #------------------------------
    #  INSCRIPTION (vue et ajout)
    #------------------------------
    public function signIn()
    {
        session_destroy();

        $this->set('title', 'inscription');
        $this->set('css', 'tooltip');
        $this->set('inscription_css', 'inscription');
        $this->render('./view/inscription.php');
    }

    public function insertUser()
    {
        if (isset($_POST['submit-signin'])) { # accès interdit si on est pas passé par le submit-signin
            if ($_POST['email'] != "" && $_POST['password'] != "" && $_POST['confirmPassword'] != "") {
                $userManager = new UserManager();
                $user = new User($_POST);
                $reponse = $userManager->insertUser($user);

                if ( is_bool($reponse)) {
                    header("Location: connexion");
                    $this->set('title', 'Connexion');
                    $this->render('./view/connexion.php');
                    header("HTTP/1.0 200");
                } else {

                    $this->set('title', 'inscription');
                    $this->set('css', 'tooltip');
                    $this->set('inscription_css', 'inscription');
                    //$this->set('Info', 'Cet email existe déjà');
                    $this->render('./view/inscription.php');
                    throw new Exception($reponse);
                }
            } else {
                header("HTTP/1.0 400");
                throw new Exception('Il reste des champs à remplir.');
            }

        } else {
            header("HTTP/1.0 403"); 
            header('Location: '.PUBLIC_URL);
        }
    }

    public function emailValidation()
    {
        $userManager = new UserManager();
        $userManager->email_validation();
        require_once './view/validation.php';

        if ($userManager->email_validation()) {
            echo 'Compte validé';
        } else {
            throw new Exception('Erreur lors de la validation');
        }
    }

    #-------------------------
    #  ASSETS (vue et ajout)
    #-------------------------
    public function newAsset()
    {
        if (isset($_SESSION['user']) AND !empty($_SESSION['user'])) { # contrôle du droit d'accès
            if ($_SESSION['user']->getStaff()) {
                $assetManager = new AssetManager();
                # passer ici les valeurs des champs des radios pour la vue
                $types = $assetManager->getAll('type');
                $qualities = $assetManager->getAll('quality');

                if (isset($types) && isset($qualities)) {

                    require_once('./view/ajout.php');

                } else {
                    throw new Exception('Problème sur la récupération des tables.');
                }
            } else {
                header('Location: '.PUBLIC_URL);
            }
        } else {
            header('Location: '.PUBLIC_URL);
        }
    }


    public function insertAsset()
    {
        if (isset($_SESSION['user']) AND !empty($_SESSION['user'])) { # contrôler que la méthode est accédée uniquement par un staff ou admin
            if ($_SESSION['user']->getStaff()) {
                if (isset($_POST) && !empty($_POST)) {
                    $post = $_POST;
                    $assetManager = new AssetManager();
                    if (isset($post)) {

                        if (!empty($post['idtype']) && !empty($post['idquality'])) {
                            if (empty($post['iduser'])) {
                                throw  new Exception('Le champ du bénéficiaire est vide');
                            } else {
                                if (strtolower($post['iduser']) == strtolower($_SESSION['user']->getIdentifier())) {
                                    throw new Exception('Un membre de l\'équipe ne doit pas se créditer lui-même !');
                                } else {
                                    $asset = new Asset($post);
                                    $assetManager->insertAsset($asset);
                                    session_start();
                                    $_SESSION['lastAsset'] = $asset;

                                    header('location:success');
                                }
                            }

                        } else {
                            throw new Exception('Certains champs (ou tous) sont vides.');
                        }
                    } else {
                        throw new Exception('Erreur monumentale.');
                    }
                } else {
                    header('Location: '.PUBLIC_URL);
                }
            } else {
                header('Location: '.PUBLIC_URL);
            }
        } else {
            header('Location: '.PUBLIC_URL);
        }

    }

    public function successInsertAsset()
    {
        require_once('./view/success.php');
    }

    #--------------
    #  ERREUR 404
    #--------------
    public function notFound()
    {        
        $this->set('css', 'erreurs');
        $this->set('title', 'Tu t\'es perdu');
        $this->render('view/notfound.php');
    }

    #--------------
    #  EXCEPTIONS
    #--------------
    public function error()
    {
        $this->set('css', 'erreurs');
        $this->set('title', 'Il y a eu un problème');
        $this->set('errorMessage', $_SESSION['error_msg'] ?? 'Il y a eu un problème, on sait pas trop.');
        $this->render('view/erreur.php');
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
            require_once ROOT.DS.'view'.DS.'template.php';
            $this->rendered = true;
        } else {
            
            //throw new Exception();
        }
    }

    /**
     * E2:
     * cette fonction permet de stocker temporairement des données
     * destinées à  la vue dans la variable $vars
     * exemple : $this->set('user',$user);
     * utilisation dans la vue --> <?php echo $user->id_user ?>
     */
    public function set($key, $value = null)
    {
        if (is_array($key)) {
            $this->vars += $key;
        } else {
            $this->vars[$key] = $value;
        }
        return $this;
    }

     /**
     * Permet de gérer mes erreurs
     */
    function erreur($coderror,$errorMessage){
        header("HTTP/1.0 ".$coderror); 
        $this->set('errorMessage',$errorMessage);
        $this->render('./view/erreur.php');
    }
}
