// FADING AD CONTAINERS
const ad = document.getElementById("ad");
const adLink = document.getElementById("ad-link");

// ARRAY OF ADS FOR SCROLLING ADVERTISEMENT
const bannerAds = [
    {
        url: "N/A",
        img: "img/food/bk-logo2.jpg",
        name: "Burger King",
        discount: "Free medium fry with purchase of a sandwich.",
        views: 1000,
    },
    {
        url: "N/A",
        img: "img/food/mcdonalds-logo2.png",
        name: "McDonalds",
        discount: "$2 off any combo meal.",
        views: 1400,
    },
    {
        url: "N/A",
        img: "img/auto/sw-logo.png",
        name: "Sherwin Williams",
        discount: "$10 off any order over $50",
        views: 1534,
    },
    {
        url: "N/A",
        img: "img/health/walgreens-logo.png",
        name: "Walgreens",
        discount: "Weekly Deals And Clearance Sales",
        views: 1678,
    },
    {
        url: "N/A",
        img: "img/food/subway-banner-logo.png",
        name: "Subway",
        discount: "Free footlong with purchase",
        views: 1687,
    },
    {
        url: "N/A",
        img: "img/fashion/joann-fabrics-logo.png",
        name: "Joann Fabrics",
        discount: "Looking For Our Coupon Specials",
        views: 1774,
    },
    {
        url: "N/A",
        img: "img/fashion/bed-bath-logo.png",
        name: "Bed Bath and Beyond",
        discount: "Every Day Specials",
        views: 1222,
    },
];

// NEW ARRAY TO HOLD IMAGES FOR AD
const adImages = [];
const result = bannerAds.map((ad) => {
    adImages.push(ad);
});

// POPULATES THE AD, SHOWS FOR 5 SECONDS, FADES OUT AFTER 3 SECONDS, REPEATS
function showAds() {
    const randomImages = adImages[Math.floor(Math.random() * adImages.length)];
    adLink.href = randomImages.url;
    document.slide.src = randomImages.img;
    document.slide.alt = randomImages.name;
    setTimeout(function () {
        setTimeout(function () {
            ad.style.opacity = "1";
            showAds();
        }, 2500); // not showing for 2.5 seconds
        ad.style.opacity = "0";
    }, 8000); // showing for 8 seconds
}

// SHOWS AD WITH PAGE LOAD
window.addEventListener("load", showAds);
