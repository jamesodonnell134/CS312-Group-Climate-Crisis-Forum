<?php
session_start();

include ('dbconn.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgotten Password</title>
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

<div class = logincont>

<h2>Password Reset</h2>
<br>

<p>Please enter the email address used to set up your account.</p>
<p>We will send you a password recovery email.</p>

<form class="login-form" method="post">
    <div class="form-group">
        <label>&#x1F4E7; Recovery e-mail:</label>
        <input type="email" name="email" required>
    </div>
    <div class="form-group">
        <br>
        <br>
        <button style="font-weight: bold; margin-bottom:  20px; margin-top:  10px;" type="submit" name="ForgotPassword">Submit</button>
    </div>
</form>


<?php
if(isset($_POST) && !empty($_POST)){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $sql = "SELECT * FROM `users` WHERE email = '$email'";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);

    if($count == 1){

        $code = substr(md5(uniqid(mt_rand(), true)) , 0, 8);
        $result = mysqli_query($conn,"SELECT * FROM password_resets WHERE email ='$email' ");

        if( mysqli_num_rows($result) > 0) {
            mysqli_query($conn, "UPDATE password_resets SET code = '$code' WHERE email = '$email' ");
        }
        else
        {
            mysqli_query($conn, "INSERT INTO password_resets (email, code) VALUES ('$email', '$code') ");
        }



        if (mysqli_query($conn, $sql)) {

            echo "<br>Sent recovery code to email " . $email . " to recover password.";

            if (($_POST["email"]) && !empty($_POST["email"])) {
                $receiver = "isb17184@uni.strath.ac.uk";
                $sender = $_POST['email'];
                $subject = "Forgot Password Recovery";
                $message1 = "Your unique code is: " . $code . ".";
                $message2 = "Hello!\r\nYou have requested to reset your password.\r\nFollow this link and enter the unique code to reset your password: https://devweb2019.cis.strath.ac.uk/cs312x/resetpassword.php?email=".$email."";

                $headers = "sender:" . $sender;
                $headers2 = "sender:" . $receiver;

                // Send e-mail
                mail($sender, $subject, $message1, $message2, $headers2);

            }
        }
    }
    else{
        echo "<br>Sorry! Email does not exist on our system!<br>";
    }
}

?>

</div>


<footer>
    © 2019 Group X | CS312 | University of Strathclyde
</footer>


</body>
</html>


