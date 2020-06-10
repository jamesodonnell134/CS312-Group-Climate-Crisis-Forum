<?php
ob_start();
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Topics</title>
    <link rel="stylesheet" href="style.css" type="text/css" />
    <script src="js_scripts.js"></script>

</head>
<body>

<?php
include 'dbconn.php';
include ('dataFunc.php');
?>

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

$cid = 0;
$scid = 0;
if (isset($_GET['scid']) && isset($_GET['cid'])){
    $scid = $_GET['scid'];
    $cid = $_GET['cid'];
}

$sql = "SELECT * FROM subcategories WHERE parent_id = '$cid' AND subcat_id = '$scid'";
$query = mysqli_query($conn, $sql);
$count = mysqli_num_rows($query);

if($count == 0){
    echo "<h2> This topic does not exist in our database! </h2>";
}

else {

    ?>
    <h2>
        Topics:
    </h2>

    <?php
    if (isset($_GET['cid']) && isset($_GET['scid'])) {

        showCatSub($_GET['cid'], $_GET['scid']);

        echo "<button class = 'button' onclick=\"window.location.href = 'forum.php';\"><b>&laquo; Categories</b></button><br>";


        echo "<div class='content'><p><a href='newtopic.php?cid=" . $_GET['cid'] . "&scid=" . $_GET['scid'] . "'>
                              Add a new topic!</a></p></div>";

        echo "<div class='wrapper'>";

        echo "<div class='content'>";


        showTopics($_GET['cid'], $_GET['scid']);
    }
    else {
        echo "<p> Oh No! You haven't entered a valid subtopic and topic id! You should go back to the main forum pages and pick a thread from there. </p>";
    }

    echo "</div>";
    echo "</div>";

}
?>
<footer>
    © 2019 Group X | CS312 | University of Strathclyde
</footer>

</body>
</html>