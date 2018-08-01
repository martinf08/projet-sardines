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
            <div>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus feugiat lectus a felis rutrum tincidunt. Nunc quis lectus a neque condimentum tempus id sed lectus. Curabitur consequat eleifend iaculis. Suspendisse quam purus, sollicitudin eu hendrerit sed, auctor quis orci. Nam facilisis massa purus, id luctus mi pretium sit amet. In pretium ornare faucibus. Maecenas mattis efficitur eros, id dignissim orci. ligula molestie venenatis nec ut magna. In tristique quam odio, vitae lobortis leo eleifend at.
                </p>
            </div>
        </div>
        <div class="slider-item" id="slider-2">
            <div>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus feugiat lectus a felis rutrum tincidunt. Nunc quis lectus a neque condimentum tempus id sed lectus. Curabitur consequat eleifend iaculis. Suspendisse quam purus, sollicitudin eu hendrerit sed, auctor quis orci. Nam facilisis massa purus, id luctus mi pretium sit amet. In pretium ornare faucibus. Maecenas mattis efficitur eros, id dignissim orci. ligula molestie venenatis nec ut magna. In tristique quam odio, vitae lobortis leo eleifend at.
                </p>
            </div>
        </div>
        <div class="slider-item" id="slider-3">
            <div>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus feugiat lectus a felis rutrum tincidunt. Nunc quis lectus a neque condimentum tempus id sed lectus. Curabitur consequat eleifend iaculis. Suspendisse quam purus, sollicitudin eu hendrerit sed, auctor quis orci. Nam facilisis massa purus, id luctus mi pretium sit amet. In pretium ornare faucibus. Maecenas mattis efficitur eros, id dignissim orci. ligula molestie venenatis nec ut magna. In tristique quam odio, vitae lobortis leo eleifend at.
                </p>
            </div>
        </div>
        <div class="slider-item" id="slider-4">
            <div>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus feugiat lectus a felis rutrum tincidunt. Nunc quis lectus a neque condimentum tempus id sed lectus. Curabitur consequat eleifend iaculis. Suspendisse quam purus, sollicitudin eu hendrerit sed, auctor quis orci. Nam facilisis massa purus, id luctus mi pretium sit amet. In pretium ornare faucibus. Maecenas mattis efficitur eros, id dignissim orci. ligula molestie venenatis nec ut magna. In tristique quam odio, vitae lobortis leo eleifend at.
                </p>
            </div>
        </div>
        <div class="slider-item" id="slider-5">
            <div>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus feugiat lectus a felis rutrum tincidunt. Nunc quis lectus a neque condimentum tempus id sed lectus. Curabitur consequat eleifend iaculis. Suspendisse quam purus, sollicitudin eu hendrerit sed, auctor quis orci. Nam facilisis massa purus, id luctus mi pretium sit amet. In pretium ornare faucibus. Maecenas mattis efficitur eros, id dignissim orci. ligula molestie venenatis nec ut magna. In tristique quam odio, vitae lobortis leo eleifend at.
                </p>
            </div>
        </div>
        <div class="slider-item" id="slider-6">
            <div>
                <h2>
                   DONNE !
                </h2>
            </div>
        </div>
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


