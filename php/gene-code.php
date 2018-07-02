<?php
/**
 * Created by PhpStorm.
 * User: utilisateur
 * Date: 29/06/18
 * Time: 16:08
 */

function autoload_class($class)
{
    include $class . '.php';
}
spl_autoload_register('autoload_class');

require('validation.php');

function email_validation($email)
{
    //Generation du code
    $hash_validation = md5(uniqid(rand(), true));
    //Connexion
    $conn = new ConnectDB();
    //Query
    $sql = 'SELECT * FROM users WHERE email="' . $email . '"';
    //storage in var the query function
    $result = mysqli_query($conn, $sql);
    //If result is different to null
    if (mysqli_num_rows($result) > 0) {
        //travels the result
        while ($row = mysqli_fetch_assoc($result)) {
            //Cut the white space
            if ($row['activation'] != "") {
                //storage link activation in var
                $link = $row['activation'];
            }
        }
        //if link exist and not empty
        if (isset($link) && !empty($link)) {

        }
    }

}

email_validation('test2@test.fr');
