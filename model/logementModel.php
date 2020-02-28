<?php

// fonction d'ajout d'un logement
function createLogement($newLogement){
    //on récupère la BD
    $db = getDB();
    // on prépare notre requête d'ajout
    $req = $db->prepare('INSERT INTO logement (titre, adresse, ville, cp, surface, prix, photo, type, description) VALUES (:titre, :adresse, :ville, :cp, :surface, :prix, :photo, :type, :description)');
    // on bin les paramètres
    $req->bindParam(":titre", $newLogement['titre']);
    $req->bindParam(":adresse", $newLogement['adresse']);
    $req->bindParam(":ville", $newLogement['ville']);
    $req->bindParam(":cp", $newLogement['cp']);
    $req->bindParam(":surface", $newLogement['surface']);
    $req->bindParam(":prix", $newLogement['prix']);
    $req->bindParam(":photo", $newLogement['photo']);
    $req->bindParam(":type", $newLogement['type']);
    $req->bindParam(":description", $newLogement['description']);
    // on execute la requête
    $req->execute();
    // on récupère et retourne l'id du nouveau logement
    return $db->lastInsertId();
}

// on récupère tous les logements
function getLogements(){
    $db = getDB();
    $req = $db->prepare('SELECT * FROM logement');
    $req->execute();

    return $req->fetchAll();
}

// on récupère un seul logement
function getLogement($id){
    $db = getDB();
    $req = $db->prepare('SELECT * FROM logement WHERE id_logement = :id');
    $req->bindParam(':id', $id);
    $req->execute();

    return $req->fetch();
}

function updateLogement($logement, $id) {
    // on récup la DB
    $db = getDB();
    // On prépare notre requête d'ajout
    $req = $db->prepare('UPDATE logement SET titre = :titre, adresse = :adresse, ville = :ville, cp = :cp, surface = :surface, prix = :prix, photo = :photo, type = :type, description = :description WHERE id = :id');
    // On bind les paramètres
    $req->bindParam(":id", $id);
    $req->bindParam(":titre", $logement['titre']);
    $req->bindParam(":adresse", $logement['adresse']);
    $req->bindParam(":ville", $logement['ville']);
    $req->bindParam(":cp", $logement['cp']);
    $req->bindParam(":surface", $logement['surface']);
    $req->bindParam(":prix", $logement['prix']);
    $req->bindParam(":photo", $logement['photo']);
    $req->bindParam(":type", $logement['type']);
    $req->bindParam(":description", $logement['description']);
    // on execute
    $req->execute();

    return;
}

// delete un logement
function destroyLogement($id) {
    // on récup la DB
    $db = getDB();
    // On prépare notre requête d'ajout
    $req = $db->prepare('DELETE FROM logement WHERE id = :id');
    // On bind les paramètres
    $req->bindParam(":id", $id);
    // on execute
    $req->execute();

    return $_GET['id'];
}