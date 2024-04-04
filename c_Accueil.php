<?php

// Vérifie si le fichier en cours d'exécution est le script principal
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = ".."; // Définit la racine du projet
}

// Inclusion du fichier contenant les fonctions pour la manipulation des utilisateurs en base de données
include_once "$racine/modele/bd.utilisateur.inc.php";

// Vérifie si l'utilisateur est connecté en vérifiant s'il existe une session utilisateur
if (isset($_SESSION["user_id"])) {
    $utilisateurConnecte = true; // Indique que l'utilisateur est connecté
} else {
    $utilisateurConnecte = false; // Indique que l'utilisateur n'est pas connecté
}

// Définition du titre de la page
$titre = "Couture for Fun";

// Inclusion des fichiers d'en-tête, de contenu principal et de pied de page
include_once "$racine/vue/entete.php";
include_once "$racine/vue/vueAccueil.php";
include_once "$racine/vue/pied.php";
