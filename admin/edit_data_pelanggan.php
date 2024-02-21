<?php

$pelangganToEdit = [ // Inisialisasi default jika tidak ada parameter pelanggan_id
    'pelanggan_id' => '',
    'toko_id' => '',
    'nama_pelanggan' => '',
    'alamat' => '',
    'no_hp' => '',
    'created_at' => ''
];

// Ambil parameter pelanggan_id dari URL
if (isset($_GET['id'])) {
    // Contoh pengambilan data pelanggan dari database berdasarkan pelanggan_id
    // Gantilah bagian ini dengan kueri atau metode pengambilan data sesuai dengan struktur database Anda
    $pelanggan_id = $_GET['id'];
    // Misalnya, Anda menggunakan PDO untuk koneksi ke database
    $pdo = new PDO("mysql:host=localhost;dbname=pos_alfi", "root", "");
    $stmt = $pdo->prepare("SELECT * FROM pelanggan WHERE pelanggan_id = :pelanggan_id");
    $stmt->bindParam(":pelanggan_id", $pelanggan_id, PDO::PARAM_INT);
    $stmt->execute();
    $pelangganToEdit = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Jika data pelanggan sudah ada dalam formulir POST, gunakan data tersebut
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pelangganToEdit = [
        'pelanggan_id' => $_POST['pelangganId'],
        'toko_id' => $_POST['tokoId'],
        'nama_pelanggan' => $_POST['namaPelanggan'],
        'alamat' => $_POST['alamat'],
        'no_hp' => $_POST['noHp'],
        'created_at' => $_POST['createdAt'],
    ];
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Pelanggan</title>
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
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
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
    </style>
</head>
<body>

<div id="formContainer">
    <h2>Edit Data Pelanggan</h2>

    <form id="formEditPelanggan" method="post" action="process_edit_pelanggan.php">
    <!-- Remove the Pelanggan ID input field -->
    <label for="pelangganId">Pelanggan ID:</label>
    <input type="text" id="pelangganId" name="pelangganId" value="<?= $pelangganToEdit['pelanggan_id'] ?>" readonly>

    <label for="tokoId">Toko ID:</label>
    <input type="text" id="tokoId" name="tokoId" value="<?= $pelangganToEdit['toko_id'] ?>" required>

    <label for="namaPelanggan">Nama Pelanggan:</label>
    <input type="text" id="namaPelanggan" name="namaPelanggan" value="<?= $pelangganToEdit['nama_pelanggan'] ?>" required>

    <label for="alamat">Alamat:</label>
    <input type="text" id="alamat" name="alamat" value="<?= $pelangganToEdit['alamat'] ?>" required>

    <label for="noHp">No HP:</label>
    <input type="text" id="noHp" name="noHp" value="<?= $pelangganToEdit['no_hp'] ?>" required>

    <label for="createdAt">Created At:</label>
    <input type="text" id="createdAt" name="createdAt" value="<?= $pelangganToEdit['created_at'] ?>" readonly>

    <a href="../admin/data_pelanggan.php"></a><button id="simpanBtn" type="submit">Simpan Perubahan</button>
    <button id="batalBtn" type="button" onclick="history.back()">Batal</button>
</form>


</div>

</body>
</html>
