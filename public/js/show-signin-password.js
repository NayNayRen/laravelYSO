const password = document.getElementById("password");
const showPassword = document.getElementById("show-password");
const hidePassword = document.getElementById("hide-password");

// shows password text and switches icon
function show() {
    password.type = "password";
    hidePassword.style.display = "inline";
    showPassword.style.display = "none";
}

// hides password text and switches icon
function hide() {
    password.type = "text";
    hidePassword.style.display = "none";
    showPassword.style.display = "inline";
}
