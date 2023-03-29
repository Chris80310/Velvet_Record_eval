

<?php

// var_dump($_POST)

    // Récupération du Nom :
    if (isset($_POST['nom']) && $_POST['nom'] != "") {
        $nom = $_POST['nom'];
    }
    else {
        $nom = Null;
    }

    // Récupération de l'URL (même traitement, avec une syntaxe abrégée)
    $url = (isset($_POST['url']) && $_POST['url'] != "") ? $_POST['url'] : Null;

    // En cas d'erreur, on renvoie vers le formulaire
    if ($nom == Null || $url == Null) {
        header("Location: artist_new.php");
        exit;
    }

    // S'il n'y a pas eu de redirection vers le formulaire (= si la vérification des données est ok) :
    require "db.php"; 
    $db = connexionBase();



/* Nous voulons maintenant créer un enregsitrement dans notre table artist, contenant les données récupérées via notre formulaire.
Pour ce faire, nous allons créer une requête préparée afin d'éviter les injections SQL. Nous utiliserons ici des marqueurs nommés afin d'envoyer nos données.*/


try {
    // Construction de la requête INSERT sans injection SQL :
    $requete = $db->prepare("INSERT INTO artist (artist_name, artist_url) VALUES (:nom, :url);");

    // Association des valeurs aux paramètres via bindValue() :
    $requete->bindValue(":url", $url, PDO::PARAM_STR);
    $requete->bindValue(":nom", $nom, PDO::PARAM_STR);

    // Lancement de la requête :
    $requete->execute();

    // Libération de la requête (utile pour lancer d'autres requêtes par la suite) :
    $requete->closeCursor();
}

// Gestion des erreurs
catch (Exception $e) {
    var_dump($requete->queryString);
    var_dump($requete->errorInfo());
    echo "Erreur : " . $requete->errorInfo()[2] . "<br>";
    die("Fin du script (script_artist_ajout.php)");
}

// Si OK: redirection vers la page artists.php
header("Location: artists.php");

// Fermeture du script
exit;
?>