<?php 
session_start();
$_SESSION = array();
//comme le nom l'indique on supprime la session de l'utilisateur et le deconnect.
session_destroy();
header("location: connexion.php");

?>