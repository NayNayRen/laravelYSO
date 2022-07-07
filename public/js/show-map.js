const mapOpenButton = document.querySelector("#map-open-button");
const mapCloseButton = document.querySelector(".map-close-button");
const map = document.querySelector(".map");

mapOpenButton.addEventListener("click", () => {
    map.style.zIndex = 2;
    map.style.opacity = 1;
    windowOverlay.classList.add("window-overlay-dim");
});

mapCloseButton.addEventListener("click", () => {
    map.style.zIndex = -1;
    map.style.opacity = 0;
    windowOverlay.classList.remove("window-overlay-dim");
});
