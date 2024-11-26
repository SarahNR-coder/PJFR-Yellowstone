<?php


session_start();

$visibleConnectedUser ="";
$visibleUnconnectedUser ="";
$current_page = basename($_SERVER['PHP_SELF']);


//Paramétrer l'affichage
if(isset($_SESSION['id_user'])){
    $visibleConnectedUser = "toggleElt";
    $visibleUnconnectedUser ="displayNone";
}else{
    $visibleConnectedUser = "displayNone";
    $visibleUnconnectedUser ="toggleElt";
}


include './views/view_header.php';
include './views/view_wolf.php';
include './views/view_footer.php';

?>