let errMessageObject = {
    errPseudo:{
        errXss:"",
        errPseudo:""
    },
    errEmail:{
        errXss:"",
        errEmail:""
    },
    errOriginalPwd:{
        errXss:"",
        errLowerCase:"",
        errUpperCase:"",
        errCharDecimal:"",
        errCharSpecial:""
    },
    errConfirmationPwd:""
}

let inputRed = "#F56552";
let inputGreen = "#89F5C4";

const parentInput = document.getElementsByClassName("parent-input");
const parentInputTab = Array.from(parentInput);
const pseudo = document.querySelector("#pseudo");
const email = document.querySelector("#email");
const originalPwd = document.querySelector("#originalPwd");
const confirmationPwd = document.querySelector("#confirmationPwd");

function pseudoChecker(){
    const xssPattern = /<script.*?>.*?<\/script>|<.*?onclick=.*?>|<.*?on\w+=".*?"/i;
    const regexPseudo = /^[0-9A-Za-z!@#\$%\^&\*\(\)_\+\-=\[\]\{\};':"\\|,.<>\/?]*$/;

    let testXss = xssPattern.test(pseudo.value);
    if(testXss){
        errMessageObject.errPseudo.errXss="Nous détectons une attaque Xss";
    }

    let testPseudo = regexPseudo.test(pseudo.value);
    if(!testPseudo){
        errMessageObject.errPseudo.errPseudo="Veuillez n'utiliser que les caractères spéciaux courants";
    }

    return errMessageObject;
}

function clearPseudoErr(){
    (toClearPseudo === true)?parentInputTab[0].removeChild(parentInputTab[0].lastElementChild):"";
    toClearPseudo = false;
}


function pseudoDisplay(){

    if(errMessageObject.errPseudo.errXss!=""||errMessageObject.errPseudo.errPseudo!=""){
        pseudo.style.background = inputRed;
        const pseudoErrList = document.createElement("ul");
        parentInputTab[0].appendChild(pseudoErrList);
        toClearPseudo = true;

        if(errMessageObject.errPseudo.errXss!=""){
            const pseudoXss = document.createElement("li");
            pseudoErrList.append(pseudoXss);
            pseudoXss.style.listStyle = "none";
            pseudoXss.innerText = errMessageObject.errPseudo.errXss;
        }

        if(errMessageObject.errPseudo.errPseudo!=""){
            const pseudoFormat = document.createElement("li");
            pseudoErrList.append(pseudoFormat);
            pseudoFormat.style.listStyle = "none";
            pseudoFormat.innerText = errMessageObject.errPseudo.errPseudo;
        }
    }


}
let toClearPseudo = false;
let timeout;
pseudo.addEventListener("keyup", ()=>{
    clearPseudoErr();
    pseudo.style.background = "white";
    clearTimeout(timeout);
    errMessageObject.errPseudo.errXss="";
    errMessageObject.errPseudo.errPseudo="";
    errMessageObject = pseudoChecker();
    timeout = setTimeout(pseudoDisplay, 1800);
    if(errMessageObject.errPseudo.errXss=="" && errMessageObject.errPseudo.errPseudo=="" && pseudo.value!=""){
        pseudo.style.background = inputGreen;
    }
})

function clearEmailErr(){
    (toClearEmail === true)?parentInputTab[1].removeChild(parentInputTab[1].lastElementChild):"";
    toClearEmail = false;
}

function emailChecker(){
    const xssPattern = /<script.*?>.*?<\/script>|<.*?onclick=.*?>|<.*?on\w+=".*?"/i;
    const regexEmail = /^[a-z0-9._-]+@[a-z0-9._-]+\.[a-z]{2,6}$/;

    let testXss = xssPattern.test(email.value);
    if(testXss){
        errMessageObject.errEmail.errXss = "Nous détectons une attaque Xss";
    }

    let testEmail = regexEmail.test(email.value)
    if(!testEmail){
        errMessageObject.errEmail.errEmail = "Veuillez utiliser le bon format d'email";
    }

    return errMessageObject;
}

function emailDisplay(){
    if((errMessageObject.errEmail.errXss !="" || errMessageObject.errEmail.errEmail !="") && email.value!="" ){
        email.style.background = inputRed;
        const emailErrList = document.createElement("ul");
        parentInputTab[1].append(emailErrList);
        toClearEmail = true;
        
        if(errMessageObject.errEmail.errXss!=""){
            const emailXss = document.createElement("li");
            emailErrList.append(emailXss);
            emailXss.style.listStyle = "none";
            emailXss.innerText = errMessageObject.errEmail.errXss;
        }

        if(errMessageObject.errEmail.errEmail!=""){
            const emailFormat = document.createElement("li");
            emailErrList.append(emailFormat);
            emailFormat.style.listStyle = "none";
            emailFormat.innerText = errMessageObject.errEmail.errEmail;
        }
    }
}

let toClearEmail = false;
email.addEventListener("keyup", ()=>{
    clearEmailErr();
    email.style.background = "white";
    clearTimeout(timeout);
    errMessageObject.errEmail.errXss ="";
    errMessageObject.errEmail.errEmail ="";
    errMessageObject = emailChecker();
    timeout = setTimeout(emailDisplay, 1800);
    if(errMessageObject.errEmail.errXss ==="" && errMessageObject.errEmail.errEmail ==="" && email.value != ""){
        email.style.background = inputGreen;
    }
})

function clearOriginalPwdErr(){
    (toClearOriginalPwd === true)?parentInputTab[2].removeChild(parentInputTab[2].lastElementChild):"";
    toClearOriginalPwd = false;
}

function originalPwdChecker(){
    const xssPattern = /<script.*?>.*?<\/script>|<.*?onclick=.*?>|<.*?on\w+=".*?"/i;
    const regexLowerCase = /[a-z]/;
    const regexUpperCase = /[A-Z]/;
    const regexCharDecimal = /\d/;
    const regexCharSpecial = /[$&@!]/;

    let testXss = xssPattern.test(originalPwd.value);
    if(testXss){
        errMessageObject.errOriginalPwd.errXss = "Nous détectons une attaque Xss";
    }

    let testLowerCase = regexLowerCase.test(originalPwd.value)
    if(!testLowerCase){
        errMessageObject.errOriginalPwd.errLowerCase = "Veuillez inclure des lettres minuscules";
    }

    let testUpperCase = regexUpperCase.test(originalPwd.value)
    if(!testUpperCase){
        errMessageObject.errOriginalPwd.errUpperCase = "Veuillez inclure des lettres majuscules";
    }

    let testCharDecimal = regexCharDecimal.test(originalPwd.value);
    if(!testCharDecimal){
        errMessageObject.errOriginalPwd.errCharDecimal = "Veuillez inclure des chiffres";
    }

    let testCharSpecial = regexCharSpecial.test(originalPwd.value);
    if(!testCharSpecial){
        errMessageObject.errOriginalPwd.errCharSpecial = "Veuillez inclure des caractères spéciaux";
    }

    return errMessageObject;
}

function originalPwdDisplay(){
    if(errMessageObject.errOriginalPwd.errXss!=""
        && errMessageObject.errOriginalPwd.errLowerCase!=""
        && errMessageObject.errOriginalPwd.errUpperCase!=""
        && errMessageObject.errOriginalPwd.errCharDecimal!=""
        && errMessageObject.errOriginalPwd.errCharSpecial!=""
        && originalPwd.value !=""
    ){
        originalPwd.style.background = inputRed;
        const originalPwdErrList = document.createElement("ul");
        parentInputTab[2].append(originalPwdErrList);
        toClearOriginalPwd = true;
        
        if(errMessageObject.errOriginalPwd.errXss!=""){
            const originalPwdXss = document.createElement("li");
            originalPwdErrList.append(originalPwdXss);
            originalPwdXss.style.listStyle = "none";
            originalPwdXss.innerText = errMessageObject.errOriginalPwd.errXss;
        }

        if(errMessageObject.errOriginalPwd.errLowerCase!=""){
            const originalPwdLowerCase = document.createElement("li");
            originalPwdErrList.append(originalPwdLowerCase);
            originalPwdLowerCase.style.listStyle = "none";
            originalPwdLowerCase.innerText = errMessageObject.errOriginalPwd.errLowerCase;
        }

        if(errMessageObject.errOriginalPwd.errUpperCase!=""){
            const originalPwdUpperCase = document.createElement("li");
            originalPwdErrList.append(originalPwdUpperCase);
            originalPwdUpperCase.style.listStyle = "none";
            originalPwdUpperCase.innerText = errMessageObject.errOriginalPwd.errUpperCase;
        }

        if(errMessageObject.errOriginalPwd.errCharDecimal!=""){
            const originalPwdCharDecimal = document.createElement("li");
            originalPwdErrList.append(originalPwdCharDecimal);
            originalPwdCharDecimal.style.listStyle = "none";
            originalPwdCharDecimal.innerText = errMessageObject.errOriginalPwd.errCharDecimal;
        }

        if(errMessageObject.errOriginalPwd.errCharSpecial!=""){
            const originalPwdCharSpecial = document.createElement("li");
            originalPwdErrList.append(originalPwdCharSpecial);
            originalPwdCharSpecial.style.listStyle = "none";
            originalPwdCharSpecial.innerText = errMessageObject.errOriginalPwd.errCharSpecial;
        }
    }
}

let toClearOriginalPwd = false
originalPwd.addEventListener("keyup", ()=>{
    clearOriginalPwdErr();
    if(confirmationPwd.getAttribute("disabled")==null){
        confirmationPwd.setAttribute("disabled","");
    }
    originalPwd.style.background = "white";
    clearTimeout(timeout);

    errMessageObject.errOriginalPwd.errXss="";
    errMessageObject.errOriginalPwd.errLowerCase="";
    errMessageObject.errOriginalPwd.errUpperCase!=""
    errMessageObject.errOriginalPwd.errCharDecimal=""
    errMessageObject.errOriginalPwd.errCharSpecial="";

    errMessageObject = originalPwdChecker();
    timeout = setTimeout(originalPwdDisplay, 1800);
    if(errMessageObject.errOriginalPwd.errXss===""
        && errMessageObject.errOriginalPwd.errLowerCase===""
        && errMessageObject.errOriginalPwd.errUpperCase===""
        && errMessageObject.errOriginalPwd.errCharDecimal===""
        && errMessageObject.errOriginalPwd.errCharSpecial===""
        && originalPwd.value!=""){
        originalPwd.style.background = inputGreen;
        confirmationPwd.removeAttribute("disabled");
    }
})

function confirmationPasswordChecker(){
    const xssPattern = /<script.*?>.*?<\/script>|<.*?onclick=.*?>|<.*?on\w+=".*?"/i;

    let testXss = xssPattern.test(confirmationPwd.value);
    if(testXss){
        errMessageObject.errConfirmationPwd.errXss = "Nous détectons une attaque Xss";
    }

    if(originalPwd.value != confirmationPwd.value){
        errMessageObject.errConfirmationPwd.errMatch = "Veuillez saisir le même mot de passe";
    }
}

function confirmationPasswordDisplay(){
    if(errMessageObject.errConfirmationPwd !=""){
        confirmationPwd.style.background = inputRed;
        const confirmationPwdErrList = document.createElement("ul");
        parentInputTab[3].append(confirmationPwdErrList);
        
        if(errMessageObject.errConfirmationPwd.errXss){
            const confirmationPwdXss = document.createElement("li");
            confirmationPwdErrList.append(confirmationPwdXss);
            confirmationPwdXss.style.listStyle = "none";
            confirmationPwdXss.innerText = errMessageObject.errConfirmationPwd.errXss;
        }

        if(errMessageObject.errConfirmationPwd.errMatch){
            const confirmationPwdMatch = document.createElement("li");
            confirmationPwdErrList.append(confirmationPwdMatch);
            confirmationPwdMatch.style.listStyle = "none";
            confirmationPwdMatch.innerText = errMessageObject.errConfirmationPwd.errMatch;
        }
    }
}

confirmationPwd.addEventListener("keyup", ()=>{
    confirmationPwd.style.background = "white";
    clearTimeout(timeout);
    errMessageObject.errConfirmationPwd ="";
    confirmationPasswordChecker();
    timeout = setTimeout(confirmationPasswordDisplay, 1800);
    if(errMessageObject.errConfirmationPwd =""){
        originalPwd.style.background = inputGreen;
    }
})