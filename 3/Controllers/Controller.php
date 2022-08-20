<?php
namespace App\Controllers;

abstract class Controller{

public function render(string $fichier, array $donnees = [] )
{
    // on extrait le contenu de $donnees
    extract($donnees);
    // on créé le chemin vers la vue
    require_once ROOT . '/Views/' . $fichier . '.php';
}
}
?>