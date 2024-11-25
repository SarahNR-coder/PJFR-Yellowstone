<?php
//J'active la SESSION
session_start();

//Déclaration des variables d'affichage
$pseudo = "";
$email = "";
$nameUser = "";
$firstnameUser = "";
$message = "";
$visibleConnectedUser = "toggleElt";
$visibleUnconnectedUser ="displayNone";
$current_page = basename($_SERVER['PHP_SELF']);

//AFFICHER LES DONNES DE L'UTILISATEURS  ENREGISTREES EN SESSION
//1er Etape : je teste si j'ai bien des SESSIONS d'enregistrés
if(isset($_SESSION['id_user'])){
    //2nd Etape : je transmets les données de SESSIONS à mes variables d'affichages
    $pseudo = $_SESSION['pseudo'];
    $email = $_SESSION['email'];
    $nameUser = $_SESSION['name_user'];
    $firstnameUser = $_SESSION['firstname_user'];
}

include './views/view_header.php';
include './views/view_account.php';
include './views/view_footer.php';
?>