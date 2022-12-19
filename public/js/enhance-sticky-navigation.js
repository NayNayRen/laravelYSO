// containers that have actions
const enhanceNavigationContainer = document.querySelector(
    ".enhance-navigation-container"
);
const enhanceNavigationScrollPoint = document.getElementById(
    "enhance-navigation-scroll-point"
);
const gains = document.querySelector(".gains");
const values = document.querySelector(".values");
const loyalties = document.querySelector(".loyalties");
const campaigns = document.querySelector(".campaigns");

// sticks secondary navigation when scrolling and window resize
function stickContainer() {
    if (document.documentElement.scrollTop > 555 && window.innerWidth > 1300) {
        enhanceNavigationContainer.style.position = "fixed";
        enhanceNavigationContainer.style.width = "85%";
        enhanceNavigationContainer.style.top = "103px";
        enhanceNavigationContainer.style.boxShadow = "0 1px 0 #000";
        enhanceNavigationScrollPoint.style.paddingTop = "65px";
    } else if (
        document.documentElement.scrollTop > 450 &&
        window.innerWidth < 1300 &&
        window.innerWidth > 1000
    ) {
        enhanceNavigationContainer.style.position = "fixed";
        enhanceNavigationContainer.style.width = "90%";
        enhanceNavigationContainer.style.top = "103px";
        enhanceNavigationContainer.style.boxShadow = "0 1px 0 #000";
        enhanceNavigationScrollPoint.style.paddingTop = "50px";
    } else if (
        document.documentElement.scrollTop > 450 &&
        window.innerWidth < 1000 &&
        window.innerWidth > 700
    ) {
        enhanceNavigationContainer.style.position = "fixed";
        enhanceNavigationContainer.style.width = "95%";
        enhanceNavigationContainer.style.top = "103px";
        enhanceNavigationContainer.style.boxShadow = "0 1px 0 #000";
        enhanceNavigationScrollPoint.style.paddingTop = "50px";
    } else if (
        document.documentElement.scrollTop > 455 &&
        window.innerWidth < 700 &&
        window.innerWidth > 500
    ) {
        enhanceNavigationContainer.style.position = "fixed";
        enhanceNavigationContainer.style.width = "100%";
        enhanceNavigationContainer.style.top = "92px";
        enhanceNavigationContainer.style.boxShadow = "0 1px 0 #000";
        enhanceNavigationScrollPoint.style.paddingTop = "45px";
    } else if (
        document.documentElement.scrollTop > 375 &&
        window.innerWidth < 500
    ) {
        enhanceNavigationContainer.style.position = "fixed";
        enhanceNavigationContainer.style.width = "100%";
        enhanceNavigationContainer.style.top = "109px";
        enhanceNavigationContainer.style.boxShadow = "0 1px 0 #000";
        enhanceNavigationScrollPoint.style.paddingTop = "42px";
    } else {
        enhanceNavigationContainer.style.position = "relative";
        enhanceNavigationContainer.style.width = "100%";
        enhanceNavigationContainer.style.top = "0";
        enhanceNavigationContainer.style.boxShadow = "none";
        enhanceNavigationScrollPoint.style.paddingTop = "0";
    }
}

// sticks navigation to the top of the page
window.addEventListener("resize", () => {
    stickContainer();
});
window.addEventListener("scroll", () => {
    stickContainer();
});
window.addEventListener("load", () => {
    stickContainer();
    upArrow.addEventListener("click", () => {
        gains.style.borderBottom = "none";
        values.style.borderBottom = "none";
        loyalties.style.borderBottom = "none";
        campaigns.style.borderBottom = "none";
    });
    gains.addEventListener("click", () => {
        gains.style.borderBottom = "solid 1px #e6331f";
        values.style.borderBottom = "none";
        loyalties.style.borderBottom = "none";
        campaigns.style.borderBottom = "none";
    });
    values.addEventListener("click", () => {
        gains.style.borderBottom = "none";
        values.style.borderBottom = "solid 1px #e6331f";
        loyalties.style.borderBottom = "none";
        campaigns.style.borderBottom = "none";
    });
    loyalties.addEventListener("click", () => {
        gains.style.borderBottom = "none";
        values.style.borderBottom = "none";
        loyalties.style.borderBottom = "solid 1px #e6331f";
        campaigns.style.borderBottom = "none";
    });
    campaigns.addEventListener("click", () => {
        gains.style.borderBottom = "none";
        values.style.borderBottom = "none";
        loyalties.style.borderBottom = "none";
        campaigns.style.borderBottom = "solid 1px #e6331f";
    });
});
