<?php
session_start();
include ('dbconn.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forum</title>
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
            echo "<a href='myaccount.php?page=1'>My Account</a>";
            echo "<a href='logged_out.php'>Logout</a>";}?>
    </div>
</div>


<?php

if(isset($_SESSION['logged_in_name']) ) {
    echo "<h2>Hello, ".$_SESSION['logged_in_name']."! Welcome to the forum!</h2>";
}

else{

    echo "<h2>Hello! Welcome to the forum!</h2>";
}
?>

    <br><li> Explore many topics related to our world's climate crisis! </li>
    <?php

    if(isset($_SESSION['logged_in_name']) ) {
        echo "    <li> Debate and discuss topics with other users on our site!</li>
    <li> Click on a <b>subcategory</b> to get started.</li>";
    }
    else{
        echo "
        
            <li><a href=\"login.php\"><b>Sign in </b></a>to debate and discuss topics with other users on our site!</li>
                <li>Click on a <b>subcategory</b> to get started.</li>

        ";

    }
    ?>


<h2>Categories</h2>
<?php 	include ('dataFunc.php');?>


<div style="margin-bottom: 100px;" class = "content">
 <?php showCategories(); ?> </div>

<footer>
    © 2019 Group X | CS312 | University of Strathclyde
</footer>
</body>
</html>

