<?php
/*
 *  Logement controller
 */

// Appel le model Logement
require('model/logementModel.php');

// montre tout les logements
function showLogements(){
    $logements = getLogements();
    // affiche la liste des logements
    include ('view/listLogementView.php');
}

// montre un logement
function showLogement(){
    $logement = getLogement(clean_data($_GET['id']));
    // affiche un logement
    include ('view/oneLogementView.php');
}

// affiche le formulaire d'ajout
function showAddLogement(){
    // affiche la vue contenant le formulaire d'ajout
    include('view/addLogement.php');
}

// Ajoute un nouveau logement
function addLogement(){
    // on récupère les données valides
    $data = getValidatedLogementData();
    // upload de la photo
    // test si on a une photo et que l'upload n'est pas en erreur
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        // On test si le fichier fait moins de 1Mo (-/+ 1000000 octets)
        if ($_FILES['photo']['size'] <= 1000000) {
            $infosFichier = pathinfo($_FILES['photo']['name']); // On récupère les informations du fichier
            $extension = $infosFichier['extension']; // on récup l'extension du fichier
            $extensionsAutorisees = array('jpg', 'jpeg', 'gif', 'png'); // on liste les extensions autorisées
            // On test si le fichier a une extension autorisée
            if (in_array($extension, $extensionsAutorisees)) {
                $nomPhoto = "logement_" .time().".jpg";
                // On utilise la fonction move_uploaded_file pour déplacer le fichier du répertoire temporaire vers le sous-dossier uploads
                move_uploaded_file($_FILES['photo']['tmp_name'], 'public/images/' . $nomPhoto);
                // on enregistre le nom de notre photo en BDD
                $data['photo'] = $nomPhoto;
            } else {
                echo "Ce fichier n'est pas autorisé";
            }
        } else {
            echo "Fichier trop volumineux";
        }

    } else {
        echo "Aucun fichier envoyé";
    }
    // envoie au model pour ajout BDD
    $newLogementID = createLogement($data);
    // renvoie vers la fiche du logement
    header('Location: index.php?page=logement&id=' . $newLogementID);
}

// Update un logement
function showUpdateLogement() {
    $logement = getLogement(clean_data($_GET['id']));
    $edit = true;
    include('view/addLogement.php');
}

// Edit un logement
function editLogement() {
    $id = clean_data($_GET['id']);
    $datas = getValidatedLogementData();
    // upload de la photo
    // test si on a une photo et que l'upload n'est pas en erreur
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        // On test si le fichier fait moins de 1Mo (-/+ 1000000 octets)
        if ($_FILES['photo']['size'] <= 1000000) {
            $infosFichier = pathinfo($_FILES['photo']['name']); // On récupère les informations du fichier
            $extension = $infosFichier['extension']; // on récup l'extension du fichier
            $extensionsAutorisees = array('jpg', 'jpeg', 'gif', 'png'); // on liste les extensions autorisées
            // On test si le fichier a une extension autorisée
            if (in_array($extension, $extensionsAutorisees)) {
                $nomPhoto = "logement_" .time().".jpg";
                // On utilise la fonction move_uploaded_file pour déplacer le fichier du répertoire temporaire vers le sous-dossier uploads
                move_uploaded_file($_FILES['photo']['tmp_name'], 'public/images/' . $nomPhoto);
                // on enregistre le nom de notre photo en BDD
                $data['photo'] = $nomPhoto;
            } else {
                echo "Ce fichier n'est pas autorisé";
            }
        } else {
            echo "Fichier trop volumineux";
        }

    } else {
        echo "Aucun fichier envoyé";
    }
    // envoie au model pour ajout BDD
    updateLogement($datas, $id);
    // renvoie vers la fiche du logement
    header('Location: index.php?page=logement&id='.$id);
}

// Efface un logement
function deleteLogement() {
    $id = clean_data($_GET['id']);
    destroyLogement($id);
    header('Location: index.php?page=logements');
}

// fonction de validation logement
function getValidatedLogementData()
{
    $errors = array();
    // test champ titre (requis)
    if (empty($_POST['titre'])) {
        $errors['titre'] = "Champs requis";
    }
    // test champ adresse (requis)
    if (empty($_POST['adresse'])) {
        $errors['adresse'] = "Champs requis";
    }
    // test champ ville (requis)
    if (empty($_POST['ville'])) {
        $errors['ville'] = "Champs requis";
    }
    // tests du champ code postal (requis & valide)
    if (empty($_POST['cp'])) {
        $errors['cp'] = "Champ requis";
    }
    if (!preg_match("(^[0-9]{5}$)", $_POST['cp'])) {
        $errors['cp'] = "Champ code postal invalide";
    }
    // tests du champ surface (requis & valide)
    if (empty($_POST['surface'])) {
        $errors['surface'] = "Champ requis";
    }
    if (!is_int((int)$_POST['surface'])) {
        $errors['surface'] = "Doit être un nombre";
    }
    // tests du champ prix (requis & valide)
    if (empty($_POST['prix'])) {
        $errors['prix'] = "Champ requis";
    }
    if (!is_int((int)$_POST['prix'])) {
        $errors['prix'] = "Doit être un nombre";
    }
    // test du champ type (valide)
    if (empty($_POST['type'])) {
        $errors['type'] = "Champ requis";
    }
    $array = ['location', 'vente'];
    if (!array_search($_POST['type'], $array) &&  array_search($_POST['type'], $array) != NULL) {
        $errors['type'] = "Le champ ne peut contenir que Location ou Vente";
    }

    // si pas d'erreur on renvoie les données
    if (empty($errors)) {
        return array(
            "titre" => clean_data($_POST['titre']),
            "adresse" => clean_data($_POST['adresse']),
            "ville" => clean_data($_POST['ville']),
            "cp" => clean_data($_POST['cp']),
            "surface" => clean_data((int)$_POST['surface']),
            "prix" => clean_data((int)$_POST['prix']),
            "type" => clean_data($_POST['type']),
            "description" => clean_data($_POST['description'])
        );
    } else {
        // si on a des erreurs, on réaffiche la page d'ajout avec les erreurs
        $logement = array(
            "titre" => $_POST['titre'],
            "adresse" => $_POST['adresse'],
            "ville" => $_POST['ville'],
            "cp" => $_POST['cp'],
            "surface" => $_POST['surface'],
            "prix" => $_POST['prix'],
            "type" => $_POST['type'],
            "description" => $_POST['description']
        );
        include('view/addLogement.php');
        die();
    }
}