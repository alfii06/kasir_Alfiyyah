<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "pos_alfi");

// Periksa koneksi
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal: " . mysqli_connect_error();
    exit();
}

// Ambil data kategori dari database
$query_kategori = "SELECT * FROM produk_kategori";
$result_kategori = mysqli_query($koneksi, $query_kategori);
$kategori_options = '';
while ($row = mysqli_fetch_assoc($result_kategori)) {
    $kategori_options .= '<option value="' . $row['kategori_id'] . '">' . $row['nama_kategori'] . '</option>';
}

// Ambil data toko dari database
$query_toko = "SELECT * FROM toko";
$result_toko = mysqli_query($koneksi, $query_toko);
$toko_options = '';
while ($row = mysqli_fetch_assoc($result_toko)) {
    $toko_options .= '<option value="' . $row['toko_id'] . '">' . $row['nama_toko'] . '</option>';
}

// Tutup koneksi
mysqli_close($koneksi);

// Contoh inisialisasi data barang untuk di-edit
$barangToEdit = [
    'produk_id' => '',
    'toko_id' => '',
    'nama_produk' => '',
    'kategori_id' => '',
    'satuan' => '',
    'harga_beli' => '',
    'harga_jual' => '',
    'stok_barang' => '',
    'created_at' => date("Y-m-d")
];

// Jika data barang sudah ada dalam formulir POST, gunakan data tersebut
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $barangToEdit = [
        'produk_id' => $_POST['produk_id'],
        'toko_id' => $_POST['toko_id'],
        'nama_produk' => $_POST['nama_produk'],
        'kategori_id' => $_POST['kategori_id'],
        'satuan' => $_POST['satuan'],
        'harga_beli' => $_POST['harga_beli'],
        'harga_jual' => $_POST['harga_jual'],
        'stok_barang' => $_POST['stok_barang'],
        'created_at' => $_POST['created_at'],
    ];
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Barang</title>
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

        input,
        select {
            width: calc(100% - 20px);
            margin-bottom: 10px;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 3px;
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
            float: right;
            background-color: #ccc;
            color: black;
            border: none;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <div id="formContainer">
        <h2>Tambah Barang</h2>

        <form id="formTambahBarang" method="post" action="process_tambah_barang.php">

            <!-- Dropdown untuk Toko ID -->
            <label for="toko_id">Nama Toko:</label>
            <select id="toko_id" name="toko_id" required>
                <option>Pilih Toko</option>
                <?= $toko_options ?>
            </select>

            <!-- Input Nama Produk tetap menggunakan input text -->
            <label for="nama_produk">Nama Produk:</label>
            <input type="text" id="nama_produk" name="nama_produk" value="<?= $barangToEdit['nama_produk'] ?>" required>

            <!-- Dropdown untuk Kategori ID -->
            <label for="kategori_id">Nama Kategori:</label>
            <select id="kategori_id" name="kategori_id" required>
                <option>Pilih Kategori</option>
                <?= $kategori_options ?>
            </select>

            <!-- Input Satuan tetap menggunakan input text -->
            <label for="satuan">Satuan:</label>
            <input type="text" id="satuan" name="satuan" value="<?= $barangToEdit['satuan'] ?>" required>

            <!-- Input Harga Beli, Harga Jual, dan Stok Barang tetap menggunakan input text -->
            <label for="harga_beli">Harga Beli:</label>
            <input type="text" id="harga_beli" name="harga_beli" value="<?= $barangToEdit['harga_beli'] ?>" required>

            <label for="harga_jual">Harga Jual:</label>
            <input type="text" id="harga_jual" name="harga_jual" value="<?= $barangToEdit['harga_jual'] ?>" required>

            <label for="stok_barang">Stok Barang:</label>
            <input type="text" id="stok_barang" name="stok_barang" value="<?= $barangToEdit['stok_barang'] ?>" required>

            <!-- Input Created At tetap menggunakan input text -->
            <label for="created_at">Created At:</label>
            <input type="text" id="created_at" name="created_at" value="<?= $barangToEdit['created_at'] ?>" readonly>

            <button id="simpanBtn" type="submit">Simpan</button>
            <button id="batalBtn" type="button" onclick="history.back()">Batal</button>
        </form>
    </div>

</body>

</html>
