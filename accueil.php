<?php 
include_once('pageConstantes/head.php');   //liaison a la base donnée et cookies et demarage session
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
<!-- pour alléger le code j'ai mis les éléments fix dans des  fichiers a part qui soont de le dossier page constante, comme le header avec le menu et le footer  -->
<?php include "pageConstantes/menu.php" ?>

<!-- la page d'accueil n'a que pour fonction principal de rediriger les utilisateurs vers les pages de connexion ou d'inscription via les boutons plus bas -->
<div class="container">
<div id ="carouselControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
               <div class="carousel-item active">
                  <img src="img/fonds2.jpg" class="d-block w-100" alt="...">
               </div>
               <div class="carousel-item">
                  <img src="img/fonds.jpg" class="d-block w-100" alt="...">
               </div>
               <div class="carousel-item">
                  <img src="img/fonds3.jpg" class="d-block w-100" alt="...">
               </div>
            </div>
            <a class="carousel-control-prev" href="#carouselControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Précédent</span>
             </a>
             <a class="carousel-control-next" href="#carouselControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Suivant</span>
             </a>
         </div>

</div>


<?php if(isset($_SESSION["id"])){ ?>

   <div class="container mt-3">
   <div class="row">
      <div class="col text-center">
         <h3> VOUS ETES CONNECTE </h3>
      </div>
   </div>
   </div>

<?php } else { ?>

   <div class="container mt-3">
   <div class="row">
      <div class="col text-center">
         <a  class ="btn btn-primary center" href="inscription.php"> s'inscrire </a> <!-- lien pour la page d'inscription -->
         <hr>
         <a class ="btn btn-primary" href="connexion.php"> se connecter </a> <!-- lien pour la page de connexion -->
      </div>
   </div>
   </div>

<?php } ?>





<div class="container mt-5 ">
   <div class="row">
      <div class="col col-lg-4 mb-3 mb-lg-4" >
            <div class="card border-dark shadow">
               <img class="card-img-top" src="img/bibliotheque.png" alt="">
               <div class="card-body bg-dark text-white">
                     <p class="card-text"> Une bibliotheque remplie</p>
               </div>
            </div>
      </div>
      <div class="col col-lg-4 mb-3 mb-lg-4" >
            <div class="card border-dark shadow">
               <img class="card-img-top" src="img/securite.png" alt="">
               <div class="card-body bg-dark text-white">
                     <p class="card-text">Des comptes sécurisés</p>
               </div>
            </div>
      </div>
      <div class="col col-lg-4 mb-3 mb-lg-4" >
            <div class="card border-dark shadow">
               <img class="card-img-top" src="img/community.png" alt="">
               <div class="card-body bg-dark text-white">
                     <p class="card-text">Une communauté présente</p>
               </div>
            </div>
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