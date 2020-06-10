<?php
session_start();
include ('dbconn.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View User</title>
    <link rel="stylesheet" href="style.css" type = "text/css" />
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
            echo "<a href='myaccount.php?page=1'>My Account</a>";
            echo "<a href='logged_out.php'>Logout</a>";
        }?>
    </div>
</div>

<?php

if(isset($_GET['usr'])) {
    $usr = $_GET['usr'];

    $query = "SELECT * FROM users WHERE username = '$usr'";
    $res = mysqli_query($conn, $query);
    if (mysqli_num_rows($res) == 0) {
        echo "<h2>User does not exist!</h2>";
        echo "<h4>The user profile you have tried to access does not exist!</h4>";
    } else {

        if (isset($_SESSION['logged_in_name'])) {
            echo "<h2>Hello, " . $_SESSION['logged_in_name'] . "!</h2>";
            echo "<h3>Viewing " . $_GET['usr'] . "'s profile </h3>";

        } else {

            echo "<h2>View User</h2>";

        }


        $username = $_GET['usr'];

        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);
        $username = mysqli_real_escape_string($conn, $row['username']);
        $email = mysqli_real_escape_string($conn, $row['email']);
        $bio = mysqli_real_escape_string($conn, $row['biography']);
        $nick = mysqli_real_escape_string($conn, $row['nickname']);
        $country = mysqli_real_escape_string($conn, $row['country']);
        $profession = mysqli_real_escape_string($conn, $row['profession']);
        $forename = mysqli_real_escape_string($conn, $row['forename']);
        $surname = mysqli_real_escape_string($conn, $row['surname']);
        $image = $row['photograph'];
        if (empty($image)) {
            $image = "images/personicon.png";
        }

        $query = "SELECT * FROM topics WHERE author= '$username'";
        $result = mysqli_query($conn, $query);
        $posts = mysqli_num_rows($result);

        $query = "SELECT * FROM replies WHERE author= '$username'";
        $result = mysqli_query($conn, $query);
        $replies = mysqli_num_rows($result);

        ?>

        <div class="logincont">
            <table id="myacc">
                <tr>
                    <th class="la">Photo ID:</th>
                    <td class="ma"><img src="<?php echo $image; ?>" alt="" width="100" height="100"/></td>
                </tr>
                <tr>
                    <th class="la">Username:</th>
                    <td class="ma"><?php echo stripslashes($username); ?></td>
                </tr>
                <tr>
                    <th class="la">Email Address:</th>
                    <td class="ma"><?php echo stripslashes($email); ?></td>
                </tr>
                <tr>
                    <th class="la">About Me:</th>
                    <td class="ma"><?php echo stripslashes($bio); ?></td>
                </tr>
                <tr>
                    <th class="la">Country:</th>
                    <td class="ma"><?php echo stripslashes($country); ?></td>
                </tr>
                <tr>
                    <th class="la">Nickname:</th>
                    <td class="ma"><?php echo stripslashes($nick); ?></td>
                </tr>
                <tr>
                    <th class="la">Profession:</th>
                    <td class="ma"><?php echo stripslashes($profession); ?></td>
                </tr>
                <tr>
                    <th class="la">Forename:</th>
                    <td class="ma"><?php echo stripslashes($forename); ?></td>
                </tr>
                <tr>
                    <th class="la">Surname:</th>
                    <td class="ma"><?php echo stripslashes($surname); ?></td>
                </tr>
                <tr>
                    <th class="la">Number of Posts:</th>
                    <td class="ma"><?php echo $posts; ?></td>
                </tr>
                <tr>
                    <th class="la">Number of Replies:</th>
                    <td class="ma"><?php echo $replies; ?></td>
                </tr>
            </table>
        </div>


        <div style="margin-bottom: 100px; margin-left: 5px; " class="content">
        <?php
        $query = "SELECT * FROM topics WHERE author= '$username'";
        $result = mysqli_query($conn, $query);
        $numRows = mysqli_num_rows($result);
        $topicID = array();
        $catID = array();
        $subCatID = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($topicID, $row['topic_id']);
                array_push($catID, $row['category_id']);
                array_push($subCatID, $row['subcategory_id']);
            }
        }
        ?>


        <?php
        if ($_GET["page"] > $numRows || $_GET["page"] == 0) {
            if ($numRows != 0) {
                ?>
                <meta http-equiv="refresh" content="0; URL='viewuser.php?usr=<?php echo $username ?>&page=1'"/>
                <?php
            }
        }

        if ($numRows == 0) {
            echo "This user has no posts yet!";
        } else {
            if (isset($_GET["page"])) {
                $page = $_GET["page"];
            } else {
                $page = 1;
            }

            if ($_GET["page"] <= $numRows && is_numeric($_GET["page"])) {
                $rpp = 1;
                include('dataFunc.php');
                $temp = $_GET["page"] - 1;
                echo "<b>Number of Replies:</b> " . countReplies($catID[$temp], $subCatID[$temp], $topicID[$temp]) . "<br>";
                echo "<button onclick = \"location.href='readtopic.php?cid=" . $catID[$temp] . "&scid=" . $subCatID[$temp] . "&tid=" . $topicID[$temp] . "'\" type  = \"button\">Read Post</button>";

                repLink($catID[$temp], $subCatID[$temp], $topicID[$temp]);
                echo "<br>";
                showTopic($catID[$temp], $subCatID[$temp], $topicID[$temp]);


                $numRows = ceil($numRows / $rpp);
                for ($i = 1; $i <= $numRows; $i++) {
                    echo "<a href='viewuser.php?usr=" . $username . "&page=" . $i . "'";
                    if ($i == $page) echo " class='curPage'";
                    echo ">" . $i . "</a> ";
                };
            } else {
                echo "nothing to see here..";
            }
        }
    }
    ?>
    </div>
    <footer>
        © 2019 Group X | CS312 | University of Strathclyde
    </footer>

    <?php
}

else{
    echo "<h2>User does not exist!</h2>";
    echo "<h4>The user profile you have tried to access does not exist!</h4>";
}
?>

</body>

</html>

