const toggleHtmlElements = document.querySelectorAll(".toggle");
const hamburgerIconElement = document.querySelector(".icon");
let toggleTable = Array.from(toggleHtmlElements);
console.log(toggleTable);

let isDisplayed = false;
hamburgerIconElement.addEventListener("click", function(){
    console.log("Je passe dans l'eventlistener du click sur l'élément de classe 'icon'");
    if(isDisplayed === true){
        console.log("je passe dans le if isDisplayed vaut true");
        toggleTable.map((element)=>{
            element.style.display = "none";
        })
    }else{
        toggleTable.map((element)=>{
            element.style.display = "block";
        })
    }
    isDisplayed= !isDisplayed;
});


window.addEventListener("resize", function(){
    if(window.innerWidth <= 800){
        if(isDisplayed === true){
            console.log("je passe dans le if de l'E.L. window au resize, càd quand window.screen.width inf ou egal à 800px");
            toggleTable.map((element)=>{
                element.style.display = "block";
            })
        }else{
            console.log("je passe dans le else de l'E.L. window au resize, càd quand window.screen.width sup à 800px");
            toggleTable.map((element)=>{
                element.style.display = "none";
            })
        }
    }else{
        toggleTable.map((element)=>{
            element.style.display = "block";
        })
        isDisplayed = false;
    }
})






