<!DOCTYPE html>
<html>

<head>
  <title>Registration</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
  <link rel="stylesheet" type="text/css" href="style.css" media="screen" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>


<body>

<?php
  include 'header.php';
  include 'menu.php';

echo '<div class="row" style="background-color:black;">
<font size="5" color="white"><strong>REGISTER</strong></font><br>
</div>';


echo '<Form name ="form1" Method ="POST" Action ="registration.php" enctype="multipart/form-data">';




$password = $_POST["password"];
$password2 = $_POST["password2"];
$name = $_POST["name"];
$date = $_POST["birthday"];
$email = $_POST["email"];
$number = $_POST["phonenumber"];
$validate = True;

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


echo '<font size="6">Please enter your name</font><br>';
/* validate name field */
validate("name",'<input name="name" id="rname" type="text" />','<input name="name" id="rname" type="text" value="'
        . htmlspecialchars($_POST['name']) . '"/>',!preg_match("/^[A-z]+$/",$_POST["name"]),'<span class="error"><b>Error:</b> <font style="color:red">Invalid character in name!</font></span>');






echo '<br><br><font size="6">Please enter a password.</font><br>';
validate("password",'<input name="password" id="pass" type="password" />','<input name="password" id="pass" type="password" value="'
        . htmlspecialchars($_POST['password']) . '"/>',!preg_match("/^[a-zA-Z0-9\-_]{1,20}$/",$_POST["password"]),'<span class="error"><b>Error:</b> <font style="color:red">Invalid character in password</font></span>');






echo ' <br><br><font size="6">Please reenter your password.</font><br>';
echo '<Input Type = "password" Value ="" Name ="password2">';

        if ($password!=$password2) {
              global $validate;
              $validate = False;
              echo '<br><b>Error:</b><font style="color:red">Your passwords do not match!</font>';
}


echo '<br><br><font size="6">Please enter your birthday (yyyy-mm-dd)</font><br>';
validate("birthday",'<input name="birthday" id="date" type="text" />','<input name="birthday" id="date" type="text" value="'
        . htmlspecialchars($_POST['birthday']) . '"/>',!preg_match("/^\d{4}\-(0?[1-9]|1[012])\-(0?[1-9]|[12][0-9]|3[01])$/",$_POST["birthday"]),'<span class="error"><b>Error:</b> <font style="color:red">Birthday must be in the form yyyy-mm-dd, must be valid</font></span>');




echo '<br><br><font size="6">Please enter a valid email address</font><br>';
validate("email",'<input name="email" id="emailID" type="text" />','<input name="email" id="emailID" type="text" value="'
        . htmlspecialchars($_POST['email']) . '"/>',!preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/",$_POST["email"]),'<span class="error"><b>Error:</b> <font style="color:red">Invalid email</font></span>');

echo '<br><br><font size="6">Please enter a valid phone number</font><br>';
validate("phonenumber",'<input name="phonenumber" id="num" type="text" />','<input name="phonenumber" id="num" type="text" value="'
    . htmlspecialchars($_POST['phonenumber']) . '"/>',!preg_match("/^[0-9]{1,12}$/",$_POST["phonenumber"]),'<span class="error"><b>Error:</b> <font style="color:red">Invalid phone number. Only numbers allowed</font></span>');



if(isset($_POST["Submit"]))
{

        if ($validate==True){

            /* Creates a random string of characters used for salting */
            $salt = bin2hex(openssl_random_pseudo_bytes(100));

            /* concatenate salt to password */
            $password.=$salt;

            /* Hash password */
            $password =md5($password);
        $sql = $dbh->prepare("INSERT INTO userinfo (username, password, birthday,email,phonenumber,salt)
                VALUES (?,?,?,?,?,?)");
        $sql->execute(array($name,$password,$date,$email,$number,$salt));
        header('Location: index.php');
}}




?>



<br><br>
<Input Type = "Submit" Name = "Submit" Value = "Register" style="width:15%">
</FORM>


<br>

<?php
include 'footer.php';
?>
  </div>
</body>
</html>

