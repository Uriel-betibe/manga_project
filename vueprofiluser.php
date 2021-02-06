<?php 
include_once('pageConstantes/head.php');   //liaison a la base donnée et cookies et demarage session
?>

<?php 
if(isset($_GET["id"]) AND ($_GET["id"] > 0) AND (($_SESSION['acces_utilisateur'] == 1) OR ($_SESSION['acces_utilisateur'] == 2))) // seul l'admin et les moderateurs peuvent acceder a cette page d'ou la condition sur les acces
{
    //requetes pour afficher les données de l'utilisateur et ses commentaires
    $getid = (int)$_GET["id"];
    $requser = $bdd->prepare("SELECT * FROM utilisateur WHERE id_utilisateur = ?");
    $requser->execute(array($getid));
    $userinfo = $requser->fetch();

    $reqcommentaire = $bdd->prepare('SELECT * FROM commentaires WHERE id_utilisateur = ?');
    $reqcommentaire->execute(array($getid)); 

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>accueil</title>
</head>
<body>
<?php include "pageConstantes/menu.php" ?>

<!-- espace d'affichage des données utilisateur  -->
<div class="container mt-5">
    <div class="row " > 
    <div class=" col-md-4 mx-auto bg-secondary text-white " text-align="center">
        <h2>PROFIL de <?php echo $userinfo["pseudo"]; ?> </h2> 
        nom =  <?php echo $userinfo["nom"];?>
        <br>   <br> 
        prenom =  <?php echo $userinfo["prenom"]; ?>
        <br>   <br> 
        Mail = <?php echo $userinfo["mail"]; ?>
        <br>   <br> 
        date de naissance = <?php echo $userinfo["date_naissance"]; ?>
        <br> <br>
        date d'inscription = <?php echo $userinfo["date_inscription"]; ?>
        <br> <br>
        <a class="btn btn-primary" href="gestionutilisateur.php"> OK </a>
    </div>
    <!-- espace affichages des commentaires de l'utilisateur -->
    <div class="col-md-5">
        <h5>commentaires</h5>
        <?php while($commentaireuser = $reqcommentaire->fetch()){ ?>
        commentaire : <?php echo $commentaireuser["remarque"];?> <br>
        <a class="btn btn-danger" href="pageConstantes\deletecom.php?idcom=<?php echo $commentaireuser['id_commentaire'];?>">SUPPRIMER</a>
        <hr>

        <?php } ?>
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

<?php } ?> 