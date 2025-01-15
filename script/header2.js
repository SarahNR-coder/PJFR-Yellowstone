const toggleHtmlElements = document.querySelectorAll(".toggleElt");
const hamburgerIconElement = document.querySelector(".hb");
const mainSectionElement = document.querySelector("main");

let toggleTable = Array.from(toggleHtmlElements);

let isDisplayed = false;
hamburgerIconElement.addEventListener("click", function(){
    if(isDisplayed === true){
        toggleTable.forEach((element)=>{
            element.style.display = "none";
        });
            mainSectionElement.style.marginTop = "0";

    }else{
        toggleTable.forEach((element)=>{
            element.style.display = "block";
        });
        mainSectionElement.style.marginTop = "18vw"; 
    }
    isDisplayed= !isDisplayed;
});


window.addEventListener("resize", function(){
    if(window.innerWidth <= 800){
        if(isDisplayed === true){
            toggleTable.forEach((element)=>{
                element.style.display = "block";
            })
        }else{
            toggleTable.forEach((element)=>{
                element.style.display = "none";
            })
        }
    }else{
        toggleTable.forEach((element)=>{
            element.style.display = "block";
        })
        isDisplayed = false;
    }
})












