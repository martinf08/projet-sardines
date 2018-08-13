<main>
<?php
if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {

    if (!isset($_COOKIE['cookie']) AND empty($_COOKIE['cookie'])) {
        ?>
        <div class="cookie">
            <p>En continuant la navigation sur les Sardines vous acceptez notre <a href="mentions-legales">politique de cookies</a></p>
            <button id="accept-cookie">accepter</button>

        </div>
    <?php
    }
}
?>
    <div class="slider">

        <div class="slider-item">
            <div class="logo">
               <div></div>
                <img src="images/pictos/logo_text_1.svg" alt="Les Sardines">
                <div></div>
            </div>
            <div class="slider-info-top">
                <div class="rond"></div> <!-- logo -->
            </div>
            <div class="slider-info-bottom">
                <p>
                    Salut Voyageur ! Chaque année, vous êtes environ 15 000 campeurs à être accueillis dans la joie et
                    la bonne humeur au Cabaret Vert. Malheureusement, à la fin du festival, beaucoup trop choisissent de repartir en laissant du matos à
                    l’abandon.
                </p>
                <div class="slider-bottom">
                    <img src="images/pictos/arrow_back.svg" alt="back" class="arrow-back">
                    <p class="page-info">1/3</p>
                    <img src="images/pictos/arrow_back.svg" alt="next" class="arrow-next">

                </div>
            </div>
        </div>

        <div class="slider-item">
            <div class="logo">
                <div></div>
                <img src="images/pictos/logo_text_1.svg" alt="Les Sardines">
                <div></div>
            </div>
            <div class="slider-info-top">
                <div class="rond"></div> <!-- logo -->
            </div>
            <div class="slider-info-bottom">
                <p>
                    Toi qui aspire à devenir un campeur éco-responsable, tu peux nous aider à éviter que le terrain du
                    Cabaret Vert ne se transforme en une poubelle géante, grâce à l’application Les Sardines. i tu comptes repartir sans ta tente, ta chaise, ton matelas, ou ton sac de couchage, tu peux nous
                    les apporter en échange de crédits appellés « les Sardines ».
                </p>
                <div class="slider-bottom">
                    <img src="images/pictos/arrow_back.svg" alt="back" class="arrow-back">
                    <p class="page-info">2/3</p>
                    <img src="images/pictos/arrow_back.svg" alt="next" class="arrow-next">
                </div>
            </div>
        </div>


        <div class="slider-item">
            <div class="logo">
                <div></div>
                <img src="images/pictos/logo_text_1.svg" alt="Les Sardines">
                <div></div>
            </div>
            <div class="slider-info-top">
                <div class="rond"></div> <!-- logo -->
            </div>
            <div class="slider-info-bottom">
                <p>
                    Tes Sardines seront utilisables pour obtenir du matos ou de quoi te rassasier lors des prochaines
                    éditions du Cabaret Vert. Pour éviter la pollution et le gaspillage inutile d’un matos encore tout à fait utilisable rien de
                    plus simple : inscris toi et profites des avantages des Sardines !
                </p>
                <div class="slider-bottom">
                    <img src="images/pictos/arrow_back.svg" alt="back" class="arrow-back">
                    <p class="page-info">3/3</p>
                    <img src="images/pictos/arrow_back.svg" alt="next" class="arrow-next">
                </div>
            </div>
        </div>
    </div>
    <script src="js/slider.js"></script>
</main>


