<?php
header("Content-Type: application/json");
include 'koneksi.php';
include 'cek_token.php'; // Panggil file penjaga gerbang

// WAJIB: Jalankan fungsi validasi sebelum memproses data database
validasi_bearer_token($conn);

// ---------- Jika lolos validasi, kode di bawah ini akan dieksekusi ----------

$query = mysqli_query($conn, "SELECT * FROM Burung ORDER BY id_burung DESC");
$data_burung = [];

while($row = mysqli_fetch_assoc($query)){
    $data_burung[] = $row;
}

echo json_encode([
    "status" => "sukses",
    "pesan" => "Data burung berhasil diambil",
    "data" => $data_burung
]);
?>