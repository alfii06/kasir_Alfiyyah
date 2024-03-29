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

// Inisialisasi data penjualan
$penjualanToAdd = [
    'penjualan_id' => '',
    'toko_id' => '',
    'user_id' => '',
    'tanggal_penjualan' => '',
    'pelanggan' => '',
    'total' => '',
    'bayar' => '',
    'sisa' => '',
    'keterangan' => '',
    'created_at' => date("Y-m-d")
];

// Ambil data toko dari database
$sql = "SELECT toko_id, nama_toko FROM toko";
$result = $conn->query($sql);
$tokoOptions = "";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $tokoOptions .= "<option value='" . $row["toko_id"] . "'>" . $row["nama_toko"] . "</option>";
    }
}

// Ambil data user dari database
$sql = "SELECT user_id, username FROM user";
$result = $conn->query($sql);
$userOptions = "";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $userOptions .= "<option value='" . $row["user_id"] . "'>" . $row["username"] . "</option>";
    }
}

// Ambil data pelanggan dari database
$sql = "SELECT pelanggan_id, nama_pelanggan FROM pelanggan";
$result = $conn->query($sql);
$pelangganOptions = "";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pelangganOptions .= "<option value='" . $row["pelanggan_id"] . "'>" . $row["nama_pelanggan"] . "</option>";
    }
}

// Jika data penjualan sudah ada dalam formulir POST, gunakan data tersebut
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangani data POST
    $penjualanToAdd = [
        'penjualan_id' => $_POST['penjualanId'],
        'toko_id' => $_POST['tokoId'],
        'user_id' => $_POST['userId'],
        'tanggal_penjualan' => $_POST['tanggalPenjualan'],
        'pelanggan' => $_POST['pelanggan'],
        'total' => $_POST['total'],
        'bayar' => $_POST['bayar'],
        'sisa' => $_POST['sisa'],
        'keterangan' => $_POST['keterangan'],
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
    <title>Tambah Penjualan</title>
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

        select,
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
        <h2>Tambah Penjualan</h2>

        <form id="formTambahPenjualan" method="post" action="process_tambah_jual_detail.php">

            <label for="tokoId">Nama Toko:</label>
            <select id="tokoId" name="tokoId" required>
                <option value="">Pilih Toko</option>
                <?= $tokoOptions ?>
            </select>

            <label for="userId">Nama User:</label>
            <select id="userId" name="userId" required>
                <option value="">Pilih User</option>
                <?= $userOptions ?>
            </select>

            <label for="tanggalPenjualan">Tanggal Penjualan:</label>
            <input type="date" id="tanggalPenjualan" name="tanggalPenjualan" value="<?= $penjualanToAdd['tanggal_penjualan'] ?>" required>

            <label for="pelanggan">Pelanggan:</label>
            <select id="pelanggan" name="pelanggan" required>
                <option value="">Pilih Pelanggan</option>
                <?= $pelangganOptions ?>
            </select>

            <label for="createdAt">Created At:</label>
            <input type="text" id="createdAt" name="createdAt" value="<?= $penjualanToAdd['created_at'] ?>" readonly>

            <button id="simpanBtn" type="submit">Simpan</button>
            <button id="batalBtn" type="button" onclick="history.back()">Batal</button>
        </form>
    </div>

</body>

</html>
