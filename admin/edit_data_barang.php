<?php

$barangToEdit = [ // Inisialisasi default jika tidak ada parameter produk_id
    'produk_id' => '',
    'toko_id' => '',
    'nama_produk' => '',
    'kategori_id' => '',
    'satuan' => '',
    'harga_beli' => '',
    'harga_jual' => '',
    'stok_barang' => '',
    'created_at' => ''
];

// Ambil parameter produk_id dari URL
if (isset($_GET['id'])) {
    // Contoh pengambilan data barang dari database berdasarkan produk_id
    // Gantilah bagian ini dengan kueri atau metode pengambilan data sesuai dengan struktur database Anda
    $produk_id = $_GET['id'];
    // Misalnya, Anda menggunakan PDO untuk koneksi ke database
    $pdo = new PDO("mysql:host=localhost;dbname=pos_alfi", "root", "");
    $stmt = $pdo->prepare("SELECT * FROM produk WHERE produk_id = :produk_id");
    $stmt->bindParam(":produk_id", $produk_id, PDO::PARAM_INT);
    $stmt->execute();
    $barangToEdit = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Jika data barang sudah ada dalam formulir POST, gunakan data tersebut
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $barangToEdit = [
        'produk_id' => $_POST['produkId'],
        'toko_id' => $_POST['tokoId'],
        'nama_produk' => $_POST['namaProduk'],
        'kategori_id' => $_POST['kategoriId'],
        'satuan' => $_POST['satuan'],
        'harga_beli' => $_POST['hargaBeli'],
        'harga_jual' => $_POST['hargaJual'],
        'stok_barang' => $_POST['stokBarang'],
        'created_at' => $_POST['createdAt'],
    ];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Barang</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 130vh;
            margin: 0;
        }

        #formContainer {
            width: 400px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input {
            width: 100%;
            margin-bottom: 10px;
            padding: 8px;
            box-sizing: border-box;
        }

        button {
            width: 49%;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        #simpanBtn {
            background-color: #4CAF50;
            color: white;
            border: none;
        }

        #batalBtn {
            background-color: #ccc;
            color: black;
            border: none;
        }

        h2{
            text-align: center;
        }
    </style>
</head>
<body>

<div id="formContainer">
    <h2>Edit Data Barang</h2>

    <form id="formEditBarang" method="post" action="process_edit_barang.php">
        <!-- Remove the Barang ID input field -->
        <label for="produkId">Produk ID:</label>
        <input type="text" id="produkId" name="produkId" value="<?= $barangToEdit['produk_id'] ?>" readonly>

        <label for="tokoId">Toko ID:</label>
        <input type="text" id="tokoId" name="tokoId" value="<?= $barangToEdit['toko_id'] ?>" required>

        <label for="namaProduk">Nama Produk:</label>
        <input type="text" id="namaProduk" name="namaProduk" value="<?= $barangToEdit['nama_produk'] ?>" required>

        <label for="kategoriId">Kategori ID:</label>
        <input type="text" id="kategoriId" name="kategoriId" value="<?= $barangToEdit['kategori_id'] ?>" required>

        <label for="satuan">Satuan:</label>
        <input type="text" id="satuan" name="satuan" value="<?= $barangToEdit['satuan'] ?>" required>

        <label for="hargaBeli">Harga Beli:</label>
        <input type="text" id="hargaBeli" name="hargaBeli" value="<?= $barangToEdit['harga_beli'] ?>" required>

        <label for="hargaJual">Harga Jual:</label>
        <input type="text" id="hargaJual" name="hargaJual" value="<?= $barangToEdit['harga_jual'] ?>" required>
        
        <label for="stokBarang">Stok Barang:</label>
        <input type="text" id="stokBarang" name="stokBarang" value="<?= $barangToEdit['stok_barang'] ?>" required>

        <label for="createdAt">Created At:</label>
        <input type="text" id="createdAt" name="createdAt" value="<?= $barangToEdit['created_at'] ?>" readonly>

        <a href="../admin/data_barang.php"><button id="simpanBtn" type="submit">Simpan Perubahan</button></a>
        <button id="batalBtn" type="button" onclick="history.back()">Batal</button>
    </form>
</div>

</body>
</html>
