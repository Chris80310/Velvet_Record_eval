<?php
require "db.php";
$db = connexionBase();
$requete = $db->prepare("SELECT * FROM disc join artist on disc.artist_id = artist.artist_id WHERE disc_id = ? ");
$requete->execute(array($_GET["id"]));
$myDisc = $requete->fetch(PDO::FETCH_OBJ);
$requete->closeCursor();

// Requête pour le foreach :
$requete2 = $db->prepare("SELECT * FROM artist");
$requete2->execute();
$myArtists = $requete2->fetchAll(PDO::FETCH_OBJ);
$requete2->closeCursor();

// header :
include('header.php');

?>

<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">

        <title>Disc_formulaire</title>
    </head>
    

    <body>
    
        <div class="container my-5 cont_form" style="p-auto">

            <br><div class="center"><h1>Modifier un vinyle</h1></div>

            <div class="d-flex justify-content-between row ">

                <form class="margin col-12" action="script_disc_modif.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $myDisc->disc_id ?>">

                    <label id="title" class="lb" for="title">Titre : </label><br>
                    <input type="text" value="<?= $myDisc->disc_title ?>" id="title" name="title" class="col-12"><br>


                    <label id="name" class="lb" for="name">Artiste :</label><br>
                    <select name="name" id="name" class="col-12">
                    
                        <option disabled selected>Selectionnez un artiste</option>
                                <?php foreach ( $myArtists as $select):?>
                                    <option value="<?=$select->artist_id?>"><?=$select->artist_name?></option>
                                <?php endforeach; ?>
                    </select><br><br>

                    <label id="year" class="lb" for="year">Année : </label><br>
                    <input type="text" value="<?= $myDisc->disc_year ?>" id="year" name="year" class="col-12"><br>


                    <label id="genre" class="lb" for="genre">Genre : </label><br>
                    <input type="text" value="<?= $myDisc->disc_genre ?>" id="genre" name="genre" class="col-12"><br>


                    <label id="label" class="lb" for="label">Label : </label><br>
                    <input type="text" value="<?= $myDisc->disc_label ?>" id="label" name="label" class="col-12"><br>


                    <label id="price" class="lb" for="Price">Prix : </label><br>
                    <input type="text" value="<?= $myDisc->disc_price .' €' ?>" id="price" name="price" class="col-12"><br>

                    <label id="Picture" class="lb" for="label"> Fichier : </label><br><br>
                    <input type="file" name="picture" >
                    <br><br>
                    
                    <div class=" col-12 d-flex justify-content-center">
                        <input id="sb" type="submit" value="Modifier" class="btn btn-primary col-2 mx-5 mt-3" onclick="return confirm('Voulez-vous vraiment modifier ce vinyle?')">
                        <input type="button" value="Retour" onclick="history.back()" class="btn btn-primary col-2 mx-5 mt-3">
                    </div>

                    <br><br>

                </form>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    </body>
</html>

