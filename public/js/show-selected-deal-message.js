function loadScript() {
    const shareButton = document.querySelector("#share-button");
    const favoriteButton = document.querySelector("#favorite-button");
    const removeShareMessage = document.querySelector("#remove-share-message");
    const windowOverlay = document.querySelector("#window-overlay");
    const selectedDealShareMessage = document.querySelector(
        ".selected-deal-share-message"
    );

    shareButton.addEventListener("click", () => {
        selectedDealShareMessage.classList.add("show-selected-deal-message");
        windowOverlay.classList.add("window-overlay-dim");
    });

    removeShareMessage.addEventListener("click", () => {
        selectedDealShareMessage.classList.remove("show-selected-deal-message");
        windowOverlay.classList.remove("window-overlay-dim");
    });

    favoriteButton.addEventListener("click", () => {
        console.log("favorite button");
    });
}

window.onload = loadScript;
