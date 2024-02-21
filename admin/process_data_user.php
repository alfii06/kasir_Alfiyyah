<?php
// File: process_data_user.php

// Koneksi ke database
try {
    $pdo = new PDO("mysql:host=localhost;dbname=pos_alfi", "root", "");
} catch (PDOException $e) {
    // Handle error jika koneksi gagal
    echo "Error: " . $e->getMessage();
    exit();
}

// Fungsi untuk mendapatkan data user dari database
function getUserData() {
    global $pdo;
    
    try {
        $stmt = $pdo->query("SELECT * FROM user");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Handle error jika query gagal
        echo "Error: " . $e->getMessage();
        exit();
    }
}

// Fungsi untuk menambahkan user ke database
function tambahUser($username, $email, $namaLengkap, $alamat, $role) {
    global $pdo;

    try {
        $createdAt = date("Y-m-d");
        $stmt = $pdo->prepare("INSERT INTO user (username, email, nama_lengkap, alamat, role, created_at) VALUES (:username, :email, :namaLengkap, :alamat, :role, :createdAt)");
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":namaLengkap", $namaLengkap, PDO::PARAM_STR);
        $stmt->bindParam(":alamat", $alamat, PDO::PARAM_STR);
        $stmt->bindParam(":role", $role, PDO::PARAM_STR);
        $stmt->bindParam(":createdAt", $createdAt, PDO::PARAM_STR);
        $stmt->execute();
        return ['success' => true];
    } catch (PDOException $e) {
        // Handle error jika query gagal
        echo "Error: " . $e->getMessage();
        return ['success' => false];
    }
}

// Fungsi untuk menghapus user dari database
function hapusUser($userId) {
    global $pdo;

    try {
        $stmt = $pdo->prepare("DELETE FROM user WHERE user_id = :userId");
        $stmt->bindParam(":userId", $userId, PDO::PARAM_INT);
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
    // Proses pengambilan data user
    $dataUser = getUserData();
    echo json_encode($dataUser); // Misalnya, kirim data dalam format JSON
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Proses penambahan atau penghapusan user
    if (isset($_POST["action"])) {
        $action = $_POST["action"];
        
        if ($action == "tambah") {
            // Proses penambahan user
            echo json_encode(tambahUser($_POST['username'], $_POST['email'], $_POST['namaLengkap'], $_POST['alamat'], $_POST['role']));
        } elseif ($action == "hapus") {
            // Proses penghapusan user
            echo json_encode(hapusUser($_POST['userId']));
        }
    }
}
