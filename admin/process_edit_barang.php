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
    $produkId = $_POST['produkId'];
    $tokoId = $_POST['tokoId'];
    $namaProduk = $_POST['namaProduk'];
    $kategoriId = $_POST['kategoriId'];
    $satuan = $_POST['satuan'];
    $hargaBeli = $_POST['hargaBeli'];
    $hargaJual = $_POST['hargaJual'];
    $stokBarang = $_POST['stokBarang'];

    // Query untuk melakukan update data barang
    $sql = "UPDATE produk SET toko_id='$tokoId', nama_produk='$namaProduk', kategori_id='$kategoriId', satuan='$satuan', harga_beli='$hargaBeli', harga_jual='$hargaJual', stok_barang='$stokBarang' WHERE produk_id='$produkId'";

    if ($conn->query($sql) === TRUE) {
        // Redirect kembali ke halaman edit dengan parameter sukses
        header("Location: data_barang.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }

    // Tutup koneksi
    $conn->close();
} else {
    // Jika halaman ini diakses tanpa menggunakan metode POST, kembalikan ke halaman sebelumnya
    header("Location: data_barang.php");
}
?>
