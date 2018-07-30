<?php

class Controller
{
    /**
     * E2 -
     * $vars: cette variable permet de stocker temporairement des données
     *        destinées à  la vue
     */
    private $vars = array();

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

            $prefix = '../'; # petit cheat pour réparer les liens du menu dans cette vue

            require_once './view/profil.php';
        } else {
            header('Location: index');
        }
    }

    public function accountUpdate($post) # PAS ENCORE CODÉ
    {
        if (isset($_POST['submit-account'])) { # vérifie que le submit ayant le name convenu sur la vue profil existe

            $userManager = new UserManager();
            if (strtolower($userManager->getEmailUserByIdentifier($_SESSION['user']) == $_SESSION['user']->getEmail())) {
                if (isset($_POST['pseudo_account']) && !empty($_POST['pseudo_account'])) {
                    if (strtolower($userManager->getEmailUser($_SESSION['user'])) == strtolower($_SESSION['user']->getEmail())) {
                        $regex = "#[A-Za-z0-9àèìòùÀÈÌÒÙáéíóúýÁÉÍÓÚÝâêîôûÂÊÎÔÛãñõÃÑÕäëïöüÿÄËÏÖÜŸçÇßØøÅåÆæœ\-\_]{3,25}#";
                        if (preg_match($regex, $_POST['pseudo_account'])) {
                            $_SESSION['user']->setNickname($_POST['pseudo_account']);
                            $userManager->updatePseudo($_SESSION['user']);
                            header('Location: profil/'.$_SESSION['user']->getIdentifier());
                        }
                    }
                }
            }
        } else {
            header('Location: index');
        }
    }

    #-------------
    #  CONNEXION
    #-------------

    public function logView() 
    {

        $this->set('title', 'Connexion');
        $this->render('./view/connexion.php');
    }
    public function passForget($request = null){

        $error ="";
        $code_recover = false;
        $model = new UserManager();

    
        
  
        if (!isset($_POST['email_recuperation'])){

        }else{
            if(isset($_POST['recover_submit'],$_POST['email_recuperation'])){
                
                if(!empty($_POST['email_recuperation'])){
                    $email = htmlspecialchars($_POST['email_recuperation']);
                    if(filter_var($email,FILTER_VALIDATE_EMAIL)){
                        //check if the email exit
                        $user = $model->UserChecker($email);
                      
                        if($user){
                            $_SESSION['email_recuperation'] = $email;
                            $code = "";
                            $sending_code ="";
                            for($i=0; $i <8; $i++){
                                $sending_code .=  mt_rand(0,9);
                            }
                                debug($sending_code);
                                $code .= md5($sending_code);
                                $pre = $model->dbConnect()->prepare("SELECT id FROM recovery_password WHERE email = :email");
                                $pre->execute(array(':email'=> $email));
                                $reponse  = $pre->fetch(PDO::FETCH_ASSOC);

                            if($reponse){
                                $pre = $model->dbConnect()->prepare("UPDATE recovery_password SET code = :code WHERE email =:email");
                                $pre->execute(array(':code'=> $code,':email'=> $email));
                            }else{
                                $pre = $model->dbConnect()->prepare("INSERT INTO recovery_password(code,email) VALUES (?,?)");
                                $pre->execute(array($code,$email));
                            }
                           
    
                            $to = $_SESSION['email_recuperation'];
                            $subject = "Récupération de mot de passe";
                            
                            $message = "
                            <html>
                                <head>
                                    <title>HTML email</title>
                                </head>
                                <body>
                                    Cliquez sur <a href='http://localhost/projet-sardines/forget?section=code&code='.$code.'>ici</a>
                                    pour réinitialiser votre mot de passe
                                </body>
                            </html>
                            ";
                            
                            // Always set content-type when sending HTML email
                            $headers  = "MIME-Version: 1.0" . "\r\n";
                            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                            $headers .="content-Transfer-Encoding: 8bit";
                            // More headers
                            $headers .= 'From:"eudes"eudes<@ici08.fr>' . "\r\n";
                    
            
                            mail($to,$subject,$message,$headers);
                            //header(location );
                        }else{
                            $error = "Cette adresse email n'est pas enregistrée";
                        }

                    }else{
                        $error = "Adresse email non valide";
                    }
                }else{
                    $error ="Veuillez entrer votre adresse email";
                }  
            }
      
        }

        
        if(isset($request)){
         
            try{
                $request = md5(htmlspecialchars($request));
                $pre = $model->dbConnect()->prepare("SELECT id FROM recovery_password WHERE email = :email AND code =:code");
                $pre->bindParam(':email', $_SESSION['email_recuperation']);
                $pre->bindParam(':code',$request);
                $pre->execute();
                $reponse  = $pre->fetch(PDO::FETCH_ASSOC);
            debug($request);
            debug($_SESSION['email_recuperation']);

            }catch (Exception $e) {
                 debug($e);
            }
           
        
            if($reponse){
                $pre = $model->dbConnect()->prepare("UPDATE recovery_password SET confirm = 1  WHERE email = ?");
                $pre->execute(array($_SESSION['email_recuperation']));
                $code_recover = true;
            }else{
                $code_recover = false;
                $error = "Modification de mot de passe impossible"; 
            }
        }


        if(isset($_POST['submitNewpassword'])){
            if(isset($_POST['newPasseword'],$_POST['confirmNewpasseword'])){
                $newPasseword = htmlspecialchars($_POST['newPasseword']);
                $confirmNewpasseword = htmlspecialchars($_POST['confirmNewpasseword']);
                if(!empty($newPasseword) AND !empty($confirmNewpasseword)){
                    if($newPasseword === $confirmNewpasseword){
                        $newPasseword = md5($newPasseword);
                        //update
                        $pre = $model->dbConnect()->prepare("UPDATE user SET password= ? WHERE email = ?");
                        $pre->execute(array( $newPasseword,$_SESSION['email_recuperation']));
                        $pre = $model->dbConnect()->prepare("DELETE FROM recovery_password WHERE email = :email");
                        $pre->execute(array(':email'=>$_SESSION['email_recuperation']));
                         header("location: ../connexion");
                         die();
                    }else{
                        $error = "Vos deux mots de passe ne sont pas identiques";
                    }
                }else{
                    $error = "Veuiller remplir tous les champs";
                }

            }else{
                $error = "Veuiller remplir tous les champs";
            }
        }
            

        $this->set('title','forget');
        $this->set('errors',$error);
        $this->set('code_recover',$code_recover);
        $this->render('./view/forgotpassword.php');

    }

    public function logIn()
    {
        if (isset($_POST['email'])) { # est-ce que l'user est passé par le formulaire de logView ? sinon redirection
            if ($_POST['email'] != "" || $_POST['password'] != "") {

                $userManager = new UserManager(); // Création d'un objet
                $user = new User($_POST);
                $reponse = $userManager->logIn($user);

                if ($reponse) {
                    $_SESSION['islog'] = true;

                    $this->set('title', 'Les Sardines');
                    $this->render('./view/donner.php');
                } else {
                    $_SESSION['islog'] = false;

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
        $_SESSION['user'] = "";
        $_SESSION['islog'] = 0;

        header('Location: index');
        $this->set('title', 'index');
        $this->render('./view/index.php');
    }

    #------------------------------
    #  INSCRIPTION (vue et ajout)
    #------------------------------
    public function signIn()
    {
        session_destroy();

        $this->set('title','inscription');
        $this->set('css', 'tooltip');
        $this->render('./view/inscription.php');
    }

    public function insertUser()
    {
        if (isset($_POST['submit-signin'])) { # accès interdit si on est pas passé par le submit-signin
            if ($_POST['email'] != "" && $_POST['password'] != "" && $_POST['confirmPassword'] != "") {
                $userManager = new UserManager(); // Création d'un objet
                $user = new User($_POST);
                $reponse = $userManager->insertUser($user);

                if ($reponse) {
                    header("Location: connexion");
                    $this->set('title', 'Connexion');
                    $this->render('./view/connexion.php');

                } else {
                    throw new Exception('Impossible d\'ajouter l\'utilisateur !');
                }
            } else {
                 throw new Exception('Il reste des champs à remplir.');
            }
        } else {
            header('Location: index');
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
            echo 'Erreur lors de la validation';
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
    public function notFound()
    {
        echo 'ici, la vue pour page non trouvée';
    }

    /** E2
     * Cette fonction va nous permettre de de rendre dynamiquement des vues
     * et des données au templete.
     * la vue doit être passé en paramètre
     */
    public function render($view) # j'ai apporté cette modification pour injecter mon css sur inscription
    {

        if (file_exists($view)) {
            extract($this->vars);
            ob_start();
            require($view);
            $content = ob_get_clean();
            require_once 'view/template.php';
        } else {
            throw new Exception("la vue demandée n'existe pas");
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
}
