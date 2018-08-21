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
                <div class="picto-slider"><img src="images/pictos/leaf.svg" alt=""></div> <!-- logo -->
            </div>
            <div class="slider-info-bottom">
                <div class="slider-txt">
                    <h2>Le Cabaret Vert, un festival de plus en plus vert !</h2>
                    <p>
                        Le Cabaret Vert met en place depuis presque 15 ans, une organisation éco-responsable :
                    </p>
                    <ul>
                        <li>Tri des déchets</li>
                        <li>Centre de tri temporaire sur le site</li>
                        <li>Charte de restauration durable</li>
                        <li>Valorisation des producteurs locaux</li>
                        <li>Information et sensibilisation sur les grands enjeux environnementaux</li>
                    </ul>
                </div>
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
                <div class="picto-slider"><img src="images/pictos/reuse.svg" alt=""></div> <!-- logo -->
            </div>
            <div class="slider-info-bottom">
                <div class="slider-txt">
                    <h2>Sur le camping, l’environnement c’est aussi l’affaire de tous !</h2>
                    <p>
                        Trier et recycler ses déchets présentent de nombreux avantages. :
                    </p>
                    <ul>
                        <li>Préservation des ressources naturelles,</li>
                        <li>Économie d’énergie,</li>
                        <li>Charte de restauration durable</li>
                        <li>amélioration de la propreté d’un site qui est utilisé le reste de l’année par la population.</li>
                    </ul>
                </div>
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
                <div class="picto-slider"><img src="images/pictos/magic.svg" alt=""></div> <!-- logo -->
            </div>
            <div class="slider-info-bottom">
            <div class="slider-txt">
                <h2>L’application les sardines : donnez une seconde vie à votre matériel de camping.</h2>
                <p>
                    Sur le camping, rien ne se perd, tout se transforme.
                    Avec l’application les Sardines, votre matériel de camping (tentes, matelas, chaises) retrouve de nouvelles valeurs.
                </p>
                <p>
                    Ne jetez plus, échanger votre matériel contre des Sardines !
                </p>
                <div class="align-btn">
                    <button class="btn-full-donation" id="start">C'est parti !</button>
                </div>
            </div>
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


