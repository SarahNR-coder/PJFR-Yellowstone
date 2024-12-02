<?php

include './models/model_users.php';
include './models/model_comments.php';
include './models/model_rating.php';
include './models/model_page.php';
include './utils/functions.php';

session_start();

$visibleConnectedUser ="";
$visibleUnconnectedUser ="";
$current_page = basename($_SERVER['PHP_SELF']);
$listRatings = "";
$listComments = "";
$page = new ModelPage($current_page);
$tabIdPage = $page->getPageIdFromName();
$idPage = $tabIdPage[0];
$date_commentaire = date("Y-m-d H:i:s");


//Paramétrer l'affichage
if(isset($_SESSION['id_user'])){
    $visibleConnectedUser = "toggleElt";
    $visibleUnconnectedUser ="displayNone";
    $idCommentateur = $_SESSION['id_user'];
}else{
    $visibleConnectedUser = "displayNone";
    $visibleUnconnectedUser ="toggleElt";
}

function dataTestAddingComment(){
    if(empty($_POST["contenuCommentaire"])){
        return ["contenuCommentaire"=>'',"dateCommentaire"=>'',"idPage"=>'',"idCommentateur"=>'',"erreur"=>'Veuillez rédiger un commentaire'];
    }

    $current_page = basename($_SERVER['PHP_SELF']);
    $page = new ModelPage($current_page);
    $tabIdPage = $page->getPageIdFromName();
    $idPage = $tabIdPage[0];
    $contenu_commentaire = sanitize($_POST['contenuCommentaire']);
    $date_commentaire = date("Y-m-d H:i:s");
    $idCommentateur = $_SESSION['id_user'];


    return ["contenuCommentaire"=>$contenu_commentaire,"dateCommentaire"=>$date_commentaire,"idPage"=>$idPage,"idCommentateur"=>$idCommentateur,"erreur"=>''];
}

//Test envoi formulaire ajout commentaire
if(isset($_POST['Poster'])){
    //test données 
    $tab=dataTestAddingComment();

    //test paramètre erreur pas vide càd erreur on ne récupère pas les données formulaire
    if($tab['erreur'] != ''){
        $message = $tab['erreur'];
    }else{
        $comment = new ModelComment();
        

        $comment->setContenuCommentaire($tab['contenuCommentaire'])->setDateCommentaire($tab['dateCommentaire'])->setIdPage($tab['idPage'])->setIdCommentateur($tab['idCommentateur']);

        $message = $comment->addComment();      
    }
}


// function dataTestAddingRating(){
//     if(empty($_POST["contenuCommentaire"])){
//         return ["contenuCommentaire"=>'',"dateCommentaire"=>'',"idPage"=>'',"idCommentateur"=>'',"erreur"=>'Veuillez rédiger un commentaire'];
//     }

//     $current_page = basename($_SERVER['PHP_SELF']);
//     $page = new ModelPage($current_page);
//     $tabIdPage = $page->getPageIdFromName();
//     $idPage = $tabIdPage[0];
//     $contenu_commentaire = sanitize($_POST['contenuCommentaire']);
//     $date_commentaire = date("Y-m-d H:i:s");
//     $idCommentateur = $_SESSION['id_user'];


//     return ["contenuCommentaire"=>$contenu_commentaire,"dateCommentaire"=>$date_commentaire,"idPage"=>$idPage,"idCommentateur"=>$idCommentateur,"erreur"=>''];
// }

// //Test envoi formulaire ajout commentaire
// if(isset($_POST['Poster'])){
//     //test données 
//     $tab=dataTestAddingComment();

//     //test paramètre erreur pas vide càd erreur on ne récupère pas les données formulaire
//     if($tab['erreur'] != ''){
//         $message = $tab['erreur'];
//     }else{
//         $comment = new ModelComment();
        

//         $comment->setContenuCommentaire($tab['contenuCommentaire'])->setDateCommentaire($tab['dateCommentaire'])->setIdPage($tab['idPage'])->setIdCommentateur($tab['idCommentateur']);

//         $message = $comment->addComment();      
//     }
// }

include './views/view_header.php';
include './views/view_wolf.php';
include './views/view_footer.php';

?>