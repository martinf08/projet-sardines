<h1>
    <?php 
        if(!empty($_SESSION['user'])){echo'Bonjour '.$_SESSION['user']->getEmail();
            echo'<h3>Bienvenue dans votre nouvel espace Sardines</h3>';
        }else{ echo"<h3>Page d'accueil</h3>";}
    ?>
</h1>

<h1>tu es pret à devenir riche en sardines</h1>
<p>Alors donne !!!!!</p>