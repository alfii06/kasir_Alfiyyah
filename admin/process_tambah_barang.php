<?php
// process_tambah_barang.php

// Periksa apakah ada data POST yang dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari formulir POST
    $produkId = $_POST['produk_id'];
    $tokoId = isset($_POST['toko_id']) ? $_POST['toko_id'] : ''; // Memeriksa apakah toko_id ada dalam data POST
    $namaProduk = $_POST['nama_produk'];
    $kategoriId = $_POST['kategori_id'];
    $satuan = $_POST['satuan'];
    $hargaBeli = $_POST['harga_beli'];
    $hargaJual = $_POST['harga_jual'];
    $stokBarang = $_POST['stok_barang'];
    $createdAt = date('Y-m-d H:i:s');

    // Koneksi ke database MySQL
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pos_alfi";

    // Buat koneksi
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Periksa koneksi
    if ($conn->connect_error) {
        die("Koneksi Gagal: " . $conn->connect_error);
    }

    // Query SQL untuk menyimpan data ke tabel produk
    $query = "INSERT INTO produk (produk_id, toko_id, nama_produk, kategori_id, satuan, harga_beli, harga_jual, stok_barang, created_at)
                VALUES ('$produkId', '$tokoId', '$namaProduk', '$kategoriId', '$satuan', '$hargaBeli', '$hargaJual', '$stokBarang', '$createdAt')";

    if ($conn->query($query) === TRUE) {
        // Redirect ke halaman lain atau berikan respons sesuai kebutuhan
        header("Location: data_barang.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }

    // Tutup koneksi database
    $conn->close();
}
?>
