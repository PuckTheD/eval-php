<?php
$title = "404 Not found";

ob_start()
?>

<?php if (!empty($message)) { ?>
    <h2><?= $message ?></h2>
<?php } else { ?>
    <h2>Not found</h2>
<?php } ?>

    <button onclick="javascript:history.back()" class="btn btn-primary btn-sm">Retour</button>


<?php
$content = ob_get_clean();

require('view/template.php');
