<?php
/**
 * Created by PhpStorm.
 * User: utilisateur
 * Date: 29/06/18
 * Time: 16:08
 */

$hash_validation = md5(uniqid(rand(), true));
echo '<a href="validation.php?url=' . $hash_validation . '"><button>Valider le compte</button></a>';
require('validation.php');