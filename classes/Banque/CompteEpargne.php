<?php

namespace App\Banque;
use App\Client\Compte as CompteClient;
/**
 * Compte avec taux d'intérêts
 */
class CompteEpargne extends Compte
{
    /**
     * @var float taux d'intérêts
     */
 private $taux_interets;

/**
 * Constructeur du compte épargne
 *
 * @param CompteClient $compte Titulaire du compte
 * @param float $montant Solde du compte
 * @param integer $taux_interets Taux d'intérêts
 */
public function __construct(CompteClient $compte, float $montant, int $taux_interets)
{
    parent::__construct($compte, $montant);
    $this->taux_interets = $taux_interets;
}

 /**
  * Get the value of taux_interets
  */
 public function getTauxInterets(): int
 {
  return $this->taux_interets;
 }

 /**
  * Set the value of taux_interets
  */
 public function setTauxInterets(int $taux_interets): self
 {
    if ($taux_interets >= 0) {
        $this->taux_interets = $taux_interets;
    }
  return $this;
 }
 public function verserInterets(){
     $this->solde = $this->solde + ($this->solde * ($this->taux_interets/100));
 }
}


?>