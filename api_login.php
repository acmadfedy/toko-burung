<?php
header("Content-Type: application/json");
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["status" => "gagal", "pesan" => "Method HTTP harus POST"]);
    exit;
}

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Cek username dan password
$query = mysqli_query($conn, "SELECT * FROM Users WHERE username='$username' AND password='$password'");
$user = mysqli_fetch_assoc($query);

if ($user) {
    // 🔍 KUNCI TOKEN PERMANEN: Cek apakah user sudah punya token di database
    if (!empty($user['token'])) {
        // Jika sudah ada, gunakan token yang sudah tersimpan (tidak diacak ulang)
        $token = $user['token'];
    } else {
        // Jika masih kosong (baru pertama kali login), buat baru
        $token = bin2hex(random_bytes(16));
        mysqli_query($conn, "UPDATE Users SET token='$token' WHERE id_user=" . $user['id_user']);
    }

    echo json_encode([
        "status" => "sukses",
        "pesan" => "Login berhasil (Token Permanen)",
        "token" => $token
    ]);
} else {
    http_response_code(401);
    echo json_encode([
        "status" => "gagal", 
        "pesan" => "Username atau password salah!"
    ]);
}
?>