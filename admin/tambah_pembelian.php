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
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
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
            margin-bottom: 20px;
        }

        /* CSS untuk penampilan tabel produk */
        #productTableContainer {
            float: right;
            width: 50%;
            padding-left: 20px;
        }

        #productTable {
            border-collapse: collapse;
            width: 100%;
        }

        #productTable td,
        #productTable th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #productTable th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #f2f2f2;
        }

        /* Tambahkan gaya untuk checkbox */
        .checkbox-label {
            display: block;
            position: relative;
            padding-left: 25px;
            margin-bottom: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .checkbox-label input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 20px;
            width: 20px;
            background-color: #eee;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .checkbox-label:hover input~.checkmark {
            background-color: #ccc;
        }

        .checkbox-label input:checked~.checkmark {
            background-color: #2196F3;
        }

        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        .checkbox-label input:checked~.checkmark:after {
            display: block;
        }

        .checkbox-label .checkmark:after {
            left: 7px;
            top: 3px;
            width: 6px;
            height: 12px;
            border: solid white;
            border-width: 0 3px 3px 0;
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
        }
    </style>
</head>

<body>
    <div style='display:flex;flex-direction:row;'>

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
                        <th>Qty</th>
                        <th>Pilih</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Ekonomi</td>
                        <td>Rp. 20.000</td>
                        <td><input type="number" id="qtyEkonomi" name="qtyEkonomi" min="0" style="width:60px;" oninput="hitungSisa()"></td>
                        <td><input type="checkbox" class="selectProduct" id="chkEkonomi" name="selectProduct[]" value="Ekonomi" onchange="updateQty(this)"></td>
                    </tr>
                    <tr>
                        <td>Kopi</td>
                        <td>Rp. 25.000</td>
                        <td><input type="number" id="qtyKopi" name="qtyKopi" min="0" style="width:60px;" oninput="hitungSisa()"></td>
                        <td><input type="checkbox" class="selectProduct" id="chkKopi" name="selectProduct[]" value="Kopi" onchange="updateQty(this)"></td>
                    </tr>
                    <tr>
                        <td>Nabati</td>
                        <td>Rp. 20.000</td>
                        <td><input type="number" id="qtyNabati" name="qtyNabati" min="0" style="width:60px;" oninput="hitungSisa()"></td>
                        <td><input type="checkbox" class="selectProduct" id="chkNabati" name="selectProduct[]" value="Nabati" onchange="updateQty(this)"></td>
                    </tr>
                </tbody>
            </table>
            <!-- Tambahkan tombol "Selesai" -->
            <button id="selesaiBtn" onclick="selesaiPembelian()" style="margin-left:190px;">Selesai</button>
            <!-- Tambahkan div untuk menampilkan total, bayar, dan sisa -->
            <div id="totalBayar">
                <div>Total: <span id="totalAmount" oninput="hitungTotal()">0</span></div>
                <div>
                    <label for="bayar">Bayar:</label>
                    <input type="number" id="bayar" name="bayar" oninput="hitungSisa()">
                </div>
                <div>Sisa: <span id="sisaBayar" oninput="hitungSisa()">0</span></div>
            </div>
        </div>
    </div>

    <script>
        // Fungsi untuk menghitung total pembelian
        function updateTotal() {
            let total = 0;
            const checkboxes = document.querySelectorAll('.selectProduct:checked');
            checkboxes.forEach(function (checkbox) {
                const productName = checkbox.value;
                const qty = parseFloat(document.getElementById('qty' + productName).value) || 0;
                const harga = getProductPrice(productName); // Panggil fungsi getProductPrice() untuk mendapatkan harga produk
                total += harga * qty;
            });
            document.getElementById('totalAmount').textContent = total.toFixed(2);
            return total;
        }

        // Fungsi untuk mendapatkan harga produk berdasarkan namanya
        function getProductPrice(productName) {
            // Harga barang (di sini diimplementasikan secara statis, Anda dapat memodifikasi agar sesuai dengan kebutuhan Anda)
            const hargaBarang = {
                "Ekonomi": 20000,
                "Kopi": 25000,
                "Nabati": 20000
            };

            return hargaBarang[productName] || 0; // Kembalikan harga produk, jika tidak ada, kembalikan 0
        }

        // Fungsi untuk menghitung sisa pembayaran
        function hitungSisa() {
            const total = updateTotal();
            const bayar = parseFloat(document.getElementById('bayar').value) || 0; // tambahkan || 0 untuk menangani input yang kosong
            const sisa = bayar - total;
            document.getElementById('sisaBayar').textContent = isNaN(sisa) ? 0 : (sisa >= 0 ? sisa.toFixed(2) : 0); // tangani jika sisa adalah NaN dan pastikan tidak negatif
        }

        // Fungsi untuk memperbarui checkbox dan menghitung total saat jumlah barang diubah
        function updateCheckbox(element, productName) {
            const checkbox = document.getElementById('chk' + productName);
            checkbox.checked = element.value > 0;
            hitungSisa();
        }

        // Fungsi untuk memperbarui jumlah barang dan menghitung total saat checkbox diubah
        function updateQty(element) {
            const productName = element.value;
            const qtyInput = document.getElementById('qty' + productName);
            qtyInput.value = element.checked ? 1 : 0;
            hitungSisa();
        }

        // Tambahkan event listener untuk checkbox dan input jumlah barang
        const checkboxes = document.querySelectorAll('.selectProduct');
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                updateQty(this);
            });
        });

        const qtyInputs = document.querySelectorAll('input[type="number"]');
        qtyInputs.forEach(function (input) {
            input.addEventListener('input', function () {
                updateCheckbox(this, input.id.replace('qty', ''));
            });
        });

        // Panggil hitungSisa() untuk menginisialisasi total saat halaman dimuat
        window.onload = function () {
            hitungSisa();
        };

        // Fungsi untuk menampilkan pesan dan mengonfirmasi pembelian selesai
        function selesaiPembelian() {
            // Hitung total
            const total = updateTotal();
            
            // Dapatkan nilai bayar dari input
            const bayarInput = document.getElementById('bayar');
            const bayar = parseFloat(bayarInput.value) || 0; // tambahkan || 0 untuk menangani input yang kosong

            // Hitung sisa pembayaran
            const sisa = bayar - total;

            // Perbarui tampilan sisa
            document.getElementById('sisaBayar').textContent = isNaN(sisa) ? 0 : (sisa >= 0 ? sisa.toFixed(2) : 0);

            // Tampilkan notifikasi sesuai dengan sisa pembayaran
            if (!isNaN(total)) {
                if (sisa >= 0) {
                    // Jika pembayaran mencukupi
                    alert('Pembelian berhasil. Total yang harus dibayar: Rp. ' + total.toFixed(2) + '. Sisa: Rp. ' + sisa.toFixed(2));
                } else {
                    // Jika pembayaran tidak mencukupi
                    alert('Pembayaran tidak mencukupi. Total yang harus dibayar: Rp. ' + total.toFixed(2) + '. Silakan periksa kembali pembayaran Anda.');
                }
            } else {
                // Jika jumlah barang yang dibeli tidak valid
                alert('Mohon masukkan jumlah barang yang dibeli.');
            }
        }

    </script>
</body>

</html>
