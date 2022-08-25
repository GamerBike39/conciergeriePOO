<h1>Liste des taches</h1>

<?php foreach($taches as $tache): ?>
<article>
    <h2><a href="/taches/lire/<?=$tache->id?>"> <?= $tache->date ?></a></h2>
    <div>
        <p><?= $tache->type_tache ?></p>
    </div>
</article>
<?php endforeach; ?>