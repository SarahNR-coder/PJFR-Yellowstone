<?php

session_start();

include './models/model_users.php';
include './utils/functions.php';

//Déclaration des variables d'affichage
$message = "";
$classNavConnected = "displayNone";
$classNavUnconnected ="toPage toggle";

//Fonction pour tester les données du formulaire d'inscription
function dataTestInscription(){
    //1ere étape : vérifier si les champs obligatoires sont vides
    if(empty($_POST["pseudo"]) || empty($_POST["email"]) || empty($_POST["password-one"]) || empty($_POST["password-two"])){
        return ["pseudo"=>'', "email" => '', "password" => '', "erreur" => 'Veuillez remplir tous les champs!'];
    }

    //2nd étape : ettoyer les données
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
function register(){
    //Test envoi formulaire inscription
    if(isset($_POST['Inscription'])){
        //test données d'inscription
        $tab=dataTestInscription();

        //test paramètre erreur pas vide càd erreur on ne récupère pas les données formulaire
        if($tab['erreur'] != ''){
            $message = $tab['erreur'];
        }else{
            $user = new ModelUser($tab['email']);
            //nouvel objet de ModelUser correspondant au pseudo soumis

            //règle les autres attributs de cet objet
            $user->setPseudo($tab['pseudo'])->setMotDePasse($tab['password']);

            if(empty($user->readUserByEmail())){
                //pas d'utilisateur avec ce pseudo dans la bdd
                $message = $user->addUser();
                //enregistre l'utilisateur en base de données

                //récupérer les données de l'objet utilisateur pour se connecter directement après inscription
                $data = $user-> readUserByEmail();

                //Tester  : cas d'erreur = je reçois un string
                // ça fonctionne = je reçois un array
                if(gettype($data) == 'string'){
                    $message = $data; //le message d'erreur
                }else{
                    $_SESSION['id_user'] = $data[0]['id_utilisateur'];
                    $_SESSION['pseudo'] = $data[0]['pseudo'];
                    $_SESSION['email'] = $data[0]['email'];
                    $_SESSION['name_user'] = $data[0]['nom'];
                    $_SESSION['firstname_user'] = $data[0]['prenom'];
                    $_SESSION['image']=$data[0]['image'];
                }
            }else{
                //il y a un utilisateur avec pseudo en bdd
                $message="Cet Email existe déjà en BDD !";
            }}}}


register();

//Vérifier la connexion
function testConnexion(){
    if(isset($_SESSION['id_user'])){
        $classNavConnected = "toPage toggle";
        $classNavUnconnected ="displayNone";

        //Je redirige vers la page d'accueil index.php
        header('Location:index.php');
    }


}

testConnexion();


include './views/view_signup.php';

?>
