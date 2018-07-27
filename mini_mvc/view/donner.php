<h1>
    <?php 
        if(!empty($_SESSION['user'])){echo'Bonjour '.$_SESSION['user']->getEmail();
            echo'<h3>Bienvenue dans votre nouvel espace Sardines</h3>';
        }else{ echo"<h3>Page d'accueil</h3>";}
    ?>
</h1>

<h1>Je suis pret à dovenir chiche des sardines</h1>
<h2>Pas vous </h2>