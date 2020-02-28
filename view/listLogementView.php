<?php
$title = "Liste Logements";

ob_start();
?>

    <div class="container">
        <div class="row">
            <h1>Liste des logements</h1>
        </div>
        <div class="row">
            <div class="col">
                <table class="table table-sm table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Titre</th>
                        <th>Adresse</th>
                        <th>Ville</th>
                        <th>Code postal</th>
                        <th>Surface</th>
                        <th>Prix</th>
                        <th>Type</th>
                        <th>photo</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    // Boucle sur chaque élément de notre tableau de client
                    foreach($logements as $logement) {
                        ?>
                        <tr>
                            <td><?= $logement['id_logement'] ?></td>
                            <td><?= $logement['titre'] ?></td>
                            <td><?= substr($logement['adresse'], 0, 12) ?></td>
                            <td><?= $logement['ville'] ?></td>
                            <td><?= $logement['cp'] ?></td>
                            <td><?= $logement['surface'] ?></td>
                            <td><?= $logement['prix'] ?></td>
                            <td><?= $logement['type'] ?></td>
                            <td><img class="img-fluid card" style="width: 6rem;" src="public/images/<?= $logement['photo'] ?>" alt="photo"></td>
                            <td>
                                <a class="btn btn-info btn-sm" href="index.php?page=logement&id=<?= $logement['id_logement'] ?>">Voir</a>
                                <a class="delete btn btn-danger btn-sm" data-id="<?= $logement['id_logement'] ?>">Supprimer</a>
                                <a class="update btn btn-warning btn-sm" data-id="<?= $logement['id_logement'] ?>">Modifier</a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    <a href="index.php?page=addLogement" class="btn btn-primary">Ajouter</a>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        // On récup le bouton de suppression et on l'écoute
        var btnsDelete = document.getElementsByClassName('delete'); // on récup tous les boutons
        var btnsUpdate = document.getElementsByClassName('update');
        for (i = 0; i < btnsDelete.length; i++) {
            // pour chaque bouton on va écouter l'évènement click
            btnsDelete[i].addEventListener('click', function() {
                // On demande si l'utilisateur veut vraiment supprimer le logement
                if(confirm("Voulez-vous supprimer ce logement ?")) {
                    // Si oui, on redirige vers la page de suppression.
                    // this.dataset.id permet de récupérer la valeur de l'attribut data-id sur l'HTML du bouton
                    window.location.replace(`index.php?page=deleteLogement&id=${this.dataset.id}`)
                }
            })
        }
        for (i = 0; i < btnsUpdate.length; i++) {
            // pour chaque bouton on va écouter l'évènement click
            btnsUpdate[i].addEventListener('click', function() {
                // On demande si l'utilisateur veut vraiment modifier le logement
                if(confirm("Voulez-vous modifier ce logement ?")) {
                    // Si oui, on redirige vers la page de suppression.
                    // this.dataset.id permet de récupérer la valeur de l'attribut data-id sur l'HTML du bouton
                    window.location.replace(`index.php?page=updateLogement&id=${this.dataset.id}`)
                }
            })
        }
    </script>

<?php
$content = ob_get_clean();

require('view/template.php');
