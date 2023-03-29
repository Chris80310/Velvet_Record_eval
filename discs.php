<?php

    // on importe le contenu du fichier "db.php"
    include "db.php";

    // Header (banière / logo) :
    // include("header.php");  

    // on exécute la méthode de connexion à notre BDD
    $db = connexionBase();

    // on lance une requête pour chercher toutes les fiches d'artistes
    $requete = $db->query("SELECT * FROM disc NATURAL JOIN artist");
    
    // on récupère tous les résultats trouvés dans une variable
    $resultat = $requete->fetchAll(PDO::FETCH_OBJ);
    // on clôt la requête en BDD
    $requete->closeCursor();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <title>PDO - Liste</title>
</head>

<body class="bg1">

    <div class="container div_discs my-5" style="p-auto">
        
        <div class="d-flex justify-content-around py-5">
            <div class="">
                <h1> Liste des disques (<?=count($resultat)?>)</h1> 
            </div>
            <div class="">
                <div class=""><label for="ajouter"><strong>Ajouter : </strong></label></div>
                <a class=" btn btn-primary px-5 mt-2 ajouter" href="artist_new.php">Artiste</a>
                <a class=" btn btn-primary px-5 mt-2 ajouter" href="disc_new.php">Disque</a>
            </div>
        </div> 

        <div class="row d-flex justify-content-between list_discs">
                <?php foreach ($resultat as $infos): ?>

                    <!-- $infos = les infos dont j'ai besoin -->

                    <!-- generation de la colone album -->
                    <div class="col-6 my-3 detail_disc">
                        <!-- on scinde horizontalement la colone en deux parties -->
                        <div class="row">
                            <!-- partie gauche de la colone avec l'image -->
                            <div class="col">
                                <img src="assets/jaquettes/<?= $infos->disc_picture ?>" class="img-fluid jaquettes"  alt="jaquettes" height="300px" width="300px">
                            </div>
                            <!-- partie droite avec les details -->
                            <div class="col">
                                <!-- affichage des details en ligne  -->
                                <div class="row titre_album"><?= $infos->disc_title ?></div>
                                <div class="row"><?= $infos->artist_name ?></div>
                                <div class="row"><?= $infos->disc_label ?></div>
                                <div class="row"><?= $infos->disc_year ?></div>
                                <div class="row"><?= $infos->disc_genre ?></div>
                                <div class="px-5">
                                    <!-- Lien fiche disques : -->
                                    <div class="row px-3"><a class="btn btn-primary my-5 detail" href="disc_detail.php?id=<?= $infos->disc_id ?>">Détail</a></div>
                                </div>
                            </div>            
                        </div>
                    </div>
                <?php endforeach; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>