// SHOWS HIDDEN MAP
// const mapOpenButton = document.querySelector("#map-open-button");
// const mapCloseButton = document.querySelector(".map-close-button");
// const map = document.querySelector(".map");

// mapOpenButton.addEventListener("click", () => {
//     map.style.zIndex = 3;
//     map.style.opacity = 1;
//     windowOverlay.classList.add("window-overlay-dim");
// });

// mapCloseButton.addEventListener("click", () => {
//     map.style.zIndex = -1;
//     map.style.opacity = 0;
//     windowOverlay.classList.remove("window-overlay-dim");
// });
// Home v3.0
// This file generates a google map using lat and lng coordinates
// Markers can be added via the pins object
// Info bubbles are styled and display when markers are clicked
function loadScript() {
    const hiddenMap = document.querySelector(".hidden-map");
    const hiddenMapOpenButton = document.getElementById("map-open-button");
    const hiddenMapCloseButton = document.querySelector(
        ".hidden-map-close-button"
    );
    const hiddenMapLocationButton = document.querySelector(
        ".hidden-map-location-button"
    );
    const hiddenMapHeader = document.querySelector(".hidden-map-header");
    const hiddenMapLocationContainer = document.querySelector(
        ".hidden-map-location-button-container"
    );
    const hiddenMapCloseContainer = document.querySelector(
        ".hidden-map-close-button-container"
    );
    const markerGroup = [];

    // center of U.S.
    const usCenter = {
        lat: 39.5,
        lng: -98.35,
    };

    // pinellas county lat and lng
    const myLocation = {
        lat: 27.889647,
        lng: -82.727766,
    };
    // marker data for pins
    const pins = [
        {
            lat: myLocation.lat,
            lng: myLocation.lng,
            name: "You Are Here",
            city: "Clearwater, FL",
            address: "33764",
        },
    ];
    // const pins = [
    //     {
    //         lat: myLocation.lat,
    //         lng: myLocation.lng,
    //         name: "You Are Here.",
    //         city: "Clearwater, FL",
    //         address: "33764",
    //     },
    //     {
    //         lat: 27.960969999438248,
    //         lng: -82.76100309725183,
    //         name: "Tropical Smoothie Cafe",
    //         address: "1840 Gulf to Bay Blvd.",
    //         city: "Clearwater, FL",
    //     },
    //     {
    //         lat: 27.892476851843572,
    //         lng: -82.78553762444348,
    //         name: "Largo Mall",
    //         address: "10500 Ulmerton Rd",
    //         city: "Largo, FL",
    //     },
    // ];

    // BUILDS AND ADDS MAP ON CLICKING MAP ICON
    function loadMap(zoomLevel) {
        // map centers on pinellas county
        const ysoIcon = {
            url: "../img/yso-clipped-rw.png",
            //state your size parameters in terms of pixels
            size: new google.maps.Size(35, 35),
            scaledSize: new google.maps.Size(35, 35),
            origin: new google.maps.Point(0, 0),
        };

        const map = new google.maps.Map(document.getElementById("map"), {
            center: usCenter,
            // mapId: "d9a66ad64499fde1",
            zoom: zoomLevel,
            zoomControl: false,
            mapTypeControlOptions: {
                style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
            },
        });
        // creates markers with pin info passed for pins info bubble when clicked
        hiddenMapLocationButton.addEventListener("click", () => {
            for (i = 0; i < pins.length; i++) {
                const markerInfo = new google.maps.InfoWindow({
                    content: `<span class='map-content-heading'>${pins[i].name}</span>
        <div class='map-content-address'>
          <span class='map-content-city'>${pins[i].city}</span>
          <span class='map-content-street'>${pins[i].address}</span>
        </div>`,
                });
                // for marker title and location
                const marker = new google.maps.Marker({
                    map: map,
                    // icon: ysoIcon,
                    position: new google.maps.LatLng(pins[i].lat, pins[i].lng),
                    optimized: false,
                    animation: google.maps.Animation.DROP,
                });
                setTimeout(() => {
                    markerInfo.open({
                        anchor: marker,
                        map: map,
                        shouldFocus: false,
                    });
                }, 1000);
            }
        });
    }

    // EVENT LISTENERS
    // opens map from map icon next to search entry
    hiddenMapOpenButton.addEventListener("click", () => {
        windowOverlay.classList.add("window-overlay-dim");
        hiddenMap.style.zIndex = "3";
        hiddenMap.style.opacity = "1";
        hiddenMap.style.paddingTop = "30px";
        loadMap(5);
        if (window.innerWidth > 1300) {
            hiddenMap.style.height = "600px";
        } else if (window.innerWidth < 1300 && window.innerWidth > 1000) {
            // loadMap(11);
            hiddenMap.style.height = "500px";
        } else if (window.innerWidth < 1000 && window.innerWidth > 700) {
            // loadMap(10);
            hiddenMap.style.height = "400px";
        } else if (window.innerWidth < 700 && window.innerWidth > 400) {
            // loadMap(9);
            hiddenMap.style.height = "300px";
            hiddenMapHeader.style.display = "none";
        } else if (window.innerWidth < 400) {
            // loadMap(9);
            hiddenMap.style.height = "300px";
            hiddenMapHeader.style.display = "none";
        }
    });

    // closes map, top right of container
    hiddenMapCloseButton.addEventListener("click", () => {
        windowOverlay.classList.remove("window-overlay-dim");
        hiddenMap.style.height = "0";
        hiddenMap.style.paddingTop = "0";
        hiddenMap.style.zIndex = "-1";
        hiddenMap.style.opacity = "0";
    });
}

window.onload = loadScript();
