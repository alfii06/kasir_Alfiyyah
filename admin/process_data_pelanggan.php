<?php
// File: process_data_pelanggan.php

// Koneksi ke database
try {
    $pdo = new PDO("mysql:host=localhost;dbname=pos_alfi", "root", "");
} catch (PDOException $e) {
    // Handle error jika koneksi gagal
    echo "Error: " . $e->getMessage();
    exit();
}

// Fungsi untuk mendapatkan data pelanggan dari database
function getPelangganData() {
    global $pdo;
    
    try {
        $stmt = $pdo->query("SELECT * FROM pelanggan");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Handle error jika query gagal
        echo "Error: " . $e->getMessage();
        exit();
    }
}

// Fungsi untuk menambahkan pelanggan ke database
function tambahPelanggan($tokoId, $namaPelanggan, $alamat, $noHp) {
    global $pdo;

    try {
        $createdAt = date("Y-m-d");
        $stmt = $pdo->prepare("INSERT INTO pelanggan (toko_id, nama_pelanggan, alamat, no_hp, created_at) VALUES (:tokoId, :namaPelanggan, :alamat, :noHp, :createdAt)");
        $stmt->bindParam(":tokoId", $tokoId, PDO::PARAM_INT);
        $stmt->bindParam(":namaPelanggan", $namaPelanggan, PDO::PARAM_STR);
        $stmt->bindParam(":alamat", $alamat, PDO::PARAM_STR);
        $stmt->bindParam(":noHp", $noHp, PDO::PARAM_STR);
        $stmt->bindParam(":createdAt", $createdAt, PDO::PARAM_STR);
        $stmt->execute();
        return ['success' => true];
    } catch (PDOException $e) {
        // Handle error jika query gagal
        echo "Error: " . $e->getMessage();
        return ['success' => false];
    }
}

// Fungsi untuk menghapus pelanggan dari database
function hapusPelanggan($pelangganId) {
    global $pdo;

    try {
        $stmt = $pdo->prepare("DELETE FROM pelanggan WHERE pelanggan_id = :pelangganId");
        $stmt->bindParam(":pelangganId", $pelangganId, PDO::PARAM_INT);
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
    // Proses pengambilan data pelanggan
    $dataPelanggan = getPelangganData();
    echo json_encode($dataPelanggan); // Misalnya, kirim data dalam format JSON
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Proses penambahan atau penghapusan pelanggan
    if (isset($_POST["action"])) {
        $action = $_POST["action"];
        
        if ($action == "tambah") {
            // Proses penambahan pelanggan
            echo json_encode(tambahPelanggan($_POST['tokoId'], $_POST['namaPelanggan'], $_POST['alamat'], $_POST['noHp']));
        } elseif ($action == "hapus") {
            // Proses penghapusan pelanggan
            echo json_encode(hapusPelanggan($_POST['pelangganId']));
        }
    }
}
