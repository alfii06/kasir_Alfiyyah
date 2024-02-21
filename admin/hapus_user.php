<?php
include 'koneksi.php';

// Ambil parameter user_id dari URL
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Query untuk menghapus data user berdasarkan user_id
    $sql = "DELETE FROM user WHERE user_id = $user_id";

    if ($conn->query($sql) === TRUE) {
        // Redirect kembali ke halaman data user dengan parameter status=success
        header("Location: data_user.php?status=success");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    // Jika halaman ini diakses tanpa menggunakan parameter user_id, kembalikan ke halaman data user
    header("Location: data_user.php");
}

// Tutup koneksi
$conn->close();
?>
