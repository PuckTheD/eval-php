<?php
$title = "Logement"; // on donne le nom de notre page.
ob_start(); // On démarre "l'enregistrement" du HTML
?>
<div class="row">
    <div class="col d-flex justify-content-between align-items-center">
        <h1>Logement #<?= $logement['id_logement'] ?></h1>
        <a class="btn btn-primary btn-sm" href="index.php?page=logements">Retour</a>
    </div>
</div>
<dl class="row">
    <dt class="col-3">Titre</dt>
    <dd class="col-9"><?= $logement['titre'] ?></dd>
    <dt class="col-3">photo</dt>
    <dd class="col-9">
        <img class="img-fluid" src="public/images/<?= $logement['photo'] ?>" alt="Photo">
    </dd>
    <dt class="col-3">Adresse</dt>
    <dd class="col-9"><?= $logement['adresse'] ?></dd>
    <dt class="col-3">Ville</dt>
    <dd class="col-9"><?= $logement['ville'] ?></dd>
    <dt class="col-3">Code postal</dt>
    <dd class="col-9"><?= $logement['cp'] ?></dd>
    <dt class="col-3">Surface</dt>
    <dd class="col-9"><?= $logement['surface']." m²" ?></dd>
    <dt class="col-3">Prix</dt>
    <dd class="col-9"><?= $logement['prix'] ?></dd>
    <dt class="col-3">Type</dt>
    <dd class="col-9"><?= $logement['type'] ?></dd>
    <dt class="col-3">Description</dt>
    <dd class="col-9"><?= $logement['description'] ?></dd>
</dl>
<?php
$content = ob_get_clean(); // On stop "l'enregistrement" du HTML et on le "sauvegarde" dans la variable content
require('view/template.php'); // on appel notre template, $title et $content du template vont être remplacer par les valeurs définies plus haut
?>

