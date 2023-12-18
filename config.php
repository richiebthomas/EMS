<?php
session_start();
$dbHost = "localhost";
$dbName = 'my_proj_db';
$dbUsername ='root';
$dbPassword ='root';

$conn = mysqli_connect($dbHost,$dbUsername,$dbPassword,$dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>