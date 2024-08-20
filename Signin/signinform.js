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


//Sélectionner les types de saisies
//------------------------------------
//Emails
const allEmails = document.querySelectorAll(".input-email");
//Mots de passe
const allPasswords = document.querySelectorAll(".input-password");

//Sélectionner les éléments du formulaire de connexion
//-----------------------------------------------------
//Bouton connexion
const signinButton = document.querySelector("#signin-button");
//Formulaire connexion
const signinForm = document.querySelector("#signin-form");
//Saisies connexion
const signinInputs = document.querySelectorAll(".signin-input");


//Security info HTML
//------------------
const infoBoxElement = document.querySelector("#infoBox");
const securityInfoElement = document.querySelector("#securityInfo");



signinForm.addEventListener('submit',(e)=>{
    e.preventDefault();
})


function xssInputChecker(inputElement){
    let testXss = regexObj.xssPattern.test(inputElement.value); //on vérifie si la saisie correspond à une attaque xss, cas donnant un message d'erreur
    if(testXss){
        //securityInfoElement.style.display = 'block'; //la boite de messages d'erreur s'affiche dans le cas d'un format xss remarqué
        infoBoxElement.style.display = 'block';
        errorMsg.xssMsg = "<p>⛔ Potentielle attaque XSS détéctée.</p>";
        inputElement.style.background = 'red';
    }else{
        errorMsg.xssMsg = ''; //Réinitialiser le message d'erreur xss à la fin car il comporte qu'une seule expression
    }
}


function emailInputChecker(emailInputElement){
    emailInputElement.style.background = 'white';
    let testEmail = regexObj.regexMail.test(emailInputElement.value); //on vérifie si la saisie correspond à un format email, cas contraire donnant un message d'erreur
    if(testEmail){
        emailInputElement.style.background ='lightgreen';//fond vert si saisie conforme
        errorMsg.mailMsg ="";
    }else{
        //securityInfoElement.style.display = 'block'; //la boite de messages d'erreur s'affiche dans le cas d'une erreure de format email
        infoBoxElement.style.display = 'block';
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

function passwordInputChecker(passwordInputElement) {
    passwordInputElement.style.background = 'white';
    errorMsg.passwordMsg = ''; // Réinitialiser le message avant de le remplir de nouveau

    if (passwordInputElement.value.length < 6) {
        errorMsg.passwordMsg += `<p>⛔️ Mot de passe trop Faible</p>`;
        passwordInputElement.style.background = 'red';
    } 
    if (passwordInputElement.value.length > 12) {
        errorMsg.passwordMsg += `<p>⛔️ Mot de passe trop Long</p>`;
        passwordInputElement.style.background = 'red';
    } 
    if (!passwordInputElement.value.match(regexObj.charDecimal)) {
        errorMsg.passwordMsg += `<p>⛔️ Le Mot de passe doit contenir un chiffre</p>`;
        passwordInputElement.style.background = 'red';
    }
    if (!passwordInputElement.value.match(regexObj.charSpecial)) {
        errorMsg.passwordMsg += `<p>⛔️ Le Mot de passe doit contenir un caractère spécial</p>`;
        passwordInputElement.style.background = 'red';
    }
    if(!errorMsg.passwordMsg){
        errorMsg.passwordMsg = "";
        passwordInputElement.style.background = 'lightgreen';
    }
    displayErrorMessages(); //Appel de la fonction qui affichera les messages d'erreur s'il y a lieu
};


//Au départ le formulaire d'inscription n'est pas valide puisqu'il est vide
let validSigninInfo = false;

function displayErrorMessages(){
    //S'il y a des erreurs càd message d'erreur non vide
    //on rempli l'élément security info
    let combinedMsg = "";
    if(errorMsg.mailMsg) combinedMsg += errorMsg.mailMsg;
    if(errorMsg.passwordMsg) combinedMsg += errorMsg.passwordMsg;
    if(errorMsg.xssMsg) combinedMsg += errorMsg.xssMsg;
    securityInfoElement.innerHTML = combinedMsg;
    infoBoxElement.style.display =combinedMsg ? 'block' : 'none';
    //securityInfoElement.style.display = combinedMsg ? 'block' : 'none';
    //la boite de messages d'erreur s'affiche en cas d'erreur

    if(combinedMsg === ""){
        //S'il n'y a pas d'erreurs ou que des champs ne sont pas remplis

        //Le formulaire est valide dans le cas où il n'y a pas d'erreurs...
        validSigninInfo = true;

        //...sauf dans le cas où au moins un champ est vide

        signinInputs.forEach(element =>{
            if(!element.value){
                validSigninInfo = false;
            }
        })
    }
    console.log(`validSigninInfo est ${validSigninInfo}`);
};





