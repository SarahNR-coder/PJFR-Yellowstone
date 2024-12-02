

const ratingInputs = document.querySelectorAll('.rating input');
const selectedStar = document.querySelector('#selectedStar');
  ratingInputs.forEach(input => {
    input.addEventListener('change', () => {
      console.log(`Note sélectionnée : ${input.value} étoiles`)
      selectedStar.innerText = input.value;
    });
});

