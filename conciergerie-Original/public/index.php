<?php
// on défiinit une constante contenant le dossier racine du projet
define('ROOT', dirname(__DIR__));

use App\Autoloader;
use App\Core\Main;


// on importe l'autoloader
require_once ROOT.'/Autoloader.php';
Autoloader::register();

// on instancie Main
$app = new Main();

// on démarre l'application
$app->start();