<?php 
session_start();
include 'koneksi.php'; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>BirdStore - Katalog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .card-custom { border: none; border-radius: 15px; transition: 0.3s; }
        .card-custom:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
        .btn-buy { border-radius: 10px; background: #27ae60; color: white; }
    </style>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4 shadow">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php"><i class="fas fa-dove"></i> BIRDSTORE</a>
        <div class="d-flex">
            <a href="tambah.php" class="btn btn-outline-light me-2"><i class="fas fa-plus"></i> Stok</a>
            <a href="keranjang.php" class="btn btn-warning position-relative">
                <i class="fas fa-shopping-cart"></i> Keranjang
                <?php if(!empty($_SESSION['keranjang'])): ?>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    <?= count($_SESSION['keranjang']); ?>
                </span>
                <?php endif; ?>
            </a>
        </div>
    </div>
</nav>

<div class="container">
    <h3 class="fw-bold mb-4">Koleksi kicau saya</h3>
    <div class="row">
        <?php
        $res = mysqli_query($conn, "SELECT * FROM Burung ORDER BY id_burung DESC");
        while($row = mysqli_fetch_assoc($res)):
        ?>
        <div class="col-md-3 mb-4">
            <div class="card card-custom h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-bold"><?= $row['jenis_burung']; ?></h5>
                    <p class="text-success fw-bold mb-1">Rp <?= number_format($row['harga']); ?></p>
                    <p class="small text-muted">Tersedia: <?= $row['stok']; ?> ekor</p>
                    <div class="d-grid gap-2">
                        <a href="beli.php?id=<?= $row['id_burung']; ?>" class="btn btn-buy"><i class="fas fa-cart-plus"></i> Beli Sekarang</a>
                        <div class="d-flex gap-1">
                            <a href="edit.php?id=<?= $row['id_burung']; ?>" class="btn btn-outline-secondary btn-sm flex-grow-1">Edit</a>
                            <a href="hapus.php?id=<?= $row['id_burung']; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Hapus dari database?')"><i class="fas fa-trash"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>
</body>
</html>