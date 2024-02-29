<?php
// Buat koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pos_alfi";

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Tangani data POST dari form tambah penjualan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tokoId = $_POST['tokoId'];
    $userId = $_POST['userId'];
    $tanggalPenjualan = $_POST['tanggalPenjualan'];
    $pelanggan = $_POST['pelanggan'];
    $createdAt = $_POST['createdAt'];

    // Simpan data penjualan ke tabel penjualan
    $sql = "INSERT INTO penjualan (toko_id, user_id, tanggal_penjualan, pelanggan, created_at) VALUES ('$tokoId', '$userId', '$tanggalPenjualan', '$pelanggan', '$createdAt')";
    if ($conn->query($sql) === TRUE) {
        $penjualanId = $conn->insert_id; // Mendapatkan ID penjualan yang baru saja dibuat
        echo "Data penjualan berhasil ditambahkan";

        // Redirect ke halaman tambah detail penjualan dengan membawa ID penjualan
        header("Location: penjualan_detail.php?penjualan_id=$penjualanId");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Tutup koneksi
$conn->close();
?>
    