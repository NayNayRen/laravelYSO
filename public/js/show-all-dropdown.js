function loadAllButtonDropdownScript() {
    const allButton = document.querySelector(".all-button");
    const allButtonArrow = document.querySelector(".all-button-arrow");
    const categoryItem = document.querySelectorAll(".category-item");
    const searchField = document.querySelector(".search-field");
    const allButtonDropdown = document.querySelector(".all-button-dropdown");

    allButton.addEventListener("click", () => {
        allButtonDropdown.classList.toggle("all-button-dropdown-toggle");
        allButtonArrow.classList.toggle("all-button-arrow-rotate");
        allButton.classList.toggle("all-button-toggle");
    });

    allButtonArrow.addEventListener("click", () => {
        allButtonDropdown.classList.toggle("all-button-dropdown-toggle");
        allButtonArrow.classList.toggle("all-button-arrow-rotate");
        allButtonArrow.classList.toggle("all-button-toggle");
        allButton.classList.toggle("all-button-toggle");
    });

    categoryItem.forEach((item) => {
        item.addEventListener("click", (e) => {
            searchField.value = e.target.innerText;
            allButtonDropdown.classList.remove("all-button-dropdown-toggle");
            allButtonArrow.classList.remove("all-button-arrow-rotate");
            allButton.classList.remove("all-button-toggle");
        });
    });
}

window.onload = loadAllButtonDropdownScript();
