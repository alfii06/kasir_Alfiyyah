<?php
include 'koneksi.php';

// Pastikan pembelian ID telah diterima dari halaman sebelumnya
if (!isset($_GET['pembelian_id'])) {
    header("Location: daftar_pembelian.php");
    exit();
}

$pembelian_id = $_GET['pembelian_id'];

// Ambil informasi pembelian dari database
$sql_pembelian = "SELECT * FROM pembelian WHERE pembelian_id = $pembelian_id";
$result_pembelian = $conn->query($sql_pembelian);

if ($result_pembelian->num_rows == 0) {
    echo "Pembelian tidak ditemukan.";
    exit();
}

$pembelian = $result_pembelian->fetch_assoc();

// Ambil detail pembelian dari database
$sql_detail_pembelian = "SELECT * FROM pembelian_detail WHERE pembelian_id = $pembelian_id";
$result_detail_pembelian = $conn->query($sql_detail_pembelian);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pembelian</title>
</head>
<body>
    <h2>Detail Pembelian</h2>
    <p><strong>No Faktur:</strong> <?= $pembelian['no_faktur'] ?></p>
    <p><strong>Tanggal Pembelian:</strong> <?= $pembelian['tanggal_pembelian'] ?></p>
    <p><strong>Total:</strong> <?= $pembelian['total'] ?></p>
    <p><strong>Bayar:</strong> <?= $pembelian['bayar'] ?></p>
    <p><strong>Sisa:</strong> <?= $pembelian['sisa'] ?></p>
    <p><strong>Keterangan:</strong> <?= $pembelian['keterangan'] ?></p>

    <h3>Detail Barang</h3>
    <table border="1">
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Qty</th>
            <th>Harga Beli</th>
        </tr>
        <?php $no = 1; ?>
        <?php while ($row_detail = $result_detail_pembelian->fetch_assoc()): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td>
                    <?php
                    $produk_id = $row_detail['produk_id'];
                    $sql_produk = "SELECT nama_produk FROM produk WHERE produk_id = $produk_id";
                    $result_produk = $conn->query($sql_produk);
                    $produk = $result_produk->fetch_assoc();
                    echo $produk['nama_produk'];
                    ?>
                </td>
                <td><?= $row_detail['qty'] ?></td>
                <td><?= $row_detail['harga_beli'] ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>