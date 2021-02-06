<?php 
include_once('pageConstantes/head.php');   //liaison a la base donnée et cookies et demarage session
?>

<?php 

//verification des données saisie dans le formulaire d'ajout de manga
if(isset($_POST['enregistrer']))
{   //j'enregistre les données dans des variables apres avoir utiliser les foncton htmlspecialchar et utiliser (int) 
    $titre = htmlspecialchars($_POST['titre']);
    $auteur = htmlspecialchars($_POST['auteur']);
    $image = $_POST['lienImg'];
    $nbrChap = (int) $_POST['nbrChap'];
    $dateajout = date("Y-m-d G:i:s");
    $datesortie= $_POST["dateSortie"];
    $resume = htmlspecialchars($_POST['resume']);
    //on s'assure que les champs ne sont pas vide avec la condition ci-dessous
    if(!empty($_POST['titre']) AND !empty($_POST['auteur']) AND !empty($_POST['lienImg']) 
        AND !empty($_POST['nbrChap']) AND !empty($_POST['dateSortie']) AND !empty($_POST['resume']))
    {
        if(strlen($titre) <= 255)
        {   // requete pour vérifier si l'oeuvre n'est pas déja présente dans la BDD
            $controloeuvre = $bdd->prepare("SELECT * FROM oeuvres WHERE titre = ?");
            $controloeuvre->execute(array($titre));
            $oeuvreexist = $controloeuvre->rowCount();
            if($oeuvreexist==0){

                if(strlen($auteur) <= 255){
                    /* pour l'insertion d'une nouvelle oeuvre il faut faire une insertion dasn 2 table, la table oeuvre et la table mangas*/ 
                    //insertion dasn la table oeuvre
                    $insertionoeuvre = $bdd->prepare('INSERT INTO oeuvres(titre,auteur,couverture_oeuvre,date_ajout,type_oeuvre)VALUES(?,?,?,?,?)');
                    $insertionoeuvre->execute(array($titre,$auteur,$image,$dateajout,"manga"));
                    //ici on récupère l'id_oeuvre de la nouvelle insertion
                    $temporaire = $bdd->prepare("SELECT * FROM oeuvres WHERE titre = ?");
                    $temporaire->execute(array($titre));
                    $temp = $temporaire->fetch();
                    $idtemp = $temp["id_oeuvre"];
                    //insertion dans la table mangas 
                    $insertionmanga = $bdd->prepare('INSERT INTO mangas(date_sortie_m,nbr_chapitre,resume_manga,id_oeuvre)VALUES(?,?,?,?)');
                    $insertionmanga->execute(array($datesortie,$nbrChap,$resume,$idtemp));
                    header("location: gestionOeuvres.php");//on actualise la page 

                }else{
                    $erreur="le nom de l'auteur ne dot pas depasser 255 charactères";
                }

            }else{
                $erreur="cette oeuvre existe déja";
            }
        }
        else
        {
            $erreur = "le titre ne doit pas depasser 255 charactères";
        }
    }
    else
    {
        $erreur = "tous les champs doivent etre complété";
    }
}

?>


<?php 
    //requete pour recuperer toute les oeuvres
    $reqoeuvres = $bdd->query('SELECT * FROM oeuvres')

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gestion oeuvres</title>
</head>
<body>
<?php include "pageConstantes/menu.php" ?>







<!-- formulaire de creation d'un nouveau compte uilisateur  -->
<div class="modal fade" id="addmanga" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
          <input type="text" name="titre" class="form-control" placeholder="titre" >
          </div>
          <div class="form-group">
          <input type="text" name="auteur" class="form-control" placeholder="auteur" > 
          </div>
          <div class="form-group">
          <input type="url" name="lienImg" class="form-control" placeholder="l'URL de l'image" >
          </div>
          <div class="form-group">
          <label for="nbrChap">entrez le nombre de chapitres</label>
          <input type="number" name="nbrChap" min="1" max ="3000" class="form-control"  > 
          </div>
          <div class="form-group">
          <label for="datSortie">date de sortie:</label>
          <input type="date" name="dateSortie" class="form-control" id=date max ="<?= date("Y-m-d"); ?>" > 
          </div>
          <div class="form-group">
          <textarea name="resume" cols="30" rows="10" placeholder="résumé du manga"></textarea>
          </div>
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
      <h3>GESTION DES MANGAS</h3>
</div>


<div class="container mt-5 mb-5">
  <div class="row">
    <div class="col">
        <!-- bouton pop-up pour afficher la fiche pour ajouter un manga -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addmanga">
        + Add manga
        </button>
    </div>
  </div>
</div>

<?php if(isset($erreur)){ ?> 
    <div>
        <?php echo($erreur.", veuillez réessayer "); ?>
    </div>
  <?php } ?>

<!-- table qui repertorie les oeuvres et leur données -->
<div class="container">
  <div class="row">
    <table class="table table-hover mb-3">
    <thead class="thead-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">titre</th>
        <th scope="col">auteur</th>
        <th scope="col">date d'ajout</th>
        <th scope="col">type d'oeuvre</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php while($oeuvre = $reqoeuvres->fetch()){ ?> 
      <tr>
        <th scope="row"><?= $oeuvre["id_oeuvre"] ?></th>
        <td><?= $oeuvre["titre"] ?></td>
        <td><?= $oeuvre["auteur"] ?></td>
        <td><?= $oeuvre["date_ajout"] ?></td>
        <td><?= $oeuvre["type_oeuvre"] ?></td>
        <td> <a class="btn btn-primary" href="pageConstantes\miseajouroeuvre.php?id=<?php echo $oeuvre["id_oeuvre"]; ?>" title="mise à jour des chapitres"  > MàJ </a> <a class="btn btn-danger" href="pageConstantes\deleteoeuvre.php?supoeuvre=<?php echo $oeuvre['id_oeuvre']?>"> Supprimer manga </a> </td>
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