<?php
header("Content-Type: application/json");
include 'koneksi.php';
include 'cek_token.php';

// Validasi Token: Wajib menyertakan token permanen yang benar
validasi_bearer_token($conn);

// Hitung statistik dari database
$q_pendapatan = mysqli_query($conn, "SELECT SUM(total_harga) as total FROM Transaksi");
$r_pendapatan = mysqli_fetch_assoc($q_pendapatan);

$q_terjual = mysqli_query($conn, "SELECT SUM(jumlah) as total_burung FROM Detail_Transaksi");
$r_terjual = mysqli_fetch_assoc($q_terjual);

echo json_encode([
    "status" => "sukses",
    "pesan" => "Data statistik berhasil dihitung",
    "statistik" => [
        "total_pendapatan" => (int)($r_pendapatan['total'] ?? 0),
        "total_burung_terjual" => (int)($r_terjual['total_burung'] ?? 0)
    ]
]);
?>