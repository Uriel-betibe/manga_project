<?php 
include_once('head.php');   //liaison a la base donnée et cookies et demarage session
?>

<!-- pour supprimer l'oeuvre entièrement , il faut la supprimer des tables : mangas,favoris,commentaires et oeuvres  -->
<?php 
if(isset($_GET["supoeuvre"])){
    $idoeuvre = (int)$_GET["supoeuvre"];
    //requetes de sppresion dans les différentes tables
    $deletemanga = $bdd->prepare('DELETE FROM mangas WHERE id_oeuvre = ?');
    $deletemanga->execute(array($idoeuvre));
    $deletefavoris = $bdd->prepare('DELETE FROM favoris WHERE id_oeuvre = ?');
    $deletefavoris->execute(array($idoeuvre));
    $deletecommentaire = $bdd->prepare('DELETE FROM commentaires WHERE id_oeuvre = ?');
    $deletecommentaire->execute(array($idoeuvre));
    $deleteoeuvre = $bdd->prepare('DELETE FROM oeuvres WHERE id_oeuvre = ?');
    $deleteoeuvre->execute(array($idoeuvre));
    header("location: ".$_SERVER['HTTP_REFERER']); //actualisation de la page de gestion des oeuvres 
}
?>