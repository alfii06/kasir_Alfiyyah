<?php
// Validasi jika formulir dikirimkan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Ambil data dari formulir
    $suplier_id = $_POST['suplier_id'];
    $toko_id = $_POST['toko_id'];
    $nama_suplier = $_POST['nama_suplier'];
    $tlp_suplier = $_POST['tlp_suplier'];
    $alamat_suplier = $_POST['alamat_suplier'];
    $created_at = $_POST['created_at'];

    // Koneksi ke database (sesuaikan dengan koneksi Anda)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pos_alfi";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Periksa koneksi
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query untuk menambahkan data supplier
    $sql = "INSERT INTO suplier (suplier_id, toko_id, nama_suplier, tlp_suplier, alamat_suplier, created_at)
            VALUES ('$suplier_id', '$toko_id', '$nama_suplier', '$tlp_suplier', '$alamat_suplier', '$created_at')";

    if ($conn->query($sql) === TRUE) {
        // Redirect ke halaman data_supplier.php jika data berhasil ditambahkan
        header("Location: data_supplier.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Tutup koneksi
    $conn->close();
}
?>
