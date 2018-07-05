<?php /* register_validation.php */

session_start();
$_SESSION['message'] = '';
function autoload_class($class)
{
    include $class . '.php';
}

spl_autoload_register('autoload_class');
$conn = new ConnectDB();
var_dump($_FILES);
//the form has been submitted with post
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // vérification des mots de passe
    if ($_POST['password'] == $_POST['confirmPassword']) {

        $email = $conn->real_escape_string($_POST['email']);

        // vérifier si l'email exist
        $sql = 'SELECT * From users WHERE email="' . $email . '"';

        if ($result = mysqli_query($conn, $sql)) {
            $rescount = mysqli_num_rows($result);
            if ($rescount > 0){
                // cet email exigiste déjà
                $_SESSION['message'] = 'cet email existe déjà';
            } else {
                $sql = "";
                //md5 hash password for security
                $password = sha1($_POST['password']);

                //path were our avatar image will be stored
                $avatar_path = $conn->real_escape_string('images\\' . $_FILES['avatar']['name']);
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
                        if ($conn->query($sql) === true){
                            send_validation($email);
                            $_SESSION['message'] = "Inscription réussi!!";
                            //redirect the user to welcome.php
                            header("location: welcome.php");
                        } else {
                            $_SESSION['message'] = "Ajouté impossible à la base de données!";
                        }
                        $conn->close();
                    } else {
                        die("pas de fichier");
                        $_SESSION['message'] = "Échec du téléchargement du fichier!";
                    }
                } else {
                    
                    $_SESSION['message'] = "S'il vous plaît seulement télécharger des images GIF, JPG ou PNG!";
                }
            }
        }
    }else{
        $_SESSION['message'] = "les deux mots de passe ne correspondent pas!!";
    }
}

function send_validation($email)
{
    $conn = new ConnectDB();
    $code = md5(uniqid(rand(), true));
    $sql = 'UPDATE users SET activation="' . $code . '" WHERE email="' . $email . '"';
    if (mysqli_query($conn, $sql)) {

        // Adresse email du destinataire
        $destinataire = $email;

        // Titre de l'email
        $sujet = 'Validation';

        // Contenu du message de l'email
        $message = '<html>';
        $message .= '<head><title>Titre du message</title></head>';
        $message .= '<body>';
        $message .= '<p>Bonjour !<br>Pour valder votre email <a href="http://localhost/projet-sardines/php/validation.php?='. $code .'"><button>Cliquez ici</button></a></p>';
        $message .= '<body>';
        $message .= '</html>';

        // Pour envoyer un email HTML, l'en-tête Content-type doit être défini
        $headers = 'MIME-Version: 1.0'."\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8'."\r\n";

        // Fonction principale qui envoi l'email
        mail($destinataire, $sujet, $message, $headers);
        $conn->close();
    }
}

