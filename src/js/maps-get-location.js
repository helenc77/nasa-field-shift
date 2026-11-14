var infoWindow;
var map;

export function getLocation () {

    //fallback location for testing
    var latVal = 50.716667;
    var lngVal = -3.533333;

    //check geolocation is available and set it if necessary
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition((position) => {
            latVal = position.coords.latitude;
            lngVal = position.coords.longitude;
        },() => {
        //handleLocationError(true, infoWindow, map.getCenter());
    },);
    } else {
        // Browser doesn't support Geolocation
        //handleLocationError(false, infoWindow, map.getCenter());
    }

    return [latVal, lngVal];

}

export function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    // infoWindow.setPosition(pos);
    // infoWindow.setContent(
    // 	browserHasGeolocation
    // 	? "Error: The Geolocation service failed."
    // 	: "Error: Your browser doesn't support geolocation.",
    // );
    // infoWindow.open(map);
}