<?php
// Contoh inisialisasi data toko untuk di-edit
$tokoToEdit = [
    'toko_id' => '',
    'nama_toko' => '',
    'alamat' => '',
    'tlp_hp' => '',
    'created_at' => date("Y-m-d")
];

// Jika data toko sudah ada dalam formulir POST, gunakan data tersebut
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tokoToEdit = [
        'toko_id' => $_POST['toko_id'],
        'nama_toko' => $_POST['nama_toko'],
        'alamat' => $_POST['alamat'],
        'tlp_hp' => $_POST['tlp_hp'],
        'created_at' => $_POST['created_at'],
    ];
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Toko</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
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
        <h2>Tambah Toko</h2>

        <form id="formTambahToko" method="post" action="process_tambah_toko.php">
            <label for="toko_id">Toko ID:</label>
            <input type="text" id="toko_id" name="toko_id" value="<?= $tokoToEdit['toko_id'] ?>" readonly>

            <label for="nama_toko">Nama Toko:</label>
            <input type="text" id="nama_toko" name="nama_toko" value="<?= $tokoToEdit['nama_toko'] ?>" required>

            <label for="alamat">Alamat:</label>
            <input type="text" id="alamat" name="alamat" value="<?= $tokoToEdit['alamat'] ?>" required>

            <label for="tlp_hp">Telepon:</label>
            <input type="text" id="tlp_hp" name="tlp_hp" value="<?= $tokoToEdit['tlp_hp'] ?>" required>

            <label for="created_at">Created At:</label>
            <input type="text" id="created_at" name="created_at" value="<?= $tokoToEdit['created_at'] ?>" readonly>

            <button id="simpanBtn" type="submit">Simpan</button>
            <button id="batalBtn" type="button" onclick="history.back()">Batal</button>
        </form>
    </div>

</body>

</html>
