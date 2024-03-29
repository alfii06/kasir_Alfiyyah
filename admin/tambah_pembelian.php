<?php
include 'koneksi.php';
session_start();
// Inisialisasi data pembelian
$pembelianToAdd = [
    'pembelian_id' => '',
    'toko_id' => '',
    'user_id' => '',
    'no_faktur' => '',
    'tanggal_pembelian' => '',
    'suplier_id' => '',
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

// Ambil data supplier dari database
$sql = "SELECT suplier_id, nama_suplier FROM suplier";
$result = $conn->query($sql);
$supplierOptions = "";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
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
    <title>Tambah Pembelian</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 120vh;
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

                <input type="hidden" id="pembelianId" name="pembelianId" value="">

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

                <input type="hidden" id="total" name="total" value="<?= $pembelianToAdd['total'] ?>">
                <input type="hidden" id="sisa" name="sisa" value="<?= $pembelianToAdd['sisa'] ?>">

                <!-- Tambahkan div untuk menampilkan total, bayar, dan sisa -->
                <div id="totalBayar">
                    <div>Total: <span id="totalAmount" oninput="updateTotal()">0</span></div>
                    <div>
                        <label for="bayar">Bayar:</label>
                        <input type="number" id="bayar" name="bayar" oninput="hitungSisa()">
                    </div>
                    <div>Sisa: <span id="sisaBayar" oninput="hitungSisa()">0</span></div>
                </div>

                <label for="keterangan">Keterangan:</label>
                <input type="text" id="keterangan" name="keterangan" value="<?= $pembelianToAdd['keterangan'] ?>" required>

                <input type="hidden" id="createdAt" name="createdAt" value="<?= date("Y-m-d") ?>">

                <button id="simpanBtn" type="submit">Simpan</button>
                <button id="batalBtn" type="button" onclick="history.back()">Batal</button>
            </form>
        </div>
        <!-- Container untuk menampilkan tabel produk -->
        <div id="productTableContainer">
            <h3>Daftar Produk</h3>
            <!-- Tabel Produk -->
            <table id="productTable">
                <thead>
                    <tr>
                        <th>Nama Alat Tulis Kantor</th>
                        <th>Harga Satuan</th>
                        <th>Jumlah</th>
                        <th>Pilih</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Pensil</td>
                        <td>Rp. 5.000</td>
                        <td><input type="number" id="qtyPensil" name="qtyPensil" min="0" style="width:60px;" oninput="hitungSisa()"></td>
                        <td><input type="checkbox" class="selectProduct" id="chkPensil" name="selectProduct[]" value="Pensil" onchange="updateQty(this)"></td>
                    </tr>
                    <tr>
                        <td>Bolpoin</td>
                        <td>Rp. 2.500</td>
                        <td><input type="number" id="qtyBolpoin" name="qtyBolpoin" min="0" style="width:60px;" oninput="hitungSisa()"></td>
                        <td><input type="checkbox" class="selectProduct" id="chkBolpoin" name="selectProduct[]" value="Bolpoin" onchange="updateQty(this)"></td>
                    </tr>
                    <tr>
                        <td>Penghapus</td>
                        <td>Rp. 2.000</td>
                        <td><input type="number" id="qtyPenghapus" name="qtyPenghapus" min="0" style="width:60px;" oninput="hitungSisa()"></td>
                        <td><input type="checkbox" class="selectProduct" id="chkPenghapus" name="selectProduct[]" value="Penghapus" onchange="updateQty(this)"></td>
                    </tr>
                    <tr>
                        <td>Penggaris</td>
                        <td>Rp. 2.000</td>
                        <td><input type="number" id="qtyPenggaris" name="qtyPenggaris" min="0" style="width:60px;" oninput="hitungSisa()"></td>
                        <td><input type="checkbox" class="selectProduct" id="chkPenggaris" name="selectProduct[]" value="Penggaris" onchange="updateQty(this)"></td>
                    </tr>
                    <tr>
                        <td>Pulpen</td>
                        <td>Rp. 3.000</td>
                        <td><input type="number" id="qtyPulpen" name="qtyPulpen" min="0" style="width:60px;" oninput="hitungSisa()"></td>
                        <td><input type="checkbox" class="selectProduct" id="chkPulpen" name="selectProduct[]" value="Pulpen" onchange="updateQty(this)"></td>
                    </tr>
                    <tr>
                        <td>Lem</td>
                        <td>Rp. 2.500</td>
                        <td><input type="number" id="qtyLem" name="qtyLem" min="0" style="width:60px;" oninput="hitungSisa()"></td>
                        <td><input type="checkbox" class="selectProduct" id="chkLem" name="selectProduct[]" value="Lem" onchange="updateQty(this)"></td>
                    </tr>
                </tbody>
            </table>
            <br>
        </div>
    </div>

    <script>
        // Fungsi untuk menghitung total pembelian dan memperbarui input tersembunyi
        function updateTotal() {
            let total = 0;
            const checkboxes = document.querySelectorAll('.selectProduct:checked');
            checkboxes.forEach(function(checkbox) {
                const productName = checkbox.value;
                const qty = parseFloat(document.getElementById('qty' + productName).value) || 0;
                const harga = getProductPrice(productName); // Panggil fungsi getProductPrice() untuk mendapatkan harga produk
                total += harga * qty;
            });
            document.getElementById('total').value = total; // Perbarui nilai input tersembunyi total
            document.getElementById('totalAmount').textContent = formatCurrency(total); // Format angka sebagai mata uang
            return total;
        }

        // Fungsi untuk memformat angka sebagai mata uang (Rp. 20,000.00)
        function formatCurrency(amount) {
            return 'Rp. ' + amount.toLocaleString('id-ID', {
                minimumFractionDigits: 2
            });
        }

        function getProductPrice(productName) {
            const hargaAlatTulis = {
                "Pensil": 5000,
                "Bolpoin": 2500,
                "Penghapus": 2000,
                "Penggaris": 2000,
                "Buku Tulis Kecil": 5000,
                "Buku Tulis Besar": 8000,
                "Pulpen": 3000,
                "Lem": 2500
            };

            return hargaAlatTulis[productName] || 0;
        }

        // Fungsi untuk menghitung sisa pembayaran dan memperbarui input tersembunyi
        function hitungSisa() {
            const total = updateTotal();
            let bayarValue = document.getElementById('bayar').value;
            // Hapus titik sebagai pemisah ribuan
            bayarValue = bayarValue.replace(/\./g, '');
            const bayar = parseFloat(bayarValue) || 0;
            const sisa = bayar - total;
            document.getElementById('sisa').value = sisa; // Perbarui nilai input tersembunyi sisa
            document.getElementById('sisaBayar').textContent = isNaN(sisa) ? 'Rp. 0,00' : (sisa >= 0 ? 'Rp. ' + sisa.toLocaleString('id-ID', {
                minimumFractionDigits: 2
            }) : 'Rp. 0,00');
        }

        // Fungsi untuk memperbarui checkbox dan menghitung total saat jumlah barang diubah
        function updateCheckbox(element, productName) {
            const qtyInput = document.getElementById('qty' + productName);
            const qty = parseFloat(qtyInput.value) || 0;
            const checkbox = document.getElementById('chk' + productName);
            checkbox.checked = qty > 0;
            hitungSisa();
        }

        // Tambahkan event listener untuk setiap checkbox
        const checkboxes = document.querySelectorAll('.selectProduct');
        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                updateQty(this); // Panggil updateQty() saat checkbox diubah
            });
        });

        // Fungsi untuk memperbarui jumlah barang dan checkbox terkait
        function updateQty(element) {
            const productName = element.value;
            const qtyInput = document.getElementById('qty' + productName);
            qtyInput.value = element.checked ? 1 : 0;
            updateCheckbox(element, productName); // Perbarui checkbox terkait
            hitungSisa(); // Hitung kembali total dan sisa pembayaran
        }

        const qtyInputs = document.querySelectorAll('input[type="number"]');
        qtyInputs.forEach(function(input) {
            input.addEventListener('input', function() {
                updateCheckbox(this, input.id.replace('qty', ''));
            });
        });

        // Panggil hitungSisa() untuk menginisialisasi total saat halaman dimuat
        window.onload = function() {
            hitungSisa();
            updateTotal();
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