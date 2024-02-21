<?php
include 'koneksi.php';

// Ambil parameter produk_id dari URL
if (isset($_GET['id'])) {
    $produk_id = $_GET['id'];

    // Query untuk menghapus data barang berdasarkan produk_id
    $sql = "DELETE FROM produk WHERE produk_id = $produk_id";

    if ($conn->query($sql) === TRUE) {
        // Redirect kembali ke halaman data barang dengan parameter status=success
        header("Location: data_barang.php?status=success");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    // Jika halaman ini diakses tanpa menggunakan parameter produk_id, kembalikan ke halaman data barang
    header("Location: data_barang.php");
}

// Tutup koneksi
$conn->close();
?>
