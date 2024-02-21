<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sesuaikan dengan informasi koneksi database Anda
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pos_alfi";

    // Buat koneksi
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Cek koneksi
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Ambil data dari form
    $userId = $_POST['userId'];
    $username = $_POST['username'];
    $password = $_POST['[password]'];
    $email = $_POST['email'];
    $namaLengkap = $_POST['namaLengkap'];
    $alamat = $_POST['alamat'];
    $role = $_POST['role'];

    // Query untuk melakukan update data user
    $sql = "UPDATE user SET username='$username', password='$password', email='$email', nama_lengkap='$namaLengkap', alamat='$alamat', role='$role' WHERE user_id='$userId'";

    if ($conn->query($sql) === TRUE) {
        // Redirect kembali ke halaman edit dengan parameter sukses
        header("Location: data_user.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }

    // Tutup koneksi
    $conn->close();
} else {
    // Jika halaman ini diakses tanpa menggunakan metode POST, kembalikan ke halaman sebelumnya
    header("Location: data_user.php");
}
?>
