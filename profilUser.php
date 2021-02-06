<?php 
include_once('pageConstantes/head.php');   //liaison a la base donnée et cookies et demarage session
?>
<?php 
//le profil de l'utilisateur ne s'affiche que quand il s'inscrit et quand il est connecté
if((isset($_GET["id"]) AND $_GET["id"] > 0) OR isset($_SESSION["id"]))
{   //requete pour récupere les données de la base sur l'utilisateur 
    $getid = intval($_SESSION["id"]);
    $requser = $bdd->prepare("SELECT * FROM utilisateur WHERE id_utilisateur = ?");
    $requser->execute(array($getid));
    $userinfo = $requser->fetch();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profil utilisateur</title>
</head>

<body>
<?php include "pageConstantes/menu.php" ?>
<!-- affichage des données de l'uilisateur  -->
<div class="container mt-5">
    <div class="row" >
        <div class="col text-center">
        <h2>PROFIL de <?php echo $userinfo["pseudo"]; ?> </h2> 
        nom =  <?php echo $userinfo["nom"];?>
        <br>   <br> 
        prenom =  <?php echo $userinfo["prenom"]; ?>
        <br>   <br> 
        Mail = <?php echo $userinfo["mail"]; ?>
        <br>   <br> 
        date de naissance = <?php echo $userinfo["date_naissance"]; ?>
        <br> <br>
        <?php 
        if(isset($_SESSION["id"]) AND $userinfo["id_utilisateur"] == $_SESSION["id"])
        {
        ?> <!-- dans le cas ou l'utilisateur souhaite modifier son profil il a ce lien pour le rediriger vers la page d'éditon de son profil  -->
                <a href="editionProfil.php"> éditer  mon  profil </a> <br>
        <?php
        }
        ?>
        </div>
    </div>
</div>



<?php include "pageConstantes/pieddepage.php" ?>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
<?php
}
else 
{
    header("location: connexion.php"); //si l'utilisateur n'est pas connecté dans le cas ou il clic sur la page profil il est rediriger vers la page de connexion
}
?>