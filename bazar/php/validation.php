<?php
/**
 * Created by PhpStorm.
 * User: utilisateur
 * Date: 29/06/18
 * Time: 16:17
 */
function autoload_class($class)
{
    include $class . '.php';
}

spl_autoload_register('autoload_class');

//?code=60169551c8be6bd3523327b2f6089148
function email_validation()
{
    //If code exists
    if (!empty($_GET['code'])) {
        $code = htmlspecialchars($_GET['code']);
        //Connexion
        $conn = new ConnectDB();
        //Query
        $sql = 'SELECT * FROM users WHERE activation="' . $code . '"';
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
                $sql = 'UPDATE users SET activation="1" WHERE activation="' . $code . '"';
                if (mysqli_query($conn, $sql)) {

                    echo 'Compte Activé';
                }
            }
        }
    }

}
email_validation();
