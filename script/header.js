const toggleHtmlElements = document.querySelectorAll(".toggle");
const hamburgerIconElement = document.querySelector(".icon");
const mainSectionElement = document.querySelector("main");

let toggleTable = Array.from(toggleHtmlElements);

let isDisplayed = false;
hamburgerIconElement.addEventListener("click", function(){
    if(isDisplayed === true){
        toggleTable.map((element)=>{
            element.style.display = "none";
        });
            mainSectionElement.style.marginTop = "0";

    }else{
        toggleTable.map((element)=>{
            element.style.display = "block";
        });
        mainSectionElement.style.marginTop = "18vw"; 
    }
    isDisplayed= !isDisplayed;
});


window.addEventListener("resize", function(){
    if(window.innerWidth <= 800){
        if(isDisplayed === true){
            toggleTable.map((element)=>{
                element.style.display = "block";
            })
        }else{
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






