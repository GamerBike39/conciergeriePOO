<?php

namespace App\Banque;

use App\Client\Compte as CompteClient;

// on le créé avec class
/**
 * objet Compte Bancaire. abstract pour ne pas pouvoir l'instancier directement
 */
abstract class Compte 
{
// propriétés
// Pour déclarer on va utiliser le mot clé public, par défaut les propriétés sont public 
/**
 * titulaire du compte
 * @var CompteClient
 */
private CompteClient $titulaire;

/**
 * solde du compte
 * @var float
 */
protected $solde;

// constantes
// ces propriétés ne sont pas accessible depuis l'instance elle même, mais uniquement depuis la classe.
/**
 * taux_interet
 * @var float
 */
private const TAUX_INTERETS = 0.5;

// méthodes
    /**
     * Constructeur magique de la classe Compte
     * @param CompteCLient $compte compte du Titulaire du compte
     * @param float $montant Solde du compte
     */
    public function __construct(CompteClient $compte, float $montant = 100)
    {
        // on attribue le nom à la propriété titulaire de l'instance créée
        // this se réfère à l'instance courante, c'est l'objet que l'on utilise
        $this->titulaire = $compte;
        $this->solde = $montant;
        // self:: permet d'appeler la constante de la classe courante à l'intérieur même de la classe vu que c'est une constante privée
    }


    /**
     *Méthode magique pour la conversion en chaîne de caractères
     */
    // public function __toString()
    // {
    //     return 'Le compte de ' . $this->titulaire . ' a un solde de ' . $this->solde;
    // }

   

    // Accesseurs getters et setters
    /**
     * Getter de titulaire, retourne la valeur du titulaire du compte
     * @return string
     */
    public function getTitulaire(): CompteClient
    {
        return $this->titulaire;
    }

    /**
     * Modifie le compte du titulaire et retourne l'objet
     * @param CompteClient $compte compte du titulaire
     * @param Compte compte bancaire
     */
    public function setTitulaire(CompteClient $compte): self
    {
        //on vérifie que le titulaire est bien présent
        if(isset($compte)){
            $this->titulaire = $compte;
        }
        return $this;
    }
    /**
     * Getter de solde, retourne la valeur du solde du compte
     * @return float
     */
    public function getSolde(): float
    {
        return $this->solde;
    }
    
    /**
     * Modifie le solde du compte et retourne l'objet
     * @param float $montant
     */
    public function setSolde(float $montant): self
    {
        if ($montant >= 0) {
            $this->solde = $montant;
        }
        return $this;
    }


/**
 * Deposer de l'argent sur le compte
 *
 * @param float $montant montant déposé
 * @return void
 */
    public function deposer(float $montant)
    {
        // on vérifie si le montant est positif, on ne voudrait pas d'un montant négatif ou dans ce cas ça serait un retrait. 
        if ($montant > 0) {
            // on ajoute le montant au solde
            $this->solde += $montant;
        }
    }

    /**
     * Retourne une chaine de caractère affichant le solde
     * @return string
     */
    public function voirSolde()
    {
        echo "le solde du compte est de : $this->solde euros";
    }
}

// maintenant que l'objet est créer, pour pouvoir l'utiliser, on doit l'instancier, c'est à dire crééer, une instance, version de l'objet utilisé sous la forme d'une variable.