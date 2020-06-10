<?php
session_start();

include ('dbconn.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Password Updated!</title>
    <link rel="stylesheet" href="style.css" type="text/css" />
    <script src="js_scripts.js"></script>

</head>
<body>

<script>
    function validateForm() {

        var password = document.forms["newpass"]["password"];
        var repassword = document.forms["newpass"]["repassword"];

        var errs = "";

        password.style.background = "white";
        repassword.style.background = "white";

        if ((password.value.length < 6)) {
            errs += "  *Password must not be less than 6 characters\n";
            password.style.background = "pink";
        }

        if ((repassword.value !== password.value)) {
            errs += "  *Passwords do not match\n";
            repassword.style.background = "pink";
        }

        if (errs != "") {
            alert("Sorry. The following errors need to be corrected: \n\n" + errs);
        }

        return (errs == "");
    }
</script>

<h1>Group X Climate Crisis</h1>

<div class="topnav">
    <a href="climatehome.php">Home</a>
    <a href="forum.php">Forum</a>
    <a href="topposts.php">Top Posts</a>
    <a href="about.php">About</a>
    <a href="stats.php">Statistics</a>
    <div class="login-container">
        <?php if(!isset($_SESSION['logged_in'])){
            echo "<a class = 'active' href='login.php'>Login</a>";}?>

        <?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 1){
            echo "<a href='myaccount.php?page=1'>My Account</a>";
            echo "<a href='logged_out.php'>Logout</a>";}?>
    </div>
</div>

<div class = "logincont">

<?php

if(isset($_POST['newpass']) && !empty($_POST['newpass'])) {

    $pass = mysqli_real_escape_string($conn, $_POST['newpassword']);
    $repassword = mysqli_real_escape_string($conn, $_POST['newrepassword']);
    $email = mysqli_real_escape_string($conn, $_POST['emailtoupdate']);
    $hashedPassword = password_hash($pass, PASSWORD_BCRYPT);

    $sql = "UPDATE `users` SET `pass` = '$hashedPassword'WHERE `email` = '$email';";
    if (mysqli_query($conn, $sql)) {

        echo "<h2>Password updated successfully!</h2><br>";
        echo "<p>You can now <a href='login.php'>login</a> to your account.</p>";

    }
    else {
        echo "<h2>Problem updating your password :(</h2><br>";
        echo "<p>Please try again later.</p>";
    }
}

?>

</div>

<footer>
    © 2019 Group X | CS312 | University of Strathclyde
</footer>


</body>

</html>






