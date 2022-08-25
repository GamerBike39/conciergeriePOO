<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Titre</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Conciergerie Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/">Accueil du site</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/admin">Accueil de l'admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/taches">Liste des taches</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/taches/ajouter">Ajouter une tache</a>
                    </li>
                </ul>
                <ul class="navbar-nav mb-lg-0 ms-auto">
                    <?php if (isset($_SESSION['user']) && !empty($_SESSION['user']['id'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/users/logout">déconnexion</a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/users/profil">Profil</a>
                        <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/users/login">Connexion</a>
                </ul>
                <?php endif; ?>
            </div>
        </div>
    </nav>


    <div class="container">
        <?php if(!empty($_SESSION['erreur'])) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $_SESSION['erreur']; unset($_SESSION['erreur']); ?>
        </div>
        <?php endif; ?>
        <?= $contenu ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"
        integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous">
    </script>
    <script src="/js/script.js"></script>
</body>

</html>