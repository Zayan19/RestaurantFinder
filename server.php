<?php
$servername = "localhost";
$username = "root";
$pass = "1";
$dbname = "users";


$dbh = new PDO('mysql:host=localhost;dbname=restaurants', $username, $pass);

/* try { */
/*         $dbh = new PDO('mysql:host=localhost;dbname=users', $username, $pass); */
/*         foreach($dbh->query('SELECT username from userinfo where password = "vim" ') as $row) { */
/*                     /1* print_r($row); *1/ */
/* } */
/*         $result1 = $dbh->query('SELECT username from userinfo where password = "vim" '); */
/*         $num_rows =$result1->fetchColumn(); */
/*         echo "$num_rows Rows\n"; */
/*     $dbh = null; */
/* } catch (PDOException $e) { */
/*     print "Error!: " . $e->getMessage() . "<br/>"; */
/*     die(); */
/* } */

?>

