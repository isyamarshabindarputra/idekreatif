<?php
// test
$host ="localhost";
$username = "root";
$password ="";
$database="idekreatif";

$conn = mysqli_connect($host, $username, $password, $database);

if ($conn->connect_error) {
    die ("Databaese gagal terkoneksi :" . $conn->connect_error);
    
}