<?php
$host = "mysql_db";
$dbname = "booksite";
$user = "root";
$pass = "toor";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Conexiune esuata: " . $conn->connect_error);
}
?>