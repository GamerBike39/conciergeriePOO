<?php

namespace App\Banque;

/**
 * Classe Compte Bancaire (hérite de Compte) on récupère tout par héritage avec extends.
 */
class CompteCourant extends Compte
{
    private $decouvert;

    /**
     * Constructeur CompteCourant
     * @param string $nom Titulaire du compte
     * @param float $montant Solde du compte
     * @param float $decouvert Decouvert autorisé
     */
    public function __construct(string $nom, float $montant, float $decouvert)
    {
        // on transfère les informations nécessairees au constructeur de Compte
        // on envoie les informations au parent
        parent::__construct($nom, $montant);

        // constrcuteur local
        $this->decouvert = $decouvert;
    }

    public function getDecouvert(int $montant){
        return $this->decouvert;
    }
    public function setDecouvert(int $montant): self
     {
        if($montant >= 0){
            $this->decouvert = $montant;
        }
        return $this;
    }

    /**
     * Méthode pour retirer un montant du compte
     * @param float $montant Montant à retirer
     * @return bool
     */
    public function retirer(float $montant)
    {
        // on vérifie si le découvert permet le retrait
        if ($montant > 0 && $this->solde - $montant >= -$this->decouvert) {
            $this->solde -= $montant;
        } else {
            echo "solde insuffisant";
        }
    }


}
?>