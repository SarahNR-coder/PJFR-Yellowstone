<?php

session_start();

include './models/model_users.php';
include './utils/functions.php';

//Déclaration des variables d'affichage
$message = "";
$visibleConnectedUser = "displayNone";
$visibleUnconnectedUser ="toggleElt";
$current_page = basename($_SERVER['PHP_SELF']);
$_SESSION['justSignedIn'] = false;

//Fonction pour tester les données du formulaire d'inscription
function dataTestInscription(){
    //1ere étape : vérifier si les champs obligatoires sont vides
    if(empty($_POST["pseudo"]) || empty($_POST["email"]) || empty($_POST["originalPwd"]) || empty($_POST["confirmationPwd"])){
        return ["pseudo"=>'', "email" => '', "password" => '', "erreur" => 'Veuillez remplir tous les champs!'];
    }

    //2nd étape : nettoyer les données
    $pseudo= sanitize($_POST["pseudo"]);
    $email= sanitize($_POST["email"]);
    $password= sanitize($_POST["originalPwd"]);

    //3eme étape de sécurité : Vérifier que les données sont au bon format
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        return ["pseudo"=>'', "email" => '', "password" => '', "erreur" => 'Email au mauvais format!'];
    }
    //4eme étape de sécurité : hasher le mot de passe
    $password = password_hash($password, PASSWORD_BCRYPT);

    return ["pseudo"=>$pseudo, "email" => $email, "password" => $password, "erreur" => ''];
}

//Procéder à l'inscription  
    if(isset($_POST['Inscription'])){                   //Test envoi formulaire inscription      
        $tab=dataTestInscription();                     //test données d'inscription
        if($tab['erreur'] != ''){                       //si une erreur on ne récupère pas les données formulaire
            $message = $tab['erreur'];
        }else{
            $user = new ModelUser($tab['email']);       //nouvel objet de ModelUser correspondant au email soumis
            $user->setPseudo($tab['pseudo'])->setMotDePasse($tab['password']);     //règle les autres attributs de cet objet

            if(empty($user->readUserByEmail())){        //dans if: pas d'utilisateur avec cet email dans la bdd
                $_SESSION['justSignedIn'] = true;       //défini que l'utilisateur vient de s'inscrire
                $message = $user->addUser();            //enregistre l'utilisateur en base de données
                header('Location:signin.php');

            }else{                                      //dans else: il y a un utilisateur avec email en bdd
                $message="Cet Email existe déjà en BDD !";
            }
        }
    }



include './views/view_header.php';
include './views/view_signup.php';
include './views/view_footer.php';

?>
