function loadScript() {
    const shareButton = document.querySelector("#share-button");
    const favoriteButton = document.querySelector("#favorite-button");
    const removeShareMessage = document.querySelector("#remove-share-message");
    const removeFavoriteMessage = document.querySelector(
        "#remove-favorite-message"
    );
    const windowOverlay = document.querySelector("#window-overlay");
    const selectedDealShareMessage = document.querySelector(
        ".selected-deal-share-message"
    );
    const selectedDealFavoriteMessage = document.querySelector(
        ".selected-deal-favorite-message"
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
        selectedDealFavoriteMessage.classList.add("show-selected-deal-message");
        windowOverlay.classList.add("window-overlay-dim");
    });

    removeFavoriteMessage.addEventListener("click", () => {
        selectedDealFavoriteMessage.classList.remove(
            "show-selected-deal-message"
        );
        windowOverlay.classList.remove("window-overlay-dim");
    });
}

window.onload = loadScript;
