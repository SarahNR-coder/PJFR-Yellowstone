
const toggleHtmlElements = document.querySelectorAll(".toggle");
const hamburgerIconElement = document.querySelector(".icon");
let toggleTable = Array.from(toggleHtmlElements);
console.log(toggleTable);

let isDisplayed = false;
hamburgerIconElement.addEventListener("click", function(){
    if(window.screen.width <=800){
        if(isDisplayed === true){
            toggleTable.map((element)=>{
                element.computedStyleMap.display = "none";
            })
        }else{
            toggleTable.map((element)=>{
                element.computedStyleMap.display = "block";
            })
        }
    }else{
        toggleTable.map((element)=>{
            element.computedStyleMap.display = "block";
        })
    }
    isDisplayed= !isDisplayed;
});







