// unregistered user stuff
const unregisteredDealLabel = document.getElementById(
    "unregistered-deal-label"
);
const unregisteredTextButton = document.getElementById(
    "unregistered-text-button"
);
const unregisteredEmailButton = document.getElementById(
    "unregistered-email-button"
);

const unregisteredSendButton = document.getElementById(
    "unregistered-send-button"
);
const unregisteredDealPhone = document.getElementById(
    "unregistered-deal-phone"
);
const unregisteredDealEmail = document.getElementById(
    "unregistered-deal-email"
);
const unregisteredDealResponse = document.querySelector(
    ".unregistered-deal-response"
);
const unregisteredTextRedemption = document.querySelector(
    ".unregistered-text-redemption"
);
const unregisteredEmailRedemption = document.querySelector(
    ".unregistered-email-redemption"
);
// used in the dropdown message
const unregisteredUserProfileName = document.getElementById(
    "unregistered-user-profile-name"
);
const unregisteredUserProfilePicture = document.getElementById(
    "unregistered-user-profile-picture"
);
const unregisteredShareDealButton = document.getElementById(
    "unregistered-share-deal-button"
);
const unregisteredFavoriteDealButton = document.getElementById(
    "unregistered-favorite-deal-button"
);

// shows text display when text button is clicked
function showTextChoices() {
    unregisteredDealLabel.innerText = "Send the coupon via text.";
    unregisteredDealResponse.innerText = "Enter a new phone number.";
    unregisteredEmailRedemption.innerText = "Send via email.";
    unregisteredEmailRedemption.style.display = "inline";
    unregisteredTextRedemption.style.display = "none";
    unregisteredDealPhone.style.opacity = 1;
    unregisteredDealEmail.style.opacity = 0;
    unregisteredDealEmail.style.height = 0;
    unregisteredEmailRedemption.addEventListener("click", () => {
        showEmailChoices();
    });
    if (window.innerWidth > 1300) {
        unregisteredDealPhone.style.height = "50px";
    } else if (window.innerWidth < 1300 && window.innerWidth > 700) {
        unregisteredDealPhone.style.height = "40px";
    } else if (window.innerWidth < 700) {
        unregisteredDealPhone.style.height = "35px";
    }
}

// shows email display when email button is clicked
function showEmailChoices() {
    unregisteredDealLabel.innerText = "Send the coupon via email.";
    unregisteredDealResponse.innerText = "Enter a new email address.";
    unregisteredTextRedemption.innerText = "Send via text.";
    unregisteredTextRedemption.style.display = "inline";
    unregisteredEmailRedemption.style.display = "none";
    unregisteredDealEmail.style.opacity = 1;
    unregisteredDealPhone.style.opacity = 0;
    unregisteredDealPhone.style.height = 0;
    unregisteredTextRedemption.addEventListener("click", () => {
        showTextChoices();
    });
    if (window.innerWidth > 1300) {
        unregisteredDealEmail.style.height = "50px";
    } else if (window.innerWidth < 1300 && window.innerWidth > 700) {
        unregisteredDealEmail.style.height = "40px";
    } else if (window.innerWidth < 700) {
        unregisteredDealEmail.style.height = "35px";
    }
}

// activates redemption button after method is chosen
function activateSendDealButton(button) {
    button.style.backgroundColor = "#E6331F";
    button.style.color = "#fff";
    button.disabled = false;
    button.addEventListener("mouseover", () => {
        button.style.backgroundColor = "#000";
        button.style.cursor = "pointer";
    });
    button.addEventListener("mouseout", () => {
        button.style.backgroundColor = "#E6331F";
    });
}

// deactivates redemption button after method is chosen
function deactivateButton(button) {
    button.style.backgroundColor = "#333333";
    button.disabled = true;
    button.addEventListener("mouseover", () => {
        button.style.backgroundColor = "#333333";
        button.style.cursor = "default";
    });
    button.addEventListener("mouseout", () => {
        button.style.backgroundColor = "#333333";
    });
}

// text redemption button
unregisteredTextButton.addEventListener("click", () => {
    showTextChoices();
    activateSendDealButton(unregisteredSendButton);
    unregisteredSendButton.style.marginTop = "20px";
    unregisteredTextButton.style.display = "none";
    unregisteredEmailButton.style.display = "none";
});

// email redemption button
unregisteredEmailButton.addEventListener("click", () => {
    showEmailChoices();
    activateSendDealButton(unregisteredSendButton);
    unregisteredSendButton.style.marginTop = "20px";
    unregisteredTextButton.style.display = "none";
    unregisteredEmailButton.style.display = "none";
});
