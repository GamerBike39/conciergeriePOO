<table class="table table-striped">

    <thead>
        <th>ID</th>
        <th>Date</th>
        <th>Type</th>
        <th>Desc</th>
        <th>Appart</th>
        <th>Etage</th>
    </thead>
    <tbody>
        <?php foreach ($taches as $tache): ?>
        <tr>
            <td><?= $tache->id ?></td>
            <td><?= $tache->date ?></td>
            <td><?= $tache->type_tache ?></td>
            <td><?= $tache->desc_tache ?></td>
            <td><?= $tache->appart ?></td>
            <td><?= $tache->etage ?></td>
            <td>
                <a href="/admin/modifier/<?= $tache->id ?>" class=" btn btn-warning">Modifier</a>
                <a href="/admin/supprimeTache/<?= $tache->id ?>" class=" btn btn-danger btn-del">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>

        <?php if(!empty($_SESSION['message'])) : ?>
        <div class="alert alert-success" role="alert">
            <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
        </div>
        <?php endif; ?>

</table>