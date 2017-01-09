
<!DOCTYPE html>
<html>

<head>
  <title>Login</title>
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
?>

<div class="row" style="background-color:black;">
<font size="5" color="white"><strong>LOGIN</strong></font><br>
</div>

<Form name ="form1" Method ="POST" Action ="index.php">
<font size="6">Please enter your username</font><br>
<Input Type = "text" Value ="" Name ="name" style="width:40%"><br><br>
 <font size="6">Please enter your password.</font><br>
<Input Type = "password" Value ="" Name ="password" style="width:40%"><br><br>
<Input Type = "Submit" Name = "Submit1" Value = "Login" style="width:20%"><br><br>
</FORM>

<form action="registration.php">
    <font size="6">Don't have an acount? Sign up!</font><br>
    <input type="submit" value="Sign Up" style="width:20%" />
</form>
<br>
<?PHP
include 'server.php';


if(isset($_POST["Submit1"]))
        {
            ini_set('display_errors', 'On');
            error_reporting(E_ALL);


        $name = $_POST["name"];
        $password = $_POST["password"];

        /* get the user salt value from the database */
        $userSalt = $dbh->query("SELECT salt FROM userinfo WHERE username = '".$name."'");

        /* echo '$userSalt->fetchColumn'; */
        /* contenate to the user's inputted password */
        $password .=$userSalt->fetchColumn();

        /* get the password which is md5(password+salt) when hashed*/
        $password = md5($password);


        /* get the username with the correct matching password */
        $result1 = $dbh->query("SELECT username FROM userinfo WHERE username = '".$name."' AND  password = '".$password."'");

        /* if the credentials matched login the user and start php session */
        if($result1->fetchColumn() == $name and $name!="")
        {
            $id_query = $dbh->query("SELECT `id` FROM `userinfo` WHERE username='$username' AND password='$password'");
            $user_id = $id_query->fetchColumn();
            /* echo 'The username or password are okay!'; */
            /* $_SESSION["logged_in"] = true; */
            /* $_SESSION["naam"] = $name; */

            /* disable tokens in urls to prevent scripting attacks */
            /* ini_set('session.use_only_cookies', 1); */
            /* header('Location: search.php'); */
            $session_id = (openssl_random_pseudo_bytes(15));
            $insert_session_query = $dbh->query("INSERT INTO `sessions`(`session_ID`, `user_ID`) VALUES ('$session_id','$user_id')");
            session_start();
            $_SESSION['session_id'] = $session_id;
            $_SESSION['session_username'] = $name;
            header("Location: https://{$_SERVER['HTTP_HOST']}/submission.php");
         }

        else
        {
            echo '<font class="errorFont">The username or password are incorrect!</font>';

}
 }
?>


<br>
<br>
<?php
     include 'footer.php';
?>
</body>


</html>
