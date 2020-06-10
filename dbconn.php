<?php

$host = "devweb2019.cis.strath.ac.uk";
$user = "cs312x";
$password = "veiH2eiNgahl";
$dbname = "cs312x";
$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); //
}