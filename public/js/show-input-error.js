const searchFormError = document.querySelector(".search-form-error");

function showErrorMessage() {
    if (searchFormError.innerText === "") {
        // has no error message
        searchFormError.style.padding = "0";
    } else {
        // has an error message
        searchFormError.style.padding = "2px 0";
    }
}

window.onload = showErrorMessage();
