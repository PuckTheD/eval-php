<?php
$title = (isset($edit)?"Modifier un logement":"Ajouter un logement");
ob_start()
?>

    <div class="row">
        <div class="col">
            <?php if (isset($edit)) { ?>
                <h1>Modifier le logement #<?= $logement['id_logement'] ?></h1>
            <?php } else { ?>
                <h1>Ajouter un logement</h1>
            <?php }?>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <form action="index.php?page=<?= (isset($edit)?"editLogement&id=".$logement['id_logement']:"createLogement") ?>" method="POST" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="titre">Titre</label>
                    <input type="text" class="form-control <?= (!empty($errors['titre']))? "is-invalid" : "" ?>" name="titre" required id="titre" aria-describedby="lastnameHelp" value="<?= (!empty($logement))? $logement['titre'] : "" ?>">
                    <?php if(!empty($errors['titre'])) { ?>
                        <div class="invalid-feedback"><?= $errors['titre'] ?></div>
                    <?php } ?>
                    <small id="lastnameHelp" class="form-text text-muted">Titre logement</small>
                </div>

                <div class="form-group">
                    <label for="adresse">Adresse</label>
                    <input type="text" class="form-control <?= (!empty($errors['adresse']))? "is-invalid" : "" ?>" name="adresse" required id="adresse" aria-describedby="lastnameHelp" value="<?= (!empty($logement))? $logement['adresse'] : "" ?>">
                    <?php if(!empty($errors['adresse'])) { ?>
                        <div class="invalid-feedback"><?= $errors['adresse'] ?></div>
                    <?php } ?>
                    <small id="lastnameHelp" class="form-text text-muted">Adresse du logement</small>
                </div>

                <div class="form-group">
                    <label for="ville">Ville</label>
                    <input type="text" class="form-control <?= (!empty($errors['ville']))? "is-invalid" : "" ?>" name="ville" required id="ville" aria-describedby="lastnameHelp" value="<?= (!empty($logement))? $logement['ville'] : "" ?>">
                    <?php if(!empty($errors['ville'])) { ?>
                        <div class="invalid-feedback"><?= $errors['ville'] ?></div>
                    <?php } ?>
                    <small id="lastnameHelp" class="form-text text-muted">Ville du logement</small>
                </div>

                <div class="form-group">
                    <label for="cp">Code postal</label>
                    <input type="number" class="form-control <?= (!empty($errors['cp']))? "is-invalid" : "" ?>" name="cp" required id="cp" aria-describedby="lastnameHelp" value="<?= (!empty($logement))? $logement['cp'] : "" ?>">
                    <?php if(!empty($errors['cp'])) { ?>
                        <div class="invalid-feedback"><?= $errors['cp'] ?></div>
                    <?php } ?>
                    <small id="lastnameHelp" class="form-text text-muted">Code postal du logement</small>
                </div>

                <div class="form-group">
                    <label for="surface">Surface</label>
                    <input type="number" class="form-control <?= (!empty($errors['surface']))? "is-invalid" : "" ?>" name="surface" required id="surface" aria-describedby="lastnameHelp" value="<?= (!empty($logement))? $logement['surface'] : "" ?>">
                    <?php if(!empty($errors['surface'])) { ?>
                        <div class="invalid-feedback"><?= $errors['surface'] ?></div>
                    <?php } ?>
                    <small id="lastnameHelp" class="form-text text-muted">Surface du logement en m²</small>
                </div>

                <div class="form-group">
                    <label for="prix">Prix</label>
                    <input type="number" class="form-control <?= (!empty($errors['prix']))? "is-invalid" : "" ?>" name="prix" required id="prix" aria-describedby="lastnameHelp" value="<?= (!empty($logement))? $logement['prix'] : "" ?>">
                    <?php if(!empty($errors['prix'])) { ?>
                        <div class="invalid-feedback"><?= $errors['prix'] ?></div>
                    <?php } ?>
                    <small id="lastnameHelp" class="form-text text-muted">Prix du logement en €</small>
                </div>

                <div class="form-group">
                    <label for="photo">Photo</label>
                    <input type="file" class="form-control <?= (!empty($errors['photo']))? "is-invalid" : "" ?>" name="photo" id="photo" aria-describedby="lastnameHelp" value="<?= (!empty($logement))? $logement['photo'] : "" ?>">
                    <?php if(!empty($errors['photo'])) { ?>
                        <div class="invalid-feedback"><?= $errors['photo'] ?></div>
                    <?php } ?>
                    <small id="lastnameHelp" class="form-text text-muted">Photo du logement</small>
                </div>

                <div class="form-group">
                    <label for="type">type</label>
                    <select class="form-control <?= (!empty($errors['type']))? "is-invalid" : "" ?>" required name="type" >
                        <option value="location">Location</option>
                        <option value="vente">Vente</option>
                    </select>
                    <?php if(!empty($errors['type'])) { ?>
                        <div class="invalid-feedback"><?= $errors['type'] ?></div>
                    <?php } ?>
                    <small id="lastnameHelp" class="form-text text-muted">Type du logement</small>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control <?= (!empty($errors['description']))? "is-invalid" : "" ?>" rows="3" name="description"><?= (!empty($logement))? $logement['description'] : "" ?></textarea>
                    <?php if(!empty($errors['description'])) { ?>
                        <div class="invalid-feedback"><?= $errors['description'] ?></div>
                    <?php } ?>
                    <small id="lastnameHelp" class="form-text text-muted">Description du logement</small>
                </div>
                <button type="submit" class="btn btn-primary">Sauvegarder</button>
            </form>
        </div>
    </div>

<?php
$content = ob_get_clean();
require('view/template.php');