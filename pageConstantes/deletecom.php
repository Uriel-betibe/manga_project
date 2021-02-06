<?php 
include_once('head.php');   //liaison a la base donnée et cookies et demarage session
?>


<?php 

//suppression de comentaire et retour a la page précédente.
if(isset($_GET["idcom"])){

    $idcommentaire = (int)$_GET["idcom"];
    $supuser = $bdd->prepare('DELETE FROM commentaires WHERE id_commentaire = ?');
    $supuser->execute(array($idcommentaire));
    header("location: ".$_SERVER['HTTP_REFERER']);
}


?>