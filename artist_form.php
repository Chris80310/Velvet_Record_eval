<?php

   // On charge l'enregistrement correspondant à l'ID passé en paramètre :
   require "db.php";
   $db = connexionBase();
   $requete = $db->prepare("SELECT * FROM artist WHERE artist_id=?");  
   $requete->execute(array($_GET["id"]));
   $myArtist = $requete->fetch(PDO::FETCH_OBJ);
   $requete->closeCursor();

   // Header (banière / logo) :
   include("header.php"); 

   var_dump($myArtist);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <title>Document</title>
</head>
<body>

    <div class="container cont_form my-5" style="p-auto">
        <div class="d-flex justify-content-between row ">

            <div class="center my-5"><h1>Artiste n°<?= $myArtist->artist_id; ?></h1></div>

            <div class="col">
            <a class="btn btn-primary row my-3" href="accueil.php">Retour à la liste des artistes</a>
            </div>

            <br><br>

            <form action ="/script_disc_modif.php" enctype="multipart/form-data" method="post">

                <input type="hidden" name="id" value="<?= $myArtist->disc_id ?>">

                <label for="titre_album"><strong>Titre de l'album :</strong></label><br>
                <input type="text" name="titre_album" id="titre_album" class="col-12" value="">
                <br><br>

                <label for="artiste"><strong>Artiste :</strong></label><br>

                
                <select name="selectArtist" id="selectArtist" class="col-12">
                    <option disabled selected>Selectionnez un artiste</option>
                    <?php foreach ($newDisc as $disc):?>
                        <option value="<?=$disc->artist_id?>"><?=$disc->artist_name?></option>
                    <?php endforeach; ?>
                </select>
            
                <br><br>

                <label for="annee"><strong>Année :</strong></label><br>
                <input type="number" name="annee" id="annee" class="col-12" value="">
                <br><br>

                <label for="genre"><strong>Genre :</strong></label><br>
                <input type="text" name="genre" id="genre" class="col-12" value="">
                <br><br>

                <label for="label"><strong>Label :</strong></label><br>
                <input type="text" name="label" id="label" class="col-12" value="">
                <br><br>

                <label for="prix"><strong>Prix :</strong></label><br>
                <input type="text" name="prix" id="prix" class="col-12" value="">
                <br><br>

                <label for="fichier"><strong>Fichier :</strong></label><br>
                <input type="file" name="fichier" id="fichier" class="col-12" value="">
                <br><br>
            
                <div class=" col-12 d-flex justify-content-center">

                    <input type="submit" value="Modifier" class="btn btn-primary col-2 mx-5 mt-3">
                    <input type="reset" value="Annuler" class="btn btn-primary col-2 mx-5 mt-3">

                </div>


            </form>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

        </div>
    </div>


</body>
</html>