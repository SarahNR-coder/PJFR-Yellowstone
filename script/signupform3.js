//colors
let inputRed = "#F56552";
let inputGreen = "#89F5C4";
//HTMLElements
const parentInput = document.getElementsByClassName("parent-input");
const parentInputTab = Array.from(parentInput);
const pseudo = document.querySelector("#pseudo");
const email = document.querySelector("#email");
const originalPwd = document.querySelector("#originalPwd");
const confirmationPwd = document.querySelector("#confirmationPwd");
//Regex
const xssPattern = /<script.*?>.*?<\/script>|<.*?onclick=.*?>|<.*?on\w+=".*?"/i;
const regexPseudo = /^[0-9A-Za-z!@#\$%\^&\*\(\)_\+\-=\[\]\{\};':"\\|,.<>\/?]*$/;
const regexEmail = /^[a-z0-9._-]+@[a-z0-9._-]+\.[a-z]{2,6}$/;
const regexLowerCase = /[a-z]/;
const regexUpperCase = /[A-Z]/;
const regexCharDecimal = /\d/;
const regexCharSpecial = /[$&@!]/;
//Error messages
const errXss = "Nous détectons une attaque Xss";
const errPseudo = "Veuillez n'utiliser que les caractères spéciaux courants";
const errEmail = "Veuillez utiliser le bon format d'email";
const errLowerCase = "Veuillez inclure des lettres minuscules";
const errUpperCase = "Veuillez inclure des lettres majuscules";
const errCharDecimal = "Veuillez inclure des chiffres";
const errCharSpecial = "Veuillez inclure des caractères spéciaux";
const errLength = "Veuillez donner à votre mot de passe une longueur comprise entre 6 et 10 caractères.";
const errMatch = "Veuillez saisir le même mot de passe";
//Parameters
let timeout;
let toClearPseudo = false;
let toClearEmail = false;
let toClearOriginalPwd = false;
let toClearConfirmationPwd = false;

pseudo.addEventListener("keyup",checkingPseudo);

function checkingPseudo(){

    (toClearPseudo === true)?parentInputTab[0].removeChild(parentInputTab[0].lastElementChild):"";
    toClearPseudo = false;

    //Tests
    let testXss = xssPattern.test(pseudo.value);
    let testPseudo = regexPseudo.test(pseudo.value);

    function displayEffect(){
        pseudo.style.background = inputRed;
        const pseudoErrList = document.createElement("ul");
        parentInputTab[0].appendChild(pseudoErrList);
        toClearPseudo = true;

        if(testXss){
            const pseudoXss = document.createElement("li");
            pseudoErrList.append(pseudoXss);
            pseudoXss.style.listStyle = "none";
            pseudoXss.innerText = errXss;
        }
        if(!testPseudo){
            const pseudoFormat = document.createElement("li");
            pseudoErrList.append(pseudoFormat);
            pseudoFormat.style.listStyle = "none";
            pseudoFormat.innerText = errPseudo;
        }
    }

    pseudo.style.background = "white";
    clearTimeout(timeout);
    if(testXss || !testPseudo){   
        timeout = setTimeout(displayEffect,1800);
    }else{
        if(pseudo.value!=""){
            pseudo.style.background = inputGreen;
        }
    }
}

email.addEventListener("keyup",checkingEmail);

function checkingEmail(){

    (toClearEmail === true)?parentInputTab[1].removeChild(parentInputTab[1].lastElementChild):"";
    toClearEmail = false;

    //Tests
    let testXss = xssPattern.test(email.value);
    let testEmail = regexEmail.test(email.value);

    function displayEffect(){
        email.style.background = inputRed;
        const emailErrList = document.createElement("ul");
        parentInputTab[1].append(emailErrList);
        toClearEmail = true;

        if(testXss){
            const emailXss = document.createElement("li");
            emailErrList.append(emailXss);
            emailXss.style.listStyle = "none";
            emailXss.innerText = errXss;
        }
        if(!testEmail){
            const emailFormat = document.createElement("li");
            emailErrList.append(emailFormat);
            emailFormat.style.listStyle = "none";
            emailFormat.innerText = errEmail;
        }
    }

    email.style.background = "white";
    clearTimeout(timeout);
    if((testXss || !testEmail) && email.value!=""){   
        timeout = setTimeout(displayEffect,1800);
    }else{
        if(email.value!=""){
            email.style.background = inputGreen;
        }
    }
}

originalPwd.addEventListener("keyup",checkingOriginalPwd);

function checkingOriginalPwd(){

    (toClearOriginalPwd === true)?parentInputTab[2].removeChild(parentInputTab[2].lastElementChild):"";
    toClearOriginalPwd = false;

    //Tests
    let testXss = xssPattern.test(originalPwd.value);
    let testLowerCase = regexLowerCase.test(originalPwd.value);
    let testUpperCase = regexUpperCase.test(originalPwd.value);
    let testCharDecimal = regexCharDecimal.test(originalPwd.value);
    let testCharSpecial = regexCharSpecial.test(originalPwd.value);
    let testLength = (originalPwd.value.length>10 || originalPwd.value.length<6)?false:true;

    function displayEffect(){
        originalPwd.style.background = inputRed;
        const originalPwdErrList = document.createElement("ul");
        parentInputTab[2].append(originalPwdErrList);
        toClearOriginalPwd = true;

        if(testXss){
            const originalPwdXss = document.createElement("li");
            originalPwdErrList.append(originalPwdXss);
            originalPwdXss.style.listStyle = "none";
            originalPwdXss.innerText = errXss;
        }
        if(!testLowerCase){
            const originalPwdLowerCase = document.createElement("li");
            originalPwdErrList.append(originalPwdLowerCase);
            originalPwdLowerCase.style.listStyle = "none";
            originalPwdLowerCase.innerText = errLowerCase;
        }

        if(!testUpperCase){
            const originalPwdUpperCase = document.createElement("li");
            originalPwdErrList.append(originalPwdUpperCase);
            originalPwdUpperCase.style.listStyle = "none";
            originalPwdUpperCase.innerText = errUpperCase;
        }

        if(!testCharDecimal){
            const originalPwdCharDecimal = document.createElement("li");
            originalPwdErrList.append(originalPwdCharDecimal);
            originalPwdCharDecimal.style.listStyle = "none";
            originalPwdCharDecimal.innerText = errCharDecimal;
        }

        if(!testCharSpecial){
            const originalPwdCharSpecial = document.createElement("li");
            originalPwdErrList.append(originalPwdCharSpecial);
            originalPwdCharSpecial.style.listStyle = "none";
            originalPwdCharSpecial.innerText = errCharSpecial;
        }

        if(!testLength){
            const originalPwdLength = document.createElement("li");
            originalPwdErrList.append(originalPwdLength);
            originalPwdLength.style.listStyle = "none";
            originalPwdLength.innerText = errLength;
        }

        if(confirmationPwd.value!=""){
            confirmationPwd.style.background = inputRed;
        }

    }

    if(confirmationPwd.getAttribute("disabled")==null){
        confirmationPwd.setAttribute("disabled","");
    }
    originalPwd.style.background = "white";
    clearTimeout(timeout);
    if((testXss || !testLowerCase || !testUpperCase || !testCharDecimal || !testCharSpecial || !testLength) && originalPwd.value!=""){   
        timeout = setTimeout(displayEffect,1800);
    }else{
        if(originalPwd.value!=""){
            originalPwd.style.background = inputGreen;
            confirmationPwd.removeAttribute("disabled");
        }
    }
}

confirmationPwd.addEventListener("keyup",checkingConfirmationPwd);

function checkingConfirmationPwd(){

    (toClearConfirmationPwd === true)?parentInputTab[3].removeChild(parentInputTab[3].lastElementChild):"";
    toClearConfirmationPwd = false;

    //Tests
    let testXss = xssPattern.test(originalPwd.value);
    let testMatch = (originalPwd.value != confirmationPwd.value)?false:true;

    function displayEffect(){
        confirmationPwd.style.background = inputRed;
        const confirmationPwdErrList = document.createElement("ul");
        parentInputTab[3].append(confirmationPwdErrList);
        toClearConfirmationPwd = true;

        if(testXss){
            const confirmationPwdXss = document.createElement("li");
            confirmationPwdErrList.append(confirmationPwdXss);
            confirmationPwdXss.style.listStyle = "none";
            confirmationPwdXss.innerText = errXss;
        }
        if(!testMatch){
            const confirmationPwdMatch = document.createElement("li");
            confirmationPwdErrList.append(confirmationPwdMatch);
            confirmationPwdMatch.style.listStyle = "none";
            confirmationPwdMatch.innerText = errMatch;
        }
    }

    confirmationPwd.style.background = "white";
    clearTimeout(timeout);
    if((testXss || !testMatch) && confirmationPwd.value!=""){   
        timeout = setTimeout(displayEffect,1800);
    }else{
        if(confirmationPwd.value!=""){
            confirmationPwd.style.background = inputGreen;
        }
    }
}