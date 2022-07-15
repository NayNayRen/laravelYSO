const searchFormError = document.querySelector(".search-form-error");

function showErrorMessage() {
    if (searchFormError.innerText === "") {
        // has no error message
        searchFormError.style.padding = "0";
    } else {
        // has an error message
        searchFormError.style.opacity = 1;
        searchFormError.style.padding = "5px 0";
        setTimeout(() => {
            // error goes away after 5 seconds
            searchFormError.style.opacity = 0;
            searchFormError.innerText === "";
            searchFormError.style.padding = "0";
        }, 5000);
    }
}

window.onload = showErrorMessage();
