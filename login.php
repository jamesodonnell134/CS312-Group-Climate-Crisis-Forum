<?php
session_start();

include ('dbconn.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="style.css" type="text/css" />
    <script src="js_scripts.js"></script>

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
            echo "<a class = 'active' href='login.php'>Login</a>";}?>

        <?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 1){
            echo "<a href='myaccount.php?page=1'>My Account</a>";
            echo "<a href='logged_out.php'>Logout</a>";}?>
    </div>
</div>

<div style="margin-bottom: 100px;" class = "logincont">
<h2>
    This is the login page!
</h2>

<h4>
    Please enter the required details to login!
</h4>

<script>
    function validateForm() {

        var password = document.forms["loginForm"]["pass"];
        var errs = "";

        password.style.background = "white";

        if ((password.value.length < 6)) {
            errs += "  *Password must not be less than 6 characters\n";
            password.style.background = "pink";
        }

        if (errs != "") {
            alert("Sorry. The following errors need to be corrected: \n\n" + errs);
        }

        return (errs == "");
    }
</script>

<p style="margin-top:10px;">Not registered yet? Sign up <a href="register.php"><b>here</b></a></p>


<form name="loginForm" method="post" action="login.php" onsubmit="return validateForm();">
    <label>&#x1F4E7; E-mail: </label>
    <input type="email" name="email" required="required">
    <br>
    <br>
    <label>&#x1f512; Password: </label>
    <input id="pwd" type="password" name="pass" required="required">
    <input type="checkbox" onclick="togglePassVis1()"> Show Password
    <br><br>
    <p style="margin-top:50px;">Forgotten your password? <a href="forgottenpassword.php"><b>Reset</b></a> it here.</p>
    <input style="font-weight: bold; margin-bottom: 100px; margin-top: 20px" type="submit" name="login" value="Login">
</form>

</div><br>

<?php

if(isset($_POST['login'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['pass']);


    $sql = "SELECT * FROM `users` WHERE `email` = '$email' ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $passwordCorrect = password_verify($pass, $row['pass']);

    if ($passwordCorrect == 1) {
        echo "<script type='text/javascript'>alert('Login verified!'); window.location = 'forum.php';</script>";
        session_start();
        $_SESSION['logged_in'] = 1;
        $_SESSION['logged_in_email'] = $email;
        $_SESSION['logged_in_name'] = $row['username'];
        $_SESSION['user'] = $row['id'];
        $_GET['usr'] = $_SESSION['logged_in_name'];

    }

    if($passwordCorrect !== 1) {
        echo "<script type='text/javascript'>alert('Login credentials invalid. Please try again.')</script>";
    }
}
?>

<footer>
    © 2019 Group X | CS312 | University of Strathclyde
</footer>


</body>
</html>






