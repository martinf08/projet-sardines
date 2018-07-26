<?php

class UserManager extends Model
{

    public function getUser()
    {
        /* pseudocode
        req = dbConnect().query() */
    }


    public function insertUser(User $user)
    {


        $errors = array();
        //email check
        if (filter_var($user->getEmail(), FILTER_VALIDATE_EMAIL === false)) {
            $errors[] = "email non valide";
        }


        if (empty($errors)) {

            $email = htmlentities($user->getEmail());

            // user check
            if ($this->UserChecker($user->getEmail())) {
                echo "This email already exists";
            } else {
                // password check
                if ($user->getPassword() === $user->getConfirmPassword()) {

                    $reponse = $this->identifierChecker($this->identiferGenerator());

                    if ($reponse) {
                        echo "identifier déjà utilisé";
                    } else {

                        $data = array(
                            'email' => $user->getEmail(),
                            'password' => $user->getPassword(),
                            'identifier' => $this->identiferGenerator()
                        );
                        $this->saveData($data);

                        return true;
                    }

                } else {
                    echo "mot de passe non identique";
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

        $character_set_array = array();
        $character_set_array[] = array('count' => 2, 'characters' => 'abcdefghijklmnopqrstuvwxyz');
        $character_set_array[] = array('count' => 2, 'characters' => '0123456789');
        $temp_array = array();

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

        $_SESSION['user'] = "";
        if ($user->getPassword() != null && filter_var($user->getEmail(), FILTER_VALIDATE_EMAIL)) {

            $conx = $this->userConnection(array(
                'email' => $user->getEmail(),
                'password' => $user->getPassword()
            ));

            if (empty($conx)) {
                echo('Identifiant ou mot de passe incorrect');
                return false;
            } else {

                $user->setId_user($conx['id_user']);
                $user->setStaff($conx['staff']);
                $_SESSION['user'] = $user;
                return true;
            }
        }

    }

    public function send_validation(User $user)
    {
        $email = $user->getEmail();
        $code = md5(uniqid(rand(), true));
        $req = $this->dbConnect()->prepare('UPDATE `user` SET account_status= :code WHERE email= :email');
        $req->bindParam(':code', $code);
        $req->bindParam(':email', $email);
        if ($req->execute()) {
            $destinataire = $email;
            $sujet = 'Validation compte, Les Sardines';
            $message = '<html>';
            $message .= '<head><title>Titre du message</title></head>';
            $message .= '<body>';
            $message .= '<p>Bonjour !<br>Pour valder votre email <a href="http://localhost/projet-sardines/php/validation.php?=' . $code . '"><button>Cliquez ici</button></a></p>';
            $message .= '<body>';
            $message .= '</html>';
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
            mail($destinataire, $sujet, $message, $headers);
            $req->close();
        }
    }

    public function email_validation(User $user)
    {
        if (!empty($_GET['code'])) {
            $code = htmlspecialchars($_GET['code']);
            $req = $this->dbConnect()->prepare('SELECT activation_code FROM `user` WHERE activation_code = :code');
            $req->bindParam(':code', $code);
            $req->execute();
            if ($req->fetch()['activation_code'] != false) {
                $email = $user->getEmail();
                $reqActivation = $this->dbConnect()->prepare("UPDATE `user` SET account_status= '1' WHERE email = :email ");
                $reqActivation->bindParam(':email', $email);
                $reqActivation->execute();
                echo 'Compte activé';
            } else {
                throw new Exception('Le code ne correspond pas');
            }

        }

    }

    /**------------fin de la classe ------------------ */
}