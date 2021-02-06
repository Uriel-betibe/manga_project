<?php 
include_once('pageConstantes/head.php');   //liaison a la base donnée et cookies et demarage session
?>

<?php 

    if(isset($_POST['formconnexion'])) //validaton des données du formulaire de connexion
    {   
        $mailconnect = htmlspecialchars($_POST['mailconnect']);  //cette étape sert a scuriser un peu l'entré de l'utilisateur 
        $mdpconnect = md5($_POST['mdpconnect']);
        if(!empty($mailconnect) AND !empty($mdpconnect)) //on s'assure que les champs du formulaire ne sont pas vide 
        {
            //on lance la requete SQL pour vérifier la présence de l'utilisateur dans la BDD
            $requser = $bdd->prepare("SELECT * FROM utilisateur WHERE mail = ? AND mdp = ? ");
            $requser->execute(array($mailconnect, $mdpconnect));
            $userexist = $requser->rowCount();

            if($userexist == 1 )
            {
                //une fois la vérification effectuer on récupère les données de l'utilisateur dans des variables de SESSION pour qu'elles soient accessible partout
                $userinfo = $requser->fetch();
                $_SESSION["id"] = $userinfo['id_utilisateur'];
                $_SESSION["nom"] = $userinfo['nom'];
                $_SESSION["prenom"] = $userinfo['prenom'];
                $_SESSION["pseudo"] = $userinfo['pseudo'];
                $_SESSION["mail"] = $userinfo['mail'];
                $_SESSION["date_naissance"] = $userinfo['date_naissance'];
                $_SESSION["acces_utilisateur"] = $userinfo['id_acces'];  
                header("location: profilUser.php?id=".$_SESSION["id"]); // on redirige directement l'utilisateur sur sa page personnel 
            }
            else
            {
                $erreur = "l'adresse mail ou le mot de passe es erronné";
            }
        }
        else
        {
            $erreur = "tous les champs doivent etre complété !";
        }

    }

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>connexion</title>
</head>

<body>
<?php include "pageConstantes/menu.php" ?>

    <!--zone d'entrée de l'adresse mail et du mot de passe  -->
    <div class="container">
        <div class="row">
            <div class="col-6 ">
                <hr>
                <h1>CONNEXION</h1>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="email">email :</label> 
                        <input type="email" class="form-control" name="mailconnect" placeholder="addresse mail">
                    </div>
                    <div class="form-group">
                        <label for="password">votre mot de passe :</label>
                        <input type="password" class="form-control" name="mdpconnect" placeholder="mot de passe">
                    </div>
                    <input type="submit" class="btn btn-primary"  name = "formconnexion"  value="connexion">
                    </div>
                </form>
            </div>
        </div>
    </div>




    <!-- message d'erreur lors d'une fate dasn les données de connexion -->
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