<?php
ob_start();
session_start();
include 'dbconn.php';

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Add New Topic</title>
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

if( !isset($_SESSION['user']) ) {
    echo "<h2>Please login to add a new topic!</h2>";
    echo "<p style=\"margin-top:10px;\">Sign in to your account <a href=\"login.php\"><b>here!</b></a></p>";
}
else {

// select loggedin users detail
    $res = mysqli_query($conn, "SELECT * FROM users WHERE id=" . $_SESSION['user']);
    $userRow = mysqli_fetch_array($res);


    $topic = addslashes($_POST['topic']);
    $topic = htmlentities($topic);
    $content = nl2br(addslashes($_POST['content']));
    $content = htmlentities($content);
    $cid = $_GET['cid'];
    $scid = $_GET['scid'];

    $insert = mysqli_query($conn, "INSERT INTO topics (`category_id`, `subcategory_id`, `author`, `title`, `content`, `date_posted`) 
								  VALUES ('" . $cid . "', '" . $scid . "', '" . $_SESSION['logged_in_name'] . "', '" . $topic . "', '" . $content . "', NOW());");

    if ($insert) {
        header("Location: topics.php?cid=" . $cid . "&scid=" . $scid . "");
    }

    else{

        echo "<h2>Problem with submitting your topic! :(</h2>";
    }

}
?>

<footer>
    © 2019 Group X | CS312 | University of Strathclyde
</footer>
</body>


</html>













