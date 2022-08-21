<?php

namespace App\Controllers;
use App\Core\Form;
use App\Models\UsersModel;

class UsersController extends Controller
{
    /**
     * identification de l'utilisateur
     */
    public function login()
    {
        // on vérifie si le formulaire est complet
        if(form::validate($_POST, ['email', 'password']))
        {
            // lz formulaire est complet
            // on va chercher dans la bdd l'utilisateur avec l'email rentré
            $usersModel = new UsersModel;
            $userArray = $usersModel->findOneByEmail(strip_tags($_POST['email']));

            // si l'utilisateur n'existe pas
            if(!$userArray)
            {
                // on envoie un message de session
                $_SESSION['erreur'] = "L'adresse email et/ou le mot de passe est incorrect";
                header("Location: /users/login");
                exit;
            }

            // l'utilisateur existe
            $user = $usersModel -> hydrate($userArray);

            // on vérifie le mot de passe
            if(password_verify($_POST['password'], $user->getPassword()))
            {
                // le mot de passe est bon
                $user->setSession();
                header("Location: /");
                exit;

            } else 
            {
                // le mot de passe est incorrect
                $_SESSION['erreur'] = "L'adresse email et/ou le mot de passe est incorrect";
                header("Location: /users/login");
                exit;

            }

        }

        $form = new Form();
        $form   -> debutForm()
                -> ajoutLabefFor('email', 'E-mail :')
                -> ajoutInput('email', 'email', ['id' => 'email', 'class' => 'form-control', 'placeholder' => 'Votre e-mail', 'required' => true])
                -> ajoutLabefFor('pass', 'Mot de passe :')
                -> ajoutInput('password', 'password', ['id' => 'password', 'class' => 'form-control', 'placeholder' => 'Votre mot de passe'])
                -> ajoutBouton("Se connecter", ['class' => 'btn btn-primary'])
                ->finForm();

        $this->render('users/login', ['loginForm' => $form->create()]);
    }

    /**
     * Inscription des utilisateurs
     * @return void
     */
    public function register() {

        // on vérifie si le formulaire est valide
        if(form::validate($_POST, ['email','password'])) 
        {   // le formulaire est valide 
            // on nettoie l'adresse email
            $email = strip_tags($_POST['email']);
            // on chiffre le mot de passe 
            $pass = password_hash($_POST['password'], PASSWORD_ARGON2I);
            // on hydrate l'utilisateur
            $user = new UsersModel();
            $user->setEmail($email);
            $user->setPassword($pass);
            // on stock l'utilisateur
            $user -> create();
        }

        $form = new Form();
        $form   -> debutForm()
                -> ajoutLabefFor('email', 'E-mail :')
                -> ajoutInput('email', 'email', ['id' => 'email', 'class' => 'form-control', 'placeholder' => 'Votre e-mail', 'required' => true])
                -> ajoutLabefFor('pass', 'Mot de passe :')
                -> ajoutInput('password', 'password', ['id' => 'pass', 'class' => 'form-control', 'placeholder' => 'Votre mot de passe'])
                -> ajoutBouton("S'inscrire", ['class' => 'btn btn-primary'])
                ->finForm();
        $this->render('users/register', ['registerForm' => $form->create()]);
    }


    /**
     * Déconnexion de l'utilisateur
     * @return exit
     */
    public function logout()
    {
        // on détruit la session
        session_destroy();
        // on redirige l'utilisateur vers la page d'accueil
        header('Location: '.$_SERVER['HTTP_REFERER']);
        exit;
    }
}