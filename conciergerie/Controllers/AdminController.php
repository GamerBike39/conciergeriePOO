<?php

namespace App\Controllers;

use App\Core\Form;
use App\Models\UsersModel;
use App\Models\TachesModel;
use App\Models\Model;

class AdminController extends Controller 
{
    public function index()
    {
    // on vérifie que l'on est admin
    if($this->isAdmin())
    {
        $this->render('admin/index', [], "admin");
    } 
    
    }

    /**
     * affiche la liste des taches sous forme de tableau
     *
     * @return void
     */
    public function taches()
    {
        if($this->isAdmin()){
            $tachesModel = new TachesModel();
            $taches = $tachesModel->findAll();
            $this->render('admin/taches', compact('taches'), "admin");
            // compact évite les tableaux associatifs
        }
    }

    /**
     * Supprime une tache si l'on est admin
     *
     * @return void
     */
    public function supprimeTache(int $id)
    {
        if($this->isAdmin()){
            $tache = new TachesModel();
            $tache->delete($id);
            header('Location: '.$_SERVER['HTTP_REFERER']);
           
        }
    }

    /**
     * trier par étages
     */
    public function etage(int $etage)
    {
        if($this->isAdmin()){
            $tachesModel = new TachesModel();
            $taches = $tachesModel->findBy(array("etage" => $etage));
            $this->render('admin/taches', compact('taches'), "admin");
        }
      }

    /**
     * trier par appart
     */
    public function appart(int $appart)
    {
        if($this->isAdmin()){
            $tachesModel = new TachesModel();
            $taches = $tachesModel->findBy(array("appart" => $appart));
            $this->render('admin/taches', compact('taches'), "admin");
        }
    }

    /**
     * trier par type de tache
     * @param string $type
     * @return void
     */
    public function type(string $type)
    {
        if($this->isAdmin()){
            $tachesModel = new TachesModel();
            $taches = $tachesModel->findBy(array("type_tache" => $type));
            $this->render('admin/taches', compact('taches'), "admin");
        }
    }

    /**
     * trier par date
     */
    public function date(string $date)
    {
        if($this->isAdmin()){
            $tachesModel = new TachesModel();
            $taches = $tachesModel->findByDate($date);
            $this->render('admin/taches', compact('taches'), "admin");
        }
    }

    /**
     * choisir date
     *
     * @param string $date
     * @return void
     */
    public function choixDate(string $date)
    {
        if($this->isAdmin()){
            $date = strip_tags($_POST['date']);
            $tachesModel = new TachesModel();
            $tachesModel ->setDate($date);
            $tachesModel ->create();
            $form = new Form();
            $form   -> debutForm()
                    ->ajoutLabefFor('date', 'Date')
                    -> ajoutInput('date', 'date', ['id' => 'date', 'class' => 'form-control', 'placeholder' => 'choisissez une date', 'value' => $date])
                    -> ajoutBouton('choisir', ['class' => 'btn btn-primary'])
                    ->finForm();
            $taches = $tachesModel->findByDate($date);
            $this->render('admin/taches', compact('taches'), "admin");
        }
    }
      
  
      /**
     * ajouter une tache si l'admin est connecté
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
            header("Location: /admin/taches");
            exit;
          } else {
            // le formulaire est incomplet
            $_SESSION['erreur'] = !empty($_POST['erreur']) ? "Le formulaire est incomplet" : '';
            $date = isset($_POST['date']) ? strip_tags($_POST['date']) : '';
        
            $desc_tache = isset($_POST['desc_tache']) ? strip_tags($_POST['desc_tache']) : '';
            $appart = isset($_POST['appart']) ? strip_tags($_POST['appart']) : '';
            $etage = isset($_POST['etage']) ? strip_tags($_POST['etage']) : '';
          }
  
  
  
          $form = new Form;
          $form   -> debutForm()
          -> ajoutLabefFor('date', 'date de l\'annonce :')
          -> ajoutInput('date', 'date', ['id' => 'date', 'class' => 'form-control', 'placeholder' => 'date', 'required' => 'required', 'value' => $date])
          -> ajoutLabefFor('type_tache', 'Type de la tache:')
          -> ajoutSelect('type_tache', ['reparation'=> 'reparation','changement' => 'changement','assistance'=> 'assistance', 'autre'=>'autre'])
          -> ajoutLabefFor('description', 'Description de la tache :')
          -> ajoutTextarea('description', '', ['id' => 'description', 'class' => 'form-control', 'placeholder' => 'Votre description' , 'required' => 'required', 'value' => $desc_tache])
            -> ajoutLabefFor('appart', 'Appartement :')
            -> ajoutInput('number', 'appart', ['id' => 'appart', 'class' => 'form-control', 'placeholder' => 'Appartement', 'required' => 'required', 'value' => $appart])
            -> ajoutLabefFor('etage', 'Etage :')
            -> ajoutInput('number', 'etage', ['id' => 'etage', 'class' => 'form-control', 'placeholder' => 'Etage', 'required' => 'required', 'value' => $etage])
          -> ajoutBouton('Ajouter', ['class' => 'btn btn-primary'])
          ->finForm();

                
  
                  $this->render('/admin/ajouter', ['form'=>$form->create()], "admin");
             
        }else {
          // l'utilisateur n'est pas connecté
          $_SESSION['erreur'] = "Vous devez être connecté pour accèder à cette page";
          header("Location: /users/login");
          exit;
        }
    }


    /**
     * modifier une tache si l'admin est connecté
     */
    public function modifier(int $id)
    {
      if(isset($_SESSION['user']) && !empty($_SESSION['user']['id']))
    {
        // on va vérifier si l'annonce existe dans la base.
        // on instancie notre modèle
        $tachesModel = new TachesModel();
        // on va chercher l'annonce
        $tache = $tachesModel->find($id);
        // si l'annonce n'existe pas on retourne à la liste des annonces.
        if(!$tache)
        {
          http_response_code(404);
          $_SESSION['erreur'] = "La tache recherchée n'existe pas";
          header("Location: /taches");
          exit;
        }

        // est ce que l'annonce appartient à l'utilisateur ?  on vérifie si il est propriétaire de l'annonce ou admin
        if($tache->resident_id !== $_SESSION['user']['id']){
            if (!in_array('ROLE_ADMIN' , $_SESSION['user']['roles']))
            { 
              $_SESSION['erreur'] = "Vous n'avez pas le droit d'accèder à cette page";
              header("Location: /taches");
              exit;
            }
        
        }

        // on traite le formulaire 
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
          $tachesModel
                      -> setDate($date)
                      -> setType_Tache($type_tache)
                      -> setDesc_Tache($desc_tache)
                      -> setAppart($appart)
                      -> setEtage($etage)
                      -> setResident_id($_SESSION['user']['id']);
          // on enregistre l'annonce dans la bdd
          $tachesModel->create();
          // on redirige
          $_SESSION['message'] = "L'annonce a bien été modifiée";
          header("Location: /admin/taches");
          exit;
        }


        // on crée le formulaire
        $form = new Form;
          $form   -> debutForm()
          -> ajoutLabefFor('date', 'date de l\'annonce :')
          -> ajoutInput('date', 'date', ['id' => 'date', 'class' => 'form-control', 'placeholder' => 'date', 'required' => 'required', 'value' => $tache->date])
          -> ajoutLabefFor('type_tache', 'Type de la tache:')
          -> ajoutInput('text', 'type_tache', ['id' => 'type_tache', 'class' => 'form-control', 'placeholder' => 'Nature de la tache', 'required' => 'required', 'value' => $tache->type_tache])
          -> ajoutLabefFor('description', 'Description de la tache :')
          -> ajoutInput('description', 'desc_tache', ['id' => 'description', 'class' => 'form-control', 'placeholder' => 'Votre description' , 'required' => 'required', 'value' => $tache->desc_tache])
            -> ajoutLabefFor('appart', 'Appartement :')
            -> ajoutInput('number', 'appart', ['id' => 'appart', 'class' => 'form-control', 'placeholder' => 'Appartement', 'required' => 'required', 'value' => $tache->appart])
            -> ajoutLabefFor('etage', 'Etage :')
            -> ajoutInput('number', 'etage', ['id' => 'etage', 'class' => 'form-control', 'placeholder' => 'Etage', 'required' => 'required', 'value' => $tache->etage])
          -> ajoutBouton('Ajouter', ['class' => 'btn btn-primary'])
          ->finForm();

                $this->render('admin/modifier', ['form'=>$form->create()], "admin");


      }else {
        // l'utilisateur n'est pas connecté
        $_SESSION['erreur'] = "Vous devez être connecté pour accèder à cette page";
        header("Location: /users/login");
        exit;
      }
    }


    


    /**
     * afficher tout les utilisateurs
     */
    public function users()
    {
        if($this->isAdmin()){
            $usersModel = new UsersModel();
            $users = $usersModel->findAll();
            $this->render('admin/users', compact('users'), "admin");
        }
    }

    /**
     * Supprime un user si l'on est admin
     *
     * @return void
     */
    public function supprimeUser(int $id)
    {
        if($this->isAdmin()){
            $user= new UsersModel();
            $user->delete($id);
            header('Location: '.$_SERVER['HTTP_REFERER']);
           
        }
    }


    /**
     * verifie si l'on est admin 
     */
    private function isAdmin()
    {
        // on vérifie si on est connecté et si "ROLE_ADMIN" est dans le tableau des roles de l'utilisateur
        if(isset($_SESSION['user']) && in_array('ROLE_ADMIN', $_SESSION['user']['roles']))
        {
            // on est admin
            return true;
        } else {
            // on n'est pas admin
            $_SESSION['erreur'] = "Vous n'avez pas accès à cette zone";
            header("Location: /");
            exit;
        }
    }


}