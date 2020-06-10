<!DOCTYPE html>
<html lang="en">
<head>
<?php
session_start();

include ('dbconn.php');
include ('dataFunc.php');


?>


        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Reply to Post</title>
        <link rel="stylesheet" href="style.css" type="text/css" />

    </head>

    <body>

    <h1>Group X Climate Crisis</h1>

    <div class="topnav">
        <a href="climatehome.php">Home</a>
        <a class = "active" href="forum.php">Forum</a>
        <a href="topposts.php">Top Posts</a>
        <a href="about.php">About</a>
        <a href="stats.php">Statistics</a>
        <div class="login-container">
            <?php if(!isset($_SESSION['logged_in'])){
                echo "<a href='login.php'>Login</a>";}?>

            <?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 1){
                echo "<a href='myaccount.php'>My Account</a>";
                echo "<a href='logged_out.php'>Logout</a>";}?>
        </div>
    </div>
    <?php

        if( !isset($_SESSION['logged_in_name']) ) {
            echo "<h2>Please login to reply to a post!</h2>";
            echo "<p style=\"margin-top:10px;\">Sign in to your account <a href=\"login.php\"><b>here!</b></a></p>";
        }

        else{

            if(isset($_POST['comment'])) {

                $res = mysqli_query($conn, "SELECT * FROM users WHERE id=" . $_SESSION['user'])
                or die("Error: " . mysqli_error($conn));
                $userRow = mysqli_fetch_array($res);

                $comment = addslashes($_POST['comment']);
                $comment = htmlentities($comment);
                $cid = $_GET['cid'];
                $scid = $_GET['scid'];
                $tid = $_GET['tid'];
                $usr = $_SESSION['logged_in_name'];
                $usr = mysqli_real_escape_string($conn, $usr);
                $date = date("Y-m-d");


                $rep  = "INSERT INTO `replies` (`category_id`, `subcategory_id`, `topic_id`, `author`, `comment`, `date_posted`) VALUES ('$cid', '$scid', '$tid', '$usr', '$comment', '$date')";

                if (mysqli_query($conn, $rep)) {
                    echo "success!";
                    submitReply($tid);
                    header("Location: readtopic.php?cid=" . $cid . "&scid=" . $scid . "&tid=" . $tid . "");

                } else {
                    echo "<h2>Problem with submitting your reply! :(</h2>";

                }

                ?>


                <?php
            }
    }
    ?>


    <footer>
        © 2019 Group X | CS312 | University of Strathclyde
    </footer>

    </body>

    </html>

