<?php

session_start();

include './models/model_users.php';
include './utils/functions.php';

//Déclaration des variables d'affichage
$message="";
$classNavConnected = "displayNone";
$classNavUnconnected ="toPage toggle";

//Fonction pour tester les données du formulaire de connexion
function dataTestConnexion(){
    //épape de sécurité 1: tester si les champs requis sont vides
    if(empty($_POST['email']) | empty($_POST['password'])){
        return ['email' => '', 'password' => '', 'erreur' => 'veuillez renseigner tous les champs'];
    }

    //étape sécurté 2: nettoyer les données
    $email = sanitize($_POST["email"]);
    $password = sanitize($_POST['password']);

    //étape sécurité 3: vérifier le format des données
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        return ['email' => '', 'password' => '', 'erreur' => 'Email pas au bon format!'];
    }

    return ['email' => $email, 'password' => $password, 'erreur' => ''];

}

//Fonction pour se connecter
function connect(){
    //Vérifie qu'un formulaire de connexion a été envoyé
    if(isset($_POST['Connexion'])){
        //Récupérationdes données de connexion
        $tab = dataTestConnexion();

        //je regarde si je suis dans le cas d'erreur
        if($tab['erreur'] != ''){
        //si c'est le cas : j'affiche l'erreur
        $message = $tab['erreur'];
        }else{
            //nouveau objet de class ModelUser avec l'email envoyé
            $user = new ModelUser($tab["email"]);

            //récupérer les données de l'objet utilisateur
            $data = $user-> readUserByEmail();

            //Tester  : cas d'erreur = je reçois un string
            // ça fonctionne = je reçois un array
            if(gettype($data) == 'string'){
                $message = $data; //le message d'erreur
            }else{
                //test : réponse de bdd vide = email non présent en bdd, afficher message d'erreur
                if(empty($data)){
                    $message = "Erreur d'email et/ou de mot de passe";
                }else{
                    //email présent en bdd
                    //test: correspondance mots de passe
                    if(!password_verify($tab['password'], $data[0]['motdepasse'])){
                        //si pas de correspondance
                        $message = "Erreur d'email et/ou de mot de passe";
                    }else{
                        //si correspondance
                        $_SESSION['id_user'] = $data[0]['id_utilisateur'];
                        $_SESSION['pseudo'] = $data[0]['pseudo'];
                        $_SESSION['email'] = $data[0]['email'];
                        $_SESSION['name_user'] = $data[0]['nom'];
                        $_SESSION['firstname_user'] = $data[0]['prenom'];
                        $_SESSION['image']=$data[0]['image'];

                        $message = "{$_SESSION['pseudo']} est connecté avec succés !";
                        
                    }
                }
            }
        }
    }
}

connect();

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

include './views/view_signin.php';
?>