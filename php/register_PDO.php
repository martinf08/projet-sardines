<?php /* register_validation.php */

session_start();
$_SESSION['message'] = '';
function autoload_class($class)
{
    include $class . '.php';
}

spl_autoload_register('autoload_class');
/*$conn = new ConnectDB();*/
//get $db --> pdo


//the form has been submitted with post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // vérification des mots de passe
    if (prepare($_POST['password']) == prepare($_POST['confirmPassword']) {
        
        $email = prepare($_POST['email']);
        $sql = 'SELECT * From users WHERE email="' . $email . '"';
        $objetPDO = $db->prepare($sql)
        $objetPDO->execute();
        
        //Retourne le nombre de lignes effacées ++
        if($objetPDO->rowCount()){
            // cet email exigiste déjà
            $_SESSION['message'] = 'cet email existe déjà';
        }else{
            
            $sql = "";
            //md5 hash password for security
            $password = prepare(sha1($_POST['password']));
            
            //path were our avatar image will be stored
            $avatar_path = prepare($_FILES['avatar']['name']);
            //make sure the file type is image
            if (preg_match("!image!", $_FILES['avatar']['type'])) {
                
                //copy image to images/ folder
                if (copy($_FILES['avatar']['tmp_name'], $avatar_path)){
                    //set session variables to display on welcome page
                    //$_SESSION['username']=--> unique ID
                    $_SESSION['email'] = $email;
                    $_SESSION['avatar'] = $avatar_path;
                    
                    //insert user data into database
                    $sql = "INSERT INTO users (username,email, password, avatar) VALUES ('$username','$email', '$password', '$avatar_path')";
                    //check if mysql query is successful
                    if ($db->prepare($sql) === true){
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
        } }else{
            $_SESSION['message'] = "les deux mots de passe ne correspondent pas!!";
        }
    }
    ?>