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
        die("Connection failed: " . $conn->zconnect_error);
    }

    // Ambil data dari form
    $pelangganId = $_POST['pelangganId'];
    $tokoId = $_POST['tokoId'];
    $namaPelanggan = $_POST['namaPelanggan'];
    $alamat = $_POST['alamat'];
    $noHp = $_POST['noHp'];

    // Query untuk melakukan update data pelanggan
    $sql = "UPDATE pelanggan SET toko_id='$tokoId', nama_pelanggan='$namaPelanggan', alamat='$alamat', no_hp='$noHp' WHERE pelanggan_id='$pelangganId'";

    if ($conn->query($sql) === TRUE) {
        // Redirect kembali ke halaman edit dengan parameter sukses
        header("Location: data_pelanggan.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }

    // Tutup koneksi
    $conn->close();
} else {
    // Jika halaman ini diakses tanpa menggunakan metode POST, kembalikan ke halaman sebelumnya
    header("Location: edit_data_pelanggan.php");
}
?>