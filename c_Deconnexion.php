
<?php

if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
    $racine="..";
}


// Détruire toutes les variables de session
$_SESSION = array();

// Détruire la session
session_destroy();

header("Location: index.php");
exit;
?>
