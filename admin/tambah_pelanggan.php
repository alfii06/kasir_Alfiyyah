<?php
// Buat koneksi ke database
$servername = "localhost";
$username = "root"; 
$password = "";
$dbname = "pos_alfi";

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Inisialisasi data pelanggan untuk di-edit
$pelangganToEdit = [
    'pelanggan_id' => '',
    'toko_id' => '', 
    'nama_pelanggan' => '',
    'alamat' => '',
    'no_hp' => '',
    'created_at' => date("Y-m-d")
];

// Ambil data toko dari database
$sql = "SELECT toko_id, nama_toko FROM toko";
$result = $conn->query($sql);
$tokoOptions = "";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $tokoOptions .= "<option value='" . $row["toko_id"] . "'>" . $row["nama_toko"] . "</option>";
    }
}

// Jika data pelanggan sudah ada dalam formulir POST, gunakan data tersebut
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pelangganToEdit = [
        'pelanggan_id' => $_POST['pelangganId'],
        'toko_id' => $_POST['tokoNama'], // Mengambil nama toko dari formulir
        'nama_pelanggan' => $_POST['namaPelanggan'],
        'alamat' => $_POST['alamat'],
        'no_hp' => $_POST['noHp'],
        'created_at' => $_POST['createdAt'],
    ];
}

// Tutup koneksi
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Pelanggan</title>
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

        input, select {
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

        h2{
            text-align: center;
        }
    </style>
</head>

<body>

    <div id="formContainer">
        <h2>Tambah Pelanggan</h2>

        <form id="formEditPelanggan" method="post" action="process_tambah_pelanggan.php">
            
            <label for="tokoNama">Nama Toko:</label>
            <select id="tokoNama" name="tokoNama" required>
                <option value="">Pilih Toko</option>
                <?= $tokoOptions ?>
            </select>

            <label for="namaPelanggan">Nama Pelanggan:</label>
            <input type="text" id="namaPelanggan" name="namaPelanggan" value="<?= $pelangganToEdit['nama_pelanggan'] ?>" required>

            <label for="alamat">Alamat:</label>
            <input type="text" id="alamat" name="alamat" value="<?= $pelangganToEdit['alamat'] ?>" required>

            <label for="noHp">No HP:</label>
            <input type="text" id="noHp" name="noHp" value="<?= $pelangganToEdit['no_hp'] ?>" required>

            <label for="createdAt">Created At:</label>
            <input type="text" id="createdAt" name="createdAt" value="<?= $pelangganToEdit['created_at'] ?>" readonly>

            <button id="simpanBtn" type="submit">Simpan</button>
            <button id="batalBtn" type="button" onclick="history.back()">Batal</button>
        </form>
    </div>

</body>

</html>
