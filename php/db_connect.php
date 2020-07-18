<?php 
$host = "localhost";
$username = "root";
$password = "74quA!Cc3E";
$dbname = "cr10_freinschlag_biglibrary";
$connect = new  mysqli($localhost, $username, $password, $dbname);
if($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}
?>