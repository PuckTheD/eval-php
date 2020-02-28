<?php
$title = "Immobilier";

ob_start();
?>

    <h1>Bienvenu sur notre site</h1>
    <hr>
    <h2>Page d'Accueil</h2>

<?php
$content = ob_get_clean();

require('view/template.php');
