<?php
session_start();

include ('dbconn.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reply to Post</title>
    <link rel="stylesheet" href="style.css" type="text/css" />
    <script src="js_scripts.js"></script>

</head>

<body>
<?php
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

if( !isset($_SESSION['user']) ) {
    echo "<h2>Please login to reply to a post!</h2>";
    echo "<p style=\"margin-top:10px;\">Sign in to your account <a href=\"login.php\"><b>here!</b></a></p>";
}

else {

    echo "    <h2>Reply to Post:</h2>";

    $cid = $_GET['cid'];
    $scid = $_GET['scid'];
    $tid = $_GET['tid'];

    showCatSub($_GET['cid'], $_GET['scid']);
    echo "<button class = 'button' onclick=\"window.location.href = 'readtopic.php?cid=".$cid."&scid=".$scid."&tid=".$tid."';\"><b>&laquo; Back to Post</b></button><br>";
    repPost($_GET['cid'], $_GET['scid'], $_GET['tid']);

    ?>

    <div class="loginpane">

        </div>
        <div class="forumdesc">
        </div>

    <div style="margin-bottom: 100px;" class = "content">
        <h2><b><i>Original Post:</i></b></h2>
        <?php showTopic($_GET['cid'], $_GET['scid'], $_GET['tid']); ?>
    </div>

        <?php

        ?>
    </div><br>

    <?php
}
?>
<footer>
    © 2019 Group X | CS312 | University of Strathclyde
</footer>

</body>

</html>