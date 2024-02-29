<?php
include 'koneksi.php';

// Query untuk mengambil data kategori
$sqlKategori = "SELECT * FROM produk_kategori";
$resultKategori = $conn->query($sqlKategori);

// Query untuk mengambil data produk
$sqlProduk = "SELECT * FROM produk";
$resultProduk = $conn->query($sqlProduk);

// Query untuk mengambil data detail penjualan
$sql = "SELECT * FROM penjualan_detail";
$result = $conn->query($sql);

// Tutup koneksi database
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Penjualan</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
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

        .tbs {
            margin-top: 20px;
        }

        .tbs div {
            margin-bottom: 10px;
        }

        .tbs label {
            display: inline-block;
            width: 100px;
        }

        .tbs input[type="number"] {
            width: 150px;
            padding: 5px;
        }

        .tbs button {
            padding: 5px 10px;
        }

        .no-data {
            display: none;
            color: red;
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <select id="kategori">
        <option value="">Pilih Kategori</option>
        <?php
        // Memuat pilihan kategori dari database
        if ($resultKategori->num_rows > 0) {
            while ($row = $resultKategori->fetch_assoc()) {
                echo "<option value='" . $row["kategori_id"] . "'>" . $row["nama_kategori"] . "</option>";
            }
        }
        ?>
    </select>
    <select id="namaBarang">
        <option value="" data-kategori="">Pilih Nama Barang</option>
        <?php
        // Memuat pilihan nama barang dari database
        if ($resultProduk->num_rows > 0) {
            while ($row = $resultProduk->fetch_assoc()) {
                echo "<option value='" . $row["produk_id"] . "' data-harga='" . $row["harga_jual"] . "' data-kategori='" . $row["kategori_id"] . "'>" . $row["nama_produk"] . "</option>";
            }
        }
        ?>
    </select>
    <input type="number" id="harga" placeholder="Harga" disabled>
    <input type="number" id="qty" placeholder="Qty">
    <button onclick="tambahBarang()">Input</button>
    <input type="number" name="bayar" id="bayar" placeholder="Bayar">
    <button onclick="hitung()">Hitung</button>

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
            <?php
            // Jika ada data yang dikembalikan dari query, tampilkan dalam tabel
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["produk_id"] . "</td>";
                    echo "<td>" . $row["qty"] . "</td>";
                    echo "<td>" . $row["harga_beli"] . "</td>";
                    echo "<td>" . $row["harga_jual"] . "</td>";
                    echo "</tr>";
                }
            } else {
                // Jika tidak ada data yang dikembalikan dari query, tampilkan pesan
                echo "<tr class='no-data'><td colspan='6'>Tidak ada data detail penjualan.</td></tr>";
            }
            ?>
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
        var namaBarangSelect = document.getElementById("namaBarang");
        var hargaInput = document.getElementById("harga");
        var totalAmountInput = document.getElementById("totalAmount");
        var tabelPenjualan = document.getElementById("tabelPenjualan").getElementsByTagName('tbody')[0];
        var noDataMessage = document.querySelector('.no-data');

        // Array untuk menyimpan data barang yang dibeli
        var purchasedItems = [];

        // Menampilkan harga berdasarkan pilihan nama barang
        namaBarangSelect.addEventListener("change", function() {
            var selectedOption = this.options[this.selectedIndex];
            var harga = selectedOption.getAttribute("data-harga");
            hargaInput.value = harga;
        });

        function tambahBarang() {
            var namaBarang = namaBarangSelect.options[namaBarangSelect.selectedIndex].text;
            var harga = parseFloat(hargaInput.value);
            var qty = parseInt(document.getElementById("qty").value);
            var jumlah = harga * qty;

            // Menambahkan barang yang dibeli ke dalam array purchasedItems
            purchasedItems.push({
                nama: namaBarang,
                harga: harga,
                qty: qty,
                jumlah: jumlah
            });

            // Menampilkan barang yang dibeli ke dalam tabel
            var newRow = tabelPenjualan.insertRow();
            var cellNo = newRow.insertCell(0);
            var cellIDPenjualan = newRow.insertCell(1);
            var cellNamaBarang = newRow.insertCell(2);
            var cellHargaJual = newRow.insertCell(3);
            var cellQty = newRow.insertCell(4);
            var cellJumlah = newRow.insertCell(5);

            cellNo.innerHTML = tabelPenjualan.rows.length;
            cellIDPenjualan.innerHTML = Math.floor(Math.random() * 10000) + 1; // ID Penjualan secara acak
            cellNamaBarang.innerHTML = namaBarang;
            cellHargaJual.innerHTML = harga;
            cellQty.innerHTML = qty;
            cellJumlah.innerHTML = jumlah;

            // Menghitung total jumlah pembelian dan memperbarui input total
            var totalAmount = purchasedItems.reduce(function(total, item) {
                return total + item.jumlah;
            }, 0);
            totalAmountInput.value = totalAmount.toFixed(2);

            // Sembunyikan pesan "Tidak ada data detail penjualan" jika sudah ada data
            noDataMessage.style.display = 'none';
        }

        function inputBayar() {
            // Implementasi fungsi inputBayar
            alert("Fungsi inputBayar belum diimplementasikan");
        }

        function hitung() {
            // Implementasi fungsi hitung
            alert("Fungsi hitung belum diimplementasikan");
        }

        // Memfilter opsi nama barang berdasarkan kategori yang dipilih
        document.getElementById('kategori').addEventListener('change', function() {
            var selectedCategoryId = this.value;
            var namaBarangOptions = document.getElementById('namaBarang').getElementsByTagName('option');

            for (var i = 0; i < namaBarangOptions.length; i++) {
                var option = namaBarangOptions[i];
                var optionCategoryId = option.getAttribute('data-kategori');

                if (selectedCategoryId === optionCategoryId || selectedCategoryId === '') {
                    option.style.display = 'block'; // Tampilkan opsi jika kategori cocok atau tidak ada kategori yang dipilih
                } else {
                    option.style.display = 'none'; // Sembunyikan opsi jika kategori tidak cocok
                }
            }
        });
    </script>

</body>

</html>