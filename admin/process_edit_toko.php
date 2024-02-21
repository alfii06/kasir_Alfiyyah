<?php
$tokoToEdit = [
    'toko_id' => '',
    'nama_toko' => '',
    'alamat' => '',
    'tlp_hp' => '',
    'created_at' => ''
];

if (isset($_GET['id'])) {
    $toko_id = $_GET['id'];
    $mysqli = new mysqli("localhost", "root", "", "pos_alfi");

    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
    }

    $query = "SELECT * FROM toko WHERE toko_id = $toko_id";
    if ($result = $mysqli->query($query)) {
        $tokoData = $result->fetch_assoc();
        if ($tokoData) {
            $tokoToEdit = $tokoData;
        } else {
            echo "Data toko tidak ditemukan.";
        }
        $result->free();
    } else {
        echo "Error: " . $mysqli->error;
    }

    $mysqli->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tokoToEdit = [
        'toko_id' => $_POST['tokoId'],
        'nama_toko' => $_POST['namaToko'],
        'alamat' => $_POST['alamat'],
        'tlp_hp' => $_POST['tlpHp'],
        'created_at' => $_POST['createdAt'],
    ];
    $toko_id = $_POST['tokoId'];

    $mysqli = new mysqli("localhost", "root", "", "pos_alfi");

    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
    }

    $nama_toko = $mysqli->real_escape_string($tokoToEdit['nama_toko']);
    $alamat = $mysqli->real_escape_string($tokoToEdit['alamat']);
    $tlp_hp = $mysqli->real_escape_string($tokoToEdit['tlp_hp']);

    $query = "UPDATE toko SET nama_toko='$nama_toko', alamat='$alamat', tlp_hp='$tlp_hp' WHERE toko_id=$toko_id";

    if ($mysqli->query($query) === TRUE) {
        header("Location: toko.php");
    } else {
        echo "Error: " . $mysqli->error;
    }

    $mysqli->close();
}
?>
