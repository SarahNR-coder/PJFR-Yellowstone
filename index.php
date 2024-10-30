<?php

session_start();

$classNavConnected ="";
$classNavUnconnected ="";

//Paramétrer l'affichage
if(isset($_SESSION['id_user'])){
    $classNavConnected = "toPage toggle";
    $classNavUnconnected ="displayNone";
}else{
    $classNavConnected = "displayNone";
    $classNavUnconnected ="toPage toggle";
}

//Si on a été redirigé après connexion, affichage d'un message pop-up
if(isset($_SESSION['justLoggedIn'])){
    if($_SESSION['justLoggedIn'] === true){
        //Je crée un message popup
        $messagePopUp = "Vous êtes maintenant connecté!";
        // Générer le code JavaScript pour afficher le popup
        echo "<script type='text/javascript'>alert('$messagePopUp');</script>";
}
}

//Par défaut on ne provient pas d'une connexion
$_SESSION['justLoggedIn'] = false;




include './views/view_index.php';

?>