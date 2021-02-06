<?php 
include_once('head.php');   //liaison a la base donnée et cookies et demarage session
?>

<?php
//ajout de mangas favoris a l'especes favoris de l'utilisateur, verification des variables GET puis insertion ou suppression de l'oeuvre dans la table favoris 
if(isset($_GET["t"],$_GET["id"]) AND !empty($_GET["t"]) AND !empty($_GET["id"])){
    $getid = (int)$_GET["id"];
    $gett = (int)$_GET["t"];
    $sessionid = $_SESSION["id"];
    $reqcheck = $bdd->prepare("SELECT id_oeuvre FROM oeuvres WHERE id_oeuvre = ?");
    $reqcheck->execute(array($getid));

    if($reqcheck->rowCount() == 1){
        if($gett == 1){
            //requete pour vérifier la présence de l'oeuvre dasn les favoris de l'utiisateur
            $reqCheckFav = $bdd->prepare("SELECT id_favoris FROM favoris WHERE id_oeuvre = ? AND id_utilisateur =?");
            $reqCheckFav->execute(array($getid,$sessionid));
            // on met une condition dans le cas l'utilisateur veut retirer l'oeure de ses favoris
            if($reqCheckFav->rowCount() == 1 ){//si l'oeuvre est présente donc 1 et que l'utilisateur press le bouton favoris l'oeuvre est delete des favoris par la requete si dessous et l'inverse dasn l'autr cas (INSERTION)
                $delFav = $bdd->prepare("DELETE FROM favoris WHERE id_oeuvre = ? AND id_utilisateur =?");
                $delFav->execute(array($getid,$sessionid));
            } else{
                $addfav = $bdd->prepare("INSERT INTO favoris(id_utilisateur,id_oeuvre) VALUES(?,?)");
                $addfav->execute(array($sessionid,$getid));
            }
            
        }
        header("location: ".$_SERVER['HTTP_REFERER']);  /* une fois la requete effectué, retour a la page précédente.*/
    } else{
        exit("erreur fatal");
    }
}else {
    exit("erreur fatale. <a href='bibliotheque.php'> revenir a l'accueil </a> ");
}

?>