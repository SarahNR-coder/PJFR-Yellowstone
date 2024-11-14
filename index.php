<?php

session_start();

$visibleConnectedUser ="";
$visibleUnconnectedUser ="";
$current_page = basename($_SERVER['PHP_SELF']);


//Paramétrer l'affichage
if(isset($_SESSION['id_user'])){
    $visibleConnectedUser = "toPage toggle";
    $visibleUnconnectedUser ="displayNone";
}else{
    $visibleConnectedUser = "displayNone";
    $visibleUnconnectedUser ="toPage toggle";
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





include './views/view_header.php';
include './views/view_index.php';
include './views/view_footer.php';

?>