<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "placement_db";

// Connection create karna
$con = mysqli_connect($host, $username, $password, $database);

// Check connection
if(!$con)
{
    die("Connection Failed: " . mysqli_connect_error());
}
?>