// loads elements for the shared message
const removeShareMessage = document.querySelector(".remove-share-message");
const sharedMessageName = document.querySelector("#shared-message-name");
const cardName = document.querySelector("#card-name");
const selectedDealShareMessage = document.querySelector(
    ".selected-deal-share-message"
);
function showSharedMessage() {
    sharedMessageName.innerText = cardName.innerText;
    selectedDealShareMessage.classList.add("show-selected-deal-message");
    windowOverlay.classList.add("window-overlay-dim");
    console.log(cardName.innerText);
}
removeShareMessage.addEventListener("click", () => {
    selectedDealShareMessage.classList.remove("show-selected-deal-message");
    windowOverlay.classList.remove("window-overlay-dim");
});
