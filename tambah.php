<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Burung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-secondary">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-lg border-0" style="border-radius: 20px;">
                <div class="card-body p-4">
                    <h4 class="fw-bold text-center mb-4">Input Burung Baru</h4>
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Kategori (1=Kicau, 2=Hias)</label>
                            <input type="number" name="id_kat" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama/Jenis Burung</label>
                            <input type="text" name="jenis" class="form-control" placeholder="Contoh: Murai Medan" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga (Rp)</label>
                            <input type="number" name="harga" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jumlah Stok</label>
                            <input type="number" name="stok" class="form-control" required>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary w-100 py-2 fw-bold">Simpan ke Katalog</button>
                        <a href="index.php" class="btn btn-link w-100 mt-2 text-decoration-none">Batal & Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if(isset($_POST['submit'])){
    $id_kat = $_POST['id_kat']; $jenis = $_POST['jenis']; $harga = $_POST['harga']; $stok = $_POST['stok'];
    mysqli_query($conn, "INSERT INTO Burung (id_kategori, jenis_burung, harga, stok) VALUES ('$id_kat', '$jenis', '$harga', '$stok')");
    echo "<script>alert('Berhasil ditambah!'); window.location='index.php';</script>";
}
?>
</body>
</html>