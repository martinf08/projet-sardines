# projet-sardines

## Configuration
Pour configurer la base de donnée il faut créer un fichier Config.php dans mini_mvc/class qui contiendra ceci
class Config {
  public static $config = array(
                            'host'=> 'nom du serveur',
                            'db'=> 'nom de la bdd',
                            'username'=> 'le username',
                            'password'=> 'le mdp'
                          );
}
