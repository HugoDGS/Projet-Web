<?php

// Définition de la fonction controleurPrincipal avec un paramètre $action
function controleurPrincipal(string $action){
    // Déclaration d'un tableau associatif contenant les actions et les noms des fichiers de contrôleur correspondants
    $lesActions = array();
    $lesActions["defaut"] = "c_Accueil.php"; // Action par défaut : page d'accueil
    $lesActions["login"] = "c_Login.php"; // Action pour gérer la connexion
    $lesActions["contact"] = "c_Contact.php"; // Action pour gérer le formulaire de contact
    $lesActions["devis"] = "c_Devis.php"; // Action pour gérer le formulaire de devis
    $lesActions["cours"] = "c_Cours.php"; // Action pour gérer la page des cours
    $lesActions["inscription"] = "c_Inscription.php"; // Action pour gérer le formulaire d'inscription
    $lesActions["compte"] = "c_Compte.php"; // Action pour gérer le compte utilisateur
    $lesActions["deconnexion"] = "c_Deconnexion.php"; // Action pour gérer la déconnexion de l'utilisateur

    // Vérifie si l'action passée en paramètre existe dans le tableau $lesActions
    if (array_key_exists($action, $lesActions)) {
        // Si l'action existe, renvoie le nom du fichier de contrôleur correspondant à cette action
        $resultat = $lesActions[$action];
    } else {
        // Si l'action n'existe pas, renvoie le fichier de contrôleur par défaut (page d'accueil)
        $resultat = $lesActions["defaut"];
    }
    return $resultat; // Renvoie le nom du fichier de contrôleur
}
?>
