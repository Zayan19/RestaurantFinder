<!DOCTYPE html>
<html>

<!-- This page is for submitting  Restaurants into the database. -->
<!-- Head of the html. -->



<head>
  <title>Add Restaurant</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
  <link rel="stylesheet" type="text/css" href="style.css" media="screen" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="geoLocation.js"></script>
</head>
<body>

<?php
    include 'header.php';
    include 'menu.php';
?>

<div class="row" style="background-color:black;">
<font size="5" color="white"><strong>ADD RESTAURANT</strong></font><br>
</div>
    <?PHP
echo '<Form name ="form1" Method ="POST" Action ="submission.php" enctype="multipart/form-data">';


require 'vendor/autoload.php';
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
include 'server.php';


        $name = $_POST["name"];
        $description = $_POST["description"];
        $latitude = $_POST["latitude"];
        $longitude = $_POST["longitude"];
        $rating = $_POST["rating"];
        $validate = True;
        $filepath = $_FILES['pic']['tmp_name'];
        $img = $_FILES['pic']['name'];
        $validate = True;
        $bucket = 'bucketvim';
echo '<font size="6">Please enter the restaurant name </font><br>';

/* the following function validates each form the user fills out */
/* Name corresponds to the form name, initial is the inital state (empty) */
/* savedstring saves the user input so they don't have to input everyhting again in case of error */
/* check if valid checks usually via regular expression if the user input is valid or not */
/* errorMessage echos out the error message if the user inputted something incorrect */

/* Note - */
    /* Since some forms used totally different syntax such as description (for large text box) */
    /* and file uploads I unforunately could not generalize this further */

function validate($Name,$initial,$savedString,$checkIfValid,$errorMessage){
if (!array_key_exists($Name,$_POST)) {
    echo $initial;
} else if ($checkIfValid) {
    echo $savedString;
    echo '<br>';
    global $validate;
    $validate =false;
    echo $errorMessage;
    } else {
    echo $savedString;}}

/* validate name field */
validate("name",'<input name="name" id="rname" type="text" />','<input name="name" id="rname" type="text" value="'
        . htmlspecialchars($_POST['name']) . '"/>',!preg_match("/^[a-zA-Z]+$/",$_POST["name"]),'<span class="error"><b>Error:</b> <font color="red">Invalid character in name</font></span>');

echo '<br><br><font size="6">Briefly describe the restaurant </font><br>';
/* Text area tag to specify length and width of area for user to type response */

/* validate description field */
validate ("description",'<textarea name="description" id="des" rows="5" cols="30"></textarea><br />','<textarea name="description" id="des" rows="5" cols="30">'
        . htmlspecialchars($_POST['description']) .'</textarea>',!preg_match("/^(\w.+ ?){5,100}$/",$_POST["description"]),'<span class="error"><b>Error:</b> <font color="red">Please enter 10-100 characters for the description!</font></span>');


echo '<br><br><font size="6">Enter Restaurant Latitude</font><br>';

/* validate latitude return error message if incorrect*/
validate ("latitude",'<input type="text" id= "lat" name="latitude" /></>','<input name="latitude" id="lat" type="text" value="'
        . htmlspecialchars($_POST['latitude']) . '"/>',!preg_match("/^-?([1-8]?[1-9]|[1-9]0)\.{1}\d{1,6}/",$_POST["latitude"] ),'<span class="error"><b>Error:</b> <font color="red">Invalid Latitude</font></span>');

echo '<br><font size="6">Enter Restaurant Longitude</font><br>';

/* validate longitude return error message if incorrect value */
validate ("longitude",'<input type="text" id= "long" name="longitude" /></>','<input name="longitude" id="long" type="text" value="'
        . htmlspecialchars($_POST['longitude']) . '"/>',!preg_match("/^-?([1-8]?[1-9]|[1-9]0)\.{1}\d{1,6}/",$_POST['longitude']),'<span class="error"><b>Error:</b> <font color="red">Invalid Longitude</font></span>');

?>
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script>
function showlocation() {
    navigator.geolocation.getCurrentPosition(function(position) {
        callback(position.coords.latitude, position.coords.longitude);

});
}
function callback(lat,lon) {

 lat = lat.toString().match(/^-?\d+(?:\.\d{0,4})?/)[0]
 lon = lon.toString().match(/^-?\d+(?:\.\d{0,4})?/)[0]
    document.getElementById("lat").value = lat;
    document.getElementById("long").value = lon;
/* var with2Decimals = num.toString().match(/^-?\d+(?:\.\d{0,2})?/)[0]; */
};
</script>
</script>
<div>
Click on Show my location to automatically get your current location <br>
<input type="button" value="Show my location" onclick="javascript:showlocation()">
</div>


    <?php

echo '<br><font size="6">Choose a rating:</font>
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
  </select> Star(s)<br>';







echo '<br><font size="6">Upload an image of the restaurant</font><br>';


/* check to ensure picture uploaded is really a picture */
    /* this is done by getimagesize (it wont work if it's not a picture) */
echo '<center style="margin-left:15%;">';
if (!array_key_exists("longitude",$_POST)) {
echo '<input type="file" id="picture" name="pic"  />';}
else if (getimagesize($filepath)=="")
    {
echo '<input type="file" name="pic"  />';
echo '<b><font>Error:</b><font color="red">Not a valid image</font>';
$validate = False;}
else {
echo '<input type="file" name="pic" />';
}
echo'</center>';



if(isset($_POST["Submit"])){

    /* when they press submit check if validate is still true */
    /*     if it is it means they inputted everything correctly and */
            /* the restaurant can be submitted */
if ($validate==True) {
// Instantiate the client.
$s3 = S3Client::factory(array(
    'credentials'=> [
    'key'    => 'AKIAJOAZIZLHX5HQR3YQ',
    'secret' => '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'],
    'region' => 'us-west-2',
    'version'=> '2006-03-01'
));
    // Upload data using amazon s3 bucket
    $result = $s3->putObject(array(
        'Bucket' => $bucket,
        'Key'    => $img,
        'SourceFile'   => $filepath,
        'ContentType' =>'image/jpeg',
        'ACL'    => 'public-read'
    ));
    // Print the URL to the object.
    echo $result['ObjectURL'] . "\n";
    $imagelink =  $result['ObjectURL'] . "\n";
 $sql = $dbh->prepare("INSERT INTO restaurant (name,rating, description, longitude,latitude,imagelink)
                VALUES (?,?,?,?,?,?)");
        $sql->execute(array($name,$rating,$description,$longitude,$latitude,$imagelink));
        header('Location: search.php');

}}

?>

<br>
<Input Type = "Submit" Name = "Submit" Value = "Submit"><br><br>
</FORM>





</div>
<?php
include 'footer.php';
?>


</body>
</html>

