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
$messageComment = "";
$messageRating = "";


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
    $tabIdPage = $page->getPageIdFromAddress();
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
        $messageComment = $tab['erreur'];
    }else{
        $comment = new ModelComment();
        

        $comment->setContenuCommentaire($tab['contenuCommentaire'])->setDateCommentaire($tab['dateCommentaire'])->setIdPage($tab['idPage'])->setIdCommentateur($tab['idCommentateur']);

        $messageComment = $comment->addComment();      
    }
}

function cardComment($commentParam){
    return "<article class='cardComment'>
        <div class='commentInfos'>
            <p>{$commentParam['date_commentaire']}</p>
            <p>{$commentParam['pseudo']}</p>
        </div>
        <p class='contenuCommentaire'>{$commentParam['contenu_commentaire']}</p>
    </article>";
}

function dataTestAddingRating(){
    if(empty($_POST["nombreEtoiles"])){
        return ["note"=>'',"dateNote"=>'',"idPage"=>'',"idNoteur"=>'',"erreur"=>'Veuillez donner une note'];
    }

    //Récupérer l'identifiant correspondant à la page en base de données
    $current_page = basename($_SERVER['PHP_SELF']);
    $page = new ModelPage($current_page);
    $tabIdPage = $page->getPageIdFromAddress();
    $idPage = $tabIdPage[0];

    $note = sanitize($_POST['nombreEtoiles']);
    $date_note = date("Y-m-d H:i:s");
    $idNoteur = $_SESSION['id_user'];


    return ["note"=>$note,"dateNote"=>$date_note,"idPage"=>$idPage,"idNoteur"=>$idNoteur,"erreur"=>''];
}

//Test envoi formulaire ajout commentaire
if(isset($_POST['Noter'])){
    //test données 
    $tab=dataTestAddingRating();

    //test paramètre erreur pas vide càd erreur on ne récupère pas les données formulaire
    if($tab['erreur'] != ''){
        $messageRating = $tab['erreur'];
    }else{
        $rating = new ModelRating();
        

        $rating->setNote($tab['note'])->setDateNote($tab['dateNote'])->setIdPage($tab['idPage'])->setIdNoteur($tab['idNoteur']);

        $messageRating = $rating->addRating();      
    }
}

function cardRating($ratingParam){
    $note = $ratingParam["note"];

    $stars="";
    for($i=1; $i<=5; $i++){
        if($i<=$ratingParam['note']){
            $stars.='<i class="fa-solid fa-star" style="color: #4B4F40"></i>';
        }else{
            $stars.='<i class="fa-solid fa-star" style="color:#9fa290"></i>';
        }
    }

    return '<article class="cardRating">
        <div class="ratingInfos">
            <p>'.$ratingParam["date_note"].'</p>
            <p>'.$ratingParam["pseudo"].'</p>
        </div>
        <p class="ratingResults">
            '.$stars.'
        </p>
    </article>';
}

$current_page = basename($_SERVER['PHP_SELF']);
$page = new ModelPage($current_page);
$tabIdPage = $page->getPageIdFromAddress();
$idPage = $tabIdPage[0];


//Affichage des notations de cette page
//0) Création de mon objet $barman à partir du ModelRating
$barman = new ModelRating();

//1) lancer la récupération des notations pour cette page
$ratings = $barman->readRatingsByPage($idPage);

//2)Traiter le tableau de $rating, et afficher chaque note dedans
foreach($ratings as $rating){
    $listRatings = $listRatings.cardRating($rating);
}




//Affichage des commentaires de cette page
//0) Création de mon objet $barman à partir du ModelComment
$barman = new ModelComment();

//1) lancer la récupération des commentaires pour cette page
$comments = $barman->readCommentsByPage($idPage);

//2)Traiter le tableau de $comment, et afficher chaque commentaire dedans
foreach($comments as $comment){
    $listComments = $listComments.cardComment($comment);
}


include './views/view_header.php';
include './views/view_wolf.php';
include './views/view_footer.php';

?>