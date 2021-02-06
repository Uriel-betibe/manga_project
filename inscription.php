<?php 
include_once('pageConstantes/head.php');   //liaison a la base donnée et cookies et demarage session
?>

<?php

    //verification des données saisie dans le formulaire d'inscription
    if(isset($_POST['forminscription']))
    {   //j'effectue une verificaton sur les informations saisie
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $mail = htmlspecialchars($_POST['mail']);
        $datenaissance = $_POST['date_naissance'];
        $dateInscription = date("Y-m-d");
        $mdp = md5($_POST['mdp']);
        $v_mdp = md5  ($_POST['v_mdp']);

        $nomTaille = strlen($nom);
        $prenomTaille = strlen($prenom);
        $pseudoTaille = strlen($pseudo);
       
        if(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['pseudo']) 
            AND !empty($_POST['mail']) AND !empty($_POST['mdp']) AND !empty($_POST['v_mdp']) AND !empty($_POST['nom']))
        {  // j'impose une limite de 255 charactères aux utilisateurs pour le nom, le prenom et le pseudo
            if($nomTaille <= 255)
            {
                if($prenomTaille <= 255)
                {
                    if($pseudoTaille <= 255)
                    {  //requete por verifier la présence du pseudo dans la BDD
                        $reqpseudo = $bdd->prepare("SELECT * FROM utilisateur WHERE pseudo =  ?");
                        $reqpseudo->execute(array($pseudo));
                        $pseudoexist = $reqpseudo->rowCount();
                        if($pseudoexist==0)
                        {
                            if(filter_var($mail,FILTER_VALIDATE_EMAIL)) //j'applique la fonction filter pour m'assurer que l'adresse mal est au formart valide
                            {   //requete pour vérifier la présence de l'adresse mail dans la BDD
                                $reqmail = $bdd->prepare("SELECT * FROM utilisateur WHERE mail = ?");
                                $reqmail->execute(array($mail));
                                $mailexist = $reqmail->rowCount();
                                if($mailexist == 0)
                                {
                                    if($mdp == $v_mdp )//verfication de l'équivalence des mots de passe
                                    {   //requete d'insertion des données de l'utilisateur dasn a BDD 
                                        $insertuser = $bdd->prepare("INSERT INTO utilisateur(nom,prenom,pseudo,date_naissance,date_inscription,mail,mdp,id_acces ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                                        $insertuser->execute(array($nom, $prenom, $pseudo, $datenaissance, $dateInscription , $mail, $mdp, 3));
                                        $erreur = "votre compte a bien été créé !" ;
                                        header('location: connexion.php');
                                    }
                                    else
                                    {
                                        $erreur = "les mots de passe saisies sont différents";
                                    }
                                }
                                else
                                {
                                    $erreur = "cette adresse mail est déja utilisé ";
                                }
                            }
                            else
                            {
                                $erreur = "votre adresse mail n'est pas valide";
                            }
                        }
                        else 
                        {
                            $erreur = "ce pseudo est déja utilisé";
                        }    
                    }
                    else
                    {
                        $erreur = "le pseudo ne doit pas depasser 255 charactères";
                    }
                }
                else
                {
                    $erreur = "le prenom ne doit pas depasser 255 charactères";
                }
            }
            else
            {
                $erreur = "le nom ne doit pas depasser 255 charactères";
            }
        }
        else
        {
            $erreur = "tous les champs doivent etre complété";
        }
    }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inscription </title>
</head>

<body>
    <?php include "pageConstantes/menu.php" ?>
<!-- formulaire d'inscripton dans l'espace inscription -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-8 col-lg-4 mx-auto">
                <h1 class="text-center">INSCRIPTION</h1>
                <form action="" method="POST">
                    <div class="form-group">
                    <input type="text" name="nom" class="form-control" placeholder="nom" value="<?php if(isset($nom)){ echo $nom;}?>">
                    </div>
                    <div class="form-group">
                    <input type="text" name="prenom" class="form-control" placeholder="prenom" value="<?php if(isset($nom)){ echo $prenom;}?>"> 
                    </div>
                    <div class="form-group">
                    <input type="text" name="pseudo" class="form-control" placeholder="pseudo" value="<?php if(isset($nom)){ echo $pseudo;}?>"> 
                    </div>
                    <div class="form-group">
                    <input type="email" name="mail" class="form-control" placeholder="adresse mail" value="<?php if(isset($nom)){ echo $mail;}?>"> 
                    </div>
                    <div class="form-group">
                    <input type="date" name="date_naissance" class="form-control" id=date max ="<?= date("Y-m-d"); ?>" placeholder="date de naissance"> 
                    </div>
                    <div class="form-group">
                    <input type="password" name="mdp" class="form-control" placeholder="mot de passe"> 
                    </div>
                    <div class="form-group">
                    <input type="password" name="v_mdp" class="form-control" placeholder="resaisissez votre mot de passe"> 
                    </div>
                    <input type="submit" class="btn btn-primary mx-auto" name="forminscription" value="valider">
                </form>
            </div>
        </div>
    </div>




    <?php 
        if(isset($erreur))
        {
            echo $erreur; 
        }
    ?>



<?php include "pageConstantes/pieddepage.php" ?>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>