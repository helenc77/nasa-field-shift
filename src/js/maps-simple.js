import { getLocation } from './maps-get-location.js';

var map;
var infoWindow;
const thisLocation = getLocation ();

export async function initMap() {

    document.getElementById("noMiles").innerHTML = numMiles;

    // Request libraries when needed, not in the script tag.
    const { Map } = await google.maps.importLibrary("maps");

    // Short namespaces can be used.
    map = new Map(document.getElementById("map-canvas"), {
        center: { lat: thisLocation[0], lng: thisLocation[1] },
        zoom: 13,
    });

    const thisLatLng = new google.maps.LatLng(thisLocation[0], thisLocation[1]);
    infoWindow = new google.maps.InfoWindow();
    infoWindow.setContent("You are here.");
    infoWindow.setPosition(thisLatLng);
    infoWindow.open(map);
}

initMap();