// password container, icon that changes, and reset button
// numbers 0-9 and letters a-z
const keyPressedList = /^[0-9a-zA-Z]+$/;
const newUserPassword = document.getElementById("password");
const registerPasswordContainer = document.querySelector(".password-register");
const passwordIcon = document.querySelector(".password-length-icon");

// checks password length and changes icon accordingly
function checkPasswordLength() {
    if (newUserPassword.value.length >= 8) {
        // 8 or more
        validPassword();
    }
    if (newUserPassword.value.length < 8) {
        // less than 8
        invalidPassword();
    }
}

// checks for alphanumeric keystrokes in password input
function checkAlphanumericPassword(e) {
    const keyPressed = e.key.toLowerCase();
    if (keyPressed.match(keyPressedList)) {
        checkPasswordLength();
        return;
    }
    checkPasswordLength();
}

// changes password icon based on password length
function validPassword() {
    passwordIcon.innerHTML =
        '<span class="password-length-correct-icon"><i class="fa fa-check" aria-hidden="true"></i></span>';
}

// changes password icon based on password length
function invalidPassword() {
    passwordIcon.innerHTML =
        '<span class="password-length-incorrect-icon"><i class="fa fa-times" aria-hidden="true"></i></span>';
}

// checks the password field for password length on each key press
registerPasswordContainer.addEventListener("keyup", checkAlphanumericPassword);
