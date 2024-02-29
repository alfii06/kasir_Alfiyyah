<?php
include 'koneksi.php';

// Query untuk mengambil data kategori
$sqlKategori = "SELECT * FROM produk_kategori";
$resultKategori = $conn->query($sqlKategori);

// Query untuk mengambil data produk
$sqlProduk = "SELECT * FROM produk";
$resultProduk = $conn->query($sqlProduk);

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
        <option value="">Pilih Nama Barang</option>
        <?php
        // Memuat pilihan nama barang dari database
        if ($resultProduk->num_rows > 0) {
            while ($row = $resultProduk->fetch_assoc()) {
                echo "<option value='" . $row["produk_id"] . "' data-harga='" . $row["harga_jual"] . "'>" . $row["nama_produk"] . "</option>";
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
    </table>

    <script>
        var namaBarangSelect = document.getElementById("namaBarang");
        var hargaInput = document.getElementById("harga");

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

            var table = document.getElementById("tabelPenjualan").getElementsByTagName('tbody')[0];
            var newRow = table.insertRow();
            var cellNo = newRow.insertCell(0);
            var cellIDPenjualan = newRow.insertCell(1);
            var cellNamaBarang = newRow.insertCell(2);
            var cellHargaJual = newRow.insertCell(3);
            var cellQty = newRow.insertCell(4);
            var cellJumlah = newRow.insertCell(5);

            cellNo.innerHTML = table.rows.length;
            cellIDPenjualan.innerHTML = Math.floor(Math.random() * 10000) + 1; // ID Penjualan secara acak
            cellNamaBarang.innerHTML = namaBarang;
            cellHargaJual.innerHTML = harga;
            cellQty.innerHTML = qty;
            cellJumlah.innerHTML = jumlah;
        }

        function inputBayar() {
            // Implementasi fungsi inputBayar
            alert("Fungsi inputBayar belum diimplementasikan");
        }

        function hitung() {
            // Implementasi fungsi hitung
            alert("Fungsi hitung belum diimplementasikan");
        }
    </script>

</body>

</html>