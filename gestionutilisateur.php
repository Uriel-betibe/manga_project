<?php 
include_once('pageConstantes/head.php');   //liaison a la base donnée et cookies et demarage session
?>

<?php 

//verification des données saisie dans le formulaire de creation d'un utilisateur 
if(isset($_POST['enregistrer']))
{ //le meme système d'enregistrement que les autres, j'effectue une verificaton sur les informations saisie
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
    {    // j'impose une limite de 255 charactères aux utilisateurs pour le nom, le prenom et le pseudo
        if($nomTaille <= 255)
        {
            if($prenomTaille <= 255)
            {
                if($pseudoTaille <= 255)
                {    //requete por verifier la présence du pseudo dans la BDD
                    $reqpseudo = $bdd->prepare("SELECT * FROM utilisateur WHERE pseudo =  ?");
                    $reqpseudo->execute(array($pseudo));
                    $pseudoexist = $reqpseudo->rowCount();
                    if($pseudoexist==0)
                    {
                        if(filter_var($mail,FILTER_VALIDATE_EMAIL))//j'applique la fonction filter pour m'assurer que l'adresse mal est au formart valide
                        {   //requete pour vérifier la présence de l'adresse mail dans la BDD
                            $reqmail = $bdd->prepare("SELECT * FROM utilisateur WHERE mail = ?");
                            $reqmail->execute(array($mail));
                            $mailexist = $reqmail->rowCount();
                            if($mailexist == 0)
                            {
                                if($mdp == $v_mdp )
                                { //verfication de l'équivalence des mots de passe
                                    if(isset($_POST["acces"])){
                                        $idacces = 2; //acces 2 pour creer un compte modérateur 
                                        $insertuser = $bdd->prepare("INSERT INTO utilisateur(nom,prenom,pseudo,date_naissance,date_inscription,mail,mdp,id_acces ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                                        $insertuser->execute(array($nom, $prenom, $pseudo, $datenaissance, $dateInscription , $mail, $mdp, $idacces));
                                        $succes = "compte moderateur créé !" ;
                                        header('location: gestionCreateur.php');
                                    }else {
                                        $idacces = 3; // accès 3 pour creer un compte membre 
                                        $insertuser = $bdd->prepare("INSERT INTO utilisateur(nom,prenom,pseudo,date_naissance,date_inscription,mail,mdp,id_acces ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                                        $insertuser->execute(array($nom, $prenom, $pseudo, $datenaissance, $dateInscription , $mail, $mdp, 3));
                                        $succes = " compte membre créé !" ;
                                        header('location: gestionCreateur.php');
                                    }// un compte Admin ne peut etre créé que directement dans la BDD 
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






<?php 

  //affichage des profils en fonctions  des accès, je recupere l'acces avec la variable de SESSION etablie lors de la connexion
  //accès 1 donc j'affiche tout les profils de la BDD
  if($_SESSION["acces_utilisateur"]==1){
    $reqprofils = $bdd->query('SELECT id_utilisateur,nom,prenom,pseudo,mail,date_inscription,utilisateur.id_acces,status_adm 
    FROM utilisateur 
    LEFT JOIN profil_acces on profil_acces.id_acces = utilisateur.id_acces');

  } //acces 2 je n'affiche que les données des membres et non les autres niveaux
    elseif($_SESSION["acces_utilisateur"]==2) {
      $reqprofils = $bdd->query('SELECT id_utilisateur,nom,prenom,pseudo,mail,date_inscription,utilisateur.id_acces,status_adm 
      FROM utilisateur 
      LEFT JOIN profil_acces on profil_acces.id_acces = utilisateur.id_acces
      WHERE utilisateur.id_acces = 3');
    }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>accugestion utilisateur</title>
</head>
<body>
<?php include "pageConstantes/menu.php" ?>







<!-- formlaire de creation d'un nouveau compte uilisateur  -->
<div class="modal fade" id="addusermodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajouter utilisateur</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="" method="POST">
          <div class="form-group">
          <input type="text" name="nom" class="form-control" placeholder="nom" >
          </div>
          <div class="form-group">
          <input type="text" name="prenom" class="form-control" placeholder="prenom" > 
          </div>
          <div class="form-group">
          <input type="text" name="pseudo" class="form-control" placeholder="pseudo" > 
          </div>
          <div class="form-group">
          <input type="email" name="mail" class="form-control" placeholder="adresse mail" > 
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
          <?php if($_SESSION["acces_utilisateur"] == 1){?>  
          <div class="form-group">
          <input type="checkbox" name="acces" class="form-check-control" >
          <label for="acces" class="form-check-label"> <b>cocher si compte moderateur</b> </label>
          </div>
          <?php } else { ?>
            <div class="form-group">
            <p>compte membre</p>
            </div>
          <?php } ?>
          <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">fermer</button>
          <button type="submit" name="enregistrer" class="btn btn-primary">enregistrer</button>
          </div>
      </form>
      </div>
    </div>
  </div>
</div>



<div class="container mt-5 text-center">
      <h3>GESTION DES UTILISATEURS</h3>
</div>


<div class="container mt-5 mb-5">
  <div class="row">
    <div class="col">
        <!-- bouton pour afficher la fiche pour ajoter un utilisateur -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addusermodal">
        + Add user
        </button>
    </div>
  </div>
</div>
<!-- message d'erreur dasn le cas les données saisie das le formulaire présente des erreurs -->
<?php if(isset($erreur)){ ?> 
    <div>
        <?php echo($erreur.", veuillez réessayer "); ?>
    </div>
  <?php } ?>

<!-- tables des utilisateurs  -->
<div class="container">
  <div class="row">
    <table class="table table-hover table-dark mb-3">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nom</th>
        <th scope="col">Prenom</th>
        <th scope="col">Pseudo</th>
        <th scope="col">mail</th>
        <th scope="col">date d'inscription</th>
        <th scope="col">status</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody> 
      <?php while($profil = $reqprofils->fetch()){ ?> 
      <tr>
        <th scope="row"><?= $profil["id_utilisateur"] ?></th>
        <td><?= $profil["nom"] ?></td>
        <td><?= $profil["prenom"] ?></td>
        <td><?= $profil["pseudo"] ?></td>
        <td><?= $profil["mail"] ?></td>
        <td><?= $profil["date_inscription"] ?></td>
        <td><?= $profil["status_adm"] ?></td>
        <td> <a class="btn btn-primary" href="vueprofiluser.php?id=<?php echo $profil["id_utilisateur"]; ?>"> voir plus </a> <a class="btn btn-danger" href="pageConstantes\supprimeruser.php?delid=<?php echo($profil["id_utilisateur"]); ?> "> Supprimer user </a> </td>
      </tr>
      <?php } ?>
    </tbody>
    </table>
  </div>
</div>





<?php include "pageConstantes/pieddepage.php" ?>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>