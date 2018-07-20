<?php

class UserManager extends Model
{

    public function getUser()
    {
        /* pseudocode
        req = dbConnect().query() */
    }

    public function getAllUsers()
    {

    }

    public function insertUser()
    {

        $db = $this->dbConnect();
        //the form has been submitted with post
        if ($_SERVER["REQUEST_METHOD"] == "POST") {


            // vérification des mots de passe
            if ($_POST['password'] === $_POST['confirmPassword']{

                $email = $_POST['email'];
            $username = $_POST['username'];
            $avatar = $_POST['avatar'];

            $sql = "
        SELECT * From users 
        WHERE email= :email
        LIMIT 1
        ";
            $objetPDO = $db->prepare($sql)
        $objetPDO->execute([':email' => $email]);
        
        //Retourne le nombre de lignes effacées ++
        if ($objetPDO->rowCount()) {
            // cet email exigiste déjà
            $_SESSION['message'] = 'cet email existe déjà';
        } else {

            $sql = "";
            //md5 hash password for security
            $password = sha1($_POST['password']);

            //path were our avatar image will be stored
            $avatar_path = $_FILES['avatar']['name'];
            //make sure the file type is image
            if (preg_match("!image!", $_FILES['avatar']['type'])) {

                //copy image to images/ folder
                if (copy($_FILES['avatar']['tmp_name'], $avatar_path)) {
                    //set session variables to display on welcome page
                    //$_SESSION['username']=--> unique ID
                    $_SESSION['email'] = $email;
                    $_SESSION['avatar'] = $avatar_path;

                    //insert user data into database
                    $sql = "INSERT INTO users (username,email, password, avatar) VALUES (:username,:email, :password, :avatar_path:)";

                    //check if mysql query is successful
                    $query = $db->prepare($sql);

                    $query = $query->excecute([':username' => $username,
                        ':email' => $email,
                        ':password' => $password,
                        ':avatar' => $avatar
                    ]);

                    if ($query === true) {
                        send_validation($email);
                        $_SESSION['message'] = "Inscription réussi!!";
                        //redirect the user to welcome.php
                        header("location: welcome.php");
                    } else {
                        $_SESSION['message'] = "Ajouté impossible à la base de données!";
                    }
                    $db = null;
                } else {
                    die("pas de fichier");
                    $_SESSION['message'] = "Échec du téléchargement du fichier!";
                }
            } else {

                $_SESSION['message'] = "S'il vous plaît seulement télécharger des images GIF, JPG ou PNG!";
            }
        } 
      }else{
                $_SESSION['message'] = "les deux mots de passe ne correspondent pas!!";
            }
    }
    }
  
    
    
  
