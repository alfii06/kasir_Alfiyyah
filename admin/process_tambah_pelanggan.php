<?php
// Pastikan sudah ada koneksi ke database
$conn = new mysqli ('localhost', 'root', '', 'pos_alfi');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $tokoId = $_POST['tokoNama'];
    $namaPelanggan = $_POST['namaPelanggan'];
    $alamat = $_POST['alamat'];
    $noHp = $_POST['noHp'];
    // Misalnya, Anda ingin menggunakan waktu saat ini sebagai nilai default untuk created_at
    $createdAt = date('Y-m-d H:i:s');

    // Query untuk memasukkan data ke dalam tabel pelanggan
    $sql = "INSERT INTO pelanggan (toko_id, nama_pelanggan, alamat, no_hp, created_at) 
            VALUES ('$tokoId', '$namaPelanggan', '$alamat', '$noHp', '$createdAt')";

    if ($conn->query($sql) === TRUE) {
        header("Location: data_pelanggan.php");
        exit();
    } else {
        // Jika terjadi kesalahan dalam eksekusi query
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    // Tutup koneksi
    $conn->close();
}
?>
