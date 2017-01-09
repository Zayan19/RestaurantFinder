<!DOCTYPE html>
<html>

<!-- This page is displays a sample result in the database. -->

<!-- Head of the html. -->



<head>
  <title>Search Results</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
  <link rel="stylesheet" type="text/css" href="style.css" media="screen" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="map.js"></script>
</head>

<body>

<?php
  include 'header.php';
  include 'menu.php';
  include 'server.php';
/* ini_set('display_errors', 'On'); */
/*             error_reporting(E_ALL); */
  $initial = false;

  /* http://www.geodatasource.com/developers/php */
  function distance($lat1, $lon1, $lat2, $lon2, $unit) {

        $theta = $lon1 - $lon2;
          $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
          $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
              $unit = strtoupper($unit);

            if ($unit == "K") {
                    return ($miles * 1.609344);

            } else if ($unit == "N") {
                      return ($miles * 0.8684);

            } else {
                        return $miles;

            }

  }



/* create a table entry funciton so we don't have to keep  calling this for different search queries for restaurant names, ratings or location */


function tableEntries($row){
    $id = $row['restaurant_id'];
echo ' <tr>
      <td>'.$row["name"].'</td>
      <td>'.$row["description"].'</td>
      <td>'.'<a href="individual_object.php?restaurantid'.$id.'">Go to Page</a>'.'</td>
    </tr>';
}
echo '<table>
    <tr>
      <th>Restaurant</th>
      <th>Description</th>
      <th>Link</th>
    </tr>';
/* Get all the restaurant names */
/* get all values in the table */

$nameQuery=$_GET["name"];
if ($nameQuery!=""){

    echo '<div class="row" style="background-color:black;">
<font size="5" color="white"><strong>Your Search Results for '.$nameQuery.'</strong></font><br>
</div><br>';

$nameQuery = '%'.$nameQuery.'%';





 $name_query = $dbh->query("SELECT * FROM `restaurant` where name like '$nameQuery'") ;
while ($row = $name_query->fetch(PDO::FETCH_ASSOC)){
$lat = $row["latitude"];
$long = $row ["longitude"];
$name = $row["name"];
$latitude =substr(base64_encode($row["latitude"]),0,-2);
$longitude =substr(base64_encode($row["longitude"]),0,-2);
tableEntries($row);
}}





$latitude = $_GET['latitude'];
$longitude = $_GET['longitude'];

if ($latitude!=""&$longitude!=""){

echo '<div class="row" style="background-color:black;">
<font size="5" color="white"><strong>Restaurants less than 40 kilometers from your location'.$nameQuery.'</strong></font><br>
</div><br>';
$latitude =(base64_decode($latitude));
$longitude =(base64_decode($longitude));
$query = $dbh->query("SELECT * FROM `restaurant`");

while ($row = $query->fetch(PDO::FETCH_ASSOC)){
$lat = $row["latitude"];
$long = $row ["longitude"];
$dist = distance($latitude,$longitude,$lat,$long,'K');
if ($dist<40){
    tableEntries($row);
}


}
}


?>
    <?php


// this section is done to return all restaurants with the same
// rating from 1-5
 for ($x =1; $x <= 5; $x++) {
        if(isset($_GET["rating$x"])){

    echo '<div class="row" style="background-color:black;">
<font size="5" color="white"><strong>Your Search Results for rating '.$x.'</strong></font><br>
</div><br>';
 $rating_query = $dbh->query("SELECT * FROM `restaurant` WHERE rating='$x'");

while ($row = $rating_query->fetch(PDO::FETCH_ASSOC))
{

            tableEntries($row);
            $lat = $row["latitude"];
            $long = $row ["longitude"];
            $name = $row["name"];
            $rest = "checkplease".$row['restaurant_id'];

/* this javascript is used to generate the map based on the rows longitude,latitude and name */
?>
<?php



}
echo '</table>';
}
}

?>

<br> <a href="search.php" class="btn btn-custom " role="button"><font size="6">Go back to Search</font></a><br><br>
</font>
</body>

</html>

