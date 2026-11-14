import { getLocation } from './maps-get-location.js';

const mapElement = document.getElementById("map-canvas");
const thisLocation = getLocation ();
const searchCriteria = ['restaurant'];

var innerMap;
var center;
var infoWindow;

async function init() {

    const [{ InfoWindow }, { event }] = await Promise.all([
        google.maps.importLibrary('maps'),
        google.maps.importLibrary('core'),
    ]);

    var simpleMap = new google.maps.Map(document.getElementById("map-canvas"), {
        center: { lat: thisLocation[0], lng: thisLocation[1] },
        mapId: "exeter-map",
        zoom: 13,
    });

    innerMap = simpleMap;

    innerMap.setOptions({
        mapTypeControl: false,
    });

    infoWindow = new InfoWindow();

    // Kick off an initial search once map has loaded.
    event.addListenerOnce(innerMap, 'idle', () => {
        void nearbySearch();
    });
}

async function nearbySearch() {
    const [
        { Place, SearchNearbyRankPreference },
        { AdvancedMarkerElement },
        { spherical },
    ] = await Promise.all([
        google.maps.importLibrary('places'),
        google.maps.importLibrary('marker'),
        google.maps.importLibrary('geometry'),
    ]);
    // Get bounds and radius to constrain search.
    center = innerMap.center;
    const ne = innerMap.getBounds().getNorthEast();
    const sw = innerMap.getBounds().getSouthWest();
    const diameter = spherical.computeDistanceBetween(ne, sw);
    const radius = Math.min(diameter / 2, 50000); // Radius cannot be more than 50000.

    const request = {
        // required parameters
        fields: [
            'displayName',
            'location',
            'formattedAddress',
            'googleMapsURI',
        ],
        locationRestriction: {
            center,
            radius,
        },
        // optional parameters
        includedPrimaryTypes: searchCriteria,
        maxResultCount: 5,
        rankPreference: SearchNearbyRankPreference.POPULARITY,
    };

    const { places } = await Place.searchNearby(request);

    if (places.length) {
        const { LatLngBounds } = await google.maps.importLibrary('core');
        const bounds = new LatLngBounds();

        // First remove all existing markers.
        for (const marker of mapElement.querySelectorAll('gmp-advanced-marker'))
            marker.remove();

        // Loop through and get all the results.
        places.forEach((place) => {
            if (!place.location) return;
            bounds.extend(place.location);

            const marker = new AdvancedMarkerElement({
                map: innerMap,
                position: place.location,
                title: place.displayName,
                gmpClickable: true,
            });

            // Build the content of the InfoWindow safely using DOM elements.
            const content = document.createElement('div');
            const address = document.createElement('div');
            address.textContent = place.formattedAddress || '';
            const placeId = document.createElement('div');
            placeId.textContent = place.id;
            content.append(address, placeId);

            if (place.googleMapsURI) {
                const link = document.createElement('a');
                link.href = place.googleMapsURI;
                link.target = '_blank';
                link.textContent = 'View Details on Google Maps';
                content.appendChild(link);
            }

            marker.addEventListener('gmp-click', () => {
                innerMap.panTo(place.location);
                updateInfoWindow(place.displayName, content, marker);
            });
        });

        innerMap.fitBounds(bounds, 100);
    } else {
        console.log('No results');
    }
}

function updateInfoWindow(title, content, anchor) {
    infoWindow.setContent(content);
    infoWindow.setHeaderContent(title);
    infoWindow.open({
        anchor,
    });
}

void init();