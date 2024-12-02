

const ratingInputs = document.querySelectorAll('.rating input');
const numberOfStars = document.querySelector('#nombreEtoiles');
const ratingButton = document.querySelector('#noter');

let tempStars="";
  ratingInputs.forEach(input => {
    input.addEventListener('change', () => {
      tempStars = input.value;
    });
});

ratingButton.addEventListener('click', () =>{
  if(tempStars!=""){
    numberOfStars.value = tempStars;
  }  
})

