<?php 
$servername="localhost";
$username="guysW";
$password="guysWeb";
$dbname="web";

//Create Connection
$conn=new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>  