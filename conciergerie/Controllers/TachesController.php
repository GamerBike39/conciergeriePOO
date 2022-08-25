<?php

namespace App\Controllers;
use App\Core\Form;
use App\Models\TachesModel;

class TachesController extends Controller
{
    /**
     * liste des taches
     */
    public function index()
    {
        $tachesModel = new TachesModel;
        $taches = $tachesModel->findAll();
        $this->render('taches/index', compact('taches'));
    }

    /**
     * voir par id
     */
    public function lire(int $id)
    {
        $tachesModel = new TachesModel;
        $tache = $tachesModel->find($id);
        $this->render('taches/lire', compact('tache'));
    }

    /**
     * ajouter une tache
     */
    public function ajouter()
    {
        // on vérifie si l'utilisateur est connecté
        if(isset($_SESSION['user']) && !empty($_SESSION['user']['id']))
        {
          // l'utilisateur est connecté
          // on vérifie si le formulaire est complet
          if(Form::validate($_POST, ['date', 'type_tache', 'desc_tache','appart','etage']))
          {
            // le formulaire est complet
            // on se protège des failles XSS
            // strip tags, htmlentities, htmlspecialchars
            $date = strip_tags($_POST['date']);
            $type_tache = strip_tags($_POST['type_tache']);
            $desc_tache = strip_tags($_POST['desc_tache']);
            $appart = strip_tags($_POST['appart']);
            $etage = strip_tags($_POST['etage']);

            // on instancie le modèle
            $tachesModel = new TachesModel;
  
            // on hydrate l'objet avec les données du formulaire
            $tachesModel-> setDate($date)
                        -> setType_Tache($type_tache)
                        -> setDesc_Tache($desc_tache)
                        -> setAppart($appart)
                        -> setEtage($etage)
                        -> setResident_id($_SESSION['user']['id']);
            // on enregistre l'annonce dans la bdd
            $tachesModel->create();
            // on redirige
            $_SESSION['message'] = "L'annonce a bien été ajoutée";
            header("Location: /");
            exit;
          } else {
            // le formulaire est incomplet
            $_SESSION['erreur'] = !empty($_POST['erreur']) ? "Le formulaire est incomplet" : '';
            $date = isset($_POST['date']) ? strip_tags($_POST['date']) : '';
            $type_tache = isset($_POST['type_tache']) ? strip_tags($_POST['type_tache']) : '';
            $desc_tache = isset($_POST['desc_tache']) ? strip_tags($_POST['desc_tache']) : '';
            $appart = isset($_POST['appart']) ? strip_tags($_POST['appart']) : '';
            $etage = isset($_POST['etage']) ? strip_tags($_POST['etage']) : '';
          }
  
  
  
          $form = new Form;
          $form   -> debutForm()
          -> ajoutLabefFor('date', 'date de l\'annonce :')
          -> ajoutInput('date', 'date', ['id' => 'date', 'class' => 'form-control', 'placeholder' => 'date', 'required' => 'required', 'value' => $date])
          -> ajoutLabefFor('type_tache', 'Type de la tache:')
          -> ajoutInput('text', 'type_tache', ['id' => 'type_tache', 'class' => 'form-control', 'placeholder' => 'Nature de la tache', 'required' => 'required', 'value' => $type_tache])
          -> ajoutLabefFor('description', 'Description de la tache :')
          -> ajoutInput('description', 'desc_tache', ['id' => 'description', 'class' => 'form-control', 'placeholder' => 'Votre description' , 'required' => 'required', 'value' => $desc_tache])
            -> ajoutLabefFor('appart', 'Appartement :')
            -> ajoutInput('number', 'appart', ['id' => 'appart', 'class' => 'form-control', 'placeholder' => 'Appartement', 'required' => 'required', 'value' => $appart])
            -> ajoutLabefFor('etage', 'Etage :')
            -> ajoutInput('number', 'etage', ['id' => 'etage', 'class' => 'form-control', 'placeholder' => 'Etage', 'required' => 'required', 'value' => $etage])
          -> ajoutBouton('Ajouter', ['class' => 'btn btn-primary'])
          ->finForm();

                
  
                  $this->render('taches/ajouter', ['form'=>$form->create()]);
             
        }else {
          // l'utilisateur n'est pas connecté
          $_SESSION['erreur'] = "Vous devez être connecté pour accèder à cette page";
          header("Location: /users/login");
          exit;
        }
    }
      
}