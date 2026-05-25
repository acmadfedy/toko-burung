<?php
session_start();
$id_burung = $_GET['id'];

// Jika keranjang sudah ada, tambah jumlahnya. Jika belum, buat baru (1).
if(isset($_SESSION['keranjang'][$id_burung])){
    $_SESSION['keranjang'][$id_burung] += 1;
} else {
    $_SESSION['keranjang'][$id_burung] = 1;
}

echo "<script>alert('Burung telah dimasukkan ke keranjang'); window.location='index.php';</script>";
?>