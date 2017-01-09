



function myMap(lat,lon,name) {
  var mapCanvas = document.getElementById("map");
  var mapOptions = {center: myCenter, zoom: 13};
  var map = new google.maps.Map(mapCanvas, mapOptions);

  var myCenter = new google.maps.LatLng(lat, lon);

   window[marker] = new google.maps.Marker({position:myCenter});
    // var marker= new google.maps.Marker({position:myCenter});
   marker.setMap(map);

   google.maps.event.addListener(marker,'click',function() {
    var infowindow = new google.maps.InfoWindow({
      content:name
    })
  infowindow.open(map,marker);
  });

}


function myMap3(lat,lon,name,marker) {


var myCenter = new google.maps.LatLng(lat,lon);
var mapCanvas = document.getElementById("map");
var mapOptions = {center: myCenter, zoom: 19};
var map = new google.maps.Map(mapCanvas, mapOptions);
         // marker = new google.maps.Marker({position:myCenter});

marker = new google.maps.Marker({position:new google.maps.LatLng(lat,lon)});
      // window [marker] = new google.maps.Marker({position:myCenter});
      marker.setMap(map);
   google.maps.event.addListener(marker,'click',function() {
    var infowindow = new google.maps.InfoWindow({
      content:name
    })
  infowindow.open(map,marker);
  });




}

//when the user clicks on a marker, information about that location
//will be displayed including the restaurant name, location and link to the individual item page
function myMap2() {
  var myCenter = new google.maps.LatLng(43.255718, -79.86750);
  var mapCanvas = document.getElementById("map");
  var mapOptions = {center: myCenter, zoom: 15};
  var map = new google.maps.Map(mapCanvas, mapOptions);

  //get markers for all 5 restaurant locations.

  var m1 = new google.maps.Marker({position:myCenter});
  var m2 = new google.maps.Marker({position:new google.maps.LatLng(43.253323,-79.867597)});
  var m3 = new google.maps.Marker({position:new google.maps.LatLng(43.250812, -79.868754)});
  var m4 = new google.maps.Marker({position:new google.maps.LatLng(43.254357, -79.861570)});
  var m5 = new google.maps.Marker({position:new google.maps.LatLng(43.252133, -79.869856)});

  //set markers on map
  m1.setMap(map);
  m2.setMap(map);
  m3.setMap(map);
  m4.setMap(map);
  m5.setMap(map);

  //Add information windows when the user clicks on a marker
  //includes name and link to sampe object page
  google.maps.event.addListener(m1,'click',function() {
    var infowindow = new google.maps.InfoWindow({
      content:"Burrito Boyz, King Street East <a href='individual_sample.html'>Sample Restaurant</a>"
    })
  infowindow.open(map,m1);
  });

  google.maps.event.addListener(m2,'click',function() {
    var infowindow = new google.maps.InfoWindow({
      content:"Incognito Restaurant, 93 John Street South <a href='individual_sample.html'>Sample Restaurant</a>"});
  infowindow.open(map,m2);
  });

 google.maps.event.addListener(m3,'click',function() {
    var infowindow = new google.maps.InfoWindow({
      content:"Rapscallion Rogue Eatery, 206 John Street South <a href='individual_sample.html'>Sample Restaurant</a>"});
  infowindow.open(map,m3);
  });

 google.maps.event.addListener(m4,'click',function() {
    var infowindow = new google.maps.InfoWindow({
      content:"Black Forest Inn, 255 King St E, Hamilton <a href='individual_sample.html'>Sample Restaurant</a>"});
  infowindow.open(map,m4);
  });

  google.maps.event.addListener(m5,'click',function() {
    var infowindow = new google.maps.InfoWindow({
      content:"The Ship, 23 Augusta St <a href='individual_sample.html'>Sample Restaurant</a>"});
  infowindow.open(map,m5);
  });

}

//load the mapping api
"https://maps.googleapis.com/maps/api/js?callback=myMap"
"https://maps.googleapis.com/maps/api/js?callback=myMap2"

