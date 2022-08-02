const password = document.getElementById("password");
const confirmPassword = document.getElementById("confirm-password");
const showPassword = document.getElementById("show-password");
const hidePassword = document.getElementById("hide-password");

// shows password text and switches icon
function showLogin() {
    password.type = "password";
    hidePassword.style.display = "inline";
    showPassword.style.display = "none";
}

// hides password text and switches icon
function hideLogin() {
    password.type = "text";
    hidePassword.style.display = "none";
    showPassword.style.display = "inline";
}

// shows password text and switches icon
function showConfirm() {
    confirmPassword.type = "password";
    hidePassword.style.display = "inline";
    showPassword.style.display = "none";
}

// hides password text and switches icon
function hideConfirm() {
    confirmPassword.type = "text";
    hidePassword.style.display = "none";
    showPassword.style.display = "inline";
}
