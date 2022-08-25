<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\TachesModel;
use App\Models\AnnoncesModel;

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