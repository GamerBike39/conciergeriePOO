<?php
// elle est à la racine du dossiers classes à l'intérieur du même namespace
namespace App;

// https://www.php.net/manual/fr/function.spl-autoload-register.php
// Fonction qui est là pour détecter les classes nécessaires au chargement.
// Les méthodes Static sont là pour pouvoir les appeler sans les instancier
class Autoloader
{
 static function register()
 {
     spl_autoload_register(array(__CLASS__, 'autoload'));
 }

    static function autoload($class)
    {
        // on récupère dans $class la totalité du namespace de la classe concernée (App\Client\Compte)
        // on transforme en Client/Compte.php
        // on commence par retirer APP (Client\Compte)
        // on peut utiliser la constante magique __NAMESPACE__ qui contient le namespace de la classe courante
        // on échape l'antislash pour pouvoir avoir le \ seul.
        $class = str_replace(__NAMESPACE__ . '\\', '', $class);
        // on remplace les \ par des /
        $class = str_replace('\\', '/', $class);
        echo __DIR__ . '/' . $class . '.php';
        // on verifie si le fichier existe
        $fichier = __DIR__ . '/' . $class . '.php';
        if (file_exists($fichier)) {
            require $fichier;
        }
    }
}