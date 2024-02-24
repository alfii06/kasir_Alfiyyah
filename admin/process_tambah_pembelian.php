<?php
// process_tambah_pembelian.php

// Periksa apakah ada data POST yang dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari formulir POST
    $tokoId = $_POST['tokoId'];
    $userId = $_POST['userId'];
    $noFaktur = $_POST['noFaktur'];
    $tanggalPembelian = $_POST['tanggalPembelian'];
    $suplierId = $_POST['suplierId'];
    $total = $_POST['total'];
    $bayar = $_POST['bayar'];
    $sisa = $_POST['sisa'];
    $keterangan = $_POST['keterangan'];
    $createdAt = $_POST['createdAt'];

    // Periksa apakah nilai total, bayar, dan sisa tidak kosong
    if (!empty($total) && !empty($bayar) && !empty($sisa)) {
        // Simpan data ke database
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=pos_alfi", "root", "");

            // Set mode PDO untuk menangani error secara eksepsional
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Query SQL untuk menyimpan data ke tabel pembelian
            $query = "INSERT INTO pembelian (toko_id, user_id, no_faktur, tanggal_pembelian, suplier_id, total, bayar, sisa, keterangan, created_at)
                      VALUES (:tokoId, :userId, :noFaktur, :tanggalPembelian, :suplierId, :total, :bayar, :sisa, :keterangan, :createdAt)";

            // Persiapkan statement SQL
            $statement = $pdo->prepare($query);

            // Bind parameter ke statement
            $statement->bindParam(':tokoId', $tokoId);
            $statement->bindParam(':userId', $userId);
            $statement->bindParam(':noFaktur', $noFaktur);
            $statement->bindParam(':tanggalPembelian', $tanggalPembelian);
            $statement->bindParam(':suplierId', $suplierId);
            $statement->bindParam(':total', $total);
            $statement->bindParam(':bayar', $bayar);
            $statement->bindParam(':sisa', $sisa);
            $statement->bindParam(':keterangan', $keterangan);
            $statement->bindParam(':createdAt', $createdAt);

            // Eksekusi statement untuk menyimpan data
            $statement->execute();

            // Tutup koneksi database
            $pdo = null;

            // Redirect ke halaman lain atau berikan respons sesuai kebutuhan
            header("Location: pembelian_barang.php");
            exit();
        } catch (PDOException $e) {
            // Tangkap dan tampilkan pesan kesalahan jika terjadi
            echo "Error: " . $e->getMessage();
        }
    } else {
        // Tampilkan pesan kesalahan jika nilai total, bayar, atau sisa kosong
        echo "Error: Nilai total, bayar, atau sisa tidak boleh kosong.";
    }
} else {
    // Tampilkan pesan kesalahan jika tidak ada data POST yang dikirimkan
    echo "Error: Tidak ada data POST yang dikirimkan.";
}
?>
