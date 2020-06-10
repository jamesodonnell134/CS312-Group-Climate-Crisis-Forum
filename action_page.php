<?php
session_start();

include ('dbconn.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link rel="stylesheet" href="style.css" type="text/css" />

</head>
<body>

<h1>Group X Climate Crisis</h1>

<div class="topnav">
    <a href="climatehome.php">Home</a>
    <a class = "active" href="forum.php">Forum</a>
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



if(isset($_POST['order'])) {

    $username = $_POST["username"];
    $email = $_POST["email"];
    $pass = $_POST["password"];
    $repassword = $_POST["repassword"];

    $hashedPassword = password_hash($pass, PASSWORD_BCRYPT);
    $hashedRePassword = password_hash($repassword, PASSWORD_BCRYPT);
    $user_created = 0;

    $select = mysqli_query($conn, "SELECT `email` FROM `users` WHERE `email` = '$email'") or exit(mysqli_error($conn));
    if(mysqli_num_rows($select)) {
        echo "<br><button onclick=\"javascript:history.go(-1)\">&laquo; Back to Registration</button>    ";
        echo "<br><h2>Problem setting up your account! &#9785;</h2><br>";
        echo "Sorry. The email address entered is already taken! <br>";
        exit('Please go back and fill out the correct details.');
    }

    $select = mysqli_query($conn, "SELECT `username` FROM `users` WHERE `username` = '$username'") or exit(mysqli_error($conn));
    if(mysqli_num_rows($select)) {
        echo "<br><button onclick=\"javascript:history.go(-1)\">&laquo; Back to Registration</button>    ";
        echo "<br><h2>Problem setting up your account! &#9785;</h2><br>";
        echo "Sorry. The username entered is already taken! <br>";
        exit('Please go back and fill out the correct details.');
    }

    $usr  = "INSERT INTO users (username, email, pass) VALUES ('$username', '$email', '$hashedPassword')";

    if(mysqli_query($conn, $usr)){
        $user_created = TRUE;
    };


    if ($user_created) {

        //session_destroy();
        echo "<h2>Account created! &#9786;</h2><br>";
        echo "<p>Thank you for creating an account with us!</p>";
        echo "<p>You can now <a href=\"login.php\">login</a> to make posts!</p>";

    } else {
        echo "<h2>Problem creating your account! &#9785;</h2><br>";
        echo "<p>There has been an issue in making your account. Please try again later.</p>";
    }
}
?>

<footer>
    © 2019 Group X | CS312 | University of Strathclyde
</footer>
</body>
</html>






