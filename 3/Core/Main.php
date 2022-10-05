<?php

namespace App\Core;

use App\Controllers\MainController;
/**
 * Routeur principal
 */
class Main
{
    public function start()
    {
        // on démarrre la session, on est sur qu'ici c'est le premier endroit ou il sera actif, On aura ensuite accès à la variable super glogbale $_SESSION
        session_start();

        // on retire le "trailing slash"  éventuel de l'url
        // on récupère l'url
        $uri = $_SERVER['REQUEST_URI'];
     
        // on vérifie que uri n'est pas vide et se termine par un /
        if(!empty($uri) && $uri != '/' && $uri[-1] === '/'){
            // Dans ce cas on enlève le /
            $uri = substr($uri, 0, -1);
        
            // On envoie une redirection permanente
            http_response_code(301);
        
            // On redirige vers l'URL dans /
            header('Location: '.$uri);
            exit;
       }
         

        // on gère les paramètres de l'url
        // p=controlleur/methode/parametres
       //on sépare les paramètres dans un tableau 

       $params = explode('/', $_GET['p']);

         if($params[0] !== ""){
            // on a au moins un paramètre
            // on récupère le nom du controlleur à instancier
            // on met une majuscule en première lettre, on ajoute le namespace complet avant et on ajoute le controlleur après.
            $controller = '\\App\\Controllers\\'.ucfirst(array_shift($params)).'Controller';

            // on instancie le controlleur 
            $controller = new $controller();
            // on récupère le 2e paramètre de l'url
            $action = isset($params[0]) ? array_shift($params) : 'index';
            // est-ce que le controlleur possède cette méthode ?
            if(method_exists($controller, $action)){
            //    si il passe des paramètres on les passe à la méthode
            // (isset($params[0])) ? $controller->$action($params) : $controller->$action();      
            (isset($params[0])) ? call_user_func_array([$controller, $action], $params): $controller->$action();      
            }
            else {
                // on affiche une erreur 404
               http_response_code(404);
               echo "la page recherché n'existe pas";
            }

         }else{
            // on n'a pas de paramètres
            // on instancie le controlleur par défaut
            $controller = new MainController;
            // on appelle la méthode index
            $controller->index();
         }
    }
}