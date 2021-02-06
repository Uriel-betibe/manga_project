<?php 
include_once('pageConstantes/head.php');   //liaison a la base donnée et cookies et demarage session
?>
<?php
    //code pour afficher les données du manga, si cette condition n'est pas remple la page ne s'affiche pas 
    if(isset($_GET["id"]) and $_GET["id"] > 0 ){
        $idOeuvre = $_GET["id"];
        $reqoeuvre = $bdd->prepare("SELECT id_manga,date_sortie_m,nbr_chapitre,resume_manga,titre,auteur,couverture_oeuvre,date_ajout FROM oeuvres 
                                    LEFT JOIN mangas on mangas.id_oeuvre = oeuvres.id_oeuvre 
                                    WHERE oeuvres.id_oeuvre = ?");
        $reqoeuvre->execute(array($idOeuvre));
        $oeuvreinfo = $reqoeuvre->fetch();


    //enregistrer les commentaires 
    if(isset($_POST["envoyer"])){
        if(isset($_POST["commentaire"]) AND !empty($_POST["commentaire"])){
            $commentaire = htmlspecialchars($_POST["commentaire"]);//on applique htmlspecialchar pour verifier l'entrée des utilisateurs
            $sessionid = $_SESSION["id"]; // le session id permet de récupere l'id de l'utilisateur 
            // requete d'inserion des commentaires dasn la BDD
            $inscom = $bdd->prepare("INSERT INTO commentaires(remarque,id_utilisateur,id_oeuvre) VALUES(?,?,?)");
            $inscom->execute(array($commentaire,$sessionid,$idOeuvre));

        }else {
            $msg = "tous les champs doivent etre complété";
        }
    }

    //recupérer les commentaires sur l'oeuvre
    $reqcommentaire = $bdd->prepare("SELECT pseudo,remarque FROM commentaires 
                                    LEFT JOIN utilisateur on utilisateur.id_utilisateur = commentaires.id_utilisateur
                                    WHERE id_oeuvre = ? ORDER BY id_commentaire DESC");
    $reqcommentaire->execute(array($idOeuvre));
    
    
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>details</title>
</head>
<body>
<?php include "pageConstantes/menu.php" ?>

    <!-- affichage des détails de l'oeuvre -->
    <div class="container mt-5">
        <div class="row ">
            <div class="col-12 col-lg-3">
                <img src="<?php echo($oeuvreinfo["couverture_oeuvre"]); ?>"  wight="105" height="300" alt="couverture de l'oeuvre">
            </div>
            <div class="col  col-lg-5 ml-lg-3">
                <h4> titre : <?= $oeuvreinfo["titre"]; ?> </h4> 
                <p> auteur : <?= $oeuvreinfo["auteur"] ;?> </p> 
                <p> nombres de chapitre disponible : <?= $oeuvreinfo["nbr_chapitre"] ;?>  </p> 
                <p> date de sortie : <?= $oeuvreinfo["date_sortie_m"]; ?> </p> 
                <p> date d'ajout : <?= $oeuvreinfo["date_ajout"]; ?> </p> 
                <p> resumé :
                    <?= $oeuvreinfo["resume_manga"]; ?>
                </p>   
            </div>
        </div>

        <div class="row">
            <div>
                <!-- espace commentaire por les utilisateur -->
                <h5>commentaires </h5>
                <form action="" method="POST">
                    <label for="pseudo">Pseudo : <?= $_SESSION["pseudo"]; ?> </label><br>
                    <textarea name="commentaire" cols="50" rows="5" placeholder="laisser un commentaire...." ></textarea> <br> <br>
                    <input type="submit" value="poster" name="envoyer">
                </form>
                <?php if(isset($c_erreur)){ echo $msg; }?>
            </div>
        </div>

        <!-- affichage des commentaires laissé par les utilisateur  -->
        <div class="row mt-3">
            <div class="col"> 
                <?php while($com = $reqcommentaire->fetch()){ ?>
                    <b><?= $com["pseudo"];?> :</b> <?= $com["remarque"];?> <br>
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
<?php
    } // fermeture de la conditon if(isset($_GET["id"]) and $_GET["id"] > 0 )
?>