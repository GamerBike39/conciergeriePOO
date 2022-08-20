<?php
namespace App\Controllers;

use App\Models\AnnoncesModel;

class AnnoncesController extends Controller
{
    /**
     * Cette méthode affichera une page listant toutes les annonces de la base de données
     *
     * @return void
     */
    public function index()
    {     
      // include_once ROOT . '/Views/Annonces/index.php';
      // on instancie le modèle correspondant à la table annonces pour pouvoir l'utiliser dans la vue
       $annoncesModel = new AnnoncesModel();
      // on va chercher toutes les annonces.
      $annonces = $annoncesModel->findBy(array("actif" => 1));
      $this->render('annonces/index',compact('annonces'));
       
    }
}