<?php

// Vérifie si le fichier en cours d'exécution est le script principal
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = ".."; // Définit la racine du projet
}

// Inclusion du fichier contenant les fonctions pour la manipulation des utilisateurs en base de données
include_once "$racine/modele/bd.utilisateur.inc.php";

// Initialisation du message d'erreur
$msg_erreur = NULL;

// Vérifie si la requête HTTP est de type POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifie si les champs requis sont présents dans la requête POST
    if (isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["telephone"])) {
        // Récupération des données du formulaire
        $newEmail = $_POST["email"];
        $newPassword = $_POST["password"];
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $telephone = $_POST["telephone"];
        
        // Hashage du mot de passe
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        
        // Insertion du nouvel utilisateur dans la base de données
        $resultat = insertUser($newEmail, $hashedPassword, $nom, $prenom, $telephone);
        
        // Vérifie si l'insertion a réussi
        if ($resultat) {
            // Récupération de l'ID de l'utilisateur nouvellement inscrit
            $_SESSION["user_id"] = getUserByEmail($newEmail)["id"];
            
            // Redirection vers le contrôleur du compte utilisateur après une inscription réussie
            include_once "controleur/c_Compte.php";
            exit();
        } else {
            // Affichage d'un message d'erreur en cas d'échec de l'inscription
            $msg_erreur = "Erreur lors de l'inscription";
        }
    }
}

// Définition du titre de la page
$titre = "Inscription";

// Inclusion du fichier de la vue d'inscription
include_once "$racine/vue/vueInscription.php";
