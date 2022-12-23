// registered user stuff
const registeredDealLabel = document.getElementById("registered-deal-label");
const registeredTextButton = document.getElementById("registered-text-button");
const registeredEmailButton = document.getElementById(
    "registered-email-button"
);
const registeredSendButton = document.getElementById("registered-send-button");
const registeredDealPhone = document.getElementById("registered-deal-phone");
const registeredDealEmail = document.getElementById("registered-deal-email");
const registeredDealResponse = document.querySelector(
    ".registered-deal-response"
);
const registeredTextRedemption = document.querySelector(
    ".registered-text-redemption"
);
const registeredEmailRedemption = document.querySelector(
    ".registered-email-redemption"
);
const registeredUserProfileName = document.getElementById(
    "registered-user-profile-name"
);
const registeredUserProfilePicture = document.getElementById(
    "registered-user-profile-picture"
);
const registeredShareDealButton = document.getElementById(
    "registered-share-deal-button"
);
const registeredFavoriteDealButton = document.getElementById(
    "registered-favorite-deal-button"
);

// shows text display when text button is clicked
function showTextChoices() {
    registeredDealLabel.innerText = "Send the coupon via text.";
    registeredDealResponse.innerText = "Use or enter a new phone number.";
    registeredEmailRedemption.innerText = "Send via email.";
    registeredEmailRedemption.style.display = "inline";
    registeredTextRedemption.style.display = "none";
    registeredDealPhone.style.opacity = 1;
    registeredDealEmail.style.opacity = 0;
    registeredDealEmail.style.height = 0;
    registeredEmailRedemption.addEventListener("click", () => {
        showEmailChoices();
    });
    if (window.innerWidth > 1300) {
        registeredDealPhone.style.height = "50px";
    } else if (window.innerWidth < 1300 && window.innerWidth > 700) {
        registeredDealPhone.style.height = "40px";
    } else if (window.innerWidth < 700) {
        registeredDealPhone.style.height = "35px";
    }
}

// shows email display when email button is clicked
function showEmailChoices() {
    registeredDealLabel.innerText = "Send the coupon via email.";
    registeredDealResponse.innerText = "Use or enter a new email address.";
    registeredTextRedemption.innerText = "Send via text.";
    registeredTextRedemption.style.display = "inline";
    registeredEmailRedemption.style.display = "none";
    registeredDealEmail.style.opacity = 1;
    registeredDealPhone.style.opacity = 0;
    registeredDealPhone.style.height = 0;
    registeredTextRedemption.addEventListener("click", () => {
        showTextChoices();
    });
    if (window.innerWidth > 1300) {
        registeredDealEmail.style.height = "50px";
    } else if (window.innerWidth < 1300 && window.innerWidth > 700) {
        registeredDealEmail.style.height = "40px";
    } else if (window.innerWidth < 700) {
        registeredDealEmail.style.height = "35px";
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
registeredTextButton.addEventListener("click", () => {
    showTextChoices();
    activateSendDealButton(registeredSendButton);
    registeredSendButton.style.marginTop = "20px";
    registeredTextButton.style.display = "none";
    registeredEmailButton.style.display = "none";
});

// email redemption button
registeredEmailButton.addEventListener("click", () => {
    showEmailChoices(registeredTextRedemption);
    activateSendDealButton(registeredSendButton);
    registeredSendButton.style.marginTop = "20px";
    registeredTextButton.style.display = "none";
    registeredEmailButton.style.display = "none";
});
