<?php 
include_once('pageConstantes/head.php');   //liaison a la base donnée et cookies et demarage session
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>favoris</title>
</head>
<body>
<?php include "pageConstantes/menu.php" ?>

 

<div class="container mt-3">
    <h3 class="text-center">Mes favoris</h3>
    <hr>
    <div class="row">
    

    <?php
    $sessionid = $_SESSION["id"]; // on recupere l'id de l'utilisateur avec la variable de session
    // requete pour récuperer les oeuvres favoris de l'uilisateur   
    $oeuvres = $bdd->prepare("SELECT * FROM oeuvres LEFT JOIN favoris on favoris.id_oeuvre = oeuvres.id_oeuvre WHERE favoris.id_utilisateur = ?");
    $oeuvres->execute(array($sessionid));
    while($oeuvre = $oeuvres->fetch()){
    ?>  
            <!-- affichage des oeuvres dans favoris -->
            <div class="col-6 col-lg-4 mb-3 mb-lg-5" >
                <div class="card h-100  border-dark shadow">
                    <img class="card-img-top" src="<?php echo($oeuvre["couverture_oeuvre"]);?>"  wight="105" height="300" alt="couveture oeuvres">
                    <div class="card-body bg-dark text-white">
                        <h5 class="card-title">titre: <?php echo($oeuvre["titre"]); ?></h5>
                        <p class="card-text">Auteur: <?php echo($oeuvre["auteur"]); ?> <br>
                        <a class=" btn btn-primary" href="details.php?id=<?php echo($oeuvre["id_oeuvre"]) ?>" role="button" >voir plus</a> <a class=" btn btn-warning" href="pageConstantes/action.php?t=1&id=<?= $oeuvre["id_oeuvre"] ?>" role="button" >favoris</a>
                        </p>  <!-- dans le lien du bouton favois j'ai ajouter 2 variable, t et id qui passe par l'addresse et sont recupérer par a methode GET  -->
                    </div>
                </div>
            </div>

    <?php
    }
    ?>

    <div>
</div>


<!-- cas exeptionnel ou le footer est présent sur la page  -->
<footer class="bg-light fixed-bottom">
        <div class="container mt-3">
          <div class="row">
            <div class="col-12">
              <ul class="list-inline text-center">
                <li class="list-inline-item"><a href="#">À propos</a></li>
                <li class="list-inline-item">&middot;</li>
                <li class="list-inline-item"><a href="#">Vie privée</a></li>
                <li class="list-inline-item">&middot;</li>
                <li class="list-inline-item"><a href="#">Conditions d'utilisations</a></li>
              </ul>
            </div>
          </div>
        </div>
</footer>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>