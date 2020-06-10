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
            echo "<a href='login.php'>Login</a>";}?>

        <?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 1){
            echo "<a href='myaccount.php?page=1'>My Account</a>";
            echo "<a href='logged_out.php'>Logout</a>";

        }?>
    </div>
</div>

<div style = "margin-bottom: 100px;" class = "logincont">

<h2>
    This is the registration page!
</h2>
<h4>
    Please enter the required details to register!
</h4>

<script>
    function validateForm() {

        var username = document.forms["registration"]["username"];
        var email = document.forms["registration"]["email"];
        var password = document.forms["registration"]["password"];
        var repassword = document.forms["registration"]["repassword"];

        var errs = "";

        username.style.background = "white";
        email.style.background = "white";
        password.style.background = "white";
        repassword.style.background = "white";

        if ((username.value.length <= 2)) {
            errs += "  *Username must be greater than 2 characters\n";
            username.style.background = "pink";
        }
        if ((username.value.length > 16)) {
            errs += "  *Username must be no greater than 16 characters\n";
            username.style.background = "pink";
        }
        if (!isNaN(username.value)) {
            errs += "  *Username must not be numeric\n";
            username.style.background = "pink";
        }

        if ((password.value.length < 6) || (password.value.length > 16)) {
            errs += "  *Password must be between 6 and 16 characters\n";
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

<p style="margin-top:10px;">Already registered? Sign in <a href="login.php"><b>here</b></a></p>


<form action="action_page.php" name="registration" method="post" onsubmit="return validateForm();">
    <label>&#x270E; Username: </label>
    <input type="text" name="username" pattern="^\S+$" oninvalid="setCustomValidity('Username must contain no spaces!')" onchange="try{setCustomValidity('')}catch(e){}" required="required">
    <br>
    <br>
    <label>&#x1F4E7; E-mail: </label>
    <input type="email" name="email" required="required">
    <br>
    <br>
    <label>&#x1f512; Password: </label>
    <input id="pwd" type="password" name="password" required="required" onblur="check()">
    <br>
    <br>
    <label>&#x1f512; Re-Password: </label>
    <input id="pwdc" type="password" name="repassword" required="required" onblur="check()">
    <input type="checkbox" onclick="togglePassVis2()"> Show Passwords
    <br>
    <br>
    <div id="message"></div>
    <br>
    <input style="font-weight: bold; margin-bottom: 100px; margin-top: 20px" type="submit" name="order" value="Create Account">
</form>

</div>

<footer>
    © 2019 Group X | CS312 | University of Strathclyde
</footer>

</body>
</html>






