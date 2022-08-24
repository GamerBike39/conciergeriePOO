<table class="table table-striped">

    <thead>
        <th>ID</th>
        <th>Titre</th>
        <th>Contenu</th>
        <th>Actif</th>
        <th>Actions</th>
    </thead>
    <tbody>
        <?php foreach ($annonces as $annonce): ?>
        <tr>
            <td><?= $annonce->id ?></td>
            <td><?= $annonce->titre ?></td>
            <td><?= $annonce->description ?></td>
            <td>
                <div class="form-check form-switch">
                    <input class="form-check-input switchbtn" type="checkbox" role="switch"
                        id="flexSwitchCheckDefault  <?= $annonce->id ?>" <?= $annonce->actif ? "checked" : "" ?>
                        data-id="<?= $annonce->id ?>">
                    <label class="form-check-label" for="flexSwitchCheckDefault" <?= $annonce->id ?>></label>
                </div>

            </td>
            <td>
                <a href="/annonces/modifier/<?= $annonce->id ?>" class=" btn btn-warning">Modifier</a>
                <a href="/admin/supprimeAnnonce/<?= $annonce->id ?>" class=" btn btn-danger">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>

        <?php if(!empty($_SESSION['message'])) : ?>
        <div class="alert alert-success" role="alert">
            <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
        </div>
        <?php endif; ?>

</table>