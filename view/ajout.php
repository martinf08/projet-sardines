<main>
    <!--    <div id="basket-bar"></div>-->

    <!-- Main -->
    <div class="view">
        <div class="header">
            <div class="logo">
                <div id="open2"> <!-- le burger pour ouvrir le menu -->
                </div>
                <img src="images/pictos/logo_text_3.svg" alt="Les Sardines">
                <div></div>
            </div>
            <div class="blue uper bold" id="first-new-asset">
                nouvelle saisie
            </div>


        </div>

        <form action="insertAsset" method="post" id="insert-asset">


            <p id="step1" class="flex-center step">Etape 1 : Saisir l'ID du festivalier ou le code générique</p>
            <p class="flex-center">(0000 si aucun bénéficiaire)</p>

            <div class="flex-center">
                <input type="text" class="input" name="iduser" id="iduser" placeholder="identifiant">
            </div>

            <div id="responseUser">
                <img id="logoResponse" class="logoResponse">
                <p class="flex-center" id="error-id"></p>
            </div>

    </div>
    <div class="view">
        <p id="step2" class="flex-center step">Etape 2 : Choisir le type de matériel</p>
        <!-- LES RADIOS TYPE -->
        <?php
        $i = 1
        ?>
        <?php foreach ($types as $type):
            if ($i % 2 == 1) {
                echo '<div class="flex-center">';
            }
            # formatage du name pour en faire un identifiant en camelCase
            $cssID = explode(' ', $type['name']);
            $cssID = array_map(function ($x) {
                return ucfirst($x);
            }, $cssID);
            $cssID = lcfirst(implode('', $cssID));
            ?>
            <div class="item-button">
                <input type="radio"
                       id="<?php echo $cssID ?>"
                       name="idtype"
                       value="<?php echo $type['id_type'] ?>">
                <button class="btn-white" name="<?php echo $cssID ?>"></button>
                <p class="label-type"><?= $type['name']; ?></p>
            </div>

            <?php
            if ($i % 2 == 0) {
                echo '</div>';
            }
            $i++;
            ?>
        <?php endforeach; ?>
    </div>

    <div class="view">
        <p class="flex-center step">Etape 3 : Précisez l'état du matériel</p>
        <br> <!-- LES RADIOS QUALITE -->
        <div class="flex-center">
            <?php foreach ($qualities as $quality):
                # en l'état actuel, pas de formatage du label nécessaire pour les qualités
                ?>
                <div class="item-button2">
                    <input type="radio"
                           id="<?php echo $quality['label'] ?>"
                           name="idquality"
                           value="<?php echo $quality['id_quality'] ?>">
                    <button class="btn-white2" name="<?php echo $quality['label'] ?>"></button>
                    <p><?php
                        $label = $quality['label'];
                        if ($label == 'mauvaise') {
                            $label = 'mauvais';
                        }
                        else if ($label == 'bonne') {
                            $label = 'bon';
                        }
                        else if ($label == 'excellente') {
                            $label = 'excellent';
                        }
                        echo $label;

                        ?></p>
                </div>

            <?php endforeach; ?>
        </div>
        <br/> <!-- détails sur l'état du matos -->
        <div class="flex-center">
            <textarea class="flex-center" name="description" id="details" cols="30" rows="10"
                      placeholder="Commentaire..."></textarea>

        </div>
        <div id="submit-ajout">
            <div class="flex-center btn-outlined">
                <input class="btn-outlined-txt" name="submit-asset" type="submit" id="submit-asset" value="Valider">
            </div>
        </div>


    </div>
    </form>
</main>

<script src="js/insert_asset_process.js"></script>
