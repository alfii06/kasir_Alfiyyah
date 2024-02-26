<?php
include 'koneksi.php';

// Ambil parameter penjualan_id dari URL
if (isset($_GET['id'])) {
    $penjualan_id = $_GET['id'];

    // Query untuk menghapus data detail penjualan berdasarkan penjualan_id
    $sql = "DELETE FROM penjualan_detail WHERE penjualan_id = $penjualan_id";

    if ($conn->query($sql) === TRUE) {
        // Redirect kembali ke halaman data detail penjualan dengan parameter status=success
        header("Location: tabel_jual_detail.php?status=success");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    // Jika halaman ini diakses tanpa menggunakan parameter penjualan_id, kembalikan ke halaman data detail penjualan
    header("Location: tabel_jual_detail.php");
}

// Tutup koneksi
$conn->close();
?>
