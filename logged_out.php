<?php
session_start();
session_destroy();

include ('dbconn.php');

?>



<!DOCTYPE html>
<html lang="EN">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Logged Out</title>
    <link rel="stylesheet" href="style.css" type="text/css" />

        <link rel="stylesheet" href="style.css" type="text/css" />

    </head>
    <body>

    <h1>Group X Climate Crisis</h1>

    <div class="topnav">
        <a href="climatehome.php">Home</a>
        <a href="forum.php">Forum</a>
        <a href="topposts.php">Top Posts</a>
        <a href="about.php">About</a>
        <a href="stats.php">Statistics</a>
        <div class="login-container">
            <a href='login.php'>Login</a>
        </div>
    </div>


    <?php

    echo "<h2>You have been logged out!</h2>";

    ?>


    <footer>
        © 2019 Group X | CS312 | University of Strathclyde
    </footer>

    </body>
    </html>








