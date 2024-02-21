<?php
// File: process_data_barang.php

// Koneksi ke database
try {
    $pdo = new PDO("mysql:host=localhost;dbname=pos_alfi", "root", "");
} catch (PDOException $e) {
    // Handle error jika koneksi gagal
    echo "Error: " . $e->getMessage();
    exit();
}

// Fungsi untuk mendapatkan data barang dari database
function getBarangData() {
    global $pdo;
    
    try {
        $stmt = $pdo->query("SELECT * FROM barang");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Handle error jika query gagal
        echo "Error: " . $e->getMessage();
        exit();
    }
}

// Fungsi untuk menambahkan barang ke database
function tambahBarang($tokoId, $namaProduk, $kategoriId, $satuan, $hargaBeli, $hargaJual) {
    global $pdo;

    try {
        $createdAt = date("Y-m-d");
        $stmt = $pdo->prepare("INSERT INTO barang (toko_id, nama_produk, kategori_id, satuan, harga_beli, harga_jual, created_at) VALUES (:tokoId, :namaProduk, :kategoriId, :satuan, :hargaBeli, :hargaJual, :createdAt)");
        $stmt->bindParam(":tokoId", $tokoId, PDO::PARAM_INT);
        $stmt->bindParam(":namaProduk", $namaProduk, PDO::PARAM_STR);
        $stmt->bindParam(":kategoriId", $kategoriId, PDO::PARAM_INT);
        $stmt->bindParam(":satuan", $satuan, PDO::PARAM_STR);
        $stmt->bindParam(":hargaBeli", $hargaBeli, PDO::PARAM_STR);
        $stmt->bindParam(":hargaJual", $hargaJual, PDO::PARAM_STR);
        $stmt->bindParam(":createdAt", $createdAt, PDO::PARAM_STR);
        $stmt->execute();
        return ['success' => true];
    } catch (PDOException $e) {
        // Handle error jika query gagal
        echo "Error: " . $e->getMessage();
        return ['success' => false];
    }
}

// Fungsi untuk menghapus barang dari database
function hapusBarang($barangId) {
    global $pdo;

    try {
        $stmt = $pdo->prepare("DELETE FROM barang WHERE produk_id = :barangId");
        $stmt->bindParam(":barangId", $barangId, PDO::PARAM_INT);
        $stmt->execute();
        return ['success' => true];
    } catch (PDOException $e) {
        // Handle error jika query gagal
        echo "Error: " . $e->getMessage();
        return ['success' => false];
    }
}

// Mengelola aksi berdasarkan parameter yang diterima
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Proses pengambilan data barang
    $dataBarang = getBarangData();
    echo json_encode($dataBarang); // Misalnya, kirim data dalam format JSON
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Proses penambahan atau penghapusan barang
    if (isset($_POST["action"])) {
        $action = $_POST["action"];
        
        if ($action == "tambah") {
            // Proses penambahan barang
            echo json_encode(tambahBarang($_POST['tokoId'], $_POST['namaProduk'], $_POST['kategoriId'], $_POST['satuan'], $_POST['hargaBeli'], $_POST['hargaJual']));
        } elseif ($action == "hapus") {
            // Proses penghapusan barang
            echo json_encode(hapusBarang($_POST['barangId']));
        }
    }
}
