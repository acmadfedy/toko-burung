<?php
function validasi_bearer_token($conn) {
    // Ambil semua header dari request client
    $headers = apache_request_headers();
    
    // Cari header bernama 'Authorization'
    $auth_header = $headers['Authorization'] ?? '';

    // Validasi 2: Cek format Bearer Token
    if (preg_match('/Bearer\s(\S+)/', $auth_header, $matches)) {
        $token_dikirim = $matches[1];
        
        // Cek apakah token tersebut ada dan valid di database
        $query = mysqli_query($conn, "SELECT * FROM Users WHERE token='$token_dikirim'");
        
        if (mysqli_num_rows($query) > 0) {
            return true; // Token valid, izinkan akses
        }
    }
    
    // Jika token salah atau tidak menyertakan token
    http_response_code(401);
    echo json_encode([
        "status" => "gagal", 
        "pesan" => "Akses Ditolak! Bearer Token tidak valid atau tidak ditemukan."
    ]);
    exit; // Hentikan eksekusi kode selanjutnya
}
?>