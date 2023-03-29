<?php
    // On se connecte à la BDD via notre fichier db.php :
    require "db.php";
    $db = connexionBase();

    // On récupère l'ID passé en paramètre :
    $id = $_GET["id"];

    // On crée une requête préparée avec condition de recherche :
    $requete = $db->prepare("SELECT * FROM disc INNER JOIN artist ON disc.artist_id = artist.artist_id WHERE disc_id=?");

    // $requete = $db->prepare("SELECT * FROM disc WHERE disc_id=? JOIN artist  ON artist.artist_id = disc.artist_id");

    // on ajoute l'ID du disque passé dans l'URL en paramètre et on exécute :
    $requete->execute(array($id));

    // on récupère le 1e (et seul) résultat :
    $discInfo = $requete->fetch(PDO::FETCH_OBJ);

    // on clôt la requête en BDD
    $requete->closeCursor();

    // Header (banière / logo) :
    include("header.php"); 
     
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

        <title>Détail</title>
    </head>

    <body class="bg1">

        <div class="container cont_form_disc_new my-5" style="p-auto">

            <div class="d-flex justify-content-between row ">
  
                <form action ="script_disc_ajout2.php" method="post">

                    <div class="center my-5"><h1><strong>Détails</strong></h1></div>

                    <div class="col-8">
                        <div class="row">
                            
                            <div class="col">
                                <img src="assets/jaquettes/<?= $discInfo->disc_picture ?>" class="img-fluid jaquettes"  alt="jaquettes" height="300px" width="300px">
                            </div>

                            <div class="col m-auto">
                                <a class="btn btn-primary row my-3" style="width:130px" href ="disc_form.php?id=<?= $discInfo->disc_id ?>">Modifier</a>
                                <br><br>
                                <a class="btn btn-primary row my-3" style="width:130px" href="script_artist_delete.php?id=<?= $discInfo->disc_id ?>">Supprimer</a>
                                <br><br>
                                <a class="btn btn-primary row my-3" style="width:130px" href="accueil.php?id=<?= $discInfo->disc_id ?>">Retour</a>
                            </div>                     
                        </div>
                    </div>
                    <br><br>

                    <label for="titre_album"><strong>Titre de l'album : </strong></label><br>
                    <input type="text" name="title" id="titre_album" class="col-12" value="<?= $discInfo->disc_title ?>">
                    <br><br>

                    <label for="artiste"><strong>Artiste : </strong></label><br>
                    <input type="text" name="name" id="artiste" class="col-12" value="<?= $discInfo->artist_name ?>">
                    <br><br>

                    <label for="annee"><strong>Année : </strong></label><br>
                    <input type="number" name="year" id="annee" class="col-12" value="<?= $discInfo->disc_year ?>">
                    <br><br>

                    <label for="genre"><strong>Genre : </strong></label><br>
                    <input type="text" name="genre" id="genre" class="col-12" value="<?= $discInfo->disc_genre ?>">
                    <br><br>

                    <label for="label"><strong>Label : </strong></label><br>
                    <input type="text" name="label" id="label" class="col-12" value="<?= $discInfo->disc_label ?>">
                    <br><br>

                    <label for="prix"><strong>Prix : </strong></label><br>
                    <input type="text" name="price" id="prix" class="col-12" value="<?= $discInfo->disc_price .' €'?>">
                    <br><br>

                    <!-- <div class=" col-12 mb-5 d-flex justify-content-center">

                        <a class="btn btn-primary col-2 mx-5 mt-3" href ="artist_form.php?id=<?= $discInfo->disc_id ?>">Modifier</a>
                        <a class="btn btn-primary col-2 mx-5 mt-3" href="script_artist_delete.php?id=<?= $discInfo->disc_id ?>">Supprimer</a>
                        <a class="btn btn-primary col-2 mx-5 mt-3" href="discs.php?id=<?= $discInfo->disc_id ?>">Retour</a>

                    </div> -->
                </form>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    </body>   
</html>