// containers that have actions
const enhanceNavigationContainer = document.querySelector(
    ".enhance-navigation-container"
);
const enhanceNavigationScrollPoint = document.getElementById(
    "enhance-navigation-scroll-point"
);

const topContainer = document.querySelector("#gains");
const navigationLinks = document.querySelectorAll(".enhance-navigation-link");
const containerHeadings = document.querySelectorAll(
    ".enhance-container-heading"
);

// sticks secondary navigation when scrolling and window resize
function stickContainer() {
    if (document.documentElement.scrollTop > 550 && window.innerWidth > 1300) {
        enhanceNavigationContainer.style.position = "fixed";
        enhanceNavigationContainer.style.width = "85%";
        enhanceNavigationContainer.style.top = "103px";
        enhanceNavigationScrollPoint.style.paddingTop = "65px";
    } else if (
        document.documentElement.scrollTop > 450 &&
        window.innerWidth < 1300 &&
        window.innerWidth > 1000
    ) {
        enhanceNavigationContainer.style.position = "fixed";
        enhanceNavigationContainer.style.width = "90%";
        enhanceNavigationContainer.style.top = "103px";
        enhanceNavigationScrollPoint.style.paddingTop = "65px";
    } else if (
        document.documentElement.scrollTop > 450 &&
        window.innerWidth < 1000 &&
        window.innerWidth > 700
    ) {
        enhanceNavigationContainer.style.position = "fixed";
        enhanceNavigationContainer.style.width = "95%";
        enhanceNavigationContainer.style.top = "103px";
        enhanceNavigationScrollPoint.style.paddingTop = "60px";
    } else if (
        document.documentElement.scrollTop > 455 &&
        window.innerWidth < 700 &&
        window.innerWidth > 500
    ) {
        enhanceNavigationContainer.style.position = "fixed";
        enhanceNavigationContainer.style.width = "100%";
        enhanceNavigationContainer.style.top = "92px";
        enhanceNavigationScrollPoint.style.paddingTop = "60px";
    } else if (
        document.documentElement.scrollTop > 375 &&
        window.innerWidth < 500
    ) {
        enhanceNavigationContainer.style.position = "fixed";
        enhanceNavigationContainer.style.width = "100%";
        enhanceNavigationContainer.style.top = "109px";
        enhanceNavigationScrollPoint.style.paddingTop = "55px";
    } else {
        enhanceNavigationContainer.style.position = "relative";
        enhanceNavigationContainer.style.width = "100%";
        enhanceNavigationContainer.style.top = "0";
        enhanceNavigationScrollPoint.style.paddingTop = "0";
    }
}

// underlines secondary nav based on scroll position, not click
function secondaryNavActions() {
    containerHeadings.forEach((heading) => {
        const windowHeight = window.innerHeight;
        const headingDistanceFromTop = heading.getBoundingClientRect().top;
        if (headingDistanceFromTop < windowHeight * 0.5) {
            navigationLinks.forEach((link) => {
                if (
                    link.getAttribute("value") ===
                    heading.firstElementChild.innerText
                ) {
                    link.classList.add("enhance-navigation-highlight");
                } else {
                    link.classList.remove("enhance-navigation-highlight");
                }
            });
            heading.firstElementChild.classList.add(
                "enhance-container-heading-text"
            );
            heading.firstElementChild.firstElementChild.style.width = "100%";
        } else {
            heading.firstElementChild.classList.remove(
                "enhance-container-heading-text"
            );
            heading.firstElementChild.firstElementChild.style.width = "0";
        }
        if (topContainer.getBoundingClientRect().top > 115) {
            navigationLinks.forEach((link) => {
                link.classList.remove("enhance-navigation-highlight");
            });
        }
    });
}

// sticks navigation to the top of the page
window.addEventListener("resize", () => {
    stickContainer();
    secondaryNavActions();
});
window.addEventListener("scroll", () => {
    stickContainer();
    secondaryNavActions();
});
window.addEventListener("load", () => {
    stickContainer();
    secondaryNavActions();
});
