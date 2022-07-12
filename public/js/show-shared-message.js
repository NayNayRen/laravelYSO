// loads elements for the shared message
function loadSharedMessage() {
    const windowOverlay = document.querySelector("#window-overlay");
    const shareButton = document.querySelectorAll("#share-button");
    const removeShareMessage = document.querySelector("#remove-share-message");
    const selectedDealShareMessage = document.querySelector(
        ".selected-deal-share-message"
    );
    shareButton.forEach((button) => {
        button.addEventListener("click", () => {
            selectedDealShareMessage.classList.add(
                "show-selected-deal-message"
            );
            windowOverlay.classList.add("window-overlay-dim");
        });
    });

    removeShareMessage.addEventListener("click", () => {
        selectedDealShareMessage.classList.remove("show-selected-deal-message");
        windowOverlay.classList.remove("window-overlay-dim");
    });
}

window.addEventListener("load", () => {
    loadSharedMessage();
});
