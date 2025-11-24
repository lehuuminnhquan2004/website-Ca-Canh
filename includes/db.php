<?php
$host = "localhost";
$user = "root";         
$pass = "";             
$dbname = "aquarium_db";

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Kết nối database thất bại: " . mysqli_connect_error());
}
mysqli_set_charset($conn, "utf8mb4");
