<!DOCTYPE html>
<html>


<!-- This page is for submitting  Restaurants into the database. -->
<!-- Head of the html. -->

<head>
  <title>Search Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
  <link rel="stylesheet" type="text/css" href="style.css" media="screen" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css">
<!-- This is used to obtain the users coordinates -->
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
</head>

<body>
<script>
function showlocation() {
    navigator.geolocation.getCurrentPosition(function(position) {
        callback(position.coords.latitude, position.coords.longitude);

});

}

function callback(lat,lon) {

 lat = lat.toString().match(/^-?\d+(?:\.\d{0,4})?/)[0]
 lon = lon.toString().match(/^-?\d+(?:\.\d{0,4})?/)[0]

    document.getElementById('latitude1').value = lat;
    document.getElementById('longitude1').value = lon;

}
</script>


<?php
  include 'header.php';
  include 'menu.php';
  ?>



<div class="row" style="background-color:black;">
<font size="5" color="white"><strong>SEARCH</strong></font><br>
</div>

<br>

<Form name ="form1" Method ="POST" Action ="search.php" enctype="multipart/form-data">

    <font size="6">Enter Restaurant Name:</font> <input type="text" name="name" />
<Input Type = "Submit" Name = "Submit2" Value = "Search By Name"><br><br>
<br>
<br>

 <font size="6"> Or search by rating:</font>
  <!-- 5 different options using the select tag, one for each rating -->
  <select name="rating">
    <option value="1">
      1
    </option>

    <option value="2">
      2
    </option>

    <option value="3">
      3
    </option>

    <option value="4">
      4
    </option>

    <option value="5">
      5
    </option>
  </select> Star(s)
<Input Type = "Submit" Name = "Submit" Value = "Search By Rating"><br><br>

<br>
<br>

<font size="6">Or click this button to automatically enter your current location</font>
<input type="button" value="Show my location" onclick="javascript:showlocation()">
<br><br>
Latitude:&nbsp; &nbsp;  <input type="text" id="latitude1" name="latitude1">
<br>
Longitude:    <input type="text" id="longitude1" name="longitude1">
<br>
<br>
<Input Type = "Submit" Name = "Submit3" Value = "Search By Location"><br><br>
</FORM>

<?php
  /* check if the user searched by rating name or location */

  if (isset($_POST["Submit"])){
      $rating = $_POST["rating"];
      header ("Location: search_results.php?rating".$rating);
}
  if (isset($_POST["Submit2"])){
      $name = $_POST["name"];
      header ("Location: search_results.php?name=".$name);
}
/* encode latitude and longitude and formulate query string based off it */

 if (isset($_POST["Submit3"])){
      $latitude = $_POST["latitude1"];
$latitude=substr(base64_encode($latitude),0,-2);
      $longitude = $_POST["longitude1"];
$longitude=substr(base64_encode($longitude),0,-2);
      header ("Location: search_results.php?latitude=".$latitude."&longitude=".$longitude);
}

?>




<!-- This is where the results will be displayed of the comparison of distances of the user and the restaurants. -->
<p id="SearchResults"></p>
<p id="Results"></p>

<!-- When the user clicks this button the javascript functions below will be used to calculate the distance -->

  <p><br />
  <br />
  <br />

<!-- Add footer -->

<div class="row">
<?php
include 'footer.php';
?>
</div>
</body>
</html>

