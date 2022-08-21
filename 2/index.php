<?php
use App\Autoloader;
use App\Models\UsersModel;
use App\Models\AnnoncesModel;

require_once 'Autoloader.php';
Autoloader::register();


// $model = new AnnoncesModel();
$model = new UsersModel();
// $annonces = $model->findBy(array('id' > 1));
// $annonces2 = $model->find(2);

// var_dump($model->findAll());
// var_dump($annonces);
// var_dump($annonces2);

// $donnees = [
//     'titre' => 'Annonce modifiée',
//     'description' => 'description de l\'annonce hydratée',
//     'actif' => 0
// ];

// $annonce3 = $model
//             ->setTitre("nouvelle Annonce")
//             ->setDescription("nouvelle description")
//             ->setActif(1);

// $annonceH = $model->hydrate($donnees);        

// $model->delete(2);
// var_dump($annonceH);

$user = $model->setEmail('toto@gmail.com')
        ->setPassword(password_hash('toto', PASSWORD_ARGON2I));

$model->create($user);

var_dump($user);




echo "coucou"


?>