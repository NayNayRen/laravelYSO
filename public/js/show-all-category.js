const allButton = document.querySelector(".all-button");
const allButtonArrow = document.querySelector(".all-button-arrow");
const categoryItem = document.querySelectorAll(".category-item");
const searchField = document.querySelector(".search-field");
const filterSelectionDropdown = document.querySelector(
    ".filter-selection-dropdown"
);

allButton.addEventListener("click", () => {
    filterSelectionDropdown.classList.toggle("show-dropdown");
    allButtonArrow.classList.toggle("all-button-arrow-rotate");
});

categoryItem.forEach((item) => {
    item.addEventListener("click", (e) => {
        // console.log(e.target.innerText);
        searchField.value = e.target.innerText;
    });
});
