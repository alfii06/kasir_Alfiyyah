<?php
// Contoh inisialisasi data supplier untuk di-edit
$supplierToEdit = [
    'suplier_id' => '',
    'toko_id' => '',
    'nama_suplier' => '',
    'tlp_suplier' => '',
    'alamat_suplier' => '',
    'created_at' => date("Y-m-d")
];

// Jika data supplier sudah ada dalam formulir POST, gunakan data tersebut
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $supplierToEdit = [
        'suplier_id' => $_POST['suplier_id'],
        'toko_id' => $_POST['toko_id'],
        'nama_suplier' => $_POST['nama_suplier'],
        'tlp_suplier' => $_POST['tlp_suplier'],
        'alamat_suplier' => $_POST['alamat_suplier'],
        'created_at' => $_POST['created_at'],
    ];
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Supplier</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 125vh;
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
            float: right;
            background-color: #ccc;
            color: black;
            border: none;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>

<body>

    <div id="formContainer">
        <h2>Tambah Supplier</h2>

        <form id="formTambahSupplier" method="post" action="process_tambah_supplier.php">
            <label for="suplier_id">Supplier ID:</label>
            <input type="text" id="suplier_id" name="suplier_id" value="<?= $supplierToEdit['suplier_id'] ?>" readonly>

            <label for="toko_id">Toko ID:</label>
            <input type="text" id="toko_id" name="toko_id" value="<?= $supplierToEdit['toko_id'] ?>" required>

            <label for="nama_suplier">Nama Supplier:</label>
            <input type="text" id="nama_suplier" name="nama_suplier" value="<?= $supplierToEdit['nama_suplier'] ?>" required>

            <label for="tlp_suplier">Nomor HP:</label>
            <input type="text" id="tlp_suplier" name="tlp_suplier" value="<?= $supplierToEdit['tlp_suplier'] ?>" required>

            <label for="alamat_suplier">Alamat Supplier:</label>
            <input type="text" id="alamat_suplier" name="alamat_suplier" value="<?= $supplierToEdit['alamat_suplier'] ?>" required>

            <label for="created_at">Created At:</label>
            <input type="text" id="created_at" name="created_at" value="<?= $supplierToEdit['created_at'] ?>" readonly>

            <a href="../admin/data_supplier.php"></a><button id="simpanBtn" type="submit">Simpan</button>
            <button id="batalBtn" type="button" onclick="history.back()">Batal</button>
        </form>
    </div>

</body>

</html>
