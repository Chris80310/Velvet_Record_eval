<?php
var_dump($_POST);
var_dump($_FILES);

// Récupération de l'element (syntaxe abrégée)
$title   = (isset($_POST['title']) && $_POST['title'] != "") ? $_POST['title'] : Null;
$year    = (isset($_POST['year']) && $_POST['year'] != "") ? $_POST['year']  : Null;
$genre   = (isset($_POST['genre']) && $_POST['genre'] != "") ? $_POST['genre'] : Null;
$label   = (isset($_POST['label']) && $_POST['label'] != "") ? $_POST['label'] : Null;
$price   = (isset($_POST['price']) && $_POST['price'] != "") ? $_POST['price'] : Null;
$name    = (isset($_POST['name']) && $_POST['name'] != "") ? $_POST['name'] : Null;
$picsName = (isset($_POST['picture']) && $_POST['picture'] != "") ? $_POST['picture'] : Null;

// En cas d'erreur, on renvoie vers le formulaire
if ($title == Null || $year == Null || $genre == Null || $label == Null || $price == Null || $name == Null) {
    header("Location: disc_new.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Récupération de l'image:
    if (isset($_FILES["picture"]) && $_FILES["picture"]["error"] == 0) {
        $format = array("img/jpg", "img/gif", "img/jpeg", "img/pjpeg", "img/png", "img/x-png", "img/tiff", "image/gif", "image/jpeg", "image/pjpeg", "image/png", "image/x-png", "image/tiff", "image/jpg");

        $picsName = $_FILES["picture"]["name"];
        $picsType = $_FILES["picture"]["type"];
        $picsSize = $_FILES["picture"]["size"];
        $maxSize = 5000000;
        // (<= 5Mo)
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $picsType = finfo_file($finfo, $_FILES["picture"]["tmp_name"]);
            finfo_close($finfo);

        if (in_array($picsType, $format));
             else {
                move_uploaded_file($_FILES["picture"]["tmp_name"], "assets/jaquettes/" . $_FILES["picture"]["name"]);
                echo "Votre image a été téléchargé avec succès.";
            }

            if ($picsSize > $maxSize)
            die("La taille de votre image est supérieure à la limite autorisée!");

        else {
            echo "Erreur: Il y a eu un problème de téléchargement de votre image! 
            Veuillez réessayer.";
        }
    } else {
        echo "Erreur: " . $_FILES["picture"]["error"];
    }
}

// S'il n'y a pas eu de redirection vers le formulaire (= si la vérification des données est ok) :
require "db.php";
$db = connexionBase();

/* Nous voulons maintenant créer un enregsitrement dans notre table disc, contenant les données récupérées via notre formulaire.
Pour ce faire, nous allons créer une requête préparée afin d'éviter les injections SQL. Nous utiliserons ici des marqueurs nommés afin d'envoyer nos données.*/

try {
    // Construction de la requête INSERT sans injection SQL :
    $requete = $db->prepare("INSERT INTO disc (disc_title, disc_year, disc_genre, disc_label, disc_price, artist_id, disc_picture) VALUES (:title, :year, :genre, :label, :price, :name, :picture);");
    
    // Association des valeurs aux paramètres via bindValue() :
    $requete->bindValue(":title", $title,   PDO::PARAM_STR);
    $requete->bindValue(":year", $year,     PDO::PARAM_INT);
    $requete->bindValue(":genre", $genre,   PDO::PARAM_STR);
    $requete->bindValue(":label", $label,   PDO::PARAM_STR);
    $requete->bindValue(":price", $price,   PDO::PARAM_STR);
    $requete->bindValue(":name", $name,   PDO::PARAM_INT);
    $requete->bindvalue(":picture", $picsName, PDO::PARAM_STR);
    // Lancement de la requête :
    $requete->execute();
    // Libération de la requête (utile pour lancer d'autres requêtes par la suite) :
    $requete->closeCursor();

    // Gestion des erreurs
} catch (Exception $e) {
    var_dump($requete->queryString);
    var_dump($requete->errorInfo());
    echo "Erreur : " . $requete->errorInfo()[2] . "<br>";
    die("Fin du script (script_disc_ajout.php)");
}
// Si OK: redirection vers la page acceuil.php
header("Location: accueil.php");
// Fermeture du script
exit;
