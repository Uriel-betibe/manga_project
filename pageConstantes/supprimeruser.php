<?php 
include_once('head.php');   //liaison a la base donnée et cookies et demarage session
?>


<?php 

//suppression de compte utilisateur et de toute les données relatives a l'utilisateur
if(isset($_GET["delid"])){

    $idutilisateur = (int)$_GET["delid"];

    $deletefavoris = $bdd->prepare('DELETE FROM favoris WHERE id_utilisateur = ?');
    $deletefavoris->execute(array($idutilisateur));
    $deletecommentaire = $bdd->prepare('DELETE FROM commentaires WHERE id_utilisateur = ?');
    $deletecommentaire->execute(array($idutilisateur));
    $supuser = $bdd->prepare('DELETE FROM utilisateur WHERE id_utilisateur = ?');
    $supuser->execute(array($idutilisateur));
    header("location: ".$_SERVER['HTTP_REFERER']); //redirection vers la page de gestion des utilisateur a la fin d l'execution de la requete
}


?>