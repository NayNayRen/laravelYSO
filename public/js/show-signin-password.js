const registerPassword = document.getElementById("register-password");
const password = document.getElementById("password");
const confirmPassword = document.getElementById("confirm-password");
const showPassword = document.getElementById("show-password");
const hidePassword = document.getElementById("hide-password");

// shows register password text and switches icon
function showRegister() {
    registerPassword.type = "password";
    hidePassword.style.display = "inline";
    showPassword.style.display = "none";
}
// hides register password text and switches icon
function hideRegister() {
    registerPassword.type = "text";
    hidePassword.style.display = "none";
    showPassword.style.display = "inline";
}

// shows login password text and switches icon
function showLogin() {
    password.type = "password";
    hidePassword.style.display = "inline";
    showPassword.style.display = "none";
}
// hides login password text and switches icon
function hideLogin() {
    password.type = "text";
    hidePassword.style.display = "none";
    showPassword.style.display = "inline";
}

// shows change password text and switches icon
function showConfirm() {
    confirmPassword.type = "password";
    hidePassword.style.display = "inline";
    showPassword.style.display = "none";
}
// hides change password text and switches icon
function hideConfirm() {
    confirmPassword.type = "text";
    hidePassword.style.display = "none";
    showPassword.style.display = "inline";
}
