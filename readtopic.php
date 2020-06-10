<?php
session_start();

include ('dbconn.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Read Topic</title>
    <link rel="stylesheet" href="style.css" type="text/css" />
<script src="js_scripts.js"></script>

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


echo "<h2>Read Topic:</h2>";

include ('dataFunc.php');

if(isset($_GET['scid']) && isset($_GET['cid'])) {
    $cid = $_GET['cid'];
    $scid = $_GET['scid'];
    showCatSub($_GET['cid'], $_GET['scid']);

    echo "<button class = 'button' onclick=\"window.location.href = 'topics.php?cid=" . $cid . "&scid=" . $scid . "';\"><b>&laquo; Topics</b></button><br>";

    repLink($_GET['cid'], $_GET['scid'], $_GET['tid']);
    echo "<br>";
    showTopic($_GET['cid'], $_GET['scid'], $_GET['tid']);

    echo "
<div style='margin-bottom: 100px;' class = 'content'>

<h3><b>All Replies (" . countReplies($_GET['cid'], $_GET['scid'], $_GET['tid']) . ")</b></h3>";


    showReplies($_GET['cid'], $_GET['scid'], $_GET['tid']);


    echo "</div>";
}
else{
    echo "<p> No such topic or subtopic exists! </p>";
}
?>

<footer>
    © 2019 Group X | CS312 | University of Strathclyde
</footer>

</body>

</html>