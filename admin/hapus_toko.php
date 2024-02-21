<?php
include 'koneksi.php';

// Ambil parameter toko_id dari URL
if (isset($_GET['id'])) {
    $toko_id = $_GET['id'];

    // Query untuk menghapus data toko berdasarkan toko_id
    $sql = "DELETE FROM toko WHERE toko_id = $toko_id";

    if ($conn->query($sql) === TRUE) {
        // Redirect kembali ke halaman data toko dengan parameter status=success
        header("Location: toko.php?status=success");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    // Jika halaman ini diakses tanpa menggunakan parameter toko_id, kembalikan ke halaman data toko
    header("Location: toko.php");
}

// Tutup koneksi
$conn->close();
?>
