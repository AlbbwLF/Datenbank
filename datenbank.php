<?php 
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "randomtables";

//Creating connection
$conn = mysqli_connect($localhost, $username, $password, $randomtables);

//Check connection
if(!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?>