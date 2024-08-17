
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
    samePasswordMsg:'',
    xssMsg:''
};

//Sélectionner tous les input
//---------------------------
const allInputs = document.getElementsByTagName("input");


//Sélectionner les éléments par classe
//------------------------------------
//Emails
const allEmails = document.getElementsByClassName("input-email");
//Mots de passe (mais seulemant le premier pour le formulaire d'inscription)
const allPasswords = document.getElementsByClassName("input-password");


//Sélectionner les éléments du formulaire d'inscription
//-----------------------------------------------------
//Bouton inscription
const signupButton = document.querySelector("#signup-button");
//Formulaire inscription
const signupForm = document.querySelector("#signup-form");
//Saisies inscription
const signupInputs = document.getElementsByClassName("signup-input");
//Saisie email inscription
const signupEmailInput = document.querySelector("#signup-email-input");
//Premiere saisie Mot de passe inscription
const signupPasswordInputFst = document.querySelector("#signup-password-input-fst");
//Deuxième saisie Mot de passe inscription
const signUpPasswordInputScd = document.querySelector("#signup-password-input-scd");

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

let allInputsTable = Array.from(allInputs);
allInputsTable.forEach(element =>{
    element.addEventListener('keyup',(e)=>{
        e.preventDefault();
    })
});


/* signupForm.addEventListener('submit',(e)=>{
    e.preventDefault();
})
signinForm.addEventListener('submit',(e)=>{
    e.preventDefault();
}) */


function xssInputChecker(InputElement){
    errorMsg.xssMsg = "";
    let testXss = regexObj.xssPattern.test(InputElement.value);
    errorMsg.xssMsg += testXss ? "<p>⛔ Potentielle attaque XSS détéctée </p>" : "";
}


function emailInputChecker(EmailInputElement){
    errorMsg.mailMsg ="";
    let testEmail = regexObj.regexMail.test(EmailInputElement.value);
    errorMsg.mailMsg += testEmail ? "" : "<p>⛔ L'email n'est pas conforme </p>";
}

let allEmailsTable = Array.from(allEmails);

allEmailsTable.forEach(element => {
    element.addEventListener('keyup',()=>{
        xssInputChecker(element);
        emailInputChecker(element);
    });
});

function passwordLengthChecker(passwordInputElement){
    if(passwordInputElement.value.length>8){
        errorMsg.passwordMsg += "<p>⛔ Le mot de passe est trop long </p>";
    }else if(passwordInputElement.value.length<6){
        errorMsg.passwordMsg += "<p>⛔ Le mot de passe est trop court </p>";
    }
}

function passwordDecimalChecker(passwordInputElement){
    let testDecimal = regexObj. charDecimal.test(passwordInputElement.value);
    errorMsg.passwordMsg += testDecimal ? "" : "<p>⛔ Le mot de passe doit comporter des chiffres</p>";
}

function passwordSpecialChecker(passwordInputElement){
    let testSpecial = regexObj.charSpecial.test(passwordInputElement.value);
    errorMsg.passwordMsg += testSpecial ? "" : "<p>⛔ Le mot de passe doit comporter des caractères spéciaux </p>";
}

let allPasswordTable = Array.from(allPasswords);

allPasswordTable.forEach(element => {
    element.addEventListener('keyup', ()=>{
        xssInputChecker(element);
        errorMsg.passwordMsg ="";
        passwordLengthChecker(element);
        passwordDecimalChecker(element);
        passwordSpecialChecker(element);
    })
})

signUpPasswordInputScd.addEventListener("keyup", ()=>{
    xssInputChecker(signUpPasswordInputScd);
    errorMsg.samePasswordMsg ="";
    errorMsg.samePasswordMsg += (signupPasswordInputFst.value === signUpPasswordInputScd.value) ? "" : "<p> ⛔ Les deux mots de passe doivent correspondre </p>";
})

//Au départ le formulaire n'est pas valide puisqu'il est vide
let validSignupInfo = false;

function inputAlerts(){
    //S'il y a des erreurs càd message d'erreur non vide
    //on rempli l'élément security info
    let combinedMsg = "";
    if(errorMsg.xssMsg || errorMsg.mailMsg || errorMsg.passwordMsg){
        securityInfoElement.style.display = "block";
        if(errorMsg.xssMsg) combinedMsg += errorMsg.xssMsg;
        if(errorMsg.mailMsg) combinedMsg += errorMsg.mailMsg;
        if(errorMsg.passwordMsg) combinedMsg += errorMsg.passwordMsg;
        if(errorMsg.samePasswordMsg) combinedMsg +=errorMsg.samePasswordMsg;
        securityInfoElement.innerHTML = combinedMsg;    
    //S'il n'y a pas d'erreurs OU que des champs ne sont pas remplis
    }else{
        //Le formulaire est valide dans le cas où il n'y a pas d'erreur
        validSignupInfo = true;
        //Sauf dans le cas où au moins un champ est vide
        for(let i=0; i<signupInputs.length; i++){
            if(signupInputs[i].value = ""){
                validSignupInfo = false;
            }
        }    
    }
};

document.addEventListener("keyup",inputAlerts);


signupButton.addEventListener("click", function(){
    if(validSignupInfo === true){
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




