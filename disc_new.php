<?php
  require "db.php";
  $db = connexionBase();
//   $requete = $db->query("SELECT * FROM disc NATURAL JOIN artist");
  $requete = $db->query("SELECT * FROM artist");
  $newDisc = $requete->fetchall(PDO::FETCH_OBJ);
  $requete->closeCursor();

  // Header (banière / logo) :
  include("header.php");  
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <title>PDO - Ajout</title>
</head>
<body class="bg1">

    <div class="container cont_form_disc_new mt-5 mb-5" style="p-auto">

        <div class="d-flex justify-content-between row ">

            <div class="center m-3"><h1><strong>Saisie d'un nouveau vinyle</strong></h1></div> 
            <br><br>

            <form action ="script_disc_ajout.php" enctype="multipart/form-data" method="post">

                <label for="titre_album"><strong>Titre de l'album :</strong></label><br>
                <input type="text" name="title" id="titre_album" class="col-12" value="">
                <br><br>

                <label for="artiste"><strong>Artiste :</strong></label><br>
 
                
                <select name="name" id="selectArtist" class="col-12">
                    <option disabled selected>Selectionnez un artiste</option>
                    <?php foreach ($newDisc as $disc):?>
                        <option value="<?=$disc->artist_id?>"><?=$disc->artist_name?></option>
                    <?php endforeach; ?>
                </select>
             
                <br><br>

                <label for="annee"><strong>Année :</strong></label><br>
                <input type="number" name="year" id="annee" class="col-12" value="">
                <br><br>

                <label for="genre"><strong>Genre :</strong></label><br>
                <input type="text" name="genre" id="genre" class="col-12" value="">
                <br><br>

                <label for="label"><strong>Label :</strong></label><br>
                <input type="text" name="label" id="label" class="col-12" value="">
                <br><br>

                <label for="prix"><strong>Prix :</strong></label><br>
                <input type="text" name="price" id="prix" class="col-12" value="">
                <br><br>

                <label for="fichier"><strong>Fichier :</strong></label><br>
                <input type="file" name="picture" id="picture" class="col-12" value="">
                <br><br>

                <div class=" col-12 d-flex justify-content-center">

                    <input type="submit" value="Ajouter" class="btn btn-primary col-2 mx-5 mt-3">
                    <input type="reset" value="Corriger" class="btn btn-primary col-2 mx-5 mt-3">
                    <a class="btn btn-primary col-2 mx-5 mt-3" href="accueil.php" value="Retour à l'accueil"></a>
                    
                </div>
                <br><br>

            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>

</html>