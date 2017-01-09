<?php
 session_start();
 $session_id = $_SESSION['session_id'];
  $session_username = $_SESSION['session_username'];
 if(($_SERVER['REQUEST_URI']==='/index.php' || $_SERVER['REQUEST_URI']==='/registration.php') &&
     $session_id && $session_id){
               header("Location: https://{$_SERVER['HTTP_HOST']}/search.php");
                     return;

}
if($_SERVER['REQUEST_URI']==='/submission.php' && !isset($_SESSION['session_id']) && !isset($_SESSION['session_username'])){
         header("Location: https://{$_SERVER['HTTP_HOST']}/index.php");
              return;

}
?>
<!--Menu used on all pages, imported with include-->
<div class="row">
 <ul style="padding-left:15px;">
    <!--defines an unordered list-->
    <!--Links to options in navigation bar-->
    <!-- li defines a list item to be used for the navigation bar -->
 <?php
        if(!isset($_SESSION['session_id']) && !isset($_SESSION['session_username'])){
    ?>
        <li><a href="index.php" class= "<?php if($_SERVER['REQUEST_URI']==='/login.php'){ echo 'active-link';  }?>">Login</a></li>

        <li><a href="registration.php" class= "<?php if($_SERVER['REQUEST_URI']==='/registration.php'){ echo 'active-link';  }?>">Register</a></li>
<?php
                    }
        else{
                ?>

                    <li><a href="logout.php" class= "<?php if($_SERVER['REQUEST_URI']==='/logout.php'){ echo 'active-link';  }?>"><?php echo $session_username;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Logout</a></li>


    <?php
        }
    ?>


    <li><a href="submission.php">Add Restaurant</a></li>

    <li><a href="search.php">Search</a></li>

  </ul>
</div>

