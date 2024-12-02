

const ratingInputs = document.querySelectorAll('.rating input');
const numberOfStars = document.querySelector('#nombreEtoiles');
  ratingInputs.forEach(input => {
    input.addEventListener('change', () => {
      numberOfStars.value = input.value;
      console.log(`numberOfStars.value : ${numberOfStars.value} `)
    });
});

