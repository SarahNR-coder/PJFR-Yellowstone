<?php

session_start();

include './models/model_users.php';
include './utils/functions.php';

//Déclaration des variables d'affichage
$message = "";
$visibleConnectedUser = "displayNone";
$visibleUnconnectedUser ="toggleElt";
$current_page = basename($_SERVER['PHP_SELF']);

//Fonction pour tester les données du formulaire d'inscription
function dataTestInscription(){
    //1ere étape : vérifier si les champs obligatoires sont vides
    if(empty($_POST["pseudo"]) || empty($_POST["email"]) || empty($_POST["password-one"]) || empty($_POST["password-two"])){
        return ["pseudo"=>'', "email" => '', "password" => '', "erreur" => 'Veuillez remplir tous les champs!'];
    }

    //2nd étape : nettoyer les données
    $pseudo= sanitize($_POST["pseudo"]);
    $email= sanitize($_POST["email"]);
    $password= sanitize($_POST["password-one"]);

    //3eme étape de sécurité : Vérifier que les données sont au bon format
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        return ["pseudo"=>'', "email" => '', "password" => '', "erreur" => 'Email au mauvais format!'];
    }
    //4eme étape de sécurité : hasher le mot de passe
    $password = password_hash($password, PASSWORD_BCRYPT);

    return ["pseudo"=>$pseudo, "email" => $email, "password" => $password, "erreur" => ''];
}

//Procéder à l'inscription

    //Test envoi formulaire inscription
    if(isset($_POST['Inscription'])){
        //test données d'inscription
        $tab=dataTestInscription();

        //test paramètre erreur pas vide càd erreur on ne récupère pas les données formulaire
        if($tab['erreur'] != ''){
            $message = $tab['erreur'];
        }else{
            $user = new ModelUser($tab['email']);
            //nouvel objet de ModelUser correspondant au email soumis

            //règle les autres attributs de cet objet
            $user->setPseudo($tab['pseudo'])->setMotDePasse($tab['password']);

            if(empty($user->readUserByEmail())){
                //pas d'utilisateur avec cet email dans la bdd
                $message = $user->addUser();
                //enregistre l'utilisateur en base de données
                $_SESSION['justSignedIn'] = true;
                //défini que l'utilisateur vient de s'inscrire
            }else{
                //il y a un utilisateur avec email en bdd
                $message="Cet Email existe déjà en BDD !";
            }}}

//Effets de l'inscription
    if(isset($_SESSION['justSignedIn'])){
        if($_SESSION['justSignedIn'] === true){
            //Je redirige vers la page de connexion
            header('Location:signin.php'); 
        }
    }

include './views/view_header.php';
include './views/view_signup.php';
include './views/view_footer.php';

?>
