<?php
require_once 'controller/Controller.php';
$ctrl = new Controller; 
/* 
j'ai fait une classe Controller pour tout avoir en objet mais on aurait aussi bien pu avoir un fichier controller.php contenant simplement des fonctions.
Il faut imaginer que tout comme le Manager, le Controller peut avoir des controllers héritiés sur un plus gros projet, et là il faut passer par des classes. 
*/

# dans l'index une structure de contrôle sur $_GET['url'] fera office de router (quelle vue on demande au controller)
# c'est le fichier htaccess qui permet d'obtenir cette variable $_GET['url']

if(isset($_GET['url'])) {
  # ici, parser l'url en /action/paramètres
  # par exemple /test/2 (2 = l'id qu'on cible)
  $url = explode('/', $_GET['url']);
  $action = $url[0];
  # j'ai écris le rewrite de manière à ce que '/paramètre' soit facultatif, donc il faut contrôler son existence
  $param = isset($url[1]) ? $url[1] : NULL;
  # attention, si on se trompe est qu'on tape 'test/' en url, le param ne sera pas NULL à cause du / en trop

  if($action == 'test') {
    # on peut appeler la vue test dans le controller, avec ou sans paramètre (tapez 'test' ou 'test/2' dans l'url)
    if(isset($param)) $ctrl->test($param);
    else $ctrl->test();
  } else if($action == 'index.php') {
    echo "<h1>index par défaut</h1>";
  } else {
    echo "euh, je crois que tu t'es perdu. Où est ta maman ?";
  }
}
