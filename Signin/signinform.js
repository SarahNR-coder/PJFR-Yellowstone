/* import { initializeApp } from 'https://www.gstatic.com/firebasejs/${FIREBASE_VERSION}/firebase-app.js';
//import { getFirestore, collection, getDocs } from 'https://www.gstatic.com/firebasejs/${FIREBASE_VERSION}/firebase-firestore-lite.js';
// Follow this pattern to import other Firebase services
// import {} from "https://www.gstatic.com/firebasejs/${FIREBASE_VERSION}/firebase-analytics.js";
// import {} from "https://www.gstatic.com/firebasejs/${FIREBASE_VERSION}/firebase-app-check.js";
// import {} from "https://www.gstatic.com/firebasejs/${FIREBASE_VERSION}/firebase-auth.js";
// import {} from "https://www.gstatic.com/firebasejs/${FIREBASE_VERSION}/firebase-functions.js";
// import {} from "https://www.gstatic.com/firebasejs/${FIREBASE_VERSION}/firebase-firestore.js";
// import {} from "https://www.gstatic.com/firebasejs/${FIREBASE_VERSION}/firebase-storage.js";
// import {} from "https://www.gstatic.com/firebasejs/${FIREBASE_VERSION}/firebase-performance.js";
// import {} from "https://www.gstatic.com/firebasejs/${FIREBASE_VERSION}/firebase-remote-config.js";
// import {} from "https://www.gstatic.com/firebasejs/${FIREBASE_VERSION}/firebase-messaging.js";
// import {} from "https://www.gstatic.com/firebasejs/${FIREBASE_VERSION}/firebase-database.js"; */

// TODO: Replace the following with your app's Firebase project configuration
const firebaseConfig = {
    apiKey: "AIzaSyDxEuDa0ewmFsBOeV0rAgPHqmWJ7eKg51U",
    authDomain: "pjfr-yellowstone.firebaseapp.com",
    databaseURL: "https://pjfr-yellowstone-default-rtdb.firebaseio.com",
    projectId: "pjfr-yellowstone",
    storageBucket: "pjfr-yellowstone.appspot.com",
    messagingSenderId: "866729405582",
    appId: "1:866729405582:web:9d6a2c018178740563addf",
    measurementId: "G-SJDPVKB7C3"
};

firebase.initializeApp(firebaseConfig);

//Définition table de données
const dbRef = firebase.database().ref();
const usersRef = dbRef.child("users");

/*SIGNIN PAGE*/

//Pour vérifier la conformité des saisies
const regexObj = {
    regexMail : /^[a-z0-9._-]+@[a-z0-9._-]+\.[a-z]{2,6}$/,
    charDecimal : /\d/,
    charSpecial : /[$&@!]/,
    xssPattern:/<script.*?>.*?<\/script>|<.*?onclick=.*?>|<.*?on\w+=".*?"/i
};

//Messages d'erreur
let errorMsg = {
    mailMsg:'',
    passwordMsg:'',
    xssMsg:''
};

//Sélectionner tous les input
//---------------------------
const allInputs = document.getElementsByTagName("input");


//Sélectionner les éléments par classe
//------------------------------------
//Emails
const allEmails = document.querySelectorAll(".input-email");
//Mots de passe
const allPasswords = document.querySelectorAll(".input-password");


//Sélectionner les éléments du formulaire d'inscription
//-----------------------------------------------------
//Bouton inscription
const signupButton = document.querySelector("#signup-button");
//Formulaire inscription
const signupForm = document.querySelector("#signup-form");
//Saisies inscription
const signupInputs = document.querySelectorAll(".signup-input");
//Saisie email inscription
const signupEmailInput = document.querySelector("#signup-email-input");


//Saisies dans le formaulaire d'inscription de mots de passes qui doivent correspondre
const passwordsToMatch = document.querySelectorAll('.passwords-to-match');


//Sélectionner les éléments du formulaire de connexion
//-----------------------------------------------------
//Bouton connexion
const signinButton = document.querySelector("#signin-button");
//Formulaire connexion
const signinForm = document.querySelector("#signin-form");
//Saisies connexion
const signinInputs = document.getElementsByClassName("signin-input");
//Saise email connexion
const signinEmailInput = document.querySelector("signin-email-input");
//Saisie Mot de passe connexion
const signinPasswordInput = document.querySelector("#signin-password-input");

//Security info HTML
//------------------
const securityInfoElement = document.querySelector("#securityInfo");



signupForm.addEventListener('submit',(e)=>{
    e.preventDefault();
})
signinForm.addEventListener('submit',(e)=>{
    e.preventDefault();
})


function xssInputChecker(InputElement){
    let testXss = regexObj.xssPattern.test(InputElement.value); //on vérifie si la saisie correspond à une attaque xss, cas donnant un message d'erreur
    if(testXss){
        securityInfoElement.style.display = 'block'; //la boite de messages d'erreur s'affiche dans le cas d'un format xss remarqué
        errorMsg.xssMsg = "<p>⛔ Potentielle attaque XSS détéctée.</p>";
    }else{
        errorMsg.xssMsg = ''; //Réinitialiser le message d'erreur xss à la fin car il comporte qu'une seule expression
    }
}

function passwordMatchChecker(passwordsColl){
    if(passwordsColl[0].value !== passwordsColl[1].value){//les mots de passe qui doivent correspondre sont dans une collection Html; on vérifie que la valeur du précédent correspond à celle du suivant, si ce n'est pas le cas on applique le code suivant
        errorMsg.passwordMsg += "<p> ⛔ Les deux mots de passe doivent correspondre </p>";
    }
    else{
        errorMsg.passwordMsg +="";
    }
    displayErrorMessages(); //Appel de la fonction qui affichera les messages d'erreur s'il y a lieu
}

function emailInputChecker(emailInputElement){
    let testEmail = regexObj.regexMail.test(emailInputElement.value); //on vérifie si la saisie correspond à un format email, cas contraire donnant un message d'erreur
    if(testEmail){
        emailInputElement.style.background ='lightgreen';//fond vert si saisie conforme
        errorMsg.mailMsg ="";
    }else{
        securityInfoElement.style.display = 'block'; //la boite de messages d'erreur s'affiche dans le cas d'une erreure de format email
        emailInputElement.style.background ='red';//fond rouge si saisie non conforme
        errorMsg.mailMsg ="<p>⛔ L'email n'est pas conforme.</p>";
    }
    displayErrorMessages(); //Appel de la fonction qui affichera les messages d'erreur s'il y a lieu
}


allEmails.forEach(element => {
    element.addEventListener('keyup',()=>{
        xssInputChecker(element);
        emailInputChecker(element);
    });
});

allPasswords.forEach(element => {
    element.addEventListener('keyup', ()=>{
        passwordInputChecker(element);
        xssInputChecker(element);
    })
})

passwordsToMatch.forEach(element =>{
    element.addEventListener('keyup', () =>{
        //on applique sur la collection
        console.log("Par passwordsToMatch; La saisie du mot de passe est:"+element.value);
        passwordMatchChecker(passwordsToMatch);
    });
});

function passwordInputChecker(passwordInputElement) {
    errorMsg.passwordMsg = ''; // Réinitialiser le message avant de le remplir de nouveau

    if (passwordInputElement.value.length < 6) {
        errorMsg.passwordMsg += `<p>⛔️ Mot de passe trop Faible</p>`;
    } 
    if (passwordInputElement.value.length > 12) {
        errorMsg.passwordMsg += `<p>⛔️ Mot de passe trop Long</p>`;
    } 
    if (!passwordInputElement.value.match(regexObj.charDecimal)) {
        errorMsg.passwordMsg += `<p>⛔️ Le Mot de passe doit contenir un chiffre</p>`;
    }
    if (!passwordInputElement.value.match(regexObj.charSpecial)) {
        errorMsg.passwordMsg += `<p>⛔️ Le Mot de passe doit contenir un caractère spécial</p>`;
    }
    if(!errorMsg.passwordMsg){
        errorMsg.passwordMsg = "";
    }
    displayErrorMessages(); //Appel de la fonction qui affichera les messages d'erreur s'il y a lieu
};


//Au départ le formulaire d'inscription n'est pas valide puisqu'il est vide
let validSignupInfo = false;

function displayErrorMessages(){
    //S'il y a des erreurs càd message d'erreur non vide
    //on rempli l'élément security info
    let combinedMsg = "";
    if(errorMsg.mailMsg) combinedMsg += errorMsg.mailMsg;
    if(errorMsg.passwordMsg) combinedMsg += errorMsg.passwordMsg;
    if(errorMsg.xssMsg) combinedMsg += errorMsg.xssMsg;
    securityInfoElement.innerHTML = combinedMsg;
    securityInfoElement.style.display = combinedMsg ? 'block' : 'none';
    //la boite de messages d'erreur s'affiche en cas d'erreur

    if(combinedMsg === ""){
        //S'il n'y a pas d'erreurs ou que des champs ne sont pas remplis

        //Le formulaire est valide dans le cas où il n'y a pas d'erreurs...
        validSignupInfo = true;

        //...sauf dans le cas où au moins un champ est vide

        signupInputs.forEach(element =>{
            if(!element.value){
                validSignupInfo = false;
            }
        })
    }
    console.log(`validSignupInfo est ${validSignupInfo}`);
};



signupButton.addEventListener("click", function(){
    console.log("J'ai cliqué sur le bouton d'inscription");
    if(validSignupInfo === true){
    console.log("Dans if(validSignUpInfo === true)");    
        let newUser = {};
        for(let i=0; i<2; i++){
            let key = signupInputs[i].getAttribute('data-key');
            let value = signupInputs[i].value;
            newUser[key] = value;
        }
        usersRef.push(newUser);
        console.log("Nouvel utilisateur enregistré");
        console.log(`Email: ${newUser["email"]}, Password: ${newUser["password"]}`);
    }
})

