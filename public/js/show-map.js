// SHOWS HIDDEN MAP
function loadScript() {
    const hiddenMap = document.querySelector(".hidden-map");
    const hiddenMapOpenButton = document.getElementById("map-open-button");
    const hiddenMapHeader = document.querySelector(".hidden-map-header");
    const mapMessage = document.querySelector(".map-message");
    const mapMessageClose = document.querySelector(".map-message-close");
    const clearMapButton = document.querySelector(".clear-map-button");
    const submitMethod = document.querySelector(".submit-method");
    const currentPage = document.querySelector(".current-page");
    const windowOverlay = document.querySelector("#window-overlay");
    const hiddenMapCloseButton = document.querySelector(
        ".hidden-map-close-button"
    );
    const hiddenMapLocationButton = document.querySelector(
        ".hidden-map-location-button"
    );
    const mapSearchDistanceContainer = document.querySelector(
        ".map-search-distance-container"
    );
    const mapDistanceGoButton = document.querySelector(
        ".map-distance-go-button"
    );
    const mapSearchDistanceButton = document.querySelector(
        ".map-search-distance-button"
    );
    const mapSearchDistanceArrow = document.querySelector(
        ".map-search-distance-arrow"
    );
    const mapSearchDistanceDropdown = document.querySelector(
        ".map-search-distance-dropdown"
    );
    const mapSearchDistanceSelection = document.querySelectorAll(
        ".map-search-distance-selection"
    );
    const mapLocationsList = document.querySelectorAll(
        ".map-location-list-item"
    );
    const mapLocationListButton = document.querySelector(
        ".map-location-list-button"
    );
    const mapLocationListContainer = document.querySelector(
        ".map-location-list-container"
    );
    let markerGroup = [];
    let infoWindow;
    let circle;
    let map;

    // center of U.S. lat and lng
    const usCenter = {
        lat: 39.5,
        lng: -98.35,
    };

    // SHOWS LOCATION ERROR OR DENIAL
    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        let currentLocation = 0;
        infoWindow.setPosition(pos);
        infoWindow.setContent(
            browserHasGeolocation
                ? `<span class='map-bubble-heading'>Uh oh...</span>
                    <div class='map-bubble-address'>
                        <span>Looks like you said no to pinning your location. Radial search is not available unless otherwise.</span>
                    </div>`
                : `<span class='map-bubble-heading'>Error :</span>
                    <div class='map-bubble-address'>
                        <span>Your browser doesn't support geolocation.</span>
                    </div>`
        );
        infoWindow.open(map);
        setTimeout(() => {
            buildMarkers(currentLocation);
        }, 1000);
        // SHOWS SEARCH RESULTS MARKERS ON CLICK
        hiddenMapLocationButton.addEventListener("click", () => {
            buildMarkers(currentLocation);
        });
    }

    // FORMATS LOCATION PHONE NUMBER, formatted to (123) 456-7890
    function formatPhoneNumber(phoneNumberString) {
        // strips non digit characters
        const cleaned = ("" + phoneNumberString).replace(/\D/g, "");
        // returns 3 substrings
        const match = cleaned.match(/^(\d{3})(\d{3})(\d{4})$/);
        if (match) {
            // formats
            return "(" + match[1] + ") " + match[2] + "-" + match[3];
        }
        return "No Number Provided";
    }

    // FORMAT MARKER TITLE TO CAPITALIZED WORDS
    function toTitleCase(str) {
        return str.replace(/\w\S*/g, function (txt) {
            return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
        });
    }

    // CONVERTS MILES PASSED TO METERS
    function milesToMeters(miles) {
        const circleRadiusInMeters = Math.floor(miles * 1609.34);
        // console.log(circleRadiusInMeters);
        return circleRadiusInMeters;
    }

    // CONVERTS METERS TO MILES
    function metersToMiles(meters) {
        const distanceInMiles = Math.round((meters / 1609.344) * 10) / 10;
        // console.log(distanceInMiles);
        return distanceInMiles;
    }

    // BUILDS MAP AND ADDS CURRENT LOCATION
    function loadMap(zoomLevel) {
        // ensures an empty marker group
        markerGroup = [];
        // generates map
        map = new google.maps.Map(document.getElementById("map"), {
            center: usCenter,
            zoom: zoomLevel,
            zoomControl: true,
            streetViewControl: false,
            mapTypeControl: false,
            // mapTypeControlOptions: {
            //     style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
            // },
        });
        // marker info bubble
        infoWindow = new google.maps.InfoWindow({
            maxWidth: 250,
            content: "",
        });
        currentPosition();
    }

    // GET USERS CURRENT POSITION
    function currentPosition() {
        // icon Size in terms of pixels, Point centers on location position
        const ysoIcon = {
            url: "../img/yso-clipped-rw-shadowed.png",
            size: new google.maps.Size(40, 40),
            scaledSize: new google.maps.Size(40, 40),
            origin: new google.maps.Point(0, 0),
        };
        // if location is allowed
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const currentLocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude,
                        // New York City
                        // lat: 40.73061,
                        // lng: -73.935242,
                        heading: "You Are Here.",
                    };
                    // console.log(position);
                    infoWindow.setContent(`
                    <span class='map-bubble-heading'>
                    ${currentLocation.heading}
                    </span>
                    `);
                    // current location marker
                    // IF BREAKAGE CHANGE THIS BACK TO marker
                    let currentLocationMarker = new google.maps.Marker({
                        position: new google.maps.LatLng(
                            currentLocation.lat,
                            currentLocation.lng
                        ),
                        title: "You Are Here.",
                        optimized: false,
                        animation: google.maps.Animation.DROP,
                        icon: ysoIcon,
                        zIndex: 1,
                    });
                    // current location circle
                    circle = new google.maps.Circle({
                        strokeColor: "#FF0000",
                        strokeOpacity: 0.8,
                        strokeWeight: 1,
                        fillColor: "#FF0000",
                        fillOpacity: 0.15,
                        map,
                        center: currentLocation,
                        // default radius is in meters, pass miles to convert
                        radius: milesToMeters(15),
                    });
                    map.setCenter(currentLocation);
                    map.setZoom(10);
                    currentLocationMarker.setMap(map);
                    circle.setMap(map);
                    currentLocationMarker.addListener("click", () => {
                        infoWindow.open({
                            anchor: currentLocationMarker,
                            map: map,
                            shouldFocus: false,
                        });
                    });
                    // adjusts zoom level for mobile
                    if (window.innerWidth <= 400) {
                        map.setZoom(9);
                    } else {
                        map.setZoom(10);
                    }
                    // button to perfom current location adjustments
                    mapDistanceGoButton.addEventListener("click", () => {
                        if (mapSearchDistanceButton.innerText === "25 miles") {
                            map.setZoom(9);
                            map.setCenter(currentLocation);
                            circle.setRadius(milesToMeters(25));
                        }
                        if (mapSearchDistanceButton.innerText === "50 miles") {
                            map.setZoom(8);
                            map.setCenter(currentLocation);
                            circle.setRadius(milesToMeters(50));
                        }
                        if (mapSearchDistanceButton.innerText === "75 miles") {
                            map.setZoom(7);
                            map.setCenter(currentLocation);
                            circle.setRadius(milesToMeters(75));
                        }
                        if (mapSearchDistanceButton.innerText === "100 miles") {
                            map.setZoom(6);
                            map.setCenter(currentLocation);
                            circle.setRadius(milesToMeters(100));
                        }
                        if (mapSearchDistanceButton.innerText === "No Limit") {
                            if (window.innerWidth <= 400) {
                                map.setZoom(3);
                            } else {
                                map.setZoom(4);
                            }
                            map.setCenter(usCenter);
                            circle.setRadius(0);
                        }
                        if (mapSearchDistanceButton.innerText === "My Locale") {
                            if (window.innerWidth <= 400) {
                                map.setZoom(9);
                            } else {
                                map.setZoom(10);
                            }
                            map.setCenter(currentLocation);
                            circle.setRadius(milesToMeters(15));
                        }
                    });
                    setTimeout(() => {
                        buildMarkers(currentLocation);
                    }, 1000);
                    // shows current pins after being cleared
                    hiddenMapLocationButton.addEventListener("click", () => {
                        buildMarkers(currentLocation);
                    });
                },
                () => {
                    handleLocationError(true, infoWindow, map.getCenter());
                }
            );
        } else {
            // browser doesn't support geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }
    }

    // BUILDS EACH MARKER
    function buildMarkers(currentLocation) {
        const ids = document.querySelectorAll(".location-id");
        const latitudes = document.querySelectorAll(".location-lat");
        const longitudes = document.querySelectorAll(".location-lng");
        const name = document.querySelectorAll(".location-name");
        const address = document.querySelectorAll(".location-address");
        const phone = document.querySelectorAll(".location-phone");
        const email = document.querySelectorAll(".location-email");
        let markersAmount = (latitudes.length + longitudes.length) / 2;
        let markers = {};
        let content = "";
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
                    id: ids[x].innerText,
                    lat: latitudes[x].innerText,
                    lng: longitudes[x].innerText,
                    name: name[x].innerText,
                    address: address[x].innerText,
                    phone: formatPhoneNumber(phone[x].innerText),
                    email: email[x].innerText,
                };
                markerGroup.push(markers[x]);
            }
            // console.log(markerGroup);
            markerGroup.map((marker) => {
                // if no email, link is replaced with plain text
                if (marker.email === "") {
                    content = `
                        <span class='map-bubble-heading'>${marker.name}</span>
                        <div class='map-bubble-details'>
                            <span class='map-bubble-address'>
                            <i class="fa fa-map-marker" aria-hidden="true"></i> 
                            ${marker.address}</span>
                            <span class='map-bubble-email inactive'>
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            No Email Provided</span>
                            <span class='map-bubble-phone'>
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            ${marker.phone}</span>
                            <form action='/locations/${marker.id}' method='GET' class='map-bubble-deals'>
                                <button type='submit'>- View Deals -</button>
                            </form>
                        </div>
                    `;
                    // if there is an email, a link is provided
                } else {
                    content = `
                        <span class='map-bubble-heading'>${marker.name}</span>
                        <div class='map-bubble-details'>
                            <span class='map-bubble-address'>
                            <i class="fa fa-map-marker" aria-hidden="true"></i> 
                            ${marker.address}</span>
                            <a href='mailto: ${marker.email}' class='map-bubble-email'>
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            ${marker.email}</a>
                            <span class='map-bubble-phone'>
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            ${marker.phone}</span>
                            <form action='/locations/${marker.id}' method='GET' class='map-bubble-deals'>
                                <button type='submit'>- View Deals -</button>
                            </form>
                        </div>
                    `;
                }
                // each markers data bubble
                let markerInfo = new google.maps.InfoWindow({
                    maxWidth: 275,
                    content: content,
                });
                // each markers position
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(marker.lat, marker.lng),
                    // title: marker.name
                    //     .toLowerCase()
                    //     .split(" ")
                    //     .map(
                    //         (name) =>
                    //             name.charAt(0).toUpperCase() + name.substring(1)
                    //     )
                    //     .join(" "),
                    distance: "",
                    address: marker.address,
                    title: toTitleCase(marker.name),
                    optimized: false,
                    animation: google.maps.Animation.DROP,
                    zIndex: 2,
                });
                marker.setMap(map);
                marker.addListener("click", () => {
                    markerInfo.open({
                        anchor: marker,
                        map: map,
                        shouldFocus: false,
                    });
                });
                // focuses on single location page's marker
                if (currentPage.innerText === "single location") {
                    map.setCenter(marker.position);
                    setTimeout(() => {
                        map.setZoom(8);
                        markerInfo.open({
                            anchor: marker,
                            map: map,
                            shouldFocus: false,
                        });
                    }, 1000);
                }
                // if location is allowed
                if (currentLocation != 0) {
                    const distanceFromLocation =
                        google.maps.geometry.spherical.computeDistanceBetween(
                            new google.maps.LatLng(marker.position),
                            new google.maps.LatLng(
                                parseFloat(currentLocation.lat),
                                parseFloat(currentLocation.lng)
                            )
                        );
                    mapDistanceGoButton.addEventListener("click", () => {
                        if (mapSearchDistanceButton.innerText === "25 miles") {
                            if (distanceFromLocation < milesToMeters(25)) {
                                marker.setMap(map);
                            } else {
                                marker.setMap(null);
                            }
                        }
                        if (mapSearchDistanceButton.innerText === "50 miles") {
                            if (distanceFromLocation < milesToMeters(50)) {
                                marker.setMap(map);
                            } else {
                                marker.setMap(null);
                            }
                        }
                        if (mapSearchDistanceButton.innerText === "75 miles") {
                            if (distanceFromLocation < milesToMeters(75)) {
                                marker.setMap(map);
                            } else {
                                marker.setMap(null);
                            }
                        }
                        if (mapSearchDistanceButton.innerText === "100 miles") {
                            if (distanceFromLocation < milesToMeters(100)) {
                                marker.setMap(map);
                            } else {
                                marker.setMap(null);
                            }
                        }
                        if (mapSearchDistanceButton.innerText === "No Limit") {
                            markerInfo.close();
                            marker.setMap(map);
                        }
                        if (mapSearchDistanceButton.innerText === "My Locale") {
                            markerInfo.close();
                            marker.setMap(map);
                        }
                    });
                    // sets distance for each location in the list
                    mapLocationsList.forEach((location) => {
                        marker.distance = metersToMiles(distanceFromLocation);
                        if (
                            location.lastElementChild.firstChild.data ===
                            marker.address
                        ) {
                            location.firstElementChild.firstElementChild.innerText = `${marker.distance} mi`;
                        }
                    });
                    // if location is not allowed, no distance display or zoom
                } else {
                    mapLocationsList.forEach((location) => {
                        location.firstElementChild.firstElementChild.innerText =
                            "n/a";
                    });
                    mapSearchDistanceSelection.forEach((selection) => {
                        selection.addEventListener("click", (e) => {
                            mapSearchDistanceButton.innerText =
                                e.target.innerText;
                            mapSearchDistanceContainer.classList.remove(
                                "map-search-distance-container-toggle"
                            );
                            mapSearchDistanceArrow.classList.remove(
                                "map-search-distance-arrow-rotate"
                            );
                            mapSearchDistanceDropdown.classList.remove(
                                "map-search-distance-dropdown-toggle"
                            );
                            mapSearchDistanceArrow.style.display = "none";
                            mapDistanceGoButton.style.display = "inline";
                        });
                    });
                }
                // goes to each location in the list when clicked
                mapLocationsList.forEach((location) => {
                    location.addEventListener("click", () => {
                        // console.log(location.lastElementChild.firstChild.data);
                        markerInfo.close();
                        if (
                            location.lastElementChild.firstChild.data ===
                            marker.address
                        ) {
                            map.setCenter(marker.position);
                            marker.setMap(map);
                            setTimeout(() => {
                                map.setZoom(8);
                                markerInfo.open({
                                    anchor: marker,
                                    map: map,
                                    shouldFocus: false,
                                });
                            }, 1000);
                        }
                    });
                });
                // clears all location markers from the map
                clearMapButton.addEventListener("click", () => {
                    marker.setMap(null);
                });
                // clears markers from map before re-dropping
                hiddenMapLocationButton.addEventListener("click", () => {
                    marker.setMap(null);
                });
            });
        }
    }

    // AUTOLOADS MAP IF SUBMIT METHOD IS THE HOMEPAGE MAP BUTTON
    function autoLoadMap() {
        windowOverlay.classList.add("window-overlay-dim");
        hiddenMap.style.opacity = "1";
        hiddenMap.style.paddingTop = "40px";
        window.scroll(0, 0);
        if (window.innerWidth > 1300) {
            loadMap(4);
            hiddenMap.style.height = "510px";
        } else if (window.innerWidth < 1300 && window.innerWidth > 1000) {
            loadMap(4);
            hiddenMap.style.height = "460px";
        } else if (window.innerWidth < 1000 && window.innerWidth > 700) {
            loadMap(4);
            hiddenMap.style.height = "410px";
        } else if (window.innerWidth < 700 && window.innerWidth > 400) {
            loadMap(4);
            hiddenMap.style.height = "510px";
            hiddenMapHeader.style.display = "none";
        } else if (window.innerWidth < 400) {
            loadMap(3);
            hiddenMap.style.height = "370px";
            hiddenMapHeader.style.display = "none";
        }
    }

    // EVENT LISTENERS
    // OPENS MAP FROM MAP ICON
    hiddenMapOpenButton.addEventListener("click", () => {
        windowOverlay.classList.add("window-overlay-dim");
        window.scroll(0, 0);
        autoLoadMap();
    });

    // CLOSES MAP
    hiddenMapCloseButton.addEventListener("click", () => {
        windowOverlay.classList.remove("window-overlay-dim");
        hiddenMap.style.height = "0";
        hiddenMap.style.paddingTop = "0";
        hiddenMap.style.opacity = "0";
        mapMessage.style.opacity = "0";
        mapMessage.style.top = "-100%";
    });

    // TOGGLES DISTANCE SEARCH DROPDOWN
    mapSearchDistanceButton.addEventListener("click", () => {
        mapSearchDistanceButton.style.borderTopRightRadius = "2px";
        mapSearchDistanceContainer.classList.toggle(
            "map-search-distance-container-toggle"
        );
        mapSearchDistanceArrow.classList.toggle(
            "map-search-distance-arrow-rotate"
        );
        mapSearchDistanceDropdown.classList.toggle(
            "map-search-distance-dropdown-toggle"
        );
        mapSearchDistanceArrow.style.display = "inline";
        mapDistanceGoButton.style.display = "none";
    });

    // TOGGLES MAPS LOCATION LIST, HIDES ON FULLSCREEN, SHOWS ON MOBILE
    mapLocationListButton.addEventListener("click", () => {
        if (window.innerWidth > 700) {
            mapLocationListContainer.classList.toggle(
                "map-location-list-toggle-fullscreen"
            );
        }
        if (window.innerWidth <= 700) {
            mapLocationListContainer.classList.toggle(
                "map-location-list-toggle-mobile"
            );
        }
    });

    // USED IF CURRENT LOCATION IS DENIED, DOESNT ALLOW RADIAL SEARCH
    mapSearchDistanceSelection.forEach((selection) => {
        selection.addEventListener("click", (e) => {
            mapSearchDistanceButton.innerText = e.target.innerText;
            mapSearchDistanceButton.style.borderTopRightRadius = "0";
            mapSearchDistanceContainer.classList.remove(
                "map-search-distance-container-toggle"
            );
            mapSearchDistanceArrow.classList.remove(
                "map-search-distance-arrow-rotate"
            );
            mapSearchDistanceDropdown.classList.remove(
                "map-search-distance-dropdown-toggle"
            );
            mapSearchDistanceArrow.style.display = "none";
            mapDistanceGoButton.style.display = "inline";
        });
    });

    // autoloads map if map button is used from homepage or single deal location button
    if (submitMethod.innerText === "map") {
        autoLoadMap();
    }
}

// window.onload = loadScript();
window.addEventListener("load", () => {
    loadScript();
});
