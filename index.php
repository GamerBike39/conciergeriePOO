<?php
require_once 'classes/Compte.php';

// on instancie le ou les comptes
$compte1 = new Compte('Dupont', 5000);
$compte2 = new Compte("Durand", 1000);
// on écrit dans la propriété titulaire
// $compte1->titulaire = 'toto';
// $compte2->titulaire = 'Robert';
// on écrit dans la propriété solde
// $compte1->solde = 500;
// $compte2->solde = 200.35;


// on dépose 100 euros sur le compte 1
$compte1->deposer(5000);
// $compte1->retirer(500);
// $compte1->setSolde(100);


echo $compte1->getTitulaire();

// on a créé une nouvelle version de notre objet Compte, stocké dans la variable compte1
// on a accès à ses propriétés et méthodes
var_dump($compte1);
var_dump($compte2);
echo "$compte1"
// $compte1->voirSolde();

// echo "le taux d'intérêt du compte est de : " . Compte::TAUX_INTERETS . " %";
//  les :: sont appelés opérateur de résolution de portée,  (paamayim Nekudotayim) utilisé pour appeler une méthode ou une propriété d'un objet ou d'une classe constant ou static
?>

<p><?= $compte1->voirSolde(); ?></p>