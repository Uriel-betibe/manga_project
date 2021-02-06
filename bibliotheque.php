<?php 
include_once('pageConstantes/head.php');   //liaison a la base donnée et cookies et demarage session
?>
<?php  
    //requete pour récupérer toute les oeuvres de la base de données
    $oeuvres = $bdd->query("SELECT * FROM oeuvres");

    /*j'ai fais un algorithme de recherche très simple qui prends en compte l'entrée de l'utilisateur dans la barre de recherche 
        il aurait pu etre améliorer si on avait mis en place un système de catégories.
    */
    if(isset($_GET["recherche"]) AND !empty($_GET["recherche"]) ){
        $recherche = $_GET["recherche"];
        $oeuvres = $bdd->query('SELECT * FROM oeuvres WHERE titre LIKE "%'.$recherche.'%" ORDER BY id_oeuvre DESC');

    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bibliotheque</title>
</head>
<body>
<?php include "pageConstantes/menu.php" ?>

<!-- barre de recherche des oeuvres dans la bibliothèques -->
<div class="container">
      <div class="row mt-3 mb-3">
        <div class="col">
            <form method="GET">
            <input class="form-control" name="recherche" id="searchInput" type="search" placeholder="Search..">
            <input type="submit" value="valider">
            </form>
           
        </div>
     </div>
<!-- affichage des oeuvres -->
<div class="container mt-3">
    <div class="row">

    <?php if($oeuvres->rowCount() > 0){ //je m'assure qu'il y'ai des oeuvres enregistré?>
    <?php
    //j'effectue une boucle sur les oeuvre pour les afficher 
    while($oeuvre = $oeuvres->fetch()){
    ?>  

            <div class="col-6 col-lg-4 mb-3 mb-lg-5" >
                <div class="card h-100  border-dark shadow">
                    <img class="card-img-top" src="<?php echo($oeuvre["couverture_oeuvre"]);?>"  wight="105" height="300" alt="couveture oeuvres">
                    <div class="card-body bg-dark text-white">
                        <h5 class="card-title">titre: <?php echo($oeuvre["titre"]); ?></h5>
                        <p class="card-text">Auteur: <?php echo($oeuvre["auteur"]); ?> <br>
                        <a class=" btn btn-primary" href="details.php?id=<?php echo($oeuvre["id_oeuvre"]) ?>" role="button" >voir plus</a> <a class=" btn btn-warning" href="pageConstantes/action.php?t=1&id=<?= $oeuvre["id_oeuvre"] ?>" role="button" >favoris</a>
                        </p> <!-- lien au dessus dirigent vers une page qui affiche les détails sur l'oeuvre -->
                    </div>
                </div>
            </div>

    <?php
    }
    ?>

<?php } else { ?>
    Aucun résultat...
 <?php } ?> 

    </div>
</div>


<?php include "pageConstantes/pieddepage.php" ?>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>