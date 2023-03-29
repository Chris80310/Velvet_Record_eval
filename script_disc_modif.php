<?php
var_dump($_POST);
var_dump($_FILES);

$title   = (isset($_POST['title']) && $_POST['title'] != "") ? $_POST['title'] : Null;
$year    = (isset($_POST['year']) && $_POST['year'] != "") ? $_POST['year']  : Null;
$genre   = (isset($_POST['genre']) && $_POST['genre'] != "") ? $_POST['genre'] : Null;
$label   = (isset($_POST['label']) && $_POST['label'] != "") ? $_POST['label'] : Null;
$price   = (isset($_POST['price']) && $_POST['price'] != "") ? $_POST['price'] : Null;
$name    = (isset($_POST['name']) && $_POST['name'] != "") ? $_POST['name'] : Null;
$picsName = (isset($_POST['picture']) && $_POST['picture'] != "") ? $_POST['picture'] : Null;

if ($title == Null || $year == Null || $genre == Null || $label == Null || $price == Null || $name == Null) {
    header("Location: disc_form.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_FILES["picture"]) && $_FILES["picture"]["error"] == 0) {

        $picsName = $_FILES["picture"]["name"];
        $picsType = $_FILES["picture"]["type"];
        $picsSize = $_FILES["picture"]["size"];

        $format = array("img/jpg", "img/gif", "img/jpeg", "img/pjpeg", "img/png", "img/x-png", "img/tiff", "image/gif", "image/jpeg", "image/pjpeg", "image/png", "image/x-png", "image/tiff", "image/jpg");
        $maxSize = 5000000;

            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $picsType = finfo_file($finfo, $_FILES["picture"]["tmp_name"]);
            finfo_close($finfo);

        if (in_array($picsType, $format));
             else {
                move_uploaded_file($_FILES["picture"]["tmp_name"], "assets/jaquettes/" . $_FILES["picture"]["name"]);
                echo "Image téléchargée !";
            }

            if ($picsSize > $maxSize)
            die("Veuillez choisir une image d\'un format inférieur à 5Mo");

        else {
            echo "Erreur: Téléchargement impossible. Veuillez rééssayer";
        }
    } else {
        echo "Erreur: " . $_FILES["picture"]["error"];
    }
}
require "db.php";
$db = connexionBase();


try {
    $requete = $db->prepare("UPDATE disc SET disc_title = :title, disc_year = :year, disc_genre = :genre, disc_label = :label, disc_price = :price, artist_id = :name, disc_picture = :picture WHERE disc.disc_id = :id;");

    $requete->bindValue(":title", $title,   PDO::PARAM_STR);
    $requete->bindValue(":year", $year,     PDO::PARAM_INT);
    $requete->bindValue(":genre", $genre,   PDO::PARAM_STR);
    $requete->bindValue(":label", $label,   PDO::PARAM_STR);
    $requete->bindValue(":price", $price,   PDO::PARAM_STR);
    $requete->bindValue(":name", $name,   PDO::PARAM_INT);
    $requete->bindvalue(":picture", $picsName, PDO::PARAM_STR);
    $requete->execute();

    $requete->closeCursor();
} catch (Exception $e) {
    var_dump($requete->queryString);
    var_dump($requete->errorInfo());
    echo "Erreur : " . $requete->errorInfo()[2] . "<br>";
    die("Fin du script (script_disc_ajout2.php)");
}

header("Location: artist_details.php?id");

exit;
