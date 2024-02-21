<?php
include 'koneksi.php';

// Ambil parameter supplier_id dari URL
if (isset($_GET['id'])) {
    $supplier_id = $_GET['id'];

    // Query untuk menghapus data supplier berdasarkan supplier_id
    $sql = "DELETE FROM suplier WHERE suplier_id = $supplier_id";

    if ($conn->query($sql) === TRUE) {
        // Redirect kembali ke halaman data supplier dengan parameter status=success
        header("Location: data_supplier.php?status=success");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    // Jika halaman ini diakses tanpa menggunakan parameter supplier_id, kembalikan ke halaman data supplier
    header("Location: data_supplier.php");
}

// Tutup koneksi
$conn->close();
?>
