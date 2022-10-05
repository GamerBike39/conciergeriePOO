        <table class="table table-striped table-responsive">

            <thead>
                <th>ID</th>
                <th>Date <a href="/admin/dateC">&nbsp;↓&nbsp;</a><a href="/admin/dateD">&nbsp;↑&nbsp;</a>
                </th>
                <th>Type</th>
                <th>Desc</th>
                <th>Appart <a href="/admin/appartC">&nbsp;↓&nbsp;</a><a href="/admin/appartD">&nbsp;↑&nbsp;</a>
                </th>
                <th>Etage<a href="/admin/etageC">&nbsp;↓&nbsp;</a><a href="/admin/etageD">&nbsp;↑&nbsp;</a>
                </th>
            </thead>
            <tbody>
                <?php foreach ($taches as $tache): ?>
                <tr>
                    <td><?= $tache->id ?></td>
                    <td><a class="nav-link col-12"
                            href="/admin/date/<?= $tache->date ?>"><?=  strftime('%d-%m-%Y',strtotime($tache->date)); ?></a>
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

        <a class="nav-link col-2 ajouterBtn" href="/admin/ajouter">Ajouter une tache ➕</a>
        <a class="nav-link col-2 m-2" href="/admin/recherche">Rechercher 🔍</a>