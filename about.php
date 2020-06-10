<?php

session_start();
include ('dbconn.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About</title>
    <link rel="stylesheet" href="style.css" type="text/css" />

</head>

<h1>Group X Climate Crisis</h1>

<div class="topnav">
    <a href="climatehome.php">Home</a>
    <a href="forum.php">Forum</a>
    <a href="topposts.php">Top Posts</a>
    <a class="active" href="about.php">About</a>
    <a href="stats.php">Statistics</a>
    <div class="login-container">
        <?php if(!isset($_SESSION['logged_in'])){
            echo "<a href='login.php'>Login</a>";}?>

        <?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 1){
            echo "<a href='myaccount.php?page=1'>My Account</a>";
            echo "<a href='logged_out.php'>Logout</a>";}?>
    </div>
</div>

<h2>
About our planet's climate crisis!</h2>

<p>Let everyone know your stance on climate crisis by tweeting with the hashtag <b>#climatecrisis</b>!</p>

<a href="https://twitter.com/intent/tweet?button_hashtag=climatecrisis&ref_src=twsrc%5Etfw" class="twitter-hashtag-button" data-show-count="false">Tweet #climatecrisis</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>


<br>

<div class = "wrapper">

<div class = "content2">

    <h2>
        Where we are on Climate Change
    </h2>

<p>
    The overall scientific concensus on climate change is that it is <b>man-made</b> and <b>worsening.</b> Despite the massive increases and advancements
    in living standards and productivity since the spark of the industrial revolution, we have paid dearly by destroying the earth we inhabit. Pollution chokes us and nature, toxic
    run-offs in rivers poison ourselves and waterlife while plastics in the ocean suffocate and kill the countless endangered species in our seas and oceans.
    <br>
    <br>
    As much as individual changes, like using paper straws or recycling materials are important, we are at the point where only a complete retooling of society and the international
    economy will alleviate the climate emergency. The 100 most companies are responsible for <b>71%</b> of all global emissions since 1988, and half of all global industrial pollution
    is the responsibility of around 25 entities.<sup>[1]</sup> These 25 entities include private corporations like Exxon-Mobil or GazProm and state-owned companies like Saudi Aramco or the Chinese coal industry. Various industries are especially responsible for the
    decline in the cleanliness of our air and the state of our planet.<sup>[1]</sup>
    <br>
    <br>
    For example, one of the fastest growing sources of air pollution is through aviation. Practically all internal air traffic in the UK (i.e. from Glasgow to Heathrow) can be served by public
    transport, specifically trains, with the exception of tiny routes between the islands or from Scotland to Northern Ireland. Also, most inner-city and subarban to city road traffic could be replaced by other forms of public transport, like subways or buses. For short
    distances in built up areas, walking should be the primary option and public bikes could also be able to be hired on the street.
    <br>
    <br>
    Another example is the agricultural industry, especially the supply of cheap beef. A lot of the cheap beef you get in food around the world comes from ranches in what
    was the Amazon Rainforest. As ranchers have slashed and burned to clear arable land for ranches, the rainforest has decreased in size, and countless animals have suffered from
    a loss of habitat. The cows that now inhabit the land could be responsible for as much as 44% of the worlds methane production <sup>[2]</sup>, and the grazing stresses the arable soil, leading
    to erosion and compaction of the land. In human cost, the indigenous tribes that call the rainforest their home are being cast out and murdered by racist and uncaring ranchers, who
    simply want to exploit the land the indigenous call home.
</p>

</div><br>

<a class="twitter-timeline" href="https://twitter.com/unfccc?lang=en" data-tweet-limit="1" data-width="400" ></a>
<script async src="http://platform.twitter.com/widgets.js"></script>

<div class = "content2">

<h3>Pollution</h3>
<p>
    In the past ~30 years, Air Pollution in the UK has been steadily decreasing, although some work still has to be done. For example, the levels of Nitrogen Dioxide (NO<sub>2</sub>)
    have been decreasing across the country, with the roadside levels decreasing to an all time low in 2018 from when records began (1997). <sup>[3]</sup> However, most NO<sub>2</sub> pollution comes from
    engines that operate on diesel, like HGVs or diesel cars. NO<sub>2</sub> can lead to the inflamation of the airways and is generally toxic.
    <br>
    <br>
    In terms of CO<sub>2</sub> the levels in the UK are decreasing, but they are still at an unsafe level. In terms of tonnes of CO<sub>2</sub> per person, Scotland has an average
    of 5.3, while the Greater London region has 3.4.<sup>[4]</sup> It is thought of one the reasons that London has such low levels (the lowest in the UK) is that they have a strong public
    transport system in and out of the city, although Scotland is able to offset a large proportion of CO<sub>2</sub> emissions due to the large amount of land covered by forests
    out of the Central Belt. CO<sub>2</sub> is a greenhouse gas, which means it helps the atmosphere trap heat in the atmosphere, which then accumulates and contributes to the
    increasing atmospheric temperatures.
    <br>
    <br>
</p>

</div>

<div class = "content2">

<h3> Corporations and the Environment </h3>
<p>
    Some companies have pledged to reduce their environmental footprint in the past few years, as Climate Change has become a crisis. For example, around 100 large companies like
    IKEA or Apple have pledged to only use 100% renewable energy. However, some corporations have been aware of the effects of their business on the environment as early as decades
    ago and did (and still do) nothing. Exxon-Mobil, the oil and gas giant, knew about the effects of fossil fuels on climate change as early as 1977, and yet they lobbied heavily
    for climate science denying politicians for decades, just to defend their bottom line. Despite their being a scientific concensus on climate change, big oil continues to promote
    denial of the most grave situation facing the human species today, simply to continue the pursuit of profit. One of the greatest stumbling blocks in dealing with climate change
    is the modern worlds over reliance on fossil fuels. 
    <br>
    <br>
    Perhaps surprisingly, one of the most polluting and environmentally unfriendly corporations in the world is The Coca-Cola Company. Despite producing over 3 million tons of plastic a year, they do
    not support container deposit laws in the countries they operate, which would incentivise recycling their material. Meanwhile the factories that produce the sweet beverage use up
    a very high use of water, which can lead to wells in often incredibly poor communities drying up or becoming unfit for human consumption.
    <br>
     
</p>

<p>

</p>

</div>

<div class="content2">
    <p>
    Here is a video from popular scientist Bill Nye, on the climate emergency.
        <iframe style = " margin-left: 10px; margin-top: 15px;" width="560" height="300" src="https://www.youtube.com/embed/EtW2rrLHs08" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </p>

</div>


<div style="margin-bottom: 100px" class = "content2">

<h4> Sources </h4>
<p>
    [1] - <a href="https://www.theguardian.com/sustainable-business/2017/jul/10/100-fossil-fuel-companies-investors-responsible-71-global-emissions-cdp-study-climate-change">
    Just 100 companies responsible for 71% of global emissions, study says </a> <br>
    The Guardian - 10 July 2017 - Tess Riley <br>

    [2] - <a href = "http://www.fao.org/3/a-i3437e/index.html"> Tackling climate change through agriculture </a> <br>
    Food and Agriculture Orginisation of the UN - 2013 - P.J. Gerber et. al. <br>

    [3] - <a href = "https://assets.publishing.service.gov.uk/government/uploads/system/uploads/attachment_data/file/796887/Air_Quality_Statistics_in_the_UK_1987_to_2018.pdf"> Air Quality Statistics in the UK 1987 - 2018 </a> <br>
    DEFRA - 25 April 2019 <br>

    [4] - <a href = "https://assets.publishing.service.gov.uk/government/uploads/system/uploads/attachment_data/file/812134/2017_LA_CO2_emissions_stats_one_page_summary.pdf"> 2017 Local Authority CO<sub> 2 </sub> Emissions </a><br>
    Department for Business, Energy & Industrial Industry - 2017 <br>
</p>

</div>
</div>


<footer>
    © 2019 Group X | CS312 | University of Strathclyde
</footer>
</body>
</html>


