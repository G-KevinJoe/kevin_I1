<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kevin_i1";


$conn = new mysqli($servername, $username, $password, $dbname);

if (!$conn) {
    echo "Connection failed: ";
}
else {
    echo "Connected successfully";
}
?>