<h1>
    <?php
    /*if(!empty($_SESSION['user'])){echo'Bonjour '.$_SESSION['user']->getEmail();
        echo'<h3>Bienvenue dans votre nouvel espace Sardines</h3>';
    }else{ echo"<h3>Page d'accueil</h3>";}*/
    # vue incomplète si on applique seulement ce code donc je réécris la page comme elle était avant
    ?>
</h1>

<?php $title = 'Les Sardines'; ?>

<?php ob_start(); ?>
<main>

    ici le contenu de <?= $title ?>
    <div class="slider">
        <div class="slider-item" id="slider-1">

        </div>
        <div class="slider-item" id="slider-2">
        </div>
        <div class="slider-item" id="slider-3">
        </div>
        <div class="slider-item" id="slider-4">
        </div>
        <div class="slider-item" id="slider-5">
        </div>
        <div class="slider-item" id="slider-6">
        </div>
        <div class="pointer" id="pointer-1"></div>
        <div class="pointer" id="pointer-2"></div>
        <div class="pointer" id="pointer-3"></div>
        <div class="pointer" id="pointer-4"></div>
        <div class="pointer" id="pointer-5"></div>
        <div class="pointer" id="pointer-6"></div>
    </div>
    <div class="slider-navigation">
        <div class="slider-navigation-item"></div>
        <div class="slider-navigation-item"></div>
        <div class="slider-navigation-item"></div>
        <div class="slider-navigation-item"></div>
        <div class="slider-navigation-item"></div>
        <div class="slider-navigation-item"></div>
    </div>
    <i class="arrow left" id="left-arrow"></i>
    <i class="arrow right" id="right-arrow"></i>
    <script src="js/slider.js"></script>
</main>
<?php $content = ob_get_clean(); ?>

<?php require_once 'view/template.php'; ?>


