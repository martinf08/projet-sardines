<?php /* validate.php */

//the form has been submitted with post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // vérification des mots de passe
    if ($_POST['password'] == $_POST['confirmPassword']) {
        
        $email = $mysqli->real_escape_string($_POST['email']);

        //md5 hash password for security
        $password = cha1($_POST['password']);

        //path were our avatar image will be stored
        $avatar_path = $mysqli->real_escape_string('images/'.$_FILES['avatar']['name']);
        
        //make sure the file type is image
        if (preg_match("!image!",$_FILES['avatar']['type'])) {
            
            //copy image to images/ folder 
            if (copy($_FILES['avatar']['tmp_name'], $avatar_path)){
                
                //set session variables to display on welcome page
                //$_SESSION['username']=--> unique ID
                $_SESSION['email'] = $email;
                $_SESSION['avatar'] = $avatar_path;

                //insert user data into database
                $sql = 
                "INSERT INTO users (username,email, password, avatar) "
                . "VALUES ('$username',$email', '$password', '$avatar_path')";
                
                //check if mysql query is successful
                if ($mysqli->query($sql) === true){
                    $_SESSION['message'] = "Inscription réussi!!";
                    //redirect the user to welcome.php
                    header("location: welcome.php");
                }
                else {
                    $_SESSION['message'] = 'Ajouté impossible à la base de données!';
                }
                $mysqli->close();          
            }
            else {
                $_SESSION['message'] = 'Échec du téléchargement du fichier!';
            }
        }
        else {
            $_SESSION['message'] = "S'il vous plaît seulement télécharger des images GIF, JPG ou PNG!";
        }
    }
    else {
        $_SESSION['message'] = 'lest deux mots de passe ne correspondent pas!!';
    }
} 
