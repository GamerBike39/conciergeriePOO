<table class="table table-striped">

    <thead>
        <th>ID</th>
        <th>Titre</th>
        <th>Contenu</th>
        <th>users_id</th>
    </thead>
    <tbody>
        <?php foreach ($annonces as $annonce): ?>
        <tr>
            <td><?= $annonce->id ?></td>
            <td><?= $annonce->titre ?></td>
            <td><?= $annonce->description ?></td>
            <td><?= $annonce->users_id ?></td>
            <td>
                <a href="/annonces/modifier/<?= $annonce->id ?>" class=" btn btn-warning">Modifier</a>
                <a href="/admin/supprimeAnnonce/<?= $annonce->id ?>" class=" btn btn-danger btn-del">Supprimer</a>
                <a href="/admin/supprimeAnnonce/<?= $annonce->id ?>" class="trigger-btn" data-toggle="modal">Modal</a>
            </td>
        </tr>
        <?php endforeach; ?>

        <?php if(!empty($_SESSION['message'])) : ?>
        <div class="alert alert-success" role="alert">
            <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
        </div>
        <?php endif; ?>

</table>