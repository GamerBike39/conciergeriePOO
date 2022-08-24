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
        } else {
          // le formulaire est incomplet
          $_SESSION['erreur'] = !empty($_POST['erreur']) ? "Le formulaire est incomplet" : '';
          $titre = isset($_POST['titre']) ? strip_tags($_POST['titre']) : '';
          $description = isset($_POST['description']) ? strip_tags($_POST['description']) : '';
          // ceci nous permet de garder les infomrations enregistrées dans le cas d'une erreur dans le remplissage du formulaire
        }



        $form = new Form;
        $form   -> debutForm()
                -> ajoutLabefFor('titre', 'Titre de l\'annonce :')
                -> ajoutInput('text', 'titre', ['id' => 'titre', 'class' => 'form-control', 'placeholder' => 'Votre titre', 'required' => 'required', 'value' => $titre])
                -> ajoutLabefFor('description', 'Description de l\'annonce :')
                -> ajoutTextarea('description', $description, ['id' => 'description', 'class' => 'form-control', 'placeholder' => 'Votre description' , 'required' => 'required'])
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

    /**
     * modifier une annonce
     */
    public function modifier(int $id)
    {
      if(isset($_SESSION['user']) && !empty($_SESSION['user']['id']))
      {
        // on va vérifier si l'annonce existe dans la base.
        // on instancie notre modèle
        $annoncesModel = new AnnoncesModel();
        // on va chercher l'annonce
        $annonce = $annoncesModel->find($id);
        // si l'annonce n'existe pas on retourne à la liste des annonces.
        if(!$annonce)
        {
          http_response_code(404);
          $_SESSION['erreur'] = "L'annonce recherchée n'existe pas";
          header("Location: /annonces");
          exit;
        }

        // est ce que l'annonce appartient à l'utilisateur ?  on vérifie si il est propriétaire de l'annonce
        if($annonce->users_id !== $_SESSION['user']['id'])
        {
          $_SESSION['erreur'] = "Vous n'avez pas le droit d'accèder à cette page";
          header("Location: /annonces");
          exit;
        }

        // on traite le formulaire 
        if(Form::validate($_POST, ['titre', 'description']))
        {
          // on se protège des failles XSS
          $titre = strip_tags($_POST['titre']);
          $description = strip_tags($_POST['description']);

          // on stocke l'annonce
          $annonceModif = new AnnoncesModel();

          // on hydrate l'objet 
          $annonceModif -> setId($annonce->id)
                        -> setTitre($titre)
                        -> setDescription($description);
          // on met à jour l'annonce
          $annonceModif -> update();

          // on redirige
          $_SESSION['message'] = "L'annonce a bien été modifiée";
          header("Location: /");
          exit;
        }


        // on crée le formulaire
        $form = new Form;
        $form   -> debutForm()
                -> ajoutLabefFor('titre', 'Titre de l\'annonce :')
                -> ajoutInput('text', 'titre', ['id' => 'titre', 'class' => 'form-control', 'placeholder' => 'Votre titre', 'required' => 'required', 'value' => $annonce->titre])
                -> ajoutLabefFor('description', 'Description de l\'annonce :')
                -> ajoutTextarea('description', $annonce->description, ['id' => 'description', 'class' => 'form-control', 'placeholder' => 'Votre description' , 'required' => 'required'])
                -> ajoutBouton('Modifier', ['class' => 'btn btn-primary'])
                ->finForm();

                $this->render('annonces/modifier', ['form'=>$form->create()]);


      }else {
        // l'utilisateur n'est pas connecté
        $_SESSION['erreur'] = "Vous devez être connecté pour accèder à cette page";
        header("Location: /users/login");
        exit;
      }
    }

}