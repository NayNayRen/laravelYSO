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
    const focusSinglePin = document.querySelector(".focus-single-pin");
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

    // BUILDS AND ADDS MAP ON CLICKING MAP ICON
    function loadMap(zoomLevel) {
        // ensures an empty marker group
        markerGroup = [];
        // icon Size in terms of pixels, Point relative to icon
        const ysoIcon = {
            url: "../img/yso-clipped-rw-shadowed.png",
            size: new google.maps.Size(40, 40),
            scaledSize: new google.maps.Size(40, 40),
            origin: new google.maps.Point(0, 0),
        };
        // generates map
        map = new google.maps.Map(document.getElementById("map"), {
            center: usCenter,
            zoom: zoomLevel,
            zoomControl: true,
            // mapTypeControl: false,
            mapTypeControlOptions: {
                style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
            },
        });
        // marker info bubble
        infoWindow = new google.maps.InfoWindow({
            maxWidth: 200,
            content: "",
        });
        // if location is allowed
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const currentLocationMarker = {
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
                    ${currentLocationMarker.heading}
                    </span>
                    `);
                    // current location marker
                    marker = new google.maps.Marker({
                        position: new google.maps.LatLng(
                            currentLocationMarker.lat,
                            currentLocationMarker.lng
                        ),
                        title: "Your Current Location.",
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
                        fillOpacity: 0.25,
                        map,
                        center: currentLocationMarker,
                        // default radius is in meters, pass miles to convert
                        radius: milesToMeters(15),
                    });
                    map.setCenter(currentLocationMarker);
                    map.setZoom(10);
                    marker.setMap(map);
                    circle.setMap(map);
                    marker.addListener("click", () => {
                        infoWindow.open({
                            anchor: marker,
                            map: map,
                            shouldFocus: false,
                        });
                    });
                    if (window.innerWidth <= 400) {
                        map.setZoom(9);
                    }
                    // console.log(circle.radius);
                    mapDistanceGoButton.addEventListener("click", () => {
                        if (mapSearchDistanceButton.innerText === "25 miles") {
                            map.setZoom(9);
                            map.setCenter(currentLocationMarker);
                            circle.setRadius(milesToMeters(25));
                        }
                        if (mapSearchDistanceButton.innerText === "50 miles") {
                            map.setZoom(8);
                            map.setCenter(currentLocationMarker);
                            circle.setRadius(milesToMeters(50));
                        }
                        if (mapSearchDistanceButton.innerText === "75 miles") {
                            map.setZoom(7);
                            map.setCenter(currentLocationMarker);
                            circle.setRadius(milesToMeters(75));
                        }
                        if (mapSearchDistanceButton.innerText === "100 miles") {
                            map.setZoom(6);
                            map.setCenter(currentLocationMarker);
                            circle.setRadius(milesToMeters(100));
                        }
                        if (mapSearchDistanceButton.innerText === "No Limit") {
                            map.setZoom(4);
                            map.setCenter(usCenter);
                            circle.setRadius(0);
                        }
                        if (mapSearchDistanceButton.innerText === "My Locale") {
                            if (window.innerWidth <= 400) {
                                map.setZoom(9);
                            } else {
                                map.setZoom(10);
                            }
                            map.setCenter(currentLocationMarker);
                            circle.setRadius(milesToMeters(15));
                        }
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
    function buildMarkers() {
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
                // console.log(marker.id);
                // each markers data
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
                    focusSinglePin.style.display = "block";
                    map.setZoom(8);
                    setTimeout(() => {
                        map.setCenter(marker.position);
                        // markerInfo.open({
                        //     anchor: marker,
                        //     map: map,
                        //     shouldFocus: false,
                        // });
                    }, 1000);
                    // only shows go to pin button on single locxation page
                    mapDistanceGoButton.addEventListener("click", () => {
                        if (mapSearchDistanceButton.innerText === "Go To Pin") {
                            map.setZoom(8);
                            setTimeout(() => {
                                map.setCenter(marker.position);
                                // markerInfo.open({
                                //     anchor: marker,
                                //     map: map,
                                //     shouldFocus: false,
                                // });
                            }, 1000);
                        }
                    });
                }
                // clears all location markers from the map
                clearMapButton.addEventListener("click", () => {
                    marker.setMap(null);
                });
            });
        }
    }

    // AUTOLOADS MAP IF SUBMIT METHOD IS THE HOMEPAGE MAP BUTTON
    function autoLoadMap() {
        if (submitMethod.innerText === "map") {
            hiddenMap.style.opacity = "1";
            hiddenMap.style.paddingTop = "30px";
            if (window.innerWidth > 1300) {
                loadMap(4);
                hiddenMap.style.height = "500px";
            } else if (window.innerWidth < 1300 && window.innerWidth > 1000) {
                loadMap(4);
                hiddenMap.style.height = "450px";
            } else if (window.innerWidth < 1000 && window.innerWidth > 700) {
                loadMap(4);
                hiddenMap.style.height = "400px";
            } else if (window.innerWidth < 700 && window.innerWidth > 400) {
                loadMap(4);
                hiddenMap.style.height = "500px";
                hiddenMapHeader.style.display = "none";
            } else if (window.innerWidth < 400) {
                loadMap(3);
                hiddenMap.style.height = "325px";
                hiddenMapHeader.style.display = "none";
            }
            setTimeout(() => {
                buildMarkers();
            }, 2000);
        }
    }

    // EVENT LISTENERS
    // SHOWS SEARCH RESULTS MARKERS ON CLICK
    hiddenMapLocationButton.addEventListener("click", () => {
        buildMarkers();
    });

    // OPENS MAP FROM MAP ICON
    hiddenMapOpenButton.addEventListener("click", () => {
        // windowOverlay.classList.add("window-overlay-dim");
        // hiddenMap.style.zIndex = "3";
        // hiddenMap.style.zIndex = "1";
        window.scroll(0, 0);
        hiddenMap.style.opacity = "1";
        hiddenMap.style.paddingTop = "30px";
        if (window.innerWidth > 1300) {
            loadMap(4);
            hiddenMap.style.height = "500px";
        } else if (window.innerWidth < 1300 && window.innerWidth > 1000) {
            loadMap(4);
            hiddenMap.style.height = "450px";
        } else if (window.innerWidth < 1000 && window.innerWidth > 700) {
            loadMap(4);
            hiddenMap.style.height = "400px";
        } else if (window.innerWidth < 700 && window.innerWidth > 400) {
            loadMap(4);
            hiddenMap.style.height = "500px";
            hiddenMapHeader.style.display = "none";
        } else if (window.innerWidth < 400) {
            loadMap(3);
            hiddenMap.style.height = "325px";
            hiddenMapHeader.style.display = "none";
        }
        setTimeout(() => {
            buildMarkers();
        }, 2000);
    });

    // CLOSES MAP
    hiddenMapCloseButton.addEventListener("click", () => {
        // windowOverlay.classList.remove("window-overlay-dim");
        hiddenMap.style.height = "0";
        hiddenMap.style.paddingTop = "0";
        // hiddenMap.style.zIndex = "-1";
        hiddenMap.style.opacity = "0";
        mapMessage.style.opacity = "0";
        mapMessage.style.top = "-100%";
    });

    // TOGGLES DISTANCE SEARCH DROPDOWN
    mapSearchDistanceButton.addEventListener("click", () => {
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

    // USED IF CURRENT LOCATION IS DENIED, DOESNT ALLOW RADIAL SEARCH
    mapSearchDistanceSelection.forEach((selection) => {
        selection.addEventListener("click", (e) => {
            mapSearchDistanceButton.innerText = e.target.innerText;
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

    // autoloads map if map button is used from homepage
    autoLoadMap();
}

// window.onload = loadScript();
window.addEventListener("load", () => {
    loadScript();
});
