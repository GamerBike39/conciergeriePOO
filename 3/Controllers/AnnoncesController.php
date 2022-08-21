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

    /**
     * Cette méthode affichera une page listant toutes les annonces de la base de données
     * @param int $id Id de l'annonce
     * @return void
     */
    public function lire(int $id)
    {
    //  on instancie le modèle
    $annoncesModel = new AnnoncesModel();

    // on va chercher l'annonce correspondant à l'id
    $annonce = $annoncesModel->find($id);

    // on envoie à la vue
    $this->render('annonces/lire', compact('annonce'));

    }
}