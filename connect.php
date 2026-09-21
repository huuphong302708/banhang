<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$servername = "localhost";
$username = "root"; 
$password = "";     
$dbname = "Bán Hàng";

$con = new mysqli($servername, $username, $password, $dbname);
$con->set_charset("utf8mb4");

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>