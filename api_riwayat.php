<?php
header("Content-Type: application/json");
include 'koneksi.php';
include 'cek_token.php';

// Validasi Token: Jika token salah, script langsung berhenti di sini
validasi_bearer_token($conn);

// Jika lolos, ambil data dari tabel Transaksi
$query = mysqli_query($conn, "SELECT * FROM Transaksi ORDER BY id_transaksi DESC");
$data_transaksi = [];

while($row = mysqli_fetch_assoc($query)){
    $data_transaksi[] = $row;
}

echo json_encode([
    "status" => "sukses",
    "pesan" => "Data transaksi berhasil diambil",
    "data" => $data_transaksi
]);
?>