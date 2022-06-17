const dashboardOpenButton = document.querySelector("#dashboard-open-button");
const dashboardCloseButton = document.querySelector("#dashboard-close-button");
const dashboard = document.querySelector("#dashboard");
const windowOverlay = document.querySelector("#window-overlay");

dashboardOpenButton.addEventListener("click", () => {
    dashboard.style.zIndex = 2;
    dashboard.style.opacity = 1;
    windowOverlay.classList.add("window-overlay-dim");
});

dashboardCloseButton.addEventListener("click", () => {
    dashboard.style.zIndex = -1;
    dashboard.style.opacity = 0;
    windowOverlay.classList.remove("window-overlay-dim");
});
