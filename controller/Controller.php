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

    private function refreshUser() {
        if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
            $userManager = new UserManager();
            $_SESSION['user'] = new User($userManager->getUser($_SESSION['user']->getIdentifier()));
        }
    }

    #---------
    #  INDEX
    #---------
    public function index()

    {
        $this->set('title', 'Les Sardines');
        $this->set('css', array('slider'));

        $this->render('view/index.php');
    }

    #----------
    #  DONNER
    #----------
    public function dropGear()

    {
        if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
            $this->refreshUser();

            $this->set('title', 'Les Sardines');
            $this->set('css', array('donner'));
            $this->render('view/donner.php');
        } else {
            http_response_code(403);
            header('Location: bienvenue');
        }
    }

    #--------
    #  STAND
    #--------
    public function instructionsView()

    {
        $this->refreshUser();

        $this->set('title', 'Donner');
        $this->set('css', array('stand'));
        $this->render('view/stand.php');
    }

    #-----------
    #  SARDINES
    #-----------
    public function sardines()

    {
        $this->refreshUser();

        $this->set('title', 'Les Sardines');
        $this->set('css', array('slider', 'sardines'));
        $this->render('view/sardines.php');
    }

    #----------------------
    #  TABLEAU DES VALEURS
    #----------------------
    public function tableau() {
        $this->refreshUser();
        $assetManager = new AssetManager();
        $catalog = $assetManager->getAssetToPrice();

        $this->set('title', 'Barème');
        $this->set('values', $catalog);
        $this->set('css', array('tableau'));
        $this->render('view/tableau.php');
    }

    #-------------------
    #  MENTIONS LÉGALES
    #-------------------
    public function mentions()

    {
        $this->refreshUser();

        $this->set('title', 'Mentions légales');
        $this->set('css', array('standard'));
        $this->render('view/mentions.php');
    }

    #-----------------------
    #  CONDITIONS GÉNÉRALES
    #-----------------------
    public function conditions()

    {
        $this->set('title', 'Conditions générales d\'utilisation');
        $this->set('css', array('standard'));
        $this->render('view/conditions.php');
    }

    #----------
    #  PROFIL
    #----------

    public function account($updateAccount = null)
    {
     
        if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
            if ($_SESSION['user']->getIdentifier()) {
                $userManager = new UserManager();
                $avatar = $userManager->findAvatar();
                if (strtolower($userManager->getIdByIdentifier($_SESSION['user'])) == strtolower($_SESSION['user']->getId_user())) {

                    $this->refreshUser();
                    
                    if (isset($avatar) && !empty($avatar))
                        $this->set('avatar', $avatar);

                    $this->set('update',$updateAccount);
                    $this->set('title', 'Mon compte');
                    $this->set('css', array('profil'));
                    $this->render('view/profil.php');
                    
                }
            } else {
                header('Location: ' . Config::$root . 'donner');
            }
        } else {
            header('Location: ' . Config::$root . 'donner');
        }
    }

    public function accountUpdate()
    {

        if (isset($_POST['submit-account'])) { # vérifie que le submit ayant le name convenu sur la vue profil existe

            $userManager = new UserManager();
            if (strtolower($userManager->getEmailUserByIdentifier($_SESSION['user'])) == strtolower($_SESSION['user']->getEmail())) {
                if (isset($_POST['pseudo_account'])) {

                    if (strtolower($userManager->getEmailUser($_SESSION['user'])) == strtolower($_SESSION['user']->getEmail())) {
                        $regex = '`^([a-zA-Z0-9-_]{1,25})$`';
                        if (preg_match($regex, $_POST['pseudo_account']) OR $_POST['pseudo_account'] === '') {
                            # j'autorise temporairement le changement de pseudo en chaîne vide
                            # puisqu'il est vide de base donc on doit avoir le droit d'effacer notre pseudo
                            # forcer la création d'un pseudo par défaut à partir de l'email est une autre possibilité
                            $_SESSION['user']->setNickname($_POST['pseudo_account']);
                                $userManager->updatePseudo($_SESSION['user']);

                            if ($_FILES['avatar']['error'] == 4 || $_FILES['avatar'] == null) {
                                header('Location: profil');
                            }

                        } else {
                           // throw new Exception('La valeur que vous avez passé est invalide.');
                           //die(strlen($_POST['pseudo_account']).'ou');
                           //header('Location: profil');
                           if(strlen($_POST['pseudo_account']) > 25){
                               $error_msg = "25 caractères maximum";
                           }else{
                              $error_msg = "Votre pseudo ne doit pas contenir de caractères spéciaux, accentués ou d'espaces";
                           }
                           $updateAccount = array(
                               'pseudo'=> $_POST['pseudo_account'],
                               'error_msg' =>  $error_msg
                            );
                           $this->account($updateAccount);
                           
                        }
                        if (isset($_FILES['avatar']) and $_FILES['avatar']['error'] == 0 && !empty($_FILES['avatar'])) {
                            if (!is_dir('images/avatar')) {
                                mkdir('images/avatar', 0777);

                            }
                            $userManager = new UserManager();
                            $userManager->updateAvatar();
                            header('Location: profil');
                        }
                    } else {
                        throw new Exception('Vous ne pouvez pas modifier ce compte.');
                    }
                }
            }
        } else {
            header('Location: ' . Config::$root . 'donner');
        }
    }

    #-------------
    #  CONNEXION
    #-------------

    public function logView()
    {
        if (isset($_SESSION['islog']) AND $_SESSION['islog'])
            header('Location: profil');

        $this->set('title', 'Connexion');
        $css = array('tooltip', 'connexion');
        $this->set('css', $css);
        $this->render('view/connexion.php');

        $_SESSION['errorMessage'] = null;
    }

    public function passForget($request = null)
    {
        $error = "";
        $code_recover = false;
        $model = new UserManager();
        $email = "";

        $this->set('title', 'Mot de passe oublié');
        if (!isset($_POST['email_recuperation'])) {
            # ??
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
                            //Load Composer's autoloader
                            require 'vendor/autoload.php';
                            $message = $model->sendForgetPass($email, $code);
                            $_SESSION['pass_message'] = $message;


                        } else {
                            $error = "Cette adresse email n'est pas enregistrée";
                            // $_SESSION['errorPass'] = "Cette adresse email n'est pas enregistrée";
                            // header('Location: ' . Config::$root . 'forget');
                        }
                    } else {
                        $error = "Adresse email non valide";
                        // $_SESSION['errorPass'] = "Adresse email non valide";
                        // header('Location: ' . Config::$root . 'forget');
                    }
                } else {
                    $error = "Veuillez entrer votre adresse email";
                    // $_SESSION['errorPass'] = "Veuillez entrer votre adresse email";
                    // header('Location: ' . Config::$root . 'forget');
                }
            }

        }
        //password change procedure
        if (isset($request)) {

            /*try {*/
                $code = $request;
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
                    // $_SESSION['errorPass'] = "Modification de mot de passe impossible";
                }
                $code_recover = true;
                $this->set('title', 'Réinitialisation du mot de passe');

            /*} catch (Exception $e) {
                debug($e);
            }*/ # il vaut mieux ne pas tomber sur ça dans la prod

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

                        header("location: " . Config::$root . "connexion");

                    } else {
                        $error = "Vos deux mots de passe ne sont pas identiques";
                        //$_SESSION['errorPass'] = "Vos deux mots de passe ne sont pas identiques";
                    }
                } else {
                    $error = "Veuiller remplir tous les champs";
                    //$_SESSION['errorPass'] = "Veuiller remplir tous les champs";
                }

            } else {
                $error = "Veuiller remplir tous les champs";
                //$_SESSION['errorPass'] = "Veuiller remplir tous les champs";
            }
            if ($error = "Veuiller remplir tous les champs") {
                $code_recover = true;
            }
        }
        //----------------------------End of password change procedure---------------------------

        $this->set('errors', $error);
        $this->set('code_recover', $code_recover);
        $this->set('css', array('forgotpassword', 'tooltip'));
        $this->render('view/forgotpassword.php');

        //$_SESSION['errorPass'] = null;
    }

    public function logIn()
    {
        if (isset($_POST['email'])) { # est-ce que l'user est passé par le formulaire de logView ? sinon redirection
            if ($_POST['email'] != "" || $_POST['password'] != "") {
                if (isset($_POST['submit-connect'])) {
                    $userManager = new UserManager();
                    $user = new User($_POST);
                    $reponse = $userManager->logIn($user);

                    $_SESSION['errorMessage'] = null;

                    if ($reponse) {
                        $_SESSION['islog'] = User::isLog;
                        if (!isset($_COOKIE['cookie']) && empty($_COOKIE['cookie'])) {
                            setcookie('cookie', '1', time() + (86400 * 30));
                        }

                        header('Location: donner');
                    } else {
                        $_SESSION['islog'] = User::isNotlog;
                        $_SESSION['errorMessage'] = 'Identifiant ou mot de passe incorrect.'; 
                        header('Location: ' . Config::$root . 'connexion');
                    }
                }
            } else {
                $_SESSION['islog'] = User::isNotlog;
                $_SESSION['errorMessage'] = 'Veuillez remplir tous les champs obligatoires pour vous connecter.'; 
                header('Location: ' . Config::$root . 'connexion');
            }
        } else {
            http_response_code(403);
            header('Location: ' . Config::$root);
        }
    }

    public function logOut()
    {
        $_SESSION['user'] = "";
        $_SESSION['islog'] = User::isNotlog;

        header('Location: ' . Config::$root);
    }

    #------------------------------
    #  INSCRIPTION (vue et ajout)
    #------------------------------
    public function signIn()
    {
        session_destroy();

        $this->set('title', 'inscription');
        $css = array('tooltip', 'inscription');
        $this->set('css', $css);
        $this->render('view/inscription.php');
    }

    public function insertUser()
    {
        if (isset($_POST['submit-signin'])) { # accès interdit si on est pas passé par le submit-signin

            if ($_POST['email'] != "" && $_POST['password'] != "" && $_POST['confirmPassword'] != "" && $_POST['terms'] == "1") {

                $userManager = new UserManager();
                $user = new User($_POST);
                $reponse = $userManager->insertUser($user);

                $_SESSION['errorSign'] = null;

                if (is_bool($reponse)) {

                    if (!isset($_COOKIE['cookie']) && empty($_COOKIE['cookie'])) {
                        setcookie('cookie', '1', time() + (86400 * 30));
                    }
                    $_SESSION['justSign'] = true;
                    header("Location: " . Config::$root . "emailValidation");

                } else {

                    $_SESSION['errorSign'] = $reponse;
                    header('Location: ' . Config::$root . 'inscription');

                }

            } else {

                $_SESSION['errorSign'] = 'Il reste des champs à remplir.';
                header('Location: ' . Config::$root . 'inscription');

            }

        } else {

            header("HTTP/1.0 403");
            header('Location: ' . Config::$root);

        }

    }

    public function emailValidation()
    {
        $userManager = new UserManager();
        $userManager->email_validation();
        require_once 'view/validation.php';

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
                if (isset($_SESSION['user']) && $_SESSION['user']->getAccount_status() == 1) {
                    $assetManager = new AssetManager();
                    # passer ici les valeurs des champs des radios pour la vue
                    $types = $assetManager->getAll('type');
                    $qualities = $assetManager->getAll('quality');

                    if (isset($types) && isset($qualities)) {

                        $this->set('css', array('insert-asset'));
                        $this->set('title', 'Ajouter un matériel');
                        $this->set('types', $types);
                        $this->set('qualities', $qualities);
                        $this->render('view/ajout.php');
                    } else {
                        throw new Exception('Problème sur la récupération des tables.');
                    }
                } else {
                    throw new Exception('Le compte doit être activé avant de pouvoir ajouter du matériel');
                }
            } else {
                header('Location: ' . Config::$root . 'donner');
            }
        } else {
            header('Location: ' . Config::$root . 'donner');
        }
    }


    public function insertAsset()
    {

        if (isset($_POST['submit-asset'])) {

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
                                        $_SESSION['lastAsset'] = $asset;
                                        header('location:success');
                                    }
                                }
                            } else {
                                throw new Exception('Certains champs (ou tous) sont vides.');
                            }
                        } else {
                            throw new Exception('Aucun formulaire envoyé.');
                        }
                    } else {
                        header('Location: ' . Config::$root);
                    }
                } else {
                    header('Location: ' . Config::$root);
                }
            } else {
                header('Location: ' . Config::$root);
            }
        } else {
            header('Location: ' . Config::$root);
        }

    }

    public function successInsertAsset()
    {
        if (isset($_SESSION['lastAsset']) && !empty($_SESSION['lastAsset'])) {
            # une requête est ajoutée ici pour récupérer des infos sur le bénéficiaire
            # les obtenir à partir du $asset renvoyé dans le manager
            # demanderait de modifier la structure de la table asset
            $userManager = new UserManager();
            $userInfos = $userManager->getUserInfos($_SESSION['lastAsset']->getIdUser());

            $this->set('title', 'Succès de la transaction');
            $css = array('success');
            $this->set('css', $css);
            $this->set('userInfos', $userInfos);
            $this->render('view/success.php');
            unset($_SESSION['lastAsset']);
        } else {
            header('Location: ' . Config::$root . 'donner');
        }
    }


    #--------------
    #  WELCOME PAGE
    #--------------

    public function welcome()
    {
        if (isset($_SESSION['islog']) AND $_SESSION['islog']) {
            header('Location: ' . Config::$root . 'donner');
        } else {
            $this->set('title', 'Bienvenue');
            $css = array('welcome');
            $this->set('css', $css);
            $this->render('view/welcome.php');
        }
    }

    #--------------
    #  ERREUR 404
    #--------------
    public function notFound()
    {

        $this->set('css', array('standard'));
        $this->set('title', 'Tu t\'es perdu');

        $this->render('view/notfound.php');
    }

    #--------------
    #  EXCEPTIONS
    #--------------
    public function error()
    {
        $this->set('css', array('standard'));
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
            require_once ROOT . DS . 'view' . DS . 'template.php';
            $this->rendered = true;
        } else {
            throw new Exception('Problème d\'affichage de la page. Contactez le webmestre.');
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
    function erreur($coderror, $errorMessage)
    {
        header("HTTP/1.0 " . $coderror);
        $this->set('errorMessage', $errorMessage);
        $this->render('view/erreur.php');
    }

    #---------------------------------
    #  COURRIER (ENVOI ET VALIDATION)
    #---------------------------------
    function sendEmailValidation()
    {

        if (isset($_SESSION['user']) && !empty($_SESSION)) {
            if (isset($_SESSION['justSign']) && $_SESSION['justSign'] == true) {

                unset($_SESSION['justSign']);
                $_SESSION['emailResend'] = 0;

                //Load Composer's autoloader
                require 'vendor/autoload.php';

                $userManager = new UserManager();
                $userManager->sendEmailValidation();
                $this->set('title', 'Validation');
                $css = array('validation');
                $this->set('css', $css);
                $this->render('view/validation.php');
            } else {
                http_response_code(403);
                header('Location: ' . Config::$root);
            }
        } else {
            http_response_code(403);
            header('Location: ' . Config::$root);
        }
    }

    function getEmailValidation($code)
    {
        if (isset($code) && !empty($code)) {
            $userManager = new UserManager();
            $response = $userManager->getEmailValidation($code);
                $this->set('title', 'Activation');
                $css = array('validation');
                $this->set('css', $css);
                $this->set('response', $response);
            if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
                $_SESSION['user']->setAccount_status('1');
            }
                $this->render('view/activation.php');

        } else {
            throw new Exception('erreur');
        }
    }
    public function sendSecondEmailValidation() {
        //Load Composer's autoloader

        if (isset($_SESSION['emailResend']) && $_SESSION['emailResend'] == 0) {
            $_SESSION['emailResend'] += 1;
            require 'vendor/autoload.php';

            $userManager = new UserManager();
            $userManager->sendEmailValidation();
            $this->set('title', 'Validation');
            $css = array('validation');
            $this->set('css', $css);
            $this->render('view/validation.php');
            unset($_SESSION['emailResend']);
        }
        else {
            throw new Exception('Si le problème persiste contacter un organisateur');
        }
    }
}
