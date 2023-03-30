<?php

function connexionBase(){
    
    $charset="utf8";
    $db="record";
    $dbhost="localhost";

    $dbport=3306;
    $dbport2=3307;

    $dbuser="root";
    $dbuser2="admin2";

    $dbpasswd="";
    $dbpasswd2="eureka80";
    
    try 
    {
        // !!! REMPLACER SELON LE POSTE : !!!

        $pdo = new PDO('mysql:host='.$dbhost.';charset=utf8;dbname='.$db, $dbuser2, $dbpasswd2);

        // OU ://

        // $pdo = new PDO('mysql:host='.$dbhost.';port='.$dbport.';dbname='.$db.';charset=utf8'.'', $dbuser, $dbpasswd); 

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
    catch (Exception $e)
    {
        echo 'Erreur : ' . $e->getMessage() . '<br />';
        echo 'N° : ' . $e->getCode();
        die('Fin du script');
    }
}
?>