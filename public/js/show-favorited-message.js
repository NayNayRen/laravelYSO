// loads elements for the favorited message
function loadFavoritedMessage() {
    const windowOverlay = document.querySelector("#window-overlay");
    const favoriteButton = document.querySelector(".favorite-button");
    const removeFavoriteMessage = document.querySelector(
        ".remove-favorite-message"
    );
    const selectedDealFavoriteMessage = document.querySelector(
        ".selected-deal-favorite-message"
    );
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

window.addEventListener("load", () => {
    loadFavoritedMessage();
});
