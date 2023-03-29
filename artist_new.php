
<?php
  require "db.php";
  $db = connexionBase();
  $requete = $db->query("SELECT * FROM artist");
  $newArtist = $requete->fetchall(PDO::FETCH_OBJ);
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
    <title>PDO - Ajout</title>

</head>

    <body class="bg1">

    <div class="container cont_form mt-5 mb-5" style="p-auto">

        <div class="d-flex justify-content-between row">

            <div class="center m-3"><h1><strong>Saisie d'un nouvel artiste</strong></h1></div> 
            <br><br>

            <form action ="script_artist_ajout.php" method="post" enctype="multipart/form-data">

                <label for="nom_for_label"><strong>Nom de l'artiste :</strong></label><br>
                <input type="text" class="col-12" name="nom" id="nom_for_label">
                <br><br>

                <label for="url_for_label"><strong>Adresse site internet :</strong></label> <br>
                <input type="text" class="col-12" name="url" id="url_for_label">
                <br><br>

                <div class="col-12 d-flex justify-content-center">
                    <input class="btn btn-primary col-2 mx-5 mt-3" type="submit" value="Ajouter">
                    <a class="btn btn-primary col-2 mx-5 mt-3" href="accueil.php">Retour à la liste des artistes</a>
                </div>
                
                <br><br>

            </form>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    </body>
</html>

<!-- On voit ici que notre formulaire sera envoyé avec la méthode POST, vers une page nommée script_artist_ajout.php.
Il s'agit donc d'un script local, faisant partie du même projet, soit, un script que nous allons composer nous-mêmes. -->
