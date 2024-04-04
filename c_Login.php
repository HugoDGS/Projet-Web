<?php

// Vérifie si le fichier en cours d'exécution est le script principal
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = ".."; // Définit la racine du projet
}

// Inclusion du fichier contenant les fonctions pour la manipulation des utilisateurs en base de données
include_once "$racine/modele/bd.utilisateur.inc.php";

// Vérifie si la requête HTTP est de type POST et si les champs d'e-mail et de mot de passe sont définis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"]) && isset($_POST["password"])) {
    // Récupère les informations de l'utilisateur par e-mail
    $resultat = getUserByEmail($_POST["email"]);
    
    // Vérifie si aucun utilisateur n'a été trouvé avec l'e-mail fourni
    if (!$resultat) {
        $msg_erreur = "Erreur lors de la connexion"; // Affiche un message d'erreur en cas d'échec de connexion
    } else {
        // Vérifie si l'e-mail et le mot de passe fournis correspondent à ceux de l'utilisateur trouvé
        if ($_POST["email"] === $resultat['email'] && password_verify($_POST["password"], $resultat['mdp'])) {
            // Connecte l'utilisateur en définissant son ID de session
            $_SESSION["user_id"] = getUserByEmail($resultat['email'])['id'];
            
            // Redirige vers le contrôleur du compte utilisateur après une connexion réussie
            include_once "controleur/c_Compte.php";
            exit();
        } else {
            $msg_erreur = "Identifiants incorrects."; // Affiche un message d'erreur en cas d'identifiants incorrects
        }
    }
}

// Définition du titre de la page
$titre = "Connexion";

// Inclusion du fichier de la vue de connexion
include_once "$racine/vue/vueLogin.php";
