<?php

session_start();
include ('dbconn.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link rel="stylesheet" href="style.css" type="text/css" />

</head>
<body>

<h1>Group X Climate Crisis</h1>

<div class="topnav">
    <a class="active" href="climatehome.php">Home</a>
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

<?php if(isset($_SESSION['logged_in_name']) ) {
    echo "<h2>Hello, ".$_SESSION['logged_in_name']."!</h2>"; ?>


<div class="content3">

<h3>
        Welcome to the Group X Climate Crisis Website.
    </h3>


    Welcome to our Web Applications Development group project on the climate emergency. On the website we have a <a href = "forum.php"><b>forum</b></a>, and various resources on climate
    change. The web technologies we used were HTML, CSS, JavaScript, PHP, RSS and MySQL. We hope the users of the website can engage in constructive conversation on how to alleviate the
    biggest threat to human civilisation, and learn how individual choices, and huge corporations affect the world we all inhabit.
    <br> <br>
    "Global warming is not only the number one environmental challenge we face today, but one of the most important issues facing all of humanity... We all have to do our part to raise awareness
    about global warming and the problems we as a people face in promoting a sustainable environmental future for our planet." - Leonardo DiCaprio
    <br><br>
    Our <a href = "about.php"><b>about</b></a> page gives a lot of information on Climate Change, while the <a href="stats.php"><b>stats</b></a> page presents various statistics on the
    state of the Earth and human activity.
    <br><br>
</div>

    <?php
}

else{

    ?>

<div class="content3">
    <h2>
        Welcome to the Group X Climate Crisis Website.
    </h2>

        <br>Welcome to our Web Applications Development group project on the climate emergency. On the website we have a <a href = "forum.php"><b>forum</b></a>, and various resources on climate
        change. The web technologies we used were HTML, CSS, JavaScript, PHP, RSS and MySQL. We hope the users of the website can engage in constructive conversation on how to alleviate the
        biggest threat to human civilisation, and learn how individual choices, and huge corporations affect the world we all inhabit.
        <br> <br>
        "Global warming is not only the number one environmental challenge we face today, but one of the most important issues facing all of humanity... We all have to do our part to raise awareness
        about global warming and the problems we as a people face in promoting a sustainable environmental future for our planet." - Leonardo DiCaprio
        <br><br>
        Our <a href = "about.php"><b>about</b></a> page gives a lot of information on Climate Change, while the <a href="stats.php"><b>stats</b></a> page presents various statistics on the
        state of the Earth and human activity.
        <br><br>
    In order to use the forum, please <a href="login.php"><b>log in</b></a>, or <a href="register.php"> <b>sign up!</b></a><br>

</div>

    <?php
}
?>

<br><div style="margin-left:0.5%" class="slideshow-container">

    <div class="mySlides fade">
        <img src="images/earth.jpg" alt="An image." style = "border: 3px solid white; width: 400px; height: 300px; align-content: center;">
    </div>

    <div class="mySlides fade">
        <img src="images/climatechange1.jpg" alt="An image." style = "border: 3px solid white; width: 400px; height: 300px; align-content: center;">
    </div>

    <div class="mySlides fade">
        <img src="images/climatechange3.jpg" alt="An image." style = "border: 3px solid white; width: 400px; height: 300px; align-content: center;">
    </div>
    <div class="mySlides fade">
        <img src="images/climatechane5.jpg" alt="An image." style = "border: 3px solid white; width: 400px; height: 300px; align-content: center;">
    </div>
    <div class="mySlides fade">
        <img src="images/climatechange2.png" alt="An image." style = "border: 3px solid white; width: 400px; height: 300px; align-content: center;">
    </div>
    <div class="mySlides fade">
        <img src="images/climatechange4.jpg" alt="An image." style = "border: 3px solid white; width: 400px; height: 300px; align-content: center;">
    </div>

</div>



<script>
    var slideIndex = 0;
    showSlides();

    function showSlides() {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > slides.length) {slideIndex = 1}
        slides[slideIndex-1].style.display = "block";
        setTimeout(showSlides, 5000);
    }
</script>
<br><br><br>
<footer>
    © 2019 Group X | CS312 | University of Strathclyde
</footer>
</body>
</html>

