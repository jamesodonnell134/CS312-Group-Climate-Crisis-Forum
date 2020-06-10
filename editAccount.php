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

    <script>
        function validateForm() {
            var bio = document.forms["editAcc"]["bio"];
            var country = document.forms["editAcc"]["country"];
            var nick = document.forms["editAcc"]["nick"];
            var profession = document.forms["editAcc"]["profession"];
            var forename = document.forms["editAcc"]["forename"];
            var surname = document.forms["editAcc"]["surname"];

            var errs = "";

            forename.style.background = "white";
            surname.style.background = "white";
            bio.style.background = "white";
            country.style.background = "white";
            profession.style.background = "white";
            nick.style.background = "white";

            if (bio.value.length > 128) {
                errs += "  *Bio must be no more than 128 chars!\n";
                bio.style.background = "pink";
            }

            if (hasNumber(nick.value) || nick.value.length > 12) {
                errs += "  *Nickname must be non-numeric and no more than 12 chars!\n";
                nick.style.background = "pink";
            }

            if (hasNumber(forename.value) ||forename.value.length > 16) {
                errs += "  *Forename must be non-numeric and no more than 16 chars!\n";
                forename.style.background = "pink";
            }
            if (hasNumber(surname.value) || surname.value.length > 16) {
                errs += "  *Surname must be non-numeric and no more than 16 chars!\n";
                surname.style.background = "pink";
            }
            if (hasNumber(country.value) || country.value.length > 16) {
                errs += "  *Country must be non-numeric and no more than 16 chars!\n";
                country.style.background = "pink";
            }
            if (profession.value.length > 32) {
                errs += "  *Profession must be no more than 32 chars!\n";
                profession.style.background = "pink";
            }

            if (errs != "") {
                alert("Sorry. The following errors need to be corrected: \n\n" + errs);
            }

            return (errs == "");
        }

        function hasNumber(myString) {
            return /\d/.test(myString);
        }

    </script>

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

else {

    echo "<h2>" . $_SESSION['logged_in_name'] . "'s Account</h2>";

    ?>

    <?php
    $userID = $_SESSION['user'];
    $query = "SELECT * FROM users WHERE id = '$userID'";
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
    ?>
    <div class="content">
        <p><strong>Username: </strong><?php echo stripslashes($username); ?></p>
        <p><strong>Email Address:</strong> <?php echo stripslashes($email); ?></p>
        <p><strong>*You cannot change these details.</strong></p>
    </div>

    <div style="margin-bottom: 100px;" class="content">
        <form action="myaccount.php?page=1" name="editAcc" method="post" enctype="multipart/form-data"
              onsubmit="return validateForm();">
            <label>Upload Image:</label><input type="file" name="fileToUpload" id="fileToUpload">
            <label>About Me: </label><input type="text" value="<?php echo stripslashes($bio); ?>" name="bio">
            <label>Country: </label><input type="text" value="<?php echo stripslashes($country); ?>" name="country">
            <label>Nickname: </label><input type="text" value="<?php echo stripslashes($nick); ?>" name="nick">
            <label>Profession: </label><input type="text" value="<?php echo stripslashes($profession); ?>"
                                              name="profession">
            <label>Forename: </label><input type="text" value="<?php echo stripslashes($forename); ?>" name="forename">
            <label>Surname: </label><input type="text" value="<?php echo stripslashes($surname); ?>" name="surname">
            <label>Update Details:</label><input type="submit" value="Update Details" name="submit">
        </form>
    </div>
    <br><br>

    <?php
}
?>
    <footer>
        © 2019 Group X | CS312 | University of Strathclyde
    </footer>


</body>
</html>


