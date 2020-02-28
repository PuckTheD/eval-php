<?php
//On récupère les fichier utiles
require ('include/db.php');
require ('include/utils.php');
// on récupère le controller
require ('controller/logementController.php');
require ('controller/homeController.php');

// si je n'ai pas de paramètre page dans mon URL
if (empty($_GET['page'])){
    // j'envois vers la page d'accueil
    welcome();
} else { // sinon
    // on récupère la page voulue depuis l'URL
    $page = $_GET['page'];
    // root vers le bon controller
    if ($page == "logements") {
        // demande d'afficher la liste des logements
        showLogements();
    } elseif ($page == "logement"){
        //demande d'afficher un logement
        showLogement();
    } elseif ($page == "addLogement"){
        // affiche formulaire d'ajout
        showAddLogement();
    } elseif ($page == "createLogement"){
        // sauvegarde en BDD
        addLogement();
    } elseif ($page == "updateLogement"){
        showUpdateLogement();
    } elseif ($page == "editLogement"){
        editLogement();
    } elseif ($page == "deleteLogement"){
        deleteLogement();
    }
    /*
     * 404
     */
    else{
        showNotFound();
    }
}