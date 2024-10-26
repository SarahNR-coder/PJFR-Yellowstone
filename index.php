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



include './views/view_index.php';

?>