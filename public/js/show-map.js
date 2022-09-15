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
        city: "Clearwater, FL",
        address: "33764",
    };
    const marker2 = {
        lat: 27.960969999438248,
        lng: -82.76100309725183,
        name: "Tropical Smoothie Cafe",
        address: "1840 Gulf to Bay Blvd.",
        city: "Clearwater, FL",
    };
    const marker3 = {
        lat: 27.892476851843572,
        lng: -82.78553762444348,
        name: "Largo Mall",
        address: "10500 Ulmerton Rd",
        city: "Largo, FL",
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
        let marker = new google.maps.Marker({
            position: new google.maps.LatLng(marker1.lat, marker1.lng),
            optimized: false,
            animation: google.maps.Animation.DROP,
        });
        const markerInfo = new google.maps.InfoWindow({
            content: `
                <span class='map-content-heading'>${marker1.name}</span>
                <div class='map-content-address'>
                    <span class='map-content-city'>${marker1.city}</span>
                    <span class='map-content-street'>${marker1.address}</span>
                </div>
            `,
        });
        setTimeout(() => {
            markerInfo.open({
                anchor: marker,
                map: map,
                shouldFocus: false,
            });
        }, 1000);
        marker.setMap(map);
    }

    // creates markers with info
    hiddenMapLocationButton.addEventListener("click", () => {
        markerGroup = [];
        markerGroup.push(marker2, marker3);
        // icon using YSO logo
        const ysoIcon = {
            url: "../img/yso-clipped-rw.png",
            // Size in terms of pixels
            size: new google.maps.Size(35, 35),
            scaledSize: new google.maps.Size(35, 35),
            origin: new google.maps.Point(0, 0),
        };
        markerGroup.map((marker) => {
            let markerInfo = new google.maps.InfoWindow({
                content: `
                    <span class='map-content-heading'>${marker.name}</span>
                    <div class='map-content-address'>
                        <span class='map-content-city'>${marker.city}</span>
                        <span class='map-content-street'>${marker.address}</span>
                    </div>
                `,
            });
            marker = new google.maps.Marker({
                // icon: ysoIcon,
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
        });
    });

    // EVENT LISTENERS
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
