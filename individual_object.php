<!DOCTYPE html>
<html lang = "en">

<!-- Individual Restaurant page -->

<!-- Head of the html. -->



<head>
  <title>Individual Restaurant</title>
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
$initial = false;
?>

<?php
  include 'header.php';
  include 'menu.php';
  include 'server.php';
  /* used for debugging */
            /* ini_set('display_errors', 'On'); */
            /* error_reporting(E_ALL); */

?>

<div class="row" style="background-color:black;">
<font size="5" color="white"><strong>INDIVIDUAL RESTAURANT</strong></font><br>
</div>
</br>
<?PHP




/* get information about all restaurants */
$general_query = $dbh->query("SELECT * FROM restaurant");
$general_query->execute();
while ($row = $general_query->fetch(PDO::FETCH_ASSOC)){

/* get pages by restauarant id since it's a unique primary key */
if(isset($_GET["restaurantid".$row['restaurant_id']])){
$lat = $row["latitude"];
$long = $row ["longitude"];
$name = $row["name"];
/* $rest = "checkplease".$row['restaurant_id']; */
?>
<center><div id="map" style="width:70%;height:400px;margin-bottom:0 !important;"></div></center>
<script type="text/javascript">
function callback(){
    myMap3('<?php echo $lat; ?>','<?php echo $long; ?>','<?php echo $name; ?>');

}
</script>
<script src="https://maps.googleapis.com/maps/api/js?callback=callback"></script>

<table>
<?php
/* Display information about that particular restaurant */
echo '<tr><th><b>Name</b>:</th>'.'<th>'.$row["name"].'</th></tr>';
echo '<br>';
echo '<tr><th><b>Description</b>:</th>'.'<th>'.$row["description"].'</th></tr>';
echo '<br>';
echo '<tr><th><b>Rating</b>:</th>'.'<th>'.$row["rating"].'</th></tr>';
echo '<br>';
echo '</table>';
$restId = $row["restaurant_id"];

/* display the image corresponding to the restaurant */
echo '<br>';
echo '<img src="'.$row["imagelink"].'"  style="width:70%;height:600px;"><br>';
echo'<br>';

/* echo '<div class="border">'; */
echo '<div class="rborder" style="background-color:#333;margin-left:100px;margin-right:100px;">
<font size="6" color="white"><strong>Customer Reviews</strong></font><br>
</div>
</br>';

/* Get the review and average rating and display it */
$reviewrow = $dbh->query("SELECT * FROM reviews WHERE restaurantid = '".$restId."'");
global $totalReviewScore;
global $rowCount;
while ($r = $reviewrow->fetch(PDO::FETCH_ASSOC)){
    echo '<div class="rborder" style="background-color:white">';
    echo $r["review_info"]." ".$r["rating"]."/5";
    echo '</div>';
    echo '</br>';
    $totalReviewScore = ($totalReviewScore + $r["rating"]);
    $rowCount=$rowCount+1;

}

echo '</div>';
/* average rating will all the ratings of the individual reviewers */
/*     dividied by the amount of reviews */
$averageRating = round ($totalReviewScore/$rowCount);

/* update the rating of the restaurant when the user refreshes the page after posting a review */
$currentRestaurantID = $row['restaurant_id'];
global $update_rating_query;
$update_rating_query = $dbh->prepare("Update `restaurant` set rating='$averageRating'  WHERE restaurant_id='$currentRestaurantID'");
$update_rating_query->execute();


/* check to see if the user is logged in, of they allow them to add a review and rating */

if (isset($_SESSION["session_username"]))
{

    echo '<font size="6">Submit a review  and rating for this restaurant below!</font><br>';

    /* Allow the user to select a review and rating */
echo '<Form name ="form1" Method ="POST" Action ="individual_object.php?restaurantid'.$row['restaurant_id'].'"multipart/form-data">';
    echo '<textarea name="review" id="des" rows="5" cols="30"></textarea><br />';
echo '<br><label for="rating">Choose a rating: </label>
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
  </select> Star(s)<br><br>';


    echo '<Input style="width:100px" Type = "Submit" Name = "Submit" Value = "Submit"><br><br>';
    echo '</FORM>';
    if (isset($_POST["Submit"])){
        $review = $_POST["review"]." - ".$_SESSION['session_username'];
        $rating = $_POST["rating"];
        $restaurantid = $row['restaurant_id'];
        $sql = $dbh->prepare("INSERT INTO reviews (review_info,rating,restaurantid)
                VALUES (?,?,?)");
        $sql->execute(array($review,$rating,$restaurantid));
header ('Location: individual_object.php?restaurantid'.$row['restaurant_id']);
}

}

else {

    echo '<b>Login to submit a review</b>';

}
}}






include 'footer.php';
?>
</body>
</html>

