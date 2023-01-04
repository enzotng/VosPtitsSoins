<?php

// Récupération ou démarrage de la session

session_start();

// On écrase le tableau de session

$_SESSION = array();

// On détruit la session

session_destroy();

// On redirige le visiteur vers la page d'accueil

echo '<script type="text/javascript">'; 
echo 'window.location.href = "index.php";';
echo '</script>';

?>
