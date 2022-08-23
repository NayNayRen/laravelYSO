// containers that have actions
const header = document.querySelector(".header");
const scrollPoint = document.getElementById("scroll-point");
const burgerMenu = document.querySelector(".burger-menu");
const upArrow = document.getElementById("up-arrow");
const upArrowMessage = document.getElementById("up-arrow-message");
const windowOverlay = document.querySelector("#window-overlay");
// sticky settings for makeItStick
function makeItStickSettings() {
    header.style.position = "fixed";
    header.style.width = "100%";
    header.style.top = "0";
    header.style.zIndex = "10";
}

// function to add sticky settings on the header/navigation when scrolled 0px from the top of page
function makeItStick() {
    if (document.documentElement.scrollTop > 0 && window.innerWidth > 700) {
        makeItStickSettings();
        scrollPoint.style.paddingTop = "102px";
        upArrow.style.left = "5px";
    } else if (
        document.documentElement.scrollTop > 0 &&
        window.innerWidth < 700
    ) {
        makeItStickSettings();
        scrollPoint.style.paddingTop = "95px";
        upArrow.style.left = "5px";
    } else {
        header.style.position = "relative";
        scrollPoint.style.paddingTop = "0px";
        upArrow.style.left = "-40px";
    }
}

// event listeners
// sticks navigation to the top of the page
window.addEventListener("load", () => {
    makeItStick();
});
window.addEventListener("scroll", () => {
    makeItStick();
});

// toggles the links menu left and right when clicked
burgerMenu.addEventListener("click", () => {
    document
        .querySelector(".links-user-container")
        .classList.toggle("move-links-on");
    document
        .querySelector("#burger-bars-1")
        .classList.toggle("burger-bars-rotate-clockwise");
    document
        .querySelector("#burger-bars-2")
        .classList.toggle("burger-bars-remove");
    document
        .querySelector("#burger-bars-3")
        .classList.toggle("burger-bars-rotate-counter-clockwise");
});

// added hover effect to up arrow
upArrow.addEventListener("mouseover", () => {
    upArrowMessage.style.opacity = "1";
    upArrowMessage.style.left = "0";
});
upArrow.addEventListener("mouseout", () => {
    upArrowMessage.style.opacity = "0";
    upArrowMessage.style.left = "-80px";
});
$(document).ready(function () {
    // $('.views-likes-icons .fa-star').click(function(){
    //     $(this).toggleClass('favourite');
    // });
    var owl = $(".card-display");
    owl.owlCarousel({
        loop: true,
        nav: true,
        items: 3,
        autoplay: false,
        autoplayTimeout: 3000,
        smartSpeed: 500, // length of time to scroll in ms
        autoplayHoverPause: true,
        dots: false,
        touchDrag: true,
        navText: [
            "<div class='container-arrow-left' aria-label='Previous Arrow'><i class='fa fa-arrow-left' aria-hidden='false'></i></div>",
            "<div class='container-arrow-right' aria-label='Next Arrow'><i class='fa fa-arrow-right' aria-hidden='false'></i></div>",
        ],
        responsive: {
            0: {
                items: 1,
                dots: false,
            },
            540: {
                items: 2,
            },
            1300: {
                items: 3,
            },
        },
    });
    // added to stop mobile horizontal auto scroll {
    // disable scroll
    owl.on("drag.owl.carousel", function (event) {
        document.ontouchmove = function (e) {
            e.preventDefault();
        };
    });

    // enable scroll
    owl.on("dragged.owl.carousel", function (event) {
        document.ontouchmove = function (e) {
            return true;
        };
    });
    //  }
    $(".c-list__link").click(function () {
        $(".c-list__link").removeClass("active");
        $(this).addClass("active");
        var activeCard = $(this).attr("link");
        $(activeCard).addClass("active");
        $(activeCard).nextAll().removeClass("active");
        $(activeCard).prevAll().removeClass("active");
    });
});
