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

$hash_validation = md5(uniqid(rand(), true));
//?code="1fa13762a6b91360f8741330d15ed38d"
function email_validation()
{
    //If code exists
    if (!empty($_GET['code'])) {
        $code = $_GET['code'];
        //Connexion
        var_dump($code);
        $conn = new ConnectDB();
        //Query
        $sql = 'SELECT * FROM users WHERE activation="' . $code . '"';
        //storage in var the query function
        $result = mysqli_query($conn, $sql);
        var_dump($result);
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
                $sql = 'UPDATE users SET activation="" WHERE activation="' . $code . '"';
                if (mysqli_query($conn, $sql)) {

                    echo 'Compte Activé';
                }
            }
        }
    }

}

function send_validation(){

}

email_validation('test2@test.fr');
