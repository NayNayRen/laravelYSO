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
    const clearMapButton = document.querySelector(".clear-map-button");
    let markerGroup = [];
    let map;

    // center of U.S. lat and lng
    const usCenter = {
        lat: 39.5,
        lng: -98.35,
    };

    // new york lat and lng
    const newYork = {
        lat: 40.73061,
        lng: -73.935242,
        address: "New York City, New York",
    };

    // pinellas county lat and lng
    const pinellas = {
        lat: 27.889647,
        lng: -82.727766,
        address: "Clearwater, FL",
    };

    // current location marker data
    const currentLocationMarker = {
        lat: pinellas.lat,
        lng: pinellas.lng,
        heading: "You Are Here.",
        address: pinellas.address,
    };

    // BUILDS AND ADDS MAP ON CLICKING MAP ICON
    function loadMap(zoomLevel) {
        const ysoIcon = {
            url: "../img/yso-clipped-rw-shadowed.png",
            // icon Size in terms of pixels, Point relative to icon
            size: new google.maps.Size(40, 40),
            scaledSize: new google.maps.Size(40, 40),
            origin: new google.maps.Point(0, 0),
        };
        // generates map
        map = new google.maps.Map(document.getElementById("map"), {
            center: usCenter,
            zoom: zoomLevel,
            zoomControl: false,
            // mapTypeControl: false,
            mapTypeControlOptions: {
                style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
            },
        });
        // ensures only 1 current marker
        markerGroup = [];
        markerGroup.push(currentLocationMarker);
        markerGroup.map((marker) => {
            // current location markers data
            let markerInfo = new google.maps.InfoWindow({
                maxWidth: 200,
                content: `
                    <span class='map-bubble-heading'>${marker.heading}</span>
                    <div class='map-bubble-address'>
                        <span>${marker.address}</span>
                    </div>
                `,
            });
            // current location markers location
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(marker.lat, marker.lng),
                title: marker.heading,
                optimized: false,
                animation: google.maps.Animation.DROP,
                icon: ysoIcon,
                zIndex: 2,
            });
            // delays the info bubble
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
        });
    }

    // EVENT LISTENERS
    // SHOWS SEARCH RESULTS MARKERS ON CLICK
    hiddenMapLocationButton.addEventListener("click", () => {
        const latitudes = document.querySelectorAll(".location-lat");
        const longitudes = document.querySelectorAll(".location-lng");
        const name = document.querySelectorAll(".location-name");
        const address = document.querySelectorAll(".location-address");
        let markersAmount = (latitudes.length + longitudes.length) / 2;
        let markers = {};
        // console.log(markersAmount);
        // ensures empty group on each display
        markerGroup = [];
        if (markersAmount === 0) {
            mapMessage.style.opacity = "1";
            mapMessage.style.top = "50%";
            mapMessageClose.addEventListener("click", () => {
                mapMessage.style.opacity = "0";
                mapMessage.style.top = "-100%";
            });
        } else {
            // sets data for each marker
            for (let x = 0; x < markersAmount; x++) {
                markers[x] = {
                    lat: latitudes[x].innerText,
                    lng: longitudes[x].innerText,
                    name: name[x].innerText,
                    address: address[x].innerText,
                };
                markerGroup.push(markers[x]);
            }
            // console.log(markerGroup.length);
            markerGroup.map((marker) => {
                // each markers data
                let markerInfo = new google.maps.InfoWindow({
                    maxWidth: 200,
                    content: `
                        <span class='map-bubble-heading'>${marker.name}</span>
                        <div class='map-bubble-address'>
                            <span>${marker.address}</span>
                        </div>
                    `,
                });
                // each markers position
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(marker.lat, marker.lng),
                    title: marker.name,
                    optimized: false,
                    animation: google.maps.Animation.DROP,
                    zIndex: 1,
                });
                marker.setMap(map);
                marker.addListener("click", () => {
                    markerInfo.open({
                        anchor: marker,
                        map: map,
                        shouldFocus: false,
                    });
                });
                // clears all markers from the map
                clearMapButton.addEventListener("click", () => {
                    marker.setMap(null);
                });
            });
        }
    });

    // OPENS MAP FROM MAP ICON
    hiddenMapOpenButton.addEventListener("click", () => {
        windowOverlay.classList.add("window-overlay-dim");
        hiddenMap.style.zIndex = "3";
        hiddenMap.style.opacity = "1";
        hiddenMap.style.paddingTop = "30px";
        if (window.innerWidth > 1300) {
            loadMap(4);
            hiddenMap.style.height = "600px";
        } else if (window.innerWidth < 1300 && window.innerWidth > 1000) {
            loadMap(4);
            hiddenMap.style.height = "500px";
        } else if (window.innerWidth < 1000 && window.innerWidth > 700) {
            loadMap(4);
            hiddenMap.style.height = "400px";
        } else if (window.innerWidth < 700 && window.innerWidth > 400) {
            loadMap(3);
            hiddenMap.style.height = "400px";
            hiddenMapHeader.style.display = "none";
        } else if (window.innerWidth < 400) {
            loadMap(3);
            hiddenMap.style.height = "350px";
            hiddenMapHeader.style.display = "none";
        }
    });

    // CLOSES MAP
    hiddenMapCloseButton.addEventListener("click", () => {
        windowOverlay.classList.remove("window-overlay-dim");
        hiddenMap.style.height = "0";
        hiddenMap.style.paddingTop = "0";
        hiddenMap.style.zIndex = "-1";
        hiddenMap.style.opacity = "0";
        mapMessage.style.opacity = "0";
        mapMessage.style.top = "-100%";
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
