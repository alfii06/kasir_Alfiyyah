<?php
// File: process_data_supplier.php

include 'koneksi.php';

// Fungsi untuk mendapatkan data supplier dari database
function getSupplierData() {
    global $pdo;
    
    try {
        $stmt = $pdo->query("SELECT * FROM suplier");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Handle error jika query gagal
        echo "Error: " . $e->getMessage();
        exit();
    }
}

// Fungsi untuk menambahkan supplier ke database
function tambahSupplier($tokoId, $namaSupplier, $nomorHP, $alamatSupplier) {
    global $pdo;

    try {
        $createdAt = date("Y-m-d");
        $stmt = $pdo->prepare("INSERT INTO suplier (toko_id, nama_suplier, tlp_suplier, alamat_suplier, created_at) VALUES (:tokoId, :namaSupplier, :nomorHP, :alamatSupplier, :createdAt)");
        $stmt->bindParam(":tokoId", $tokoId, PDO::PARAM_INT);
        $stmt->bindParam(":namaSupplier", $namaSupplier, PDO::PARAM_STR);
        $stmt->bindParam(":nomorHP", $nomorHP, PDO::PARAM_STR);
        $stmt->bindParam(":alamatSupplier", $alamatSupplier, PDO::PARAM_STR);
        $stmt->bindParam(":createdAt", $createdAt, PDO::PARAM_STR);
        $stmt->execute();
        return ['success' => true];
    } catch (PDOException $e) {
        // Handle error jika query gagal
        echo "Error: " . $e->getMessage();
        return ['success' => false];
    }
}

// Fungsi untuk menghapus supplier dari database
function hapusSupplier($supplierId) {
    global $pdo;

    try {
        $stmt = $pdo->prepare("DELETE FROM suplier WHERE suplier_id = :supplierId");
        $stmt->bindParam(":supplierId", $supplierId, PDO::PARAM_INT);
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
    // Proses pengambilan data supplier
    $dataSupplier = getSupplierData();
    echo json_encode($dataSupplier); // Misalnya, kirim data dalam format JSON
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Proses penambahan atau penghapusan supplier
    if (isset($_POST["action"])) {
        $action = $_POST["action"];
        
        if ($action == "tambah") {
            // Proses penambahan supplier
            echo json_encode(tambahSupplier($_POST['tokoId'], $_POST['namaSupplier'], $_POST['nomorHP'], $_POST['alamatSupplier']));
        } elseif ($action == "hapus") {
            // Proses penghapusan supplier
            echo json_encode(hapusSupplier($_POST['supplierId']));
        }
    }
}
