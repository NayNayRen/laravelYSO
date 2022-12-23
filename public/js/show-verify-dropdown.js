function loadVerifyDropdownScript() {
    const verifyBy = document.querySelector("#verify_by");
    const verifyDropdown = document.querySelector(".verification-dropdown");
    const verifyButtonArrow = document.querySelector(".verify-button-arrow");
    const verificationSelection = document.querySelectorAll(
        ".verification-selection"
    );

    verifyBy.addEventListener("click", () => {
        verifyBy.classList.toggle("verification-list-container-toggle");
        verifyDropdown.classList.toggle("verification-dropdown-toggle");
        verifyButtonArrow.classList.toggle("verify-button-arrow-rotate");
    });

    verificationSelection.forEach((selection) => {
        selection.addEventListener("click", (e) => {
            verifyBy.value = e.target.innerText;
            verifyBy.style.color = "#000";
            verifyBy.classList.remove("verification-list-container-toggle");
            verifyDropdown.classList.remove("verification-dropdown-toggle");
            verifyButtonArrow.classList.remove("verify-button-arrow-rotate");
        });
    });
}

window.onload = loadVerifyDropdownScript();
