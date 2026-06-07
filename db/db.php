<?php
$host = 'localhost';
$user = 'estation_user';
$pass = 'estationconnect';
$dbname = 'estation';

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

