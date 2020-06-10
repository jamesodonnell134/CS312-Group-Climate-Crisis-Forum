<?php

session_start();
include ('dbconn.php');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Account</title>
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
        <?php if(!isset($_SESSION['logged_in'])){
            echo "<a href='login.php'>Login</a>";}?>

        <?php if(isset($_SESSION['logged_in_name'])){
            echo "<a class = \"active\" href='myaccount.php?page=1'>My Account</a>";
            echo "<a href='logged_out.php'>Logout</a>";
        }?>
    </div>
</div>

<?php

if (!isset($_SESSION['logged_in_name'])) {
    echo "<h2>Please login to view your account!</h2>";
    echo "<p style=\"margin-top:10px;\">Sign in to your account <a href=\"login.php\"><b>here!</b></a></p>";
}

else{
        echo "<h2>Hello, ".$_SESSION['logged_in_name']."!</h2>";

if(isset($_POST['submit'])){
    $bio = $_POST['bio'];
    $bio = htmlentities($bio);
    $nick = $_POST['nick'];
    $nick = htmlentities($nick);
    $country = $_POST['country'];
    $country = htmlentities($country);
    $profession = $_POST['profession'];
    $profession = htmlentities($profession);
    $forename = $_POST['forename'];
    $forename = htmlentities($forename);
    $surname = mysqli_real_escape_string($conn, $_POST['surname']);
    $surname = htmlentities($surname);
    $userID = $_SESSION['user'];

    $msg=' ';
    $target_dir="images/";
    $target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);
    $upOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if(isset($_POST["submit"]) && !empty($_FILES["fileToUpload"]["name"])){
        $allowTypes = array('jpg','png','jpeg','gif','pdf');
        if(in_array($imageFileType, $allowTypes)){
            if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)){
                $insert = $conn->query("UPDATE users SET photograph='$target_file' WHERE id='$userID'");
                if($insert){
                    $msg = "The file ".$target_file. " has been uploaded successfully.";
                }else{
                    $msg = "File upload failed, please try again.";
                }
            }
            else{
                $msg="Error uploading file.";
            }
        }
        else {
            $msg = "File formatted not allowed.";
        }
    }
    else{
        $msg="Select a file to upload";
    }

    echo $msg;


    $query = "UPDATE users SET biography='$bio', country='$country', profession='$profession', forename = '$forename', surname = '$surname', nickname='$nick' WHERE id='$userID'";
    if ($conn->query($query) === TRUE) {
        echo "<div style='color: green;'>Record updated successfully<br></div>";
    } else {
        echo "<div> style='color: red;'>Error updating record: " . $conn->error . "<br></div>";
    }
}


    $userID = $_SESSION['user'];
    $query = "SELECT * FROM users WHERE id = '$userID'";
    $result = mysqli_query($conn,$query);
    $row = mysqli_fetch_array($result);
    $username=mysqli_real_escape_string($conn, $row['username']);
    $email=mysqli_real_escape_string($conn, $row['email']);
    $bio=mysqli_real_escape_string($conn, $row['biography']);
    $nick=mysqli_real_escape_string($conn, $row['nickname']);
    $country=mysqli_real_escape_string($conn, $row['country']);
    $profession=mysqli_real_escape_string($conn, $row['profession']);
    $forename = mysqli_real_escape_string($conn, $row['forename']);
    $surname = mysqli_real_escape_string($conn, $row['surname']);
    $image = $row['photograph'];
    if (empty($image)) {
        $image = "images/personicon.png";
    }


    $query = "SELECT * FROM topics WHERE author= '$username'";
    $result = mysqli_query($conn, $query);
    $posts =  mysqli_num_rows($result);

    $query = "SELECT * FROM replies WHERE author= '$username'";
    $result = mysqli_query($conn, $query);
    $replies =  mysqli_num_rows($result);


    ?>
    <div style = "min-width: 400px" class="content">
        <table id="myacc">
            <tr><th class="la">Photo ID:</th><td class="ma"><img src="<?php echo $image; ?>" alt="Profile Picture" width="100" height="100"/></td></tr>
            <tr><th class="la">Username:</th><td class="ma"><?php echo stripslashes($username); ?></td></tr>
            <tr><th class="la">Email Address:</th><td class="ma"><?php echo stripslashes($email); ?></td></tr>
            <tr><th class="la">About Me:</th><td class="ma"><?php echo stripslashes($bio); ?></td></tr>
            <tr><th class="la">Country:</th><td class="ma"><?php echo stripslashes($country); ?></td></tr>
            <tr><th class="la">Nickname:</th><td class="ma"><?php echo stripslashes($nick); ?></td></tr>
            <tr><th class="la">Profession:</th><td class="ma"><?php echo stripslashes($profession); ?></td></tr>
            <tr><th class="la">Forename:</th><td class="ma"><?php echo stripslashes($forename); ?></td></tr>
            <tr><th class="la">Surname:</th><td class="ma"><?php echo  stripslashes($surname); ?></td></tr>
            <tr><th class="la">Number of Posts:</th><td class="ma"><?php echo $posts; ?></td></tr>
            <tr><th class="la">Number of Replies:</th><td class="ma"><?php echo $replies; ?></td></tr>

        </table>
        <form action="editAccount.php">
            <input type="submit" value="Edit Account">
        </form>
    </div>

    <?php
}

if(isset($username)){
?>

<div style="margin-bottom: 100px; margin-left: 5px;" class = "content">
    <?php
    $query = "SELECT * FROM topics WHERE author= '$username'";
    $result = mysqli_query($conn, $query);
    $numRows =  mysqli_num_rows($result);
    $topicID = array();
    $catID = array();
    $subCatID = array();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            array_push($topicID, $row['topic_id']);
            array_push($catID, $row['category_id']);
            array_push($subCatID, $row['subcategory_id']);
        }
    }
    ?>


    <?php

    if($_GET["page"]>$numRows || $_GET["page"]==0){
    if($numRows!=0){
    ?><meta http-equiv="refresh" content="0; URL='myaccount.php?page=1'"/></div>
<?php
}
}

if($numRows==0){
    echo "You currently do not have any posts!";
}else{
    if(isset($_GET["page"])){
        $page=$_GET["page"];
    } else{
        $page=1;
    }

    if($_GET["page"]<=$numRows && is_numeric($_GET["page"])){
        $rpp=1;
        include('dataFunc.php');
        $temp=$_GET["page"]-1;
        echo "<b>Number of Replies:</b> ".countReplies($catID[$temp], $subCatID[$temp], $topicID[$temp])."<br>";
        echo "<button style = 'margin-right: 10px;' onclick = \"location.href='readtopic.php?cid=".$catID[$temp]."&scid=".$subCatID[$temp]."&tid=".$topicID[$temp]."'\"type=\"button\">Read Post</button>";

        repLink($catID[$temp], $subCatID[$temp], $topicID[$temp]);
        echo "<br>";
        showTopic($catID[$temp], $subCatID[$temp], $topicID[$temp]);


        $numRows=ceil($numRows/$rpp);
        for ($i=1; $i<=$numRows; $i++) {
            echo "<a href='myaccount.php?page=".$i."'";
            if ($i==$page)  echo " class='curPage'";
            echo ">".$i."</a> ";
        };
    }
    else{
        echo "nothing to see here..";
    }
}}


?>

<footer>
    © 2019 Group X | CS312 | University of Strathclyde
</footer>

</body>
</html>
