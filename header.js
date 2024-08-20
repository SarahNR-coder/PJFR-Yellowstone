const toggleHtmlElements = document.querySelectorAll(".toggle");
const hamburgerIconElement = document.querySelector(".icon");
let toggleTable = Array.from(toggleHtmlElements);

let isDisplayed = false;
hamburgerIconElement.addEventListener("click", function(){
    if(isDisplayed === true){
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






