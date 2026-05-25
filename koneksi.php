<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_jual_burung";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi ke XAMPP gagal: " . mysqli_connect_error());
}
?>