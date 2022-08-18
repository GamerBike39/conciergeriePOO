<?php

namespace App\Banque;
use App\Client\Compte as CompteClient;

/**
 * Classe Compte Bancaire (hérite de Compte) on récupère tout par héritage avec extends.
 */
class CompteCourant extends Compte
{
    private $decouvert;

    /**
     * Constructeur CompteCourant
     * @param CompteClient $compte compte client du compte
     * @param float $montant Solde du compte à l'ouverture
     * @param float $decouvert Decouvert autorisé
     */
    public function __construct(CompteClient $compte, float $montant, float $decouvert)
    {
        // on transfère les informations nécessairees au constructeur de Compte
        // on envoie les informations au parent
        parent::__construct($compte, $montant);

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