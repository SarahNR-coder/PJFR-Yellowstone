//But1: afficher un message d'erreur sous les input quand il y a une erreur
//But2: envoyer le formulaire seulement si tous les champs sont valides

//Initialisation:
//Ini1: [HTML] Paragraph d'erreur avec id different pour chaque erreur
//Ini2: [HTML]Tous les paragraphes d'erreur ont la même classe error-line
//Ini3: [CSS] Tous les error-line sont en display: none
//Ini4: déclarer des valeurs booléenes "valeur_du_champ_valide"=true pour chaque champ
//Ini5: déclarer la valeur du motdepasse1 pour les comparer et agir en fonction pour le passwordTwo
//Ini6: stocker les valeurs de couleur dans des variables
//Ini7: déclarer tous les regex dans un objet regex
//Ini8: déclarer tous les éléments HTML dans on a besoin
//Ini9: déclarer timeout

//A la saisie avec l'évenement keyup on écoute l'input:
//s'il y a une erreur 
//=> le regex associé ne correspond pas à la saisie pour pseudo, email, passWordOne
//=> passWordOne.value != passwordTwo.value pour passwordTwo
//a) afficher le message d'erreur dans le paragraph d'erreur associé après 1800s grâce à timeout
//=> paragraph d'erreur correspondant en display block
//=> paragraph d'erreur innerText avec le message correspondant à l'erreur
//b) "valeur_du_champ_valide"=false
//c) couleur_du_champ= inputRed
//sinon si il n'y a pas:
//a) paragraph d'erreur en display: none et innerText ="";
//b) "valeur_du_champ_valide"=true
//c) couleur_du_champ = inputGreen

//Dans passwordOne à l'écoute de l'évenement keyup donner une valeur à motdepasse1
//Dans passwordTwo si la valeur "passwordOne_valide"===false
//Empêcher la saisie de l'input
// function desactiverChamp() {
//     document.getElementById('monChamp').disabled = true;
// }
//donc passwordTwo.disabled = true;
//=> paragraph d'erreur innerText avec le message correspondant à l'erreur càd "Veuillez donner un premier mot de passe valide"
//sinon
//Utiliser la valeur motdepasse1 pour comparer avec passwordTwo.value
//si true => etc.


//A l'appui sur le bouton submit:
//si pour tous les champs "valeur_du_champ_valide"=false
//preventDefault() pour empêcher l'envoi du formulaire
//sinon rien, donc submit
//[PHP]=> POST géré par le PHP 
//=> dans view_signup.php, après le button <p><?php echo $message ?></p>
//où $message est un message d'erreur ou confirmation

const regexObj = {
    regexPseudo : /^[0-9A-Za-z!@#\$%\^&\*\(\)_\+\-=\[\]\{\};':"\\|,.<>\/?]*$/,
    regexEmail : /^[a-z0-9._-]+@[a-z0-9._-]+\.[a-z]{2,6}$/,
    charDecimal : /\d/,
    charSpecial : /[$&@!]/,
    xssPattern:/<script.*?>.*?<\/script>|<.*?onclick=.*?>|<.*?on\w+=".*?"/i
};

let inputRed = "#F56552";
let inputGreen = "#89F5C4";

const pseudo = document.querySelector("#pseudo");
const errorPseudo = document.querySelector("#error-pseudo");
const errorPseudoXss = document.querySelector("#error-pseudo-xss");
const email = document.querySelector("#email");
const errorEmail =document.querySelector("#error-email");
const errorEmailXss = document.querySelector("#error-email-xss");
const passwordOne = document.querySelector("#password-one");
const errorLength = document.querySelector("#error-length");
const errorDecimal = document.querySelector("#error-decimal");
const errorSpecial = document.querySelector("#error-special");
const errorFstPwdXss = document.querySelector("#error-fstpwd-xss");
const passwordTwo = document.querySelector("#password-two");
const errorScdPsswdXss = document.querySelector("#error-scdpwd-xss");
const errorMatch =document.querySelector("#error-match");
const errorDisabled =document.querySelector("#error-disabled");
const form = document.querySelector("form");
const noValid = document.querySelector("#form-no-valid");



//déclarer une fonction pour le pseudo qui voit si le champ est valide
function pseudoChecker(){
    let testXss = regexObj.xssPattern.test(pseudo.value); 
    //on vérifie si la saisie correspond à une attaque xss, cas donnant un message d'erreur
    let testPseudo = regexObj.regexPseudo.test(pseudo.value)
    if(testXss){
        isPseudoValid = false;
    }
    if(!testPseudo){
        isPseudoValid = false;
    }
}


//déclarer une fonction pour le pseudo qui affiche les messages d'erreur
function pseudoDisplay(){
    let testXss = regexObj.xssPattern.test(pseudo.value); 
    //on vérifie si la saisie correspond à une attaque xss, cas donnant un message d'erreur
    let testPseudo = regexObj.regexPseudo.test(pseudo.value)
    if(testXss){
        errorPseudoXss.style.display = "block";
        errorPseudoXss.innerText = "Potentielle attaque XSS détéctée.";
        pseudo.style.background = inputRed;
    }else{
        errorPseudoXss.style.display = "none";
        errorPseudoXss.innerText = "";
    }

    if(!testPseudo){
        errorPseudo.style.display = "block";
        errorPseudo.innerHTML="Mauvais format de pseudo";
        pseudo.style.background = inputRed;
    }else{
        errorPseudo.style.display = "none";
        errorPseudo.innerText ="";
    }
}

let timeout;


let isPseudoValid = false;

//Ecouteur d'évement pseudo
pseudo.addEventListener("keyup", ()=>{
    pseudo.style.background = "white";
    clearTimeout(timeout);
    isPseudoValid = true;
    pseudoChecker();
    timeout = setTimeout(pseudoDisplay, 1800);
    if(isPseudoValid === true){
        pseudo.style.background = inputGreen;
    }
    console.log("isPseudoValid = "+isPseudoValid);
})

//déclarer une fonction pour l'email qui voit si le champ est valide
function emailChecker(){
    let testXss = regexObj.xssPattern.test(email.value); 
    //on vérifie si la saisie correspond à une attaque xss, cas donnant un message d'erreur
    let testEmail = regexObj.regexEmail.test(email.value)
    if(testXss){
        isEmailValid = false;
    }
    if(!testEmail){
        isEmailValid = false;
    }
}

//déclarer une fonction pour l'email' qui affiche les messages d'erreur
function emailDisplay(){
    let testXss = regexObj.xssPattern.test(email.value); 
    //on vérifie si la saisie correspond à une attaque xss, cas donnant un message d'erreur
    let testEmail = regexObj.regexEmail.test(email.value)
    if(testXss){
        errorEmailXss.style.display = "block";
        errorEmailXss.innerText = "Potentielle attaque XSS détéctée.";
        email.style.background = inputRed;
    }else{
        errorEmailXss.style.display = "none";
        errorEmailXss.innerText = "";
    }

    if(!testEmail){
        errorEmail.style.display = "block";
        errorEmail.innerHTML="Mauvais format d'email";
        email.style.background = inputRed;
    }else{
        errorEmail.style.display = "none";
        errorEmail.innerText ="";
    }
}

let isEmailValid = false;
//Ecouteur d'évement pseudo
email.addEventListener("keyup", ()=>{
    email.style.background = "white";
    clearTimeout(timeout);
    isEmailValid = true;
    emailChecker();
    timeout = setTimeout(emailDisplay, 1800);
    if(isEmailValid === true){
        email.style.background = inputGreen;
    }
    console.log("isEmailValid = "+isEmailValid);
})


//déclarer une fonction pour le premier mot de passe qui voit si le champ est valide
function passwordOneChecker(){
    let testXss = regexObj.xssPattern.test(passwordOne.value); 
    //on vérifie si la saisie correspond à une attaque xss, cas donnant un message d'erreur
    if(testXss){
        isPassWordOneValid = false;
    }
    if(!passwordOne.value.match(regexObj.charDecimal)){
        isPassWordOneValid = false;
    }
    if (passwordOne.value.length < 6){
        isPassWordOneValid = false;
    }
    if (passwordOne.value.length > 12){
        isPassWordOneValid = false;
    }
    if (!passwordOne.value.match(regexObj.charSpecial)){
        isPassWordOneValid = false;
    }
    passwordOneValue = passwordOne.value;
}

//déclarer une fonction pour le premier mot de passe qui affiche les messages d'erreur
function passwordOneDisplay(){
    let testXss = regexObj.xssPattern.test(passwordOne.value); 
    //on vérifie si la saisie correspond à une attaque xss, cas donnant un message d'erreur
    if(testXss){
        errorFstPwdXss.style.display = "block";
        errorFstPwdXss.innerText = "Potentielle attaque XSS détéctée.";
        passwordOne.style.background = inputRed;
    }else{
        errorFstPwdXss.style.display = "none";
        errorFstPwdXss.innerText = "";
    }
    if(!passwordOne.value.match(regexObj.charDecimal)){
        errorDecimal.style.display ="block";
        errorDecimal.innerText ="Le Mot de passe doit contenir un chiffre";
        passwordOne.style.background = inputRed;
    }else{
        errorDecimal.style.display ="none";
        errorDecimal.innerText ="";
    }
    if(!passwordOne.value.match(regexObj.charSpecial)){
        errorSpecial.style.display ="block";
        errorSpecial.innerText ="Le Mot de passe doit contenir un caractère spécial";
        passwordOne.style.background = inputRed;
    }else{
        errorSpecial.style.display ="none";
        errorSpecial.innerText ="";
    }
    if(passwordOne.value.length < 6 || passwordOne.value.length > 12){
        errorLength.style.display ="block";
        passwordOne.style.background = inputRed;
        if (passwordOne.value.length < 6){
            errorLength.innerText ="Le Mot de passe est trop court";
            
        }else{
            errorLength.innerText ="Le Mot de passe est trop long";
        }
    }else{
        errorLength.style.display ="none";
        errorLength.innerText ="";
    }
}

let isPassWordOneValid = false;
let passwordOneValue ="";
//Ecouteur d'évement mot de passe 1
passwordOne.addEventListener("keyup", ()=>{
    passwordOne.style.background = "white";
    clearTimeout(timeout);
    isPassWordOneValid = true;
    passwordOneChecker();
    timeout = setTimeout(passwordOneDisplay, 1800);
    if(isPassWordOneValid === true){
        passwordOne.style.background = inputGreen;
    }
})

//déclarer une fonction pour le deuxième mot de passe qui voit si le champ est valide
function passwordTwoChecker(){
    let testXss = regexObj.xssPattern.test(passwordTwo.value); 
    //on vérifie si la saisie correspond à une attaque xss, cas donnant un message d'erreur
    if(testXss){
        isPassWordTwoValid = false;
    }
    if(passwordOneValue !== passwordTwo.value ){
        isPassWordTwoValid = false;
    }
}

//déclarer une fonction pour le deuxième mot de passe qui affiche les messages d'erreur
function passwordTwoDisplay(){
    let testXss = regexObj.xssPattern.test(passwordTwo.value); 
    //on vérifie si la saisie correspond à une attaque xss, cas donnant un message d'erreur
    if(testXss){
        errorScdPsswdXss.style.display = "block";
        errorScdPsswdXss.innerText = "Potentielle attaque XSS détéctée.";
        passwordTwo.style.background = inputRed;
    }else{
        errorScdPsswdXss.style.display = "none";
        errorScdPsswdXss.innerText = "";
    }
    if(passwordOneValue !== passwordTwo.value ){
        errorMatch.style.display ="block";
        errorMatch.innerText = "Les mots de passe ne correspondent pas.";
        passwordTwo.style.background = inputRed;
    }else{
        errorMatch.style.display ="none";
        errorMatch.innerText = "";
    }

}


let isPassWordTwoValid =false;
//Ecouteur d'évement mot de passe 2
passwordTwo.addEventListener("keyup", ()=>{
    passwordTwo.style.background = "white";
    isPassWordTwoValid = true;
    if(isPassWordOneValid === false){
        errorDisabled.style.display = "block";
        errorDisabled.innerText = "Veuillez entrer un premier mot de passe correct."
        errorScdPsswdXss.style.display = "none";
        errorScdPsswdXss.innerText = "";
        errorMatch.style.display ="none";
        errorMatch.innerText = "";
    }else{
        errorDisabled.style.display = "none";
        errorDisabled.innerText = "";
        clearTimeout(timeout);
        passwordTwoChecker();
        timeout = setTimeout(passwordTwoDisplay, 1800);
        if(isPassWordTwoValid === true){
            passwordTwo.style.background = inputGreen;
        }
        console.log("isPassWordTwoValid = "+isPassWordTwoValid);
    }
})

// form.addEventListener("submit", (e)=>{
//     noValid.style.display="none";
//     noValid.innerText="";
//     if((isPseudoValid === false) ||
//     (isEmailValid === false) ||
//     (isPassWordOneValid === false) ||
//     (isPassWordTwoValid === false)
//     ){
//         e.preventDefault();
//         noValid.style.display="block";
//         noValid.innerText="Veuillez remplir correctement les champs";
//     }
// })

// form.addEventListener("submit", (e)=>{
//     e.preventDefault();
// });


