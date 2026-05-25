<?php
session_start();
include 'koneksi.php';

// Simulasi ID Pelanggan (Anggap saja pelanggan nomor 1 yang login)
$id_pelanggan = 1; 
$tgl_transaksi = date("Y-m-d");
$total_final = 0;

// 1. Hitung total dulu
foreach($_SESSION['keranjang'] as $id_burung => $jumlah){
    $res = mysqli_query($conn, "SELECT harga FROM Burung WHERE id_burung='$id_burung'");
    $pecah = mysqli_fetch_assoc($res);
    $total_final += ($pecah['harga'] * $jumlah);
}

// 2. Masukkan ke tabel Transaksi (Header)
mysqli_query($conn, "INSERT INTO Transaksi (id_pelanggan, tanggal_transaksi, total_harga) 
                    VALUES ('$id_pelanggan', '$tgl_transaksi', '$total_final')");

$id_transaksi_barusan = mysqli_insert_id($conn); // Ambil ID transaksi yang baru saja terjadi

// 3. Masukkan ke tabel Detail_Transaksi & Kurangi Stok
foreach($_SESSION['keranjang'] as $id_burung => $jumlah){
    $res = mysqli_query($conn, "SELECT harga FROM Burung WHERE id_burung='$id_burung'");
    $pecah = mysqli_fetch_assoc($res);
    $subtotal = $pecah['harga'] * $jumlah;

    // Simpan detail
    mysqli_query($conn, "INSERT INTO Detail_Transaksi (id_transaksi, id_burung, jumlah, subtotal) 
                        VALUES ('$id_transaksi_barusan', '$id_burung', '$jumlah', '$subtotal')");

    // Potong stok burung
    mysqli_query($conn, "UPDATE Burung SET stok = stok - $jumlah WHERE id_burung = '$id_burung'");
}

// 4. Kosongkan keranjang
unset($_SESSION['keranjang']);

echo "<script>alert('Transaksi Berhasil! Stok telah diperbarui.'); window.location='index.php';</script>";
?>