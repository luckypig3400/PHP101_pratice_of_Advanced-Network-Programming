//https://developers.google.com/maps/documentation/javascript/overview#maps_map_simple-javascript
let map;

function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: -34.397, lng: 150.644 },
        zoom: 8,
    });
}