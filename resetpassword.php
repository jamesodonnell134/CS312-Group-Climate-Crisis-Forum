<?php
session_start();

include ('dbconn.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password</title>
    <link rel="stylesheet" href="style.css" type="text/css" />
    <script src="js_scripts.js"></script>

</head>
<body>

<script>

    function validateForm() {

        var password = document.forms["newpass"]["newpassword"];
        var repassword = document.forms["newpass"]["newrepassword"];

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

<div style = "margin-bottom: 100px;" class = "logincont">

<h2>Enter your unique code:</h2>
<br>

<form method="post" name="update">
    <input type="hidden" name="action" value="update" />
    <label>Code: </label>
    <input type="text" name="code" required />
    <br>
    <br>
    <input style="margin-top:  10px;" type="submit" value="Submit Code" name="update" />
</form>
<br>



<?php
if(isset($_POST['update']) && !empty($_POST['update'])) {

    if(!empty($_GET['email'])) {

        $email = mysqli_real_escape_string($conn, $_GET['email']);
        $code = mysqli_real_escape_string($conn, $_POST['code']);

        $sql = "SELECT * FROM `password_resets` WHERE email = '$email' AND code = '$code'";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);

        if ($count == 1) {
            echo "<br><br><p><strong>Code confirmed!</strong></p><br>";

            ?>

            <h3>Enter and confirm your new password:</h3>
            <br>

            <form action="passwordupdated.php" method="post" name="newpass" onsubmit="return validateForm();">
                <input type="hidden" name="action" value="update" />
                <label>&#x1F4E7; Password: </label>
                <input type="password" name="newpassword" required="required">
                <br>
                <br>
                <label>&#x1f512; Re-Password: </label>
                <input type="password" name="newrepassword" required="required">
                <br>
                <br>
                <input type="hidden" id="email" name="emailtoupdate" value="<?php echo $email; ?>">
                <input style="margin-bottom:  50px; margin-top:  10px;" type="submit" value="Reset Password" name="newpass" />

            </form>

            <?php
        } else {
            echo "<br><br><p><strong>Incorrect code!</strong></p><br>";
        }

    }

    else{
        echo "<br><br>No email provided by link!<br>";
    }

}

?>
</div>
<footer>
    © 2019 Group X | CS312 | University of Strathclyde
</footer>


</body>
</html>






