<?php
include 'koneksi.php';

// Inisialisasi data pembelian
$pembelianToAdd = [
    'pembelian_id' => '',
    'toko_id' => '',
    'user_id' => '',
    'no_faktur' => '',
    'tanggal_pembelian' => '',
    'suplier_id' => '',
    'keterangan' => '',
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

// Ambil data user dari database
$sql = "SELECT user_id, username FROM user";
$result = $conn->query($sql);
$userOptions = "";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $userOptions .= "<option value='" . $row["user_id"] . "'>" . $row["username"] . "</option>";
    }
}

// Ambil data supplier dari database
$sql = "SELECT suplier_id, nama_suplier FROM suplier";
$result = $conn->query($sql);
$supplierOptions = "";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $supplierOptions .= "<option value='" . $row["suplier_id"] . "'>" . $row["nama_suplier"] . "</option>";
    }
}

// Jika data pembelian sudah ada dalam formulir POST, gunakan data tersebut
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangani data POST
    $pembelianToAdd = [
        'pembelian_id' => $_POST['pembelianId'],
        'toko_id' => $_POST['tokoId'],
        'user_id' => $_POST['userId'],
        'no_faktur' => $_POST['noFaktur'],
        'tanggal_pembelian' => $_POST['tanggalPembelian'],
        'suplier_id' => $_POST['suplierId'],
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
    <title>Tambah Pembelian</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 110vh;
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

        select, input {
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

        /* CSS untuk penampilan tabel produk */
        #productTableContainer {
            float: right;
            width: 50%;
            padding-left: 20px;
            position: relative;
            bottom: 300px;
        }

        #productTable {
            border-collapse: collapse;
            width: 100%;
        }

        #productTable td, #productTable th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #productTable th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>

    <div id="formContainer">
        <h2>Tambah Pembelian</h2>

        <form id="formTambahPembelian" method="post" action="process_tambah_pembelian.php">

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

            <label for="noFaktur">No Faktur:</label>
            <input type="text" id="noFaktur" name="noFaktur" value="<?= $pembelianToAdd['no_faktur'] ?>" required>

            <label for="tanggalPembelian">Tanggal Pembelian:</label>
            <input type="date" id="tanggalPembelian" name="tanggalPembelian" value="<?= $pembelianToAdd['tanggal_pembelian'] ?>" required>

            <label for="suplierId">Nama Supplier:</label>
            <select id="suplierId" name="suplierId" required onchange="showProducts()">
                <option value="">Pilih Supplier</option>
                <?= $supplierOptions ?>
            </select>

            <label for="keterangan">Keterangan:</label>
            <input type="text" id="keterangan" name="keterangan" value="<?= $pembelianToAdd['keterangan'] ?>" required>

            <label for="createdAt">Created At:</label>
            <input type="text" id="createdAt" name="createdAt" value="<?= $pembelianToAdd['created_at'] ?>" readonly>

            <button id="simpanBtn" type="submit">Simpan</button>
            <button id="batalBtn" type="button" onclick="history.back()">Batal</button>
        </form>
    </div>
    <!-- Container untuk menampilkan tabel produk -->
    <div id="productTableContainer">
                <h3>Daftar Produk</h3>
                <table id="productTable">
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <!-- Kolom lain yang Anda inginkan -->
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Isi tabel produk akan ditampilkan di sini -->
                    </tbody>
                </table>
            </div>

    <script>
        // Fungsi untuk menampilkan tabel produk saat pilihan suplier berubah
        function showProducts() {
            // Dapatkan nilai suplier yang dipilih
            var suplierId = document.getElementById("suplierId").value;
            
            // Buat objek XMLHTTPRequest
            var xhttp = new XMLHttpRequest();

            // Tetapkan fungsi yang akan dijalankan saat permintaan selesai
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Ketika permintaan selesai dan berhasil, tampilkan respons di dalam tabel produk
                    document.getElementById("productTable").innerHTML = this.responseText;
                }
            };

            // Kirim permintaan GET ke server untuk mendapatkan daftar produk dari suplier yang dipilih
            xhttp.open("GET", "get_products.php?suplierId=" + suplierId, true);
            xhttp.send();
        }
    </script>
</body>

</html>
