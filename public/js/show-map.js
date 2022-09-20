// SHOWS HIDDEN MAP
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
    const mapMessage = document.querySelector(".map-message");
    const mapMessageClose = document.querySelector(".map-message-close");
    let markerGroup = [];
    let map;

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

    // marker data
    const marker1 = {
        lat: myLocation.lat,
        lng: myLocation.lng,
        name: "You Are Here.",
        address: "Clearwater, FL 33764",
    };
    const marker2 = {
        lat: 27.960969999438248,
        lng: -82.76100309725183,
        name: "Tropical Smoothie Cafe",
        address: "1840 Gulf to Bay Blvd. Clearwater, FL",
    };
    const marker3 = {
        lat: 27.892476851843572,
        lng: -82.78553762444348,
        name: "Largo Mall",
        address: "10500 Ulmerton Rd Largo, FL",
    };

    // // BUILDS AND ADDS MAP ON CLICKING MAP ICON
    function loadMap() {
        // generates map
        map = new google.maps.Map(document.getElementById("map"), {
            center: usCenter,
            // mapId: "d9a66ad64499fde1",
            zoom: 4,
            zoomControl: false,
            mapTypeControlOptions: {
                style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
            },
        });
        markerGroup = [];
        markerGroup.push(marker1);
        markerGroup.map((marker) => {
            buildMarker(marker);
        });
    }

    // makes each marker, adds event to open info when clicked
    function buildMarker(marker) {
        let markerInfo = new google.maps.InfoWindow({
            content: `
                <span class='map-bubble-heading'>${marker.name}</span>
                <div class='map-bubble-address'>
                    <span>${marker.address}</span>
                </div>
            `,
        });
        marker = new google.maps.Marker({
            position: new google.maps.LatLng(marker.lat, marker.lng),
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
        marker.setMap(map);
        marker.addListener("click", () => {
            markerInfo.open({
                anchor: marker,
                map: map,
                shouldFocus: false,
            });
        });
    }

    // EVENT LISTENERS
    // shows search results markers
    hiddenMapLocationButton.addEventListener("click", () => {
        const latitudes = document.querySelectorAll(".location-lat");
        // latitudes.forEach((latitude) => {
        //     console.log(latitude.innerText);
        // });
        const longitudes = document.querySelectorAll(".location-lng");
        // longitudes.forEach((longitude) => {
        //     console.log(longitude.innerText);
        // });
        const name = document.querySelectorAll(".location-name");
        const address = document.querySelectorAll(".location-address");
        let markersAmount = (latitudes.length + longitudes.length) / 2;
        // console.log(markersAmount);
        markerGroup = [];
        let markers = {};
        for (let x = 0; x < markersAmount; x++) {
            markers[x] = {
                lat: latitudes[x].innerText,
                lng: longitudes[x].innerText,
                name: name[x].innerText,
                address: address[x].innerText,
            };
            markerGroup.push(markers[x]);
            buildMarker(markers[x]);
        }
        if (markersAmount === 0) {
            mapMessage.style.top = "50%";
            mapMessageClose.addEventListener("click", () => {
                mapMessage.style.top = "-100%";
            });
        }
        // console.log(markers);
    });

    // opens map from map icon next to search entry
    hiddenMapOpenButton.addEventListener("click", () => {
        windowOverlay.classList.add("window-overlay-dim");
        hiddenMap.style.zIndex = "3";
        hiddenMap.style.opacity = "1";
        hiddenMap.style.paddingTop = "30px";
        loadMap();
        if (window.innerWidth > 1300) {
            hiddenMap.style.height = "600px";
        } else if (window.innerWidth < 1300 && window.innerWidth > 1000) {
            hiddenMap.style.height = "500px";
        } else if (window.innerWidth < 1000 && window.innerWidth > 700) {
            hiddenMap.style.height = "400px";
        } else if (window.innerWidth < 700 && window.innerWidth > 400) {
            hiddenMap.style.height = "300px";
            hiddenMapHeader.style.display = "none";
        } else if (window.innerWidth < 400) {
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

// ADDS USERS CURRENT LOCATION
// let infoWindow;

// function initMap() {
//     map = new google.maps.Map(document.getElementById("map"), {
//         center: usCenter,
//         zoom: 5,
//     });
//     const locationButton = document.querySelector(
//         ".hidden-map-location-button"
//     );
//     infoWindow = new google.maps.InfoWindow();
//     locationButton.textContent = "Show";
//     locationButton.addEventListener("click", () => {
//         // Try HTML5 geolocation.
//         if (navigator.geolocation) {
//             navigator.geolocation.getCurrentPosition(
//                 (position) => {
//                     const pos = {
//                         lat: position.coords.latitude,
//                         lng: position.coords.longitude,
//                     };

//                     infoWindow.setPosition(pos);
//                     infoWindow.setContent("You are here.");
//                     infoWindow.open(map);
//                     map.setCenter(pos);
//                 },
//                 () => {
//                     handleLocationError(true, infoWindow, map.getCenter());
//                 }
//             );
//         } else {
//             // Browser doesn't support Geolocation
//             handleLocationError(false, infoWindow, map.getCenter());
//         }
//     });
// }

// function handleLocationError(browserHasGeolocation, infoWindow, pos) {
//     infoWindow.setPosition(pos);
//     infoWindow.setContent(
//         browserHasGeolocation
//             ? "Error: The Geolocation service failed."
//             : "Error: Your browser doesn't support geolocation."
//     );
//     infoWindow.open(map);
// }

// window.initMap = initMap;
