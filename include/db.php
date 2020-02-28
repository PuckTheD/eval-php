<?php

// apppel la base de données
function getDB() {
    try {
        $db = new PDO('mysql:host=localhost;dbname=immobilier;charset=utf8', 'root', '');
    } catch (Exception $e) {
        die('Erreur :'. $e->getMessage());
    }
    return $db;
}
