<?php
/**
 * Created by PhpStorm.
 * User: martin
 * Date: 26/07/18
 * Time: 10:41
 */


function send_validation($email)
{
    $servername = "";
    $username = "";
    $password = "!";
    $dbname = "";
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $code = md5(uniqid(rand(), true));
    $req = $conn->prepare('UPDATE `user` SET account_status= :code WHERE email= :email');
    $req->bindParam(':code', $code);
    $req->bindParam(':email', $email);
    if ($req->execute()) {
        $destinataire = $email;
        $sujet = 'Validation compte, Les Sardines';
        $message = '<html>';
        $message .= '<head><title>Titre du message</title></head>';
        $message .= '<body>';
        $message .= '<p>Bonjour !<br>Pour valder votre email <a href="http://simplon-charleville.fr/ftp-groupe/sardines/validation.php?code=' . $code . '"><button>Cliquez ici</button></a></p>';
        $message .= '<body>';
        $message .= '</html>';
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        mail($destinataire, $sujet, $message, $headers);

    }
    $req->closeCursor();
}
send_validation();//Definir email en parametre
