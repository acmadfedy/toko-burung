<?php
session_start();
$id_burung = $_GET['id'];

// Menghapus item berdasarkan ID yang dikirim
unset($_SESSION['keranjang'][$id_burung]);

echo "<script>alert('Produk dihapus dari keranjang'); window.location='keranjang.php';</script>";
?>