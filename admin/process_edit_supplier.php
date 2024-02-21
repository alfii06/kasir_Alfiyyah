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
    $suplierId = $_POST['suplierId'];
    $tokoId = $_POST['tokoId'];
    $namaSuplier = $_POST['namaSuplier'];
    $tlpSuplier = $_POST['tlpSuplier'];
    $alamatSuplier = $_POST['alamatSuplier'];

    // Query untuk melakukan update data supplier
    $sql = "UPDATE suplier SET toko_id='$tokoId', nama_suplier='$namaSuplier', tlp_suplier='$tlpSuplier', alamat_suplier='$alamatSuplier' WHERE suplier_id='$suplierId'";

    if ($conn->query($sql) === TRUE) {
        // Redirect kembali ke halaman edit dengan parameter sukses
        header("Location: data_supplier.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }

    // Tutup koneksi
    $conn->close();
} else {
    // Jika halaman ini diakses tanpa menggunakan metode POST, kembalikan ke halaman sebelumnya
    header("Location: data_supplier.php");
}
?>
