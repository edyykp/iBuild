// Code for the Google Maps API
var map;

// Function to implement a google map.
function initMap() {
  var manchester_lat_lng = {lat: 53.483959, lng: -2.244644};
  var map_options = {zoom: 6, center: manchester_lat_lng, disableDefaultUI: true};

  // Ref (for styling): https://developers.google.com/maps/documentation/javascript/styling
  var maps_style = [
  {
    "elementType": "geometry",
    "stylers": [{"color": "#242F3E"}]
  },
  {
    "elementType": "labels.text.fill",
    "stylers": [{"color": "#9E917C"}]
  },
  {
    "elementType": "labels.text.stroke",
    "stylers": [{"color": "#242F3E"}]
  },
  {
    "featureType": "administrative.country",
    "elementType": "geometry.stroke",
    "stylers": [{"color": "#008E8E"}]
  },
  {
    "featureType": "administrative.country",
    "elementType": "labels.text",
    "stylers": [{"saturation": -10}]
  },
  {
    "featureType": "administrative.country",
    "elementType": "labels.text.fill",
    "stylers": [{"color": "#00A8A8"}]
  },
  {
    "featureType": "administrative.land_parcel",
    "elementType": "labels",
    "stylers": [{"visibility": "off"}]
  },
  {
    "featureType": "administrative.locality",
    "elementType": "labels.text.fill",
    "stylers": [{"color": "#D3925C"}]
  },
  {
    "featureType": "poi",
    "elementType": "labels.text",
    "stylers": [{"visibility": "off"}]
  },
  {
    "featureType": "poi",
    "elementType": "labels.text.fill",
    "stylers": [{"color": "#D59563"}]
  },
  {
    "featureType": "poi.business",
    "stylers": [{"visibility": "off"}]
  },
  {
    "featureType": "poi.park",
    "elementType": "geometry",
    "stylers": [{"color": "#263C3F"}]
  },
  {
    "featureType": "poi.park",
    "elementType": "labels.text.fill",
    "stylers": [{"color": "#6B9A76"}]
  },
  {
    "featureType": "road",
    "elementType": "geometry",
    "stylers": [{"color": "#38414E"}]
  },
  {
    "featureType": "road",
    "elementType": "geometry.stroke",
    "stylers": [{"color": "#212A37"}]
  },
  {
    "featureType": "road",
    "elementType": "labels.icon",
    "stylers": [{"visibility": "off"}]
  },
  {
    "featureType": "road",
    "elementType": "labels.text.fill",
    "stylers": [{"color": "#9CA5B3"}]
  },
  {
    "featureType": "road.highway",
    "elementType": "geometry",
    "stylers": [{"color": "#746855"}]
  },
  {
    "featureType": "road.highway",
    "elementType": "geometry.stroke",
    "stylers": [{"color": "#1F2835"}]
  },
  {
    "featureType": "road.highway",
    "elementType": "labels.text.fill",
    "stylers": [{"color": "#F3D19C"}]
  },
  {
    "featureType": "road.local",
    "elementType": "labels",
    "stylers": [{"visibility": "off"}]
  },
  {
    "featureType": "transit",
    "stylers": [{"visibility": "off"}]
  },
  {
    "featureType": "transit",
    "elementType": "geometry",
    "stylers": [{"color": "#2F3948"}]
  },
  {
    "featureType": "transit.station",
    "elementType": "labels.text.fill",
    "stylers": [{"color": "#D59563"}]
  },
  {
    "featureType": "water",
    "elementType": "geometry",
    "stylers": [
      {"color": "#17263C"}]
  },
  {
    "featureType": "water",
    "elementType": "labels.text.fill",
    "stylers": [{"color": "#515C6D"}]
  },
  {
    "featureType": "water",
    "elementType": "labels.text.stroke",
    "stylers": [{"color": "#17263C"}]
  },
];
  // Creating a new map takes in two parameters: the map ID and the map_options
  map = new google.maps.Map(document.getElementById('map'), map_options);
  map.setOptions({styles: maps_style});

}


// List of pointers to be placed on the map.
var pointers = [
    ({info:'Manchester', coordinates: {lat: 53.483959, lng: -2.244644}}),
    ({info:'London', coordinates: {lat: 51.509865, lng: -0.118092}}),
    ({info:'Edinburgh', coordinates: {lat: 55.953251, lng: -3.188267}}),
    ({info:'Amsterdam', coordinates: {lat: 52.370216, lng: 4.895168}}),
    ({info:'Dublin', coordinates: {lat: 53.350140, lng: -6.266155}}),
    ({info:'Hamburg', coordinates: {lat: 53.551086, lng: 9.993682}}),
    ({info:'New York', coordinates: {lat:40.730610, lng:-73.935242}}),
    ({info:'New Delhi', coordinates: {lat:28.644800, lng:	77.216721}})
  ];

// The value in the action variable will be used to decide when to place pointers on the map.
var pointer_on_display = [];
var timeout = 400;
var index = 0;
var action = true;


function dropPointers(){
  clearPointers();
    // a for loop is used to create pointers on the map
  for (var i = 0; i < pointers.length; i++){
    index = i;
    createPointers(pointers[i]);
  }
}

// creates pointers on the map and pushes the details in the pointer_on_display list
function createPointers(props) {
  window.setTimeout(function() {
    var marker = (new google.maps.Marker({
      position: props.coordinates,
      map: map,
      //icon: 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png',
      icon: "http://maps.google.com/mapfiles/kml/pal3/icon23.png",
      draggable: false,
      animation: google.maps.Animation.DROP
    }));

    pointer_on_display.push(marker);

    // looks for a click event and displays a box with info when a pointer is clicked.
    //marker.addEventListener('click', function(marker){
    //  infoWindow.open(map, marker);
  //  });

    var infoWindow = new google.maps.InfoWindow({
      content: '<h3>' + props.info.fontcolor("green") + '</h3>'
    });

  }, index * timeout);
}

// This function removes all markers present on the map
function clearPointers() {
  for (var i = 0; i < pointer_on_display.length; i++) {
    pointer_on_display[i].setMap(null);
  }
  pointer_on_display = [];
}

// gets the distance of the map div from the top of the screen
map_element = document.getElementById("map");
var distance = map_element.getBoundingClientRect().top;
distance = (distance+200)/2;

// ****************************************************************************

// Code for increasing numbers in the highlights
var current_number = 0;
var final_number = 1517;
var step = 1;
var counter = document.getElementById("highlight");

// the IncreaseNumber function increases the value of the current_number
// and the step.
// It also updates the value of the counter using .innerHTML
function IncreaseNumber() {
  if (current_number <= final_number) {
     current_number += step;
     step += 1;
  }
  counter.innerHTML = current_number;
}


// the function looks for a scroll event and only calls the IncreaseNumber and dropPointers
// function when a user scrolls down a certain number of pixels down the page.
// the setInterval will call the IncreaseNumber function every 80 milliseconds.
window.onscroll = function() {
  if (action === true && (document.body.scrollTop > distance || document.documentElement.scrollTop > distance || window.pageYOffset > distance)) {
      action = false;
      dropPointers();
      setInterval(IncreaseNumber, 60);
 }
};
