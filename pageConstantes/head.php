<?php
session_start();  //Démarrage de la session
    
// Connexion BDD
    try
    {
        $bdd = new PDO('mysql:host=localhost; port=3307 ;dbname=manga_universe;charset=utf8', 'root', '');
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }
    
?>