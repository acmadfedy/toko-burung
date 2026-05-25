<?php
include 'koneksi.php';

$id = $_GET['id'];

// Hapus data berdasarkan ID
$hapus = mysqli_query($conn, "DELETE FROM Burung WHERE id_burung = '$id'");

if($hapus){
    echo "<script>alert('Data berhasil dihapus!'); window.location='index.php';</script>";
} else {
    echo "Gagal menghapus: " . mysqli_error($conn);
}
?>