<?php
// test
$host ="localhot";
$username = "root";
$password ="";
$database="idekreatif";

$conn = mysqli_connect($host,$username,$password,$database);

if ($conn->connection_error){
    die ("Databaese gagal terkoneksi :".$conn->connection_error);
    
}