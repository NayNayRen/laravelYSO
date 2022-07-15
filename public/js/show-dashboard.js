const dashboardOpenButton = document.querySelector("#dashboard-open-button");
const dashboardCloseButton = document.querySelector("#dashboard-close-button");
const dashboardUserPreferencesButton = document.querySelector(
    "#dashboard-user-preferences-button"
);
const dashboard = document.querySelector("#dashboard");
const dashboardUserContainer = document.querySelector(
    ".dashboard-user-container"
);

dashboardOpenButton.addEventListener("click", () => {
    dashboard.style.zIndex = 3;
    dashboard.style.opacity = 1;
    windowOverlay.classList.add("window-overlay-dim");
});

dashboardCloseButton.addEventListener("click", () => {
    dashboard.style.zIndex = -1;
    dashboard.style.opacity = 0;
    windowOverlay.classList.remove("window-overlay-dim");
});

dashboardUserPreferencesButton.addEventListener("click", () => {
    dashboardUserContainer.classList.toggle("dashboard-user-container-show");
    dashboardUserPreferencesButton.classList.toggle(
        "dashboard-user-preferences-button-move"
    );
});
