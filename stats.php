<?php

session_start();
include ('dbconn.php');

?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Statistics</title>
    <link rel="stylesheet" href="style.css" type="text/css" />
    <style>
        th{
            background-color: #414b9b;
            color: white;
        }
        td{
            background-color: whitesmoke;
            border-radius: 10px;

        }
        table{
            border: 1px solid black;
        }

    </style>
</head>
<body>

<h1>Group X Climate Crisis</h1>
<div class="topnav">
    <a href="climatehome.php">Home</a>
    <a href="forum.php">Forum</a>
    <a href="topposts.php">Top Posts</a>
    <a href="about.php">About</a>
    <a class="active" href="stats.php">Statistics</a>
    <div class="login-container">
        <?php if(!isset($_SESSION['logged_in'])){
            echo "<a href='login.php'>Login</a>";}?>

        <?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 1){
            echo "<a href='myaccount.php?page=1'>My Account</a>";
            echo "<a href='logged_out.php'>Logout</a>";}?>
    </div>
</div>
<h2>
    This is the statistics page!
</h2>
<p>
    The world is constantly changing, with the weather and other issues becoming increasingly unpredictable. Here is some auto-updating statistics on the conditions in Glasgow,
    including weather and traffic.
</p>

<div class = "wrapper">

<div class = "content2">

<h4>Weather in Glasgow</h4>


<p>
    Below is the latest observation for Glasgow, i.e. the live weather update.
</p>
<?php
    $obs_xml = "https://weather-broker-cdn.api.bbci.co.uk/en/observation/rss/2648579";

    $obs_rss = new DOMDocument($obs_xml);
    $obs_rss->load($obs_xml);

    $item = $obs_rss->getElementsByTagName('item')->item(0);
    $obser_title = $item->getElementsByTagName('title')->item(0)->childNodes->item(0)->nodeValue;
    $obser_link = $item->getElementsByTagName('link')->item(0)->childNodes->item(0)->nodeValue;
    $obser_desc = $item->getElementsByTagName('description')->item(0)->childNodes->item(0)->nodeValue;

    echo "<table style='align-content: center'><tr><th>".$obser_title."</th></tr><tr><td>".$obser_desc."</td></tr></table>";
?>

<p>
    Below is the <a href = "https://www.bbc.co.uk/weather/2648579">3-day forecast for Glasgow from BBC Weather </a>. The forecast includes temperatures, wind speeds etc., but also pollution
    levels and UV radiation forecasts.
</p>

<?php
    $xml = "https://weather-broker-cdn.api.bbci.co.uk/en/forecast/rss/3day/2648579";

    $rssDoc = new DOMDocument($xml);
    $rssDoc->load($xml);

    $chann = $rssDoc->getElementsByTagName('channel')->item(0);
    $chan_title = $rssDoc->getElementsByTagName('title')->item(0)->childNodes->item(0)->nodeValue;
    $weatherLink = $rssDoc->getElementsByTagName('link')->item(0)->childNodes->item(0)->nodeValue;
    $weatherDesc = $rssDoc->getElementsByTagName('description')->item(0)->childNodes->item(0)->nodeValue;

    echo "<br>";
    echo "<table>";
    echo "<tr><th>Day</th><th>Weather Forecast</th></tr>\n";

    $items = $rssDoc->getElementsByTagName('item');
    for($i=0; $i<3; $i++){
        $dayTitle = $items->item($i)->getElementsByTagName('title')->item(0)->childNodes->item(0)->nodeValue;
        $dayLink = $items->item($i)->getElementsByTagName('link')->item(0)->childNodes->item(0)->nodeValue;
        $dayWeather = $items->item($i)->getElementsByTagName('description')->item(0)->childNodes->item(0)->nodeValue;

        echo"<tr><td>".$dayTitle."</td><td>".$dayWeather."</td></tr> \n";

    }
    echo "</table>";

?>

</div>

<div class = "content2">
<h4> Traffic Congestion</h4>

<p>
    This is a live congestion map from Waze. You can use it to plan journeys in advance in order to miss traffic, roadworks and accidents. By planning
    your journey in order to reduce the amount of time your car is idling or stationary for, you can save a lot of fuel. By saving fuel, you reduce
    your carbon footprint in relation to driving, not to mention saving money as well!
    <br>
    <br>
    The map is centred on Richmond Street in Glasgow, but you can drag the map to any part of the world you like!
</p>

</div>
<p style = "margin-bottom: 100px;">
    <iframe src="https://embed.waze.com/iframe?zoom=16&lat=55.861575&lon=-4.245256&ct=livemap" style="height: 600px; width: 60%" allowfullscreen></iframe>
</p><br>

<p style = "margin-bottom: 100px"><b>Note:</b> Full screen feature does not work due to a problem with Waze's embed feature.</p>

</div>

<footer>
    © 2019 Group X | CS312 | University of Strathclyde
</footer>

</body>
</html>

