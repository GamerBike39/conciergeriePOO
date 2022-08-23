<?php
namespace App\Controllers;

use App\Core\Form;
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
      $annonces = $annoncesModel->findBy(array("actif" => 0));
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

    /**
     * ajouter une annonce si l'utilisateur est connecté
     */
    public function ajouter()
    {
      // on vérifie si l'utilisateur est connecté
      if(isset($_SESSION['user']) && !empty($_SESSION['user']['id']))
      {
        // l'utilisateur est connecté
        // on vérifie si le formulaire est complet
        if(Form::validate($_POST, ['titre', 'description']))
        {
          // le formulaire est complet
          // on se protège des failles XSS
          // strip tags, htmlentities, htmlspecialchars
          $titre = strip_tags($_POST['titre']);
          $description = strip_tags($_POST['description']);

          // on instancie le modèle
          $annonce = new AnnoncesModel();

          // on hydrate l'objet avec les données du formulaire
          $annonce -> setTitre($titre)
                   -> setDescription($description)
                   -> setUsers_id($_SESSION['user']['id']);
          // on enregistre l'annonce dans la bdd
          $annonce -> create();
          // on redirige
          $_SESSION['message'] = "L'annonce a bien été ajoutée";
          header("Location: /");
          exit;
        } 



        $form = new Form;
        $form   -> debutForm()
                -> ajoutLabefFor('titre', 'Titre de l\'annonce :')
                -> ajoutInput('text', 'titre', ['id' => 'titre', 'class' => 'form-control', 'placeholder' => 'Votre titre', 'required'])
                -> ajoutLabefFor('description', 'Description de l\'annonce :')
                -> ajoutTextarea('description', '', ['id' => 'description', 'class' => 'form-control', 'placeholder' => 'Votre description' , 'required'])
                -> ajoutBouton('Ajouter', ['class' => 'btn btn-primary'])
                ->finForm();

                $this->render('annonces/ajouter', ['form'=>$form->create()]);
           
      }else {
        // l'utilisateur n'est pas connecté
        $_SESSION['erreur'] = "Vous devez être connecté pour accèder à cette page";
        header("Location: /users/login");
        exit;
      }
    }

}