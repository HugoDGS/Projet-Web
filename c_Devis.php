<?php

// Vérifie si le fichier en cours d'exécution est le script principal
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = ".."; // Définit la racine du projet
}

// Configure le niveau de reporting des erreurs
error_reporting(E_ERROR | E_PARSE);

// Initialisation du message d'erreur
$msg_erreur = NULL;

// Vérifie si l'utilisateur est connecté en vérifiant s'il existe une session utilisateur
if (isset($_SESSION["user_id"])) {
    $utilisateurConnecte = true; // Indique que l'utilisateur est connecté
} else {
    $utilisateurConnecte = false; // Indique que l'utilisateur n'est pas connecté
}

// Vérifie si la requête HTTP est de type POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $mail = $_POST['mail'];
    $description = $_POST['description'];
    $type = $_POST['type'];
    $tissu = $_POST['tissu'];
    $taille = $_POST['taille'];
    $service = $_POST['service'];

    // Construit le contenu de l'e-mail de récapitulatif du devis
    $email_content = "Récapitulatif du devis:\n\n";
    $email_content .= "Description: " . $description . "\n";
    $email_content .= "Type de vêtement: " . $type . "\n";
    $email_content .= "Tissu: " . $tissu . "\n";
    $email_content .= "Taille: " . $taille . "\n";
    $email_content .= "Service: " . $service . "\n";

    // Adresse e-mail de destination
    $to = $mail;

    // Sujet de l'e-mail
    $subject = "Récapitulatif Devis Couture for Fun";

    // Envoi de l'e-mail
    if (mail($to, $subject, $email_content)) {
        echo "<p>Votre message a été envoyé avec succès à la boutique.</p>"; // Affiche un message de succès si l'e-mail est envoyé avec succès
    } else {
        $msg_erreur= "<p>Désolé, une erreur s'est produite lors de l'envoi de votre message. Veuillez réessayer plus tard.</p>"; // Affiche un message d'erreur si l'e-mail n'est pas envoyé avec succès
    }
}

// Définition du titre de la page
$titre = "Devis";

// Inclusion des fichiers d'en-tête, de contenu principal et de pied de page
include_once "$racine/vue/entete.php";
include_once "$racine/vue/vueDevis.php";
include_once "$racine/vue/pied.php";
