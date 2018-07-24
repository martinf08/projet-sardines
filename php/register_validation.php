<?php /* register_validation.php */

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

