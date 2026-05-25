<?php 
include 'koneksi.php';
$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM Burung WHERE id_burung='$id'");
$row = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Burung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="col-md-6 offset-md-3">
        <div class="card p-4">
            <h3>Edit Data Burung</h3>
            <form action="" method="POST">
                <div class="mb-3">
                    <label>Jenis Burung</label>
                    <input type="text" name="jenis" class="form-control" value="<?= $row['jenis_burung']; ?>" required>
                </div>
                <div class="mb-3">
                    <label>Harga</label>
                    <input type="number" name="harga" class="form-control" value="<?= $row['harga']; ?>" required>
                </div>
                <div class="mb-3">
                    <label>Stok</label>
                    <input type="number" name="stok" class="form-control" value="<?= $row['stok']; ?>" required>
                </div>
                <button type="submit" name="update" class="btn btn-success w-100">Update Data</button>
                <a href="index.php" class="btn btn-link w-100 mt-2">Batal</a>
            </form>
        </div>
    </div>
</div>

<?php
if(isset($_POST['update'])){
    $jenis = $_POST['jenis'];
    $harga = $_POST['harga'];
    $stok  = $_POST['stok'];

    $update = mysqli_query($conn, "UPDATE Burung SET jenis_burung='$jenis', harga='$harga', stok='$stok' WHERE id_burung='$id'");
    
    if($update){
        echo "<script>alert('Data berhasil diperbarui!'); window.location='index.php';</script>";
    }
}
?>
</body>
</html>