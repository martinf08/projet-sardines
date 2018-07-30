# projet-sardines
**Application née de la collaboration entre l'association HackArdennes et la fabrique de développeurs Simplon Charleville !**

La présente application sera exploitée au festival du Cabaret Vert de Charleville-Mézières pour inciter les festivaliers-campeurs à échanger leur matériel de camping contre un token intitulé 'sardine' plutôt que de laisser ce matériel à l'abandon à la fin du festival.

Ce projet a pour fonction de pouvoir enregistrer du nouveau matériel et de créditer en retour les utilisateurs échangeant ce matériel.
Seul un utilisateur admin ou un utilisateur staff aura accès au formulaire d'ajout.

Chaque asset sera évalué selon un type et une qualité (voir la structure de la base de donnée), au résultat de cette évaluation il lui sera attribué une valeur en 'sardines' basée sur un tableau de valeurs prédéfinis dans la base de donnée.

## Configuration

### BDD 
Importer le fichier structure.sql dans phpmyadmin (ou l'exécuter en SQL dans la base).

### Accès BDD
Pour configurer l'accès à la base de donnée, remplir le fichier class/Config.php.dist avec les bonnes valeurs et supprimer l'extension '.dist'.

L'email assigné dans $ghost devra correspondre à un ghost-user inséré dans la base de donnée.
