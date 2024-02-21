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
    $pembelianId = $_POST['pembelianId'];
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

    // Query untuk melakukan update data pembelian
    $sql = "UPDATE pembelian SET toko_id='$tokoId', user_id='$userId', no_faktur='$noFaktur', 
            tanggal_pembelian='$tanggalPembelian', suplier_id='$suplierId', total='$total', 
            bayar='$bayar', sisa='$sisa', keterangan='$keterangan', created_at='$createdAt' 
            WHERE pembelian_id='$pembelianId'";

    if ($conn->query($sql) === TRUE) {
        // Redirect kembali ke halaman edit dengan parameter sukses
        header("Location: pembelian_barang.php?id=" . $pembelianId . "&status=success");
    } else {
        echo "Error updating record: " . $conn->error;
    }

    // Tutup koneksi
    $conn->close();
} else {
    // Jika halaman ini diakses tanpa menggunakan metode POST, kembalikan ke halaman sebelumnya
    header("Location: pembelian_barang.php");
}
?>
