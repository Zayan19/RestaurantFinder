<?php
    session_start();
    $session_id = $_SESSION['session_id'];
        $now = date("Y-m-d H:i:s",time());
        include 'server.php';
            echo $session_id;
            echo '<br/>';
                echo $now;
                $expired_time = $dbh->prepare("UPDATE `sessions` SET `expired_at`='$now' WHERE `session_ID`='$session_id'");
                    $expired_time->execute();
                    unset($_SESSION['session_id']);
                        unset($_SESSION['session_username']);
                        header("Location: https://{$_SERVER['HTTP_HOST']}/index.php");
?>
