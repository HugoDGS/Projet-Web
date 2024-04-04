<?php

// Vérifie si le fichier en cours d'exécution est le script principal
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = ".."; // Définit la racine du projet
}

// Inclusion du fichier contenant les fonctions pour la manipulation des utilisateurs en base de données
include_once "$racine/modele/bd.utilisateur.inc.php";

// Initialisation des messages d'erreur et des messages de succès
$msg_erreur = NULL;
$msg = NULL;
$bon = NULL;

// Vérifie si l'utilisateur est connecté en vérifiant s'il existe une session utilisateur
if (isset($_SESSION["user_id"])) {
    // Récupère les informations de l'utilisateur connecté
    $mailC = getUserById($_SESSION["user_id"])["email"];
    $nom = getUserById($_SESSION["user_id"])["nom"];
    $prenom = getUserById($_SESSION["user_id"])["prenom"];
    $telephone = getUserById($_SESSION["user_id"])["telephone"];

    // Récupère l'ID de l'utilisateur à partir de son adresse e-mail
    $id = getUserByEmail($mailC)["id"];
    
    // Récupère les cours auxquels l'utilisateur est inscrit
    $cours = getCoursByUserId($id);
    
    // Vérifie si l'utilisateur est inscrit à des cours
    if (!empty($cours)) {
        $msg = "Vous êtes bien inscrit au(x) cours suivant(s) :";
    }
    
    // Indique que l'utilisateur est connecté
    $utilisateurConnecte = true;
} else {
    // Indique que l'utilisateur n'est pas connecté
    $utilisateurConnecte = false;
}

// Vérifie si la requête HTTP est de type POST et si les champs de mot de passe actuel et nouveau sont définis
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["current_password"]) && isset($_POST["new_password"])) {
    $currentPassword = $_POST["current_password"];
    $newPassword = $_POST["new_password"];

    // Vérifie si les champs de mot de passe actuel et nouveau ne sont pas vides
    if (!empty($currentPassword) && !empty($newPassword)) {
        // Récupère les informations de l'utilisateur connecté
        $resultat = getUserById($_SESSION["user_id"]);
        
        // Vérifie si le mot de passe actuel correspond à celui stocké en base de données
        if (password_verify($currentPassword, $resultat['mdp'])) {
            // Modifie le mot de passe de l'utilisateur
            if (modifierMotDePasse($_SESSION["user_id"], $newPassword)) {
                $bon = "Mot de Passe modifié avec succès"; // Indique que le mot de passe a été modifié avec succès
            } else {
                $msg_erreur = "Erreur lors de la modification du mot de passe."; // Indique qu'il y a eu une erreur lors de la modification du mot de passe
            }
        } else {
            $msg_erreur = "Le mot de passe actuel est incorrect."; // Indique que le mot de passe actuel est incorrect
        }
    } else {
        $msg_erreur = "Veuillez remplir tous les champs."; // Indique que tous les champs doivent être remplis
    }
}

// Définition du titre de la page
$titre = "Compte";

// Inclusion des fichiers d'en-tête, de contenu principal et de pied de page
include_once "$racine/vue/entete.php";
include_once "$racine/vue/vueCompte.php";
include_once "$racine/vue/pied.php";
