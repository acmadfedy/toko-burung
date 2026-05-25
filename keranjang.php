<?php
session_start();
include 'koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Keranjang Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card border-0 shadow-sm p-4">
        <h3 class="fw-bold mb-4 text-primary"><i class="fas fa-shopping-basket"></i> Keranjang Belanja</h3>
        
        <table class="table align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Burung</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_belanja = 0;
                if(!empty($_SESSION['keranjang'])):
                    foreach($_SESSION['keranjang'] as $id_burung => $jumlah):
                        $res = mysqli_query($conn, "SELECT * FROM Burung WHERE id_burung='$id_burung'");
                        $row = mysqli_fetch_assoc($res);
                        $sub = $row['harga'] * $jumlah;
                        $total_belanja += $sub;
                ?>
                <tr>
                    <td class="fw-bold"><?= $row['jenis_burung']; ?></td>
                    <td>Rp <?= number_format($row['harga']); ?></td>
                    <td><?= $jumlah; ?></td>
                    <td class="fw-bold text-success">Rp <?= number_format($sub); ?></td>
                    <td class="text-center">
                        <a href="hapus_keranjang.php?id=<?= $id_burung; ?>" class="btn btn-danger btn-sm rounded-pill px-3">
                            <i class="fas fa-times"></i> Batalkan
                        </a>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                <tr>
                    <td colspan="5" class="text-center py-4 text-muted">Keranjang masih kosong.</td>
                </tr>
                <?php endif; ?>
            </tbody>
            <tfoot class="table-light">
                <tr>
                    <th colspan="3" class="text-end">Total Bayar:</th>
                    <th class="text-success h4">Rp <?= number_format($total_belanja); ?></th>
                    <th></th>
                </tr>
            </tfoot>
        </table>

        <div class="d-flex justify-content-between mt-4">
            <a href="index.php" class="btn btn-outline-dark"><i class="fas fa-arrow-left"></i> Lanjut Belanja</a>
            <?php if(!empty($_SESSION['keranjang'])): ?>
                <a href="checkout.php" class="btn btn-success btn-lg shadow px-5">Proses Checkout <i class="fas fa-check"></i></a>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>