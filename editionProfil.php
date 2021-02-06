<?php 
include_once('pageConstantes/head.php');   //liaison a la base donnée et cookies et demarage session
?>
<?php 
if(isset($_SESSION["id"])) // pour s'assurer que l'utilisateur est connecté  
{
    //requete pour recuperer les données de l'utilisateur
    $requser = $bdd->prepare("SELECT * FROM utilisateur WHERE id_utilisateur = ?");
    $requser->execute(array($_SESSION["id"]));
    $user = $requser->fetch();

    //requete pour enregistrer la modification du nom de l'utilisateur 
    if(isset($_POST["newnom"]) AND !empty($_POST["newnom"]) AND $_POST["newnom"] != $user["nom"] )
    {
        $newnom = htmlspecialchars($_POST["newnom"]);
        $insertnom = $bdd->prepare("UPDATE utilisateur SET nom = ? WHERE id_utilisateur = ? ");
        $insertnom->execute(array($newnom,$_SESSION["id"]));
        header("location: profilUser.php?id=".$_SESSION["id"]);
    }
    //requete pour enregistrer la modification du prenom de l'utilisateur 
    if(isset($_POST["newprenom"]) AND !empty($_POST["newprenom"]) AND $_POST["newprenom"] != $user["prenom"] )
    {
        $newprenom = htmlspecialchars($_POST["newprenom"]);
        $insertprenom = $bdd->prepare("UPDATE utilisateur SET prenom =? WHERE id_utilisateur = ? ");
        $insertprenom->execute(array($newprenom,$_SESSION["id"]));
        header("location: profilUser.php?id=".$_SESSION["id"]);
    }

    //requete pour enregistrer la modification le pseudo de l'utilisateur 
    if(isset($_POST["newpseudo"]) AND !empty($_POST["newpseudo"]) AND $_POST["newpseudo"] != $user["pseudo"] )
    {
        $newpseudo = htmlspecialchars($_POST["newpseudo"]);
        $insertpseudo = $bdd->prepare("UPDATE utilisateur SET pseudo =? WHERE id_utilisateur = ? ");
        $insertpseudo->execute(array($newpseudo,$_SESSION["id"]));
        header("location: profilUser.php?id=".$_SESSION["id"]);
    }

    //requete pour enregistrer la modification de  l'adresse mail de l'utilisateur 
    if(isset($_POST["newmail"]) AND !empty($_POST["newmail"]) AND $_POST["newamil"] != $user["mail"] )
    {
        $newamil = htmlspecialchars($_POST["newmail"]);
        $insertmail = $bdd->prepare("UPDATE utilisateur SET mail =? WHERE id_utilisateur = ? ");
        $insertmail->execute(array($newmail,$_SESSION["id"]));
        header("location: profilUser.php?id=".$_SESSION["id"]);
    }

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edition profil</title>
</head>

<body>

<?php include "pageConstantes/menu.php" ?>

<!-- formulaire d'édition du profl de l'utilisateur  -->
<div class="text-center mt-5">
    <h2>EDITON PROFIL </h2> <br> <br>
    <form action="" method="POST">
        <label>Nom : </label>
        <input type="text" name="newnom"  value="<?php echo $user["nom"] ?>"> <br> <br>
        <label>Prenom : </label>
        <input type="text" name="newprenom"  value="<?php echo $user["prenom"] ?>"> <br> <br>
        <label>Pseudo : </label>
        <input type="text" name="newpseudo"  value="<?php echo $user["pseudo"] ?>"> <br> <br>
        <label>Mail : </label>
        <input type="email" name="newmail"  value="<?php echo $user["mail"] ?>"> <br> <br>
        <input type="submit" value="mettre a jour">
    </form>
</div>

<?php include "pageConstantes/pieddepage.php" ?>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
<?php
}
else 
{
    header("location: connexion.php"); // dans le cas ou l'uilisateur n'est pas connecté donc SESSION["id"] n'est pas set il est redirigé vers la page de connexion 
}
?>