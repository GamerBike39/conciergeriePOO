<?php

namespace App\Controllers;
use App\Core\Form;

class UsersController extends Controller
{
    public function login()
    {
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
}