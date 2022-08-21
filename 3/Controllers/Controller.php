<?php
namespace App\Controllers;

abstract class Controller{

public function render(string $fichier, array $donnees = [] )
{
    // on extrait le contenu de $donnees
    extract($donnees);

    // on démarre le buffer de sortie
    ob_start();
    // à partir d'ici toute sortie est conservée en mémoire
 
    
    // on créé le chemin vers la vue
    require_once ROOT . '/Views/' . $fichier . '.php';
    // ça prends le buffer et le stock dans la variable contenu
    $contenu = ob_get_clean();

    // template de page qui utilise la variable $contenu
    require_once ROOT.'/Views/default.php';
}
}
?>