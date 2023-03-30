<?php

var_dump($_POST);


    // $nom   = (isset($_POST['nom']) && $_POST['nom'] !== "") ? $_POST['nom'] : Null;
    // $prenom    = (isset($_POST['prenom']) && $_POST['prenom'] !== "") ? $_POST['prenom']  : Null;
    $email   = (isset($_POST['email']) && $_POST['email'] != "") ? $_POST['email'] : Null;
    $mdp   = (isset($_POST['mdp']) && $_POST['mdp'] != "") ? $_POST['mdp'] : Null;
    $Confirmer = (isset($_POST['Confirmer']));

    // En cas d'erreur, on renvoie vers le formulaire
if ($email == Null || $mdp == Null) {
    header("Location: login_form.php");
    exit;
}

if(isset($Confirmer)){
    if($email == 'email' && $mdp == "123"){
        $_session["autoriser"]="oui";
        header("login_form.php");
    }
    else{
        echo"Mauvais identifiant ou mot de passe";
    }
}

// session_start();

// $_SESSION["login"] = "webmaster";

// if ($_SESSION["login"]) 
// {
//    echo"Vous êtes autorisé à voir cette page.";  
// } 
// else 
// {
//    echo"Cette page nécessite une identification.";  
// }

// S'il n'y a pas eu de redirection vers le formulaire (= si la vérification des données est ok) :
    require "db.php"; 
    $db = connexionBase();

?>