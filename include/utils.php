<?php
//permet de nettoyer les données passées en param
function clean_data($data){
    $data = trim($data); // Permet de retirer tout ce qui n'est pas une lettre ou un chiffre
    $data = stripcslashes($data); // Permet de retirer tous les \ de $data
    $data = htmlspecialchars($data); // Transforme les char spéciaux en entité HTML
    return $data;
}
