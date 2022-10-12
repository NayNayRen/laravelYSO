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
    let infoWindow;
    let map;

    // center of U.S. lat and lng
    const usCenter = {
        lat: 39.5,
        lng: -98.35,
    };

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
            zoomControl: false,
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
                        title: "Your current location.",
                        optimized: false,
                        animation: google.maps.Animation.DROP,
                        icon: ysoIcon,
                        zIndex: 2,
                    });
                    marker.setMap(map);
                    marker.addListener("click", () => {
                        infoWindow.open({
                            anchor: marker,
                            map: map,
                            shouldFocus: false,
                        });
                    });
                    // delays the info bubble
                    // setTimeout(() => {
                    //     infoWindow.open({
                    //         anchor: marker,
                    //         map: map,
                    //         shouldFocus: false,
                    //     });
                    // }, 750);
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

    // SHOWS LOCATION ERROR OR DENIAL
    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(
            browserHasGeolocation
                ? `<span class='map-bubble-heading'>Uh oh...</span>
                    <div class='map-bubble-address'>
                        <span>Looks like you said no to pinning your location.</span>
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
            // console.log(markerGroup.length);
            markerGroup.map((marker) => {
                if (marker.email === "") {
                    content = `
                        <span class='map-bubble-heading'>${marker.name}</span>
                        <div class='map-bubble-details'>
                            <span class='map-bubble-address'>
                            <i class="fa fa-map-marker" aria-hidden="true"></i> 
                            ${marker.address}</span>
                            <span class='map-bubble-email'>
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
                // clears all location markers from the map
                clearMapButton.addEventListener("click", () => {
                    marker.setMap(null);
                });
            });
        }
    }

    // EVENT LISTENERS
    // SHOWS SEARCH RESULTS MARKERS ON CLICK
    hiddenMapLocationButton.addEventListener("click", () => {
        buildMarkers();
        // const ids = document.querySelectorAll(".location-id");
        // const latitudes = document.querySelectorAll(".location-lat");
        // const longitudes = document.querySelectorAll(".location-lng");
        // const name = document.querySelectorAll(".location-name");
        // const address = document.querySelectorAll(".location-address");
        // const phone = document.querySelectorAll(".location-phone");
        // const email = document.querySelectorAll(".location-email");
        // let markersAmount = (latitudes.length + longitudes.length) / 2;
        // let markers = {};
        // let content = "";
        // // console.log(markersAmount);
        // // ensures empty group on each display
        // markerGroup = [];
        // if (markersAmount === 0) {
        //     mapMessage.style.opacity = "1";
        //     mapMessage.style.top = "50%";
        //     mapMessageClose.addEventListener("click", () => {
        //         mapMessage.style.opacity = "0";
        //         mapMessage.style.top = "-100%";
        //     });
        // } else {
        //     // sets data for each marker
        //     for (let x = 0; x < markersAmount; x++) {
        //         markers[x] = {
        //             id: ids[x].innerText,
        //             lat: latitudes[x].innerText,
        //             lng: longitudes[x].innerText,
        //             name: name[x].innerText,
        //             address: address[x].innerText,
        //             phone: formatPhoneNumber(phone[x].innerText),
        //             email: email[x].innerText,
        //         };
        //         markerGroup.push(markers[x]);
        //     }
        //     // console.log(markerGroup.length);
        //     markerGroup.map((marker) => {
        //         if (marker.email === "") {
        //             content = `
        //                 <span class='map-bubble-heading'>${marker.name}</span>
        //                 <div class='map-bubble-details'>
        //                     <span class='map-bubble-address'>
        //                     <i class="fa fa-map-marker" aria-hidden="true"></i>
        //                     ${marker.address}</span>
        //                     <span class='map-bubble-email'>
        //                     <i class="fa fa-envelope" aria-hidden="true"></i>
        //                     No Email Provided</span>
        //                     <span class='map-bubble-phone'>
        //                     <i class="fa fa-phone" aria-hidden="true"></i>
        //                     ${marker.phone}</span>
        //                     <form action='/locations/${marker.id}' method='GET' class='map-bubble-deals'>
        //                         <button type='submit'>- View Deals -</button>
        //                     </form>
        //                 </div>
        //             `;
        //         } else {
        //             content = `
        //                 <span class='map-bubble-heading'>${marker.name}</span>
        //                 <div class='map-bubble-details'>
        //                     <span class='map-bubble-address'>
        //                     <i class="fa fa-map-marker" aria-hidden="true"></i>
        //                     ${marker.address}</span>
        //                     <a href='mailto: ${marker.email}' class='map-bubble-email'>
        //                     <i class="fa fa-envelope" aria-hidden="true"></i>
        //                     ${marker.email}</a>
        //                     <span class='map-bubble-phone'>
        //                     <i class="fa fa-phone" aria-hidden="true"></i>
        //                     ${marker.phone}</span>
        //                     <form action='/locations/${marker.id}' method='GET' class='map-bubble-deals'>
        //                         <button type='submit'>- View Deals -</button>
        //                     </form>
        //                 </div>
        //             `;
        //         }
        //         // console.log(marker.id);
        //         // each markers data
        //         let markerInfo = new google.maps.InfoWindow({
        //             maxWidth: 275,
        //             content: content,
        //         });
        //         // each markers position
        //         marker = new google.maps.Marker({
        //             position: new google.maps.LatLng(marker.lat, marker.lng),
        //             title: marker.name,
        //             optimized: false,
        //             animation: google.maps.Animation.DROP,
        //             zIndex: 1,
        //         });
        //         marker.setMap(map);
        //         marker.addListener("click", () => {
        //             markerInfo.open({
        //                 anchor: marker,
        //                 map: map,
        //                 shouldFocus: false,
        //             });
        //         });
        //         // clears all location markers from the map
        //         clearMapButton.addEventListener("click", () => {
        //             marker.setMap(null);
        //         });
        //     });
        // }
    });

    // OPENS MAP FROM MAP ICON
    hiddenMapOpenButton.addEventListener("click", () => {
        // windowOverlay.classList.add("window-overlay-dim");
        // hiddenMap.style.zIndex = "3";
        // hiddenMap.style.zIndex = "1";
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
}

window.onload = loadScript();
// window.addEventListener("load", () => {
//     hiddenMap.style.opacity = "1";
//     hiddenMap.style.paddingTop = "30px";
//     if (window.innerWidth > 1300) {
//         loadMap(4);
//         hiddenMap.style.height = "500px";
//     } else if (window.innerWidth < 1300 && window.innerWidth > 1000) {
//         loadMap(4);
//         hiddenMap.style.height = "450px";
//     } else if (window.innerWidth < 1000 && window.innerWidth > 700) {
//         loadMap(4);
//         hiddenMap.style.height = "400px";
//     } else if (window.innerWidth < 700 && window.innerWidth > 400) {
//         loadMap(4);
//         hiddenMap.style.height = "500px";
//         hiddenMapHeader.style.display = "none";
//     } else if (window.innerWidth < 400) {
//         loadMap(3);
//         hiddenMap.style.height = "325px";
//         hiddenMapHeader.style.display = "none";
//     }
//     setTimeout(() => {
//         buildMarkers();
//     }, 2000);
// });
