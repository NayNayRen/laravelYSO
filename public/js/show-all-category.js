const allButton = document.querySelector(".all-button");
const allButtonArrow = document.querySelector(".all-button-arrow");
const categoryItem = document.querySelectorAll(".category-item");
const searchField = document.querySelector(".search-field");
const filterSelectionDropdown = document.querySelector(
    ".filter-selection-dropdown"
);

allButton.addEventListener("click", () => {
    filterSelectionDropdown.classList.toggle(
        "filter-selection-dropdown-toggle"
    );
    allButtonArrow.classList.toggle("all-button-arrow-rotate");
    allButtonArrow.classList.toggle("all-button-toggle");
    allButton.classList.toggle("all-button-toggle");
});

allButtonArrow.addEventListener("click", () => {
    filterSelectionDropdown.classList.toggle(
        "filter-selection-dropdown-toggle"
    );
    allButtonArrow.classList.toggle("all-button-arrow-rotate");
    allButtonArrow.classList.toggle("all-button-toggle");
    allButton.classList.toggle("all-button-toggle");
});

categoryItem.forEach((item) => {
    item.addEventListener("click", (e) => {
        searchField.value = e.target.innerText;
    });
});
