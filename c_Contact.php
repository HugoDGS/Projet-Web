<?php

// Vérifie si le fichier en cours d'exécution est le script principal
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = ".."; // Définit la racine du projet
}

// Vérifie si l'utilisateur est connecté en vérifiant s'il existe une session utilisateur
if (isset($_SESSION["user_id"])) {
    $utilisateurConnecte = true; // Indique que l'utilisateur est connecté
} else {
    $utilisateurConnecte = false; // Indique que l'utilisateur n'est pas connecté
}

// Configure le niveau de reporting des erreurs
error_reporting(E_ERROR | E_PARSE);

// Initialisation du message d'erreur
$msg_erreur = NULL;

// Vérifie si la requête HTTP est de type POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Adresse e-mail de destination
    $to = "coutureForFun@mail.com";

    // Sujet du message
    $subject = "Nouveau message de $name";

    // Contenu du message e-mail
    $email_content = "Nom: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    // Envoi de l'e-mail
    if (mail($to, $subject, $email_content)) {
        echo "<p>Votre message a été envoyé avec succès à la boutique.</p>"; // Affiche un message de succès si l'e-mail est envoyé avec succès
    } else {
        $msg_erreur= "<p>Désolé, une erreur s'est produite lors de l'envoi de votre message. Veuillez réessayer plus tard.</p>"; // Affiche un message d'erreur si l'e-mail n'est pas envoyé avec succès
    }
}

// Définition du titre de la page
$titre = "Contact";

// Inclusion des fichiers d'en-tête, de contenu principal et de pied de page
include_once "$racine/vue/entete.php";
include_once "$racine/vue/vueContact.php";
include_once "$racine/vue/pied.php";
