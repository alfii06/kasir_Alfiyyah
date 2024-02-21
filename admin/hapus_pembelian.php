<?php
include 'koneksi.php';

// Ambil parameter pembelian_id dari URL
if (isset($_GET['id'])) {
    $pembelian_id = $_GET['id'];

    // Query untuk menghapus data pembelian berdasarkan pembelian_id
    $sql = "DELETE FROM pembelian WHERE pembelian_id = $pembelian_id";

    if ($conn->query($sql) === TRUE) {
        // Redirect kembali ke halaman data pembelian dengan parameter status=success
        header("Location: pembelian_barang.php?status=success");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    // Jika halaman ini diakses tanpa menggunakan parameter pembelian_id, kembalikan ke halaman data pembelian
    header("Location: pembelian_barang.php");
}

// Tutup koneksi
$conn->close();
?>
