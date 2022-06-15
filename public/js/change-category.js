const foodButton = document.querySelector('#food');
const fashionButton = document.querySelector('#fashion');
const autoButton = document.querySelector('#auto');
const funButton = document.querySelector('#fun');
const healthButton = document.querySelector('#health');

const foodContainer = document.querySelector('#food-container');
const fashionContainer = document.querySelector('#fashion-container');

foodButton.addEventListener('click', () => {
  foodContainer.style.display = 'grid';
  fashionContainer.style.display = 'none';
});

fashionButton.addEventListener('click', () => {
  fashionContainer.style.display = 'grid';
  foodContainer.style.display = 'none';
});
