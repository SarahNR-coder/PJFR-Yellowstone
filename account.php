<?php

session_start();

include './models/model_users.php';
include './models/model_comments.php';
include './models/model_rating.php';
include './models/model_page.php';
include './utils/functions.php';



//Déclaration des variables d'affichage
$idUtilisateur = "";
$pseudo = "";
$email = "";
$nameUser = "";
$firstnameUser = "";
$message = "";
$visibleConnectedUser = "toggleElt";
$visibleUnconnectedUser ="displayNone";
$current_page = basename($_SERVER['PHP_SELF']);
$listComments= "";
$listRatings="";

//AFFICHER LES DONNES DE L'UTILISATEURS  ENREGISTREES EN SESSION
//1er Etape : je teste si j'ai bien des SESSIONS d'enregistrés
if(isset($_SESSION['id_user'])){
    //2nd Etape : je transmets les données de SESSIONS à mes variables d'affichages
    $pseudo = $_SESSION['pseudo'];
    $email = $_SESSION['email'];
    $nameUser = $_SESSION['name_user'];
    $firstnameUser = $_SESSION['firstname_user'];
    $idUtilisateur = $_SESSION['id_user'];
}

function cardComment($commentParam){
    return "<article class='cardComment'>
        <div class='commentInfos'>
            <p>{$commentParam['date_commentaire']}</p>
            <p>{$commentParam['nom_page']}</p>
        </div>
        <p class='contenuCommentaire'>{$commentParam['contenu_commentaire']}</p>
    </article>";
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
            <p>'.$ratingParam["nom_page"].'</p>
        </div>
        <p class="ratingResults">
            '.$stars.'
        </p>
    </article>';
}

//Affichage des notations de cet utilisateur
//0) Création de mon objet $barman à partir du ModelRating
$barman = new ModelRating();

//1) lancer la récupération des notations pour cet utilisateur
$ratings = $barman->readRatingsByUser($idUtilisateur);

//2)Traiter le tableau de $rating, et afficher chaque note dedans
foreach($ratings as $rating){
    $listRatings = $listRatings.cardRating($rating);
}

//Affichage des commentaires de cet utilisateur
//0) Création de mon objet $barman à partir du ModelComment
$barman = new ModelComment();

//1) lancer la récupération des commentaires pour cet utilisateur
$comments = $barman->readCommentsByUser($idUtilisateur);

//2)Traiter le tableau de $comment, et afficher chaque commentaire dedans
foreach($comments as $comment){
    $listComments = $listComments.cardComment($comment);
}

include './views/view_header.php';
include './views/view_account.php';
include './views/view_footer.php';
?>