<?php
// process_tambah_toko.php

// Periksa apakah ada data POST yang dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari formulir POST
    $toko_id = $_POST['toko_id'];
    $nama_toko = $_POST['nama_toko'];
    $alamat = $_POST['alamat'];
    $tlp_hp = $_POST['tlp_hp'];
    $created_at = $_POST['created_at'];

    // Koneksi ke database (sesuaikan dengan koneksi Anda)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pos_alfi";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Periksa koneksi
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    try {
        // Query SQL untuk menyimpan data ke tabel toko
        $query = "INSERT INTO toko (toko_id, nama_toko, alamat, tlp_hp, created_at)
                  VALUES (?, ?, ?, ?, ?)";

        // Persiapkan statement SQL
        $statement = $conn->prepare($query);

        if (!$statement) {
            throw new Exception("Prepare statement failed: " . $conn->error);
        }

        // Bind parameter ke statement
        $bindResult = $statement->bind_param('sssss', $toko_id, $nama_toko, $alamat, $tlp_hp, $created_at);

        if (!$bindResult) {
            throw new Exception("Binding parameters failed: " . $statement->error);
        }

        // Eksekusi statement untuk menyimpan data
        if ($statement->execute()) {
            // Redirect ke halaman lain atau berikan respons sesuai kebutuhan
            header("Location: toko.php");
            exit();
        } else {
            throw new Exception("Error in executing statement.");
        }
    } catch (Exception $e) {
        // Tangkap dan tampilkan pesan kesalahan jika terjadi
        echo "Error: " . $e->getMessage();
    } finally {
        // Tutup koneksi database
        $conn->close();
    }
} else {
    // Jika tidak ada data dikirim, redirect ke halaman tambah toko
    header("Location: tambah_toko.php");
    exit();
}
?>
