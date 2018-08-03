<?php

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


    public function insertUser(User $user)
    {

        session_destroy();
        $errors = array();
        //email check
        if (filter_var($user->getEmail(), FILTER_VALIDATE_EMAIL === false)) {
            $errors[] = "email non valide";
        }

        if (empty($errors)) 
        {
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
                            'email' => $user->getEmail(),
                            'password' => $user->getPassword(),
                            'identifier' => $this->identiferGenerator()
                        );
                        $this->saveData($data);

                        return true;
                    }

                } else {
                    return "mot de passe non identique";
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

        if ($user->getPassword() != null && filter_var($user->getEmail(), FILTER_VALIDATE_EMAIL)) {
            $conx = $this->userConnection(array(
                'email' => $user->getEmail(),
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
        $id = $user->getId_user();
        if (isset($id) && !empty($id) && isset($nickname) && !empty($nickname)) {
            $req = $this->dbConnect()->prepare('UPDATE `user` SET nickname = :nickname WHERE id_user = :id');
            $req->bindParam(':nickname', $nickname);
            $req->bindParam(':id', $id);
            $req->execute();
        }
    }
    /**------------fin de la classe ------------------ */
}
