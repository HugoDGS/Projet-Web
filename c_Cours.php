<?php

// Vérifie si le fichier en cours d'exécution est le script principal
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = ".."; // Définit la racine du projet
}

// Inclusion du fichier contenant les fonctions pour la manipulation des utilisateurs en base de données
include_once "$racine/modele/bd.utilisateur.inc.php";

// Vérifie si l'utilisateur est connecté en vérifiant s'il existe une session utilisateur
if (isset($_SESSION["user_id"])) {
    // Indique que l'utilisateur est connecté
    $utilisateurConnecte = true;
    // Stocke dans la session les cours suivis par l'utilisateur
    $_SESSION["suivre"] = getCours($_SESSION["user_id"]);
} else {
    // Indique que l'utilisateur n'est pas connecté
    $utilisateurConnecte = false;
}

// Vérifie si l'utilisateur est connecté
if ($utilisateurConnecte) {
    // Vérifie si l'utilisateur suit déjà des cours
    if ($_SESSION["suivre"]) {
        // Désactive le bouton pour suivre de nouveaux cours s'il suit déjà des cours
        $disableButton = 'disabled';
    } else {
        // Active le bouton pour suivre de nouveaux cours s'il ne suit pas encore de cours
        $disableButton = '';
        // Vérifie si un cours a été sélectionné pour suivre
        if (isset($_POST["coursId"])) {
            // Insère le cours suivi par l'utilisateur dans la base de données
            insertCours($_SESSION["user_id"], $_POST["coursId"]);
            // Redirige vers le contrôleur du compte utilisateur après avoir suivi un cours avec succès
            include_once "controleur/c_Compte.php";
            exit();
        }
    }
}

// Définition du titre de la page
$titre = "Cours";

// Inclusion des fichiers d'en-tête, de contenu principal et de pied de page
include_once "$racine/vue/entete.php";
include_once "$racine/vue/vueCours.php";
include_once "$racine/vue/pied.php";
