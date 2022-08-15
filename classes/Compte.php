<?php
// on le créé avec class
/**
 * objet Compte Bancaire
 */
abstract class Compte 
{
// propriétés
// Pour déclarer on va utiliser le mot clé public, par défaut les propriétés sont public 
/**
 * titulaire du compte
 * @var string
 */
private $titulaire;

/**
 * solde du compte
 * @var float
 */
private $solde;

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
     * @param string $nom Titulaire du compte
     * @param float $montant Solde du compte
     */
    public function __construct(string $nom, float $montant = 100)
    {
        // on attribue le nom à la propriété titulaire de l'instance créée
        // this se réfère à l'instance courante, c'est l'objet que l'on utilise
        $this->titulaire = $nom;
        $this->solde = $montant;
        $this->solde = $montant + ($montant * self::TAUX_INTERETS);
        // self:: permet d'appeler la constante de la classe courante à l'intérieur même de la classe vu que c'est une constante privée
    }


    /**
     *Méthode magique pour la conversion en chaîne de caractères
     */
    public function __toString()
    {
        return 'Le compte de ' . $this->titulaire . ' a un solde de ' . $this->solde;
    }

   

    // Accesseurs getters et setters
    /**
     * Getter de titulaire, retourne la valeur du titulaire du compte
     * @return string
     */
    public function getTitulaire(): string
    {
        return $this->titulaire;
    }

    /**
     * Modifie le nom du titulaire et retourne l'objet
     * @param string $titulaire
     */
    public function setTitulaire(string $nom): self
    {
        //on vérifie que le titulaire est bien présent
        if(!empty($nom)){
            $this->titulaire = $nom;
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

    public function retirer(float $montant)
    {
// on vérifie le montant et le solde, si le retrait est négatif ça serait un dépôt
/**
 * montant à retirer du compte
 * @var float
 */   
if ($montant > 0 && $this->solde >= $montant) {
            $this->solde -= $montant;
        }else
        {
            echo "le montant à retirer est invalide ou le solde est insuffisant";
        }
       echo $this->decouvert();

    }

    private function decouvert(){
        if ($this->solde <= 0) {
            return " vous êtes à découvert ";
        }else{
            return " Vous n'êtes pas à découvert";
        }
    }

};

// maintenant que l'objet est créer, pour pouvoir l'utiliser, on doit l'instancier, c'est à dire crééer, une instance, version de l'objet utilisé sous la forme d'une variable.