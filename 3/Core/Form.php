<?php
namespace App\Core;

class Form
{
    private $formCode = "";


    /**
     * Genère le formulaire HTML
     *
     * @return string
     */
    public function create()
    {
        return $this->formCode;
    }

    // méthode de validation du form
    /**
     * valide si touts les champs proposés sont remplis
     *
     * @param array $form tableau issu du formulaire ($_POST ou $_GET)
     * @param array $champs tableau listant les champs obligatoires
     * @return bool
     */
   public static function validate(array $form, array $champs)
    {
        // on parcourt les champs
        foreach ($champs as $champ) {
            // Si le champ est absent ou vide dans le formulaire
            if (!isset($form[$champ]) || empty($form[$champ])) {
                // on sort en retournant False
                return false;
            }
        }
        // si on arrive ici, c'est que le formulaire est valide
        return true;
    }

    /**
     * Ajoute les attributs envoyé à la balise du formulaire
     * @param array $attributs Tableau associatifs ["class" => 'form-control', 'required" => true]
     * @return string
     */
    private function ajoutAttributs(array $attributs): string
    {
        // on initialise la chaine de caractères
        $str = "";

        // on liste les attributs "courts"
        $courts = ['checked', 'readonly', 'disabled', 'multiple', 'required', 'autofocus','novalidate', 'formnovalidate'];

        // on boucle sur le tableau d'attributs $courts
        foreach ($attributs as $attribut => $valeur)
        {
            // on vérifie si l'attribut est danas la liste des attributs courts et est true
            if (in_array($attribut, $courts) && $valeur == true)
            {
            $str .= " $attribut";
            } else {
                // on ajoute l'attribut et sa valeur
                $str .= " $attribut='$valeur'";
            }
        }

        return $str;

    }

        /**
         * balise d'ouverture du formulaire
         *
         * @param string $methode méthode du formulaire (post ou get) par défaut post
         * @param string $action action du formulaire
         * @param array $attributs attributs du formulaire
         * @return Form
         */
        public function debutForm(string $methode = "post", string $action ="#", array $attributs = []): self
        {
            // on crée la balise <form>
            $this->formCode .= "<form action='$action' method='$methode'";
            // on ajoute les attributs éventuels
            $this->formCode .= $attributs ? $this->ajoutAttributs($attributs).'>' : '>';
            
            return $this;
        }

        /**
         * balise de fermeture du formulaire
         *
         * @return Form
         */
        public function finForm(): self
        {
            $this->formCode .= '</form>';
            return $this;
        }

            /**
         * Ajout d'un label
         * @param string $for 
         * @param string $texte 
         * @param array $attributs 
         * @return Form 
         */
        public function ajoutLabefFor(string $for, string $texte, array $attributs = []): self
        {
            // on ouvre la balise
            $this->formCode .= "<label for='$for'";
            // on ajoute les attributs 
            $this->formCode .= $attributs ? $this->ajoutAttributs($attributs) : '';
            // on ajoute le texte
            $this->formCode .= ">$texte</label>";
            // puis l'on retourne l'objet
            return $this;
        }

        /**
         * Ajout d'un input
         * @param string $name 
         * @param string $type 
         * @param array $attributs 
         * @return Form 
         */
        public function ajoutInput(string $type, string $nom, array $attributs = []): self
        {
            // on ouvre la balise
            $this->formCode .= "<input type='$type' name='$nom'";
            // on ajoute les attributs et la fermeture
            $this->formCode .= $attributs ? $this->ajoutAttributs($attributs).'>' : '>';
            return $this;
        }

        /**
         * Ajout d'un textarea
         * @param string $name 
         * @param array $attributs 
         * @return Form 
         */
        public function ajoutTextarea(string $nom, string $valeur ='', array $attributs = []): self
        {
           // on ouvre la balise
           $this->formCode .= "<textarea name='$nom'";
           // on ajoute les attributs 
           $this->formCode .= $attributs ? $this->ajoutAttributs($attributs) : '';
           // on ajoute la valeur
           $this->formCode .= ">$valeur</textarea>";
           // puis l'on retourne l'objet
           return $this;
        }

        /**
         * Ajout d'un select
         * @param string $name 
         * @param array $options 
         * @param array $attributs 
         * @return Form 
         */
        public function ajoutSelect(string $nom, array $options, array $attributs = []): self
        {
            // on crée le select
            $this->formCode .= "<select name='$nom'";
            // on ajoute les attributs 
            $this->formCode .= $attributs ? $this->ajoutAttributs($attributs).'>' : '>';
            // on boucle sur les options
            foreach ($options as $valeur => $texte) {
                // on ouvre la balise option et on y ajoute les options
                $this->formCode .= "<option value='$valeur'>$texte</option>";
            }
            // on ferme la balise
            $this->formCode .= "</select>";
            // puis l'on retourne l'objet
            return $this;
        }

        /**
         * Ajout d'un bouton
         * @param string $texte 
         * @param array $attributs 
         * @return Form 
         */
        public function ajoutBouton(string $texte, array $attributs = []): self
        {
            // on crée la balise
            $this->formCode .= "<button";
            // on ajoute les attributs 
            $this->formCode .= $attributs ? $this->ajoutAttributs($attributs) : '';
            // on ajoute le texte
            $this->formCode .= ">$texte</button>";
            // puis l'on retourne l'objet
            return $this;
        }
}