const prev = document.getElementById("prev");
const next = document.getElementById("next");
const bannerSlideContainer = document.querySelector(".banner-slide-container");
let step;

// BANNER NEXT BUTTON
next.addEventListener("click", () => {
    step = 1;
    bannerSlideContainer.style.transform = "translateX(-100%)";
    bannerSlideContainer.style.transition = "transform 500ms ease-in-out";
});

// BANNER PREVIOUS BUTTON
prev.addEventListener("click", () => {
    step = -1;
    bannerSlideContainer.style.transition = "none";
    bannerSlideContainer.prepend(bannerSlideContainer.lastElementChild);
    bannerSlideContainer.style.transform = "translateX(-100%)";
    setTimeout(() => {
        bannerSlideContainer.style.transition = "transform 500ms ease-in-out";
        bannerSlideContainer.style.transform = "translateX(0)";
    });
});

// BANNER CONTAINER AND TRANSITION
bannerSlideContainer.addEventListener("transitionend", () => {
    if (step === 1) {
        bannerSlideContainer.style.transition = "none";
        bannerSlideContainer.append(bannerSlideContainer.firstElementChild);
        bannerSlideContainer.style.transform = "translateX(0)";
        setTimeout(() => {
            bannerSlideContainer.style.transition =
                "transform 500ms ease-in-out";
        });
    }
});
