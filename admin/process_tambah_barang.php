<?php
// process_tambah_barang.php

// Periksa apakah ada data POST yang dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari formulir POST
    $produkId = $_POST['produk_id'];
    $tokoId = $_POST['tokoNama'];
    $namaProduk = $_POST['nama_produk'];
    $kategoriId = $_POST['kategori_id'];
    $satuan = $_POST['satuan'];
    $hargaBeli = $_POST['harga_beli'];
    $hargaJual = $_POST['harga_jual'];
    $stokBarang = $_POST['stok_barang'];
    $createdAt = $_POST['created_at'];

    // Simpan data ke database atau lakukan operasi lain sesuai kebutuhan
    // Di sini Anda perlu menyesuaikan sesuai dengan struktur tabel dan database yang Anda gunakan
    // Contoh penggunaan PDO untuk menyimpan data ke database MySQL
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=pos_alfi", "root", "");

        // Set mode PDO untuk menangani error secara eksepsional
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Query SQL untuk menyimpan data ke tabel barang
        $query = "INSERT INTO produk (produk_id, tokoNama, nama_produk, kategori_id, satuan, harga_beli, harga_jual, stok_barang, created_at)
                    VALUES (:produk_id, :tokoId, :namaProduk, :kategoriId, :satuan, :hargaBeli, :hargaJual, :stokBarang, :createdAt)";

        // Persiapkan statement SQL
        $statement = $pdo->prepare($query);

        // Bind parameter ke statement
        $statement->bindParam(':produk_id', $produkId);
        $statement->bindParam(':tokoNama', $tokoId);
        $statement->bindParam(':namaProduk', $namaProduk);
        $statement->bindParam(':kategoriId', $kategoriId);
        $statement->bindParam(':satuan', $satuan);
        $statement->bindParam(':hargaBeli', $hargaBeli);
        $statement->bindParam(':hargaJual', $hargaJual);
        $statement->bindParam(':stokBarang', $stokBarang);

        // Eksekusi statement untuk menyimpan data
        $statement->execute();

        // Tutup koneksi database
        $pdo = null;

        // Redirect ke halaman lain atau berikan respons sesuai kebutuhan
        header("Location: data_barang.php");
        exit();
    } catch (PDOException $e) {
        // Tangkap dan tampilkan pesan kesalahan jika terjadi
        echo "Error: " . $e->getMessage();
    }
}
?>
