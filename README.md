# projet-sardines

*@HackArdennes*
*@Simplon08*

## Sur l'application

En 2017, l'association HackArdennes organisait le premier hackathon en immersion dans un festival, le Cabaret Vert, sur le thème du développement durable. L'équipe Les Sardines, remportait alors ce concours avec une application faisant la promesse de favoriser la remise à disposition de matériel de camping plutôt que l'abandonner ou même le détruire.

En 2018, une toute nouvelle école Simplon s'implantait dans les locaux du pôle formation de la CCI de Charleville-Mézières. Il n'en fallait pas moins pour que HackArdennes propose à ces nouveaux développeurs en devenir de développer concrètement cette application afin qu'elle soit testable en situation normale pour la prochaine édition du Cabaret Vert en 2018.

## Fonctionnement

La présente application sera exploitée au festival du Cabaret Vert de Charleville-Mézières pour inciter les festivaliers-campeurs à échanger leur matériel de camping contre un token intitulé 'sardine' plutôt que de laisser ce matériel à l'abandon à la fin du festival.

Ce projet a pour fonction de pouvoir enregistrer du nouveau matériel et de créditer en retour les utilisateurs échangeant ce matériel.
Seul un utilisateur admin ou un utilisateur staff aura accès au formulaire d'ajout.

Chaque asset sera évalué selon un type et une qualité (voir la structure de la base de donnée), au résultat de cette évaluation il lui sera attribué une valeur en 'sardines' basée sur un tableau de valeurs prédéfinis dans la base de donnée.

## Configuration

### Installation

Des fichiers d'intallations de dépendances sont présents.
Exécuter la commande `php composer.phar install`

Pour que fonctionne l'API Sendgrid, installer `sudo apt-get install php-curl` si ça n'est pas déjà fait.

### BDD 
Importer le fichier structure.sql dans phpmyadmin puis le fichier fixtures.sql pour remplir les tables avec les valeurs prédéfinies.

### Accès BDD
Pour configurer l'accès à la base de donnée, remplir le fichier class/Config.php.dist avec les bonnes valeurs et supprimer l'extension '.dist'.

L'email assigné dans $ghost devra correspondre à un ghost-user inséré dans la base de donnée avec pour identifier 0000.

### Service de courriel
Une clé d'API Sendgrid est nécessaire pour l'envoi de courriel. Cette clé doit être écrite, ainsi que l'adresse du serveur, dans Config.php.

### Navigation
On peut redéfinir le chemin de la racine du site dans la variable statique $root dans le fichier Config.php. De cette manière, la redirection sur l'index fonctionnera quel que soit le type d'hôte et de chemins utilisés.