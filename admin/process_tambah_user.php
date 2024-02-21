<?php
// process_tambah_user.php

// Periksa apakah ada data POST yang dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari formulir POST
    $username = $_POST['username'];
    $email = $_POST['email'];
    $namaLengkap = $_POST['namaLengkap'];
    $alamat = $_POST['alamat'];
    $role = $_POST['role'];
    $createdAt = $_POST['createdAt'];

    // Simpan data ke database atau lakukan operasi lain sesuai kebutuhan
    // Di sini Anda perlu menyesuaikan sesuai dengan struktur tabel dan database yang Anda gunakan
    // Contoh penggunaan PDO untuk menyimpan data ke database MySQL
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=pos_alfi", "root", "");

        // Set mode PDO untuk menangani error secara eksepsional
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Query SQL untuk menyimpan data ke tabel user
        $query = "INSERT INTO user (username, password, email, nama_lengkap, alamat, role, created_at)
                  VALUES (:username, :password, :email, :namaLengkap, :alamat, :role, :createdAt)";

        // Persiapkan statement SQL
        $statement = $pdo->prepare($query);

        // Bind parameter ke statement
        $statement->bindParam(':username', $username);
        $statement->bindParam(':password', $password);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':namaLengkap', $namaLengkap);
        $statement->bindParam(':alamat', $alamat);
        $statement->bindParam(':role', $role);
        $statement->bindParam(':createdAt', $createdAt);

        // Eksekusi statement untuk menyimpan data
        $statement->execute();

        // Tutup koneksi database
        $pdo = null;

        // Redirect ke halaman lain atau berikan respons sesuai kebutuhan
        header("Location: data_user.php");
        exit();
    } catch (PDOException $e) {
        // Tangkap dan tampilkan pesan kesalahan jika terjadi
        echo "Error: " . $e->getMessage();
    }
}
