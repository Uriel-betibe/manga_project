<?php 
include_once('head.php');   //liaison a la base donnée et cookies et demarage session

if(isset($_GET["id"]) and $_GET["id"] > 0 ){
    $idOeuvre = $_GET["id"];
    //requete pour recpérer l'oeuvre et ses données de la table oeuvre et manga
    $reqoeuvre = $bdd->prepare("SELECT id_manga,date_sortie_m,nbr_chapitre,resume_manga,titre,auteur,couverture_oeuvre,date_ajout FROM oeuvres 
                                LEFT JOIN mangas on mangas.id_oeuvre = oeuvres.id_oeuvre 
                                WHERE oeuvres.id_oeuvre = ?");
    $reqoeuvre->execute(array($idOeuvre));
    $oeuvreinfo = $reqoeuvre->fetch();
?>

<?php 

    if(isset($_POST["misaj"])){
        $newchap = (int)$_POST["newchap"];
        //requete de mise a jour du nombre de chapitre
        $majchapitre = $bdd->prepare('UPDATE mangas SET nbr_chapitre = ? WHERE id_oeuvre = ? ');
        $majchapitre->execute(array($newchap,$idOeuvre));
        header("location: miseajouroeuvre.php?id=".$idOeuvre);
    }

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

<!-- espace d'information sur le manga et de mis a jour du nombre de chapitre disponible  -->
<div class="container">
    <div class="row">
        <div class="col col-md-4 mx-auto">
        <h4> titre : <?= $oeuvreinfo["titre"]; ?> </h4> 
                <p> auteur : <?= $oeuvreinfo["auteur"] ;?> </p> 
                <p> nombres de chapitre disponible : <?= $oeuvreinfo["nbr_chapitre"] ;?>  </p>
                <!-- formulaire pour mettre a jour le nombre de chapitre -->
                <form action="" method="POST">
                    <input type="number" name="newchap" min="1" max="3000">
                    <input type="submit" name ="misaj" value="mettre a jour">
                </form>
                <p> date de sortie : <?= $oeuvreinfo["date_sortie_m"]; ?> </p> 
                <p> date d'ajout : <?= $oeuvreinfo["date_ajout"]; ?> </p> 
        </div>
    </div>
</div>

<div> 
    <button><a href="http://localhost/cours_2020/site_final/gestionOeuvres.php">retour a la page de gestion</a></button> <!-- lien de retour a la page de gestion des oeuvres -->
</div>







<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>

<?php } ?>