<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
    <title>Titre</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Conciergerie</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Actualité</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/annonces/ajouter">Déposer une annonce</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/annonces">voir les annonces</a>
                    </li>
                </ul>
                <ul class="navbar-nav mb-lg-0 ms-auto">
                    <?php if (isset($_SESSION['user']) && !empty($_SESSION['user']['id'])): ?>

                    <?php if (isset($_SESSION['user']['roles']) && in_array('ROLE_ADMIN', $_SESSION['user']['roles'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin">Admin</a>
                    </li>
                    <?php endif; ?>

                    <li class="nav-item">
                        <a class="nav-link" href="/users/logout">déconnexion</a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/users/profil">Profil</a>
                    </li>
                    <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/users/login">Connexion</a>
                    </li>
                </ul>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <?php if(!empty($_SESSION['message'])) : ?>
    <div class="alert alert-success" role="alert">
        <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
    </div>
    <?php endif; ?>


    <div class="container">
        <?php if(!empty($_SESSION['erreur'])) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $_SESSION['erreur']; unset($_SESSION['erreur']); ?>
        </div>
        <?php endif; ?>
    </div>

    <div class="container-fluid m-0 p-0 home">
        <div class="card text-bg-dark col-12 ">
            <div class="immeuble"></div>
            <div class="card-img-overlay">
                <p class="title m-0 p-0 display-1">Bienvenue</p>
                <?php if (!isset($_SESSION['user']) && empty($_SESSION['user']['id'])): ?>
                <a class="nav-link m-0 ps-3" aria-current="page" href="/users/login"> Se connecter</a>
                <?php endif; ?>
            </div>
            <div class="card-img-overlay2 col-12 col-lg-3">
                <p>Vous pourrez ici : </p>
                <ul>
                    <li>Consulter l'actualité de votre immeuble</li>
                    <li>Poster une annonce</li>
                    <li>Rechercher une annonce</li>
                    <li>Contacter le concierge</li>
                </ul>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"
        integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous">
    </script>
    <script src="/js/script.js"></script>
</body>

</html>