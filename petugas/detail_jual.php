<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .no-data {
            display: none;
            color: red;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Detail Penjualan</h2>
        <div class="input-field">
            <label for="kategori">Kategori</label>
            <select id="kategori">
                <option value="">Pilih Kategori</option>
                <!-- Opsi Kategori -->
            </select>
        </div>
        <div class="input-field">
            <label for="nama_produk">Nama Produk</label>
            <select id="nama_produk">
                <option value="">Pilih Nama Produk</option>
                <!-- Opsi Nama Produk -->
            </select>
        </div>
        <div class="input-field">
            <label for="harga_beli">Harga Beli</label>
            <input type="number" id="harga_beli" name="harga_beli" readonly>
        </div>
        <div class="input-field">
            <label for="harga_jual">Harga Jual</label>
            <input type="number" id="harga_jual" name="harga_jual" readonly>
        </div>
        <div class="input-field">
            <label for="qty">Qty</label>
            <input type="number" id="qty" name="qty" oninput="updateTotal()">
        </div>
        <div class="input-field">
            <button type="button" onclick="saveData()">Simpan</button>
        </div>
    </div>

    <table id="tabelPenjualan">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Penjualan</th>
                <th>Nama Barang</th>
                <th>Harga Jual</th>
                <th>Qty</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data Tabel Penjualan -->
        </tbody>
    </table>

    <!-- Bagian bawah tabel untuk total, bayar, dan sisa -->
    <div class="tbs">
        <div class="total">
            <label for="total">Total:</label>
            <input type="number" id="totalAmount" value="0.00" readonly>
        </div>
        <div class="bayar">
            <label for="bayar">Bayar:</label>
            <input type="number" id="bayarInput" name="bayar">
        </div>
        <div class="sisa">
            <label for="sisa">Sisa:</label>
            <input type="number" id="sisa" name="sisa" readonly>
        </div>
        <button onclick="hitung()">Hitung Sisa</button>
    </div>

    <script>
        function updateTotal() {
            var qty = parseInt(document.getElementById("qty").value);
            var selectedOption = document.getElementById("nama_produk").options[document.getElementById("nama_produk").selectedIndex];
            var hargaJual = parseInt(selectedOption.getAttribute("data-harga-jual"));
            document.getElementById("harga_jual").value = hargaJual * qty;
        }

        function saveData() {
            // Mendapatkan nilai dari semua input
            var penjualan_id = <?php echo isset($_GET['id']) ? $_GET['id'] : '0'; ?>;
            var nama_pelanggan = document.getElementById("nama_pelanggan").value;
            var produk = document.getElementById("nama_produk").value;
            var qty = document.getElementById("qty").value;
            var harga_beli = document.getElementById("harga_beli").value;
            var harga_jual = document.getElementById("harga_jual").value;

            // Mengirim data ke halaman process_detail_penjualan.php menggunakan AJAX
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "process_detail_penjualan.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Menampilkan pesan atau melakukan tindakan setelah penyimpanan data berhasil
                    alert(xhr.responseText); // Misalnya, menampilkan pesan dari server
                }
            };
            xhr.send("penjualan_id=" + penjualan_id + "&nama_pelanggan=" + nama_pelanggan + "&produk=" + produk + "&qty=" + qty + "&harga_beli=" + harga_beli + "&harga_jual=" + harga_jual);
        }
    </script>

</body>

</html>