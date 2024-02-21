<?php
include 'koneksi.php';

// Ambil parameter pelanggan_id dari URL
if (isset($_GET['id'])) {
    $pelanggan_id = $_GET['id'];

    // Query untuk menghapus data pelanggan berdasarkan pelanggan_id
    $sql = "DELETE FROM pelanggan WHERE pelanggan_id = $pelanggan_id";

    if ($conn->query($sql) === TRUE) {
        // Redirect kembali ke halaman data pelanggan dengan parameter status=success
        header("Location: data_pelanggan.php?status=success");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    // Jika halaman ini diakses tanpa menggunakan parameter pelanggan_id, kembalikan ke halaman data pelanggan
    header("Location: data_pelanggan.php");
}

// Tutup koneksi
$conn->close();
?>