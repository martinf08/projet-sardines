# projet-sardines

Application inspirée du projet gagnant du hackathon #HackCV17, organisé en immersion sur le Festival Cabaret Vert en 2017 par l'association HackArdennes.
HackArdennes accompagne en 2018 une équipe de la fabrique de développeurs Simplon Charleville dans la refonte de cette appli.
Son lancement sera présenté lors du Festival Cabaret Vert 2018.

*@HackArdennes*
*@Simplon08*


La présente application sera exploitée au festival du Cabaret Vert de Charleville-Mézières pour inciter les festivaliers-campeurs à échanger leur matériel de camping contre un token intitulé 'sardine' plutôt que de laisser ce matériel à l'abandon à la fin du festival.

Ce projet a pour fonction de pouvoir enregistrer du nouveau matériel et de créditer en retour les utilisateurs échangeant ce matériel.
Seul un utilisateur admin ou un utilisateur staff aura accès au formulaire d'ajout.

Chaque asset sera évalué selon un type et une qualité (voir la structure de la base de donnée), au résultat de cette évaluation il lui sera attribué une valeur en 'sardines' basée sur un tableau de valeurs prédéfinis dans la base de donnée.

## Configuration

### BDD 
Importer le fichier structure.sql dans phpmyadmin puis le fichier fixtures.sql pour remplir les tables avec les valeurs prédéfinies.

### Accès BDD
Pour configurer l'accès à la base de donnée, remplir le fichier class/Config.php.dist avec les bonnes valeurs et supprimer l'extension '.dist'.

L'email assigné dans $ghost devra correspondre à un ghost-user inséré dans la base de donnée.

### Navigation
On peut redéfinir le chemin de la racine du site dans la variable statique $root dans le fichier Config.php. De cette manière, la redirection sur l'index fonctionnera quel que soit le type d'hôte et de chemins utilisés.