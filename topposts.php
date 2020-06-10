<?php
session_start();
include ('dbconn.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Top Posts</title>
    <link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
<h1>Group X Climate Crisis</h1>

<div class="topnav">
    <a href="climatehome.php">Home</a>
    <a href="forum.php">Forum</a>
    <a class="active" href="topposts.php">Top Posts</a>
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

<?php if(isset($_SESSION['logged_in_name']) ) {
    echo "<h2>Hello, ".$_SESSION['logged_in_name']."! Have a look at some of our trending forum posts:</h2>";
}

else{

    echo "<h2>Welcome!</h2>";
}
?>

<?php
$post1 = 1;
$rep1 = 0;

$post2 = 1;
$rep2 = 0;

$post3 = 1;
$rep3 = 0;

$query = "SELECT * FROM topics";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_array($result);

while($row = mysqli_fetch_assoc($result))
{
    if($row['replies']>$rep1){
        $post3=$post2;
        $post2=$post1;
        $post1=$row['topic_id'];

        $rep3 = $rep2;
        $rep2 = $rep1;
        $rep1 = $row['replies'];
    }
    else if($row['replies']>$rep2){
        $post3=$post2;
        $post2=$row['topic_id'];

        $rep3 = $rep2;
        $rep2 = $row['replies'];
    }
    else if($row['replies']>$rep3){
        $post3=$row['topic_id'];

        $rep3 = $row['replies'];
    }
}


$query = "SELECT * FROM topics WHERE topic_id = '$post1'";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_array($result);
$cid1=$row['category_id'];
$scid1=$row['subcategory_id'];
$tid1=$row['topic_id'];

$query = "SELECT * FROM topics WHERE topic_id = '$post2'";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_array($result);
$cid2=$row['category_id'];
$scid2=$row['subcategory_id'];
$tid2=$row['topic_id'];

$query = "SELECT * FROM topics WHERE topic_id = '$post3'";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_array($result);
$cid3=$row['category_id'];
$scid3=$row['subcategory_id'];
$tid3=$row['topic_id'];
?>


<?php
include('dataFunc.php');

echo "<div class='wrapper'>";
echo "<div class = 'content'><h2><b>#1 Trending Post This Week:</b></h2>";
echo "<b>Number of Replies:</b> ".countReplies($cid1, $scid1, $tid1)."<br>";
echo "<button style = 'margin-right: 10px;' onclick = \"location.href='readtopic.php?cid=".$cid1."&scid=".$scid1."&tid=".$tid1."'\" type = \"button\">Read Post</button>";
repLink($cid1, $scid1, $tid1);

echo "<br>";
showTopic($cid1, $scid1, $tid1);

echo "</div>";


echo "<div class = 'content'><h2><b>#2 Trending Post This Week:</b></h2>";
echo "<b>Number of Replies:</b> ".countReplies($cid2, $scid2, $tid2)."<br>";
echo "<button style = 'margin-right: 10px;' onclick = \"location.href='readtopic.php?cid=".$cid2."&scid=".$scid2."&tid=".$tid2."'\" type = \"button\">Read Post</button>";
repLink($cid2, $scid2, $tid2);

echo "<br>";

showTopic($cid2, $scid2, $tid2);


echo "</div>";

echo "<div style=\"margin-bottom: 100px;\" class = \"content\">
<h2><b>#3 Trending Post This Week:</b></h2>";
echo "<b>Number of Replies:</b> ".countReplies($cid3, $scid3, $tid3)."<br>";
echo "<button style = 'margin-right: 10px;' onclick = \"location.href='readtopic.php?cid=".$cid3."&scid=".$scid3."&tid=".$tid3."'\" type = \"button\">Read Post</button>";
repLink($cid3, $scid3, $tid3);

echo "<br>";
showTopic($cid3, $scid3, $tid3);


echo "</div>";
echo "</div>";


?>

<footer>
    © 2019 Group X | CS312 | University of Strathclyde
</footer>

</body>
</html>