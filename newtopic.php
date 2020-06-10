<?php
session_start();
include 'dbconn.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Topic</title>
    <link rel="stylesheet" href="style.css" type="text/css" />
    <script src="myscripts.js"></script>
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
    echo "<h2>Please login to add a new topic!</h2>";
    echo "<p style=\"margin-top:10px;\">Sign in to your account <a href=\"login.php\"><b>here!</b></a></p>";
}

else{

$cid = 0;
$scid = 0;
if(isset($_GET['scid']) && isset($_GET['cid'])) {
    $scid = $_GET['scid'];
    $cid = $_GET['cid'];
}

$sql = "SELECT * FROM subcategories WHERE parent_id = '$cid' AND subcat_id = '$scid'";
$query = mysqli_query($conn, $sql);
$count = mysqli_num_rows($query);

if ($count == 0) {
    echo "<h2> This topic does not exist in our database! </h2>";
} else {


    ?>


<h2>
    Add new discussion topic:
</h2>


<?php

    $cid = $_GET['cid'];
    $scid = $_GET['scid'];

    showCatSub($_GET['cid'], $_GET['scid']);
    echo "<button class = 'button' onclick=\"window.location.href = 'topics.php?cid=".$cid."&scid=".$scid."';\"><b>&laquo; Topics</b></button><br>";

    echo "
<div style = 'margin-bottom: 100px;' class=\"content\">
<form name = 'newtopic' action='addnewtopic.php?cid=" . $_GET['cid'] . "&scid=" . $_GET['scid'] . "' method = 'POST' onsubmit='return validateForm2();'>
<label>Title: </label>
<input type='text' id='topic' name='topic' size='100' />
<br><p style = 'margin-top: 50px;'> <b>Note:</b> Topic length must be no greater than 50 characters!</p><br>
<label>Content: </label>
<textarea id='content' name='content'></textarea>
<p><b>Note:</b> Content length must be no greater than 1500 characters!</p>
<br/>
<input type='submit' value='Submit New Post' /></form> </div>";


}
}
?>

<footer>
    © 2019 Group X | CS312 | University of Strathclyde
</footer>


</body>
</html>
