        <table class="table table-striped table-responsive">

            <thead>
                <th>ID</th>
                <th class="d-flex">Date <p>⬆️</p>
                    <p>⏬</p>
                </th>
                <th>Type</th>
                <th>Desc</th>
                <th>Appart</th>
                <th>Etage</th>
            </thead>
            <tbody>
                <?php foreach ($taches as $tache): ?>
                <tr>
                    <td><?= $tache->id ?></td>
                    <td><a class="nav-link col-2" href="/admin/date/<?= $tache->date ?>"><?= $tache->date ?></a>
                    <td><a class="nav-link col-2"
                            href="/admin/type/<?= $tache->type_tache ?>"><?= $tache->type_tache ?></a>
                    </td>
                    <td><?= $tache->desc_tache ?></td>
                    <td><a class="nav-link col-2" href="/admin/appart/<?= $tache->appart ?>"><?= $tache->appart ?></a>
                    </td>
                    <td><a class="nav-link col-2" href="/admin/etage/<?= $tache->etage ?>"><?= $tache->etage ?></a></td>
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

        <a class="nav-link col-2" href="/admin/ajouter">Ajouter une tache ➕</a>