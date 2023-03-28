<?php 
$servername="127.0.0.1";
$username="guysW";
$password="guysWeb";
$dbname="web";

//Create Connection
$con=new mysqli($servername, $username, $password, $dbname);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
