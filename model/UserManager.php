<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class UserManager extends Model
{

    public function getUser($identifier)
    {
        $sql = "SELECT * FROM `user` WHERE `identifier` = :identifier";
        $req = $this->dbConnect()->prepare($sql);
        $req->bindParam(':identifier', $identifier);
        $req->execute();
        $req->setFetchMode(PDO::FETCH_ASSOC);

        return $req->fetch();
    }

    # utilisée pour la page success.php
    public function getUserInfos($id)
    {
        $sql = "SELECT nickname, identifier FROM `user` WHERE `id_user` = :id";
        $req = $this->dbConnect()->prepare($sql);
        $req->bindParam(':id', $id);
        $req->execute();
        $req->setFetchMode(PDO::FETCH_ASSOC);

        return $req->fetch();
    }

    public function insertUser(User $user)
    {

        //session_destroy();
        $_SESSION['user'] = "";
        $errors           = array();
        //email check
        if (filter_var($user->getEmail(), FILTER_VALIDATE_EMAIL === false)) {
            $errors[] = "email non valide";
        }

        if (empty($errors)) {
            $email = htmlentities($user->getEmail());

            // user check
            if ($this->UserChecker($user->getEmail())) {
                return "Cet email existe déjà";
            } else {
                // password check
                if ($user->getPassword() === $user->getConfirmPassword()) {

                    $reponse = $this->identifierChecker($this->identiferGenerator());

                    if ($reponse) {
                        return "Identifier déjà utilisé";
                    } else {

                        $data = array(
                            'email'      => $user->getEmail(),
                            'password'   => $user->getPassword(),
                            'terms'      => $user->getTerms(),
                            'identifier' => $this->identiferGenerator()
                        );
                        $this->saveData($data);
                        $this->logIn($user);
                        $_SESSION['islog'] = true;

                        return true;
                    }

                } else {
                    return "Mots de passe non identiques";
                }
            }
        }

    }

    /**
     *  IdentiferGenerator
     *  4 characters : 2 Lettres and 2 numbers
     */
    public function identiferGenerator()
    {

        $character_set_array   = array();
        $character_set_array[] = array('count' => 2, 'characters' => 'abcdefghijklmnopqrstuvwxyz');
        $character_set_array[] = array('count' => 2, 'characters' => '0123456789');
        $temp_array            = array();

        foreach ($character_set_array as $character_set) {
            for ($i = 0; $i < $character_set['count']; $i++) {
                $temp_array[] = $character_set['characters'][rand(0, strlen($character_set['characters']) - 1)];
            }
        }
        shuffle($temp_array);

        return implode('', $temp_array);
    }


    /**
     * Login function
     */
    public function logIn(User $user)
    {

        if ($user->getPassword() != null && filter_var($user->getEmail(), FILTER_VALIDATE_EMAIL)) {
            $conx = $this->userConnection(array(
                'email'    => $user->getEmail(),
                'password' => $user->getPassword()
            ));
            $user = new User($conx);

            if (empty($conx)) {
                return false;
            } else {
                $_SESSION['user'] = $user;

                return true;
            }
        }

    }

    public function forgetPassword()
    {

    }

    public function getEmailUserByIdentifier(User $user)
    {
        $identifierUser = $user->getIdentifier();
        if ($identifierUser != null) {
            $req = $this->dbConnect()->prepare('SELECT email FROM user WHERE identifier = :id');
            $req->bindParam(':id', $identifierUser);
            $req->execute();
            $result = $req->fetch()['email'];
            if ($result) {
                return $result;
            }
        }

        return false;
    }

    public function getIdByIdentifier(User $user)
    {
        $identifierUser = $user->getIdentifier();
        if ($identifierUser != null) {
            $req = $this->dbConnect()->prepare('SELECT id_user FROM user WHERE identifier = :id');
            $req->bindParam(':id', $identifierUser);
            $req->execute();
            $result = $req->fetch()['id_user'];
            if ($result) {
                return $result;
            }
        }

        return false;
    }

    public function getEmailUser(User $user)
    {
        $emailUser = $user->getEmail();
        if ($emailUser != null) {
            $req = $this->dbConnect()->prepare('SELECT email FROM user WHERE email = :email');
            $req->bindParam(':email', $emailUser);
            $req->execute();
            $result = $req->fetch()['email'];
            if ($result) {
                return $result;
            }
        }

        return false;
    }

    public function updatePseudo(User $user)
    {
        $nickname = $user->getNickname();
        $id       = $user->getId_user();
        if (isset($id) && !empty($id) && isset($nickname)) { # nickname peut être vide
            $req = $this->dbConnect()->prepare('UPDATE `user` SET nickname = :nickname WHERE id_user = :id');
            $req->bindParam(':nickname', $nickname);
            $req->bindParam(':id', $id);
            $req->execute();
        }
    }


    public function sendEmailValidation()
    {
        try {
            $code  = md5(uniqid(rand(), true));
            $email = new \SendGrid\Mail\Mail();
            $email->setFrom("noreply@hackardennes.com");
            $email->setSubject("Validation de compte, les Sardines");
            $email->addTo($_SESSION['user']->getEmail());
            $mail    = $_SESSION['user']->getEmail();
            $message = '<html>';
            $message .= '<head><title>Activation compte Sardine</title></head>';
            $message .= '<body>';
            $message .= '<img src="' . Config::$server_address . '/images/pictos/logo_text_1.svg" alt="Les Sardines">';
            $message .= '<p>Bonjour !<br>Pour valder votre email <a href="' . Config::$server_address . '/emailActivation/' . $code . '"><button>Cliquez ici</button></a></p>';
            $message .= '<p>Si le bouton n\'apparaît pas cliquez sur le lien suivant : <a href="' . Config::$server_address . '/emailActivation/' . $code . '">' . Config::$server_address . '/emailActivation/' . $code . '</a></p>';
            $message .= '<body>';
            $message .= '</html>';
            $email->addContent("text/html", $message);
            $sendgrid = new \SendGrid(Config::$sendgrid_key);
            $req      = $this->dbConnect()->prepare('UPDATE `user` SET account_status= :code WHERE email= :email');
            $req->bindParam(':code', $code);
            $req->bindParam(':email', $mail);
            if ($req->execute()) {
                $response = $sendgrid->send($email);
                /* print $response->statusCode() . "\n";
                 print_r($response->headers());
                 print $response->body() . "\n";*/
            }
        } catch (Exception $e) {
            echo 'Une erreur est survenue';
            //echo 'Caught exception: ' . $e->getMessage() . "\n";
        }
    }

    public function getEmailValidation($code)
    {
        if (isset($code) && !empty($code)) {
            $code = htmlspecialchars($code);
            $req  = $this->dbConnect()->prepare('SELECT account_status FROM `user` WHERE account_status = :code');
            $req->bindParam(':code', $code);
            $req->execute();
            if ($req->fetch()['account_status'] != false && $req->fetch()['account_status'] != '1') {
                $reqActivation = $this->dbConnect()->prepare("UPDATE `user` SET account_status= '1' WHERE account_status = :code");
                $reqActivation->bindParam(':code', $code);
                $reqActivation->execute();

                return 'Compte activé avec succès';
            } else if ($req->fetch()['account_status'] == '1') {
                throw new \Exception('Compte déjà activé');
            }
        } else {
            throw new \Exception('Une erreur s\'est produite lors de la vérification du code.');
        }
    }
  
    public function updateAvatar() 
    {
        if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
            if (isset($_FILES) and $_FILES['avatar']['error'] == 0) {
                $name     = $_FILES['avatar']['name'];
                $fileExt  = strtolower(end(explode('.', $name)));
                $allowExt = ['bmp', 'tiff', 'jpeg', 'gif', 'png', 'jpg'];
                $testExt  = false;

                $dossier = $_SERVER['DOCUMENT_ROOT'] . Config::$root . '/images/avatar/';
                foreach ($allowExt as $element) {
                    if ($element == $fileExt) {
                        $testExt = true;
                    }
                }
                if ($testExt == true) {
                    $newFilmName = $_SESSION['user']->getIdentifier() .'.'. $fileExt;
                    move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier . $newFilmName);
                } else {
                    throw new \Exception('L\'extension du fichier n\'est pas autorisé');
                }
            } else {
                throw new \Exception('Erreur');
            }
        } else {
            throw new \Exception('Erreur');
        }
    }
    /**------------fin de la classe ------------------ */
}
