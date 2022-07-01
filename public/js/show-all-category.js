const allButton = document.querySelector(".all-button");
const allButtonArrow = document.querySelector(".all-button-arrow");
const filterSelectionDropdown = document.querySelector(
    ".filter-selection-dropdown"
);

allButton.addEventListener("click", () => {
    filterSelectionDropdown.classList.toggle("show-dropdown");
    allButtonArrow.classList.toggle("all-button-arrow-rotate");
});
