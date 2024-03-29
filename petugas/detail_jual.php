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

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .input-field {
            flex: 1;
            margin-right: 10px;
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
        <div class="input-field">
            <label for="nama_produk">Nama Produk</label>
            <select id="nama_produk" onchange="updateHarga()">
                <option value="">Pilih Nama Produk</option>
                <?php
                // Buat koneksi ke database
                $koneksi = mysqli_connect("localhost", "root", "", "pos_alfi");

                // Periksa koneksi
                if (mysqli_connect_errno()) {
                    echo "Koneksi database gagal: " . mysqli_connect_error();
                    exit();
                }

                // Query untuk mengambil data produk
                $query = "SELECT produk_id, nama_produk, harga_jual FROM produk";

                // Eksekusi query
                $result = mysqli_query($koneksi, $query);

                // Loop untuk menampilkan opsi produk
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['produk_id'] . "' data-harga-jual='" . $row['harga_jual'] . "'>" . $row['nama_produk'] . "</option>";
                }

                // Tutup koneksi
                mysqli_close($koneksi);
                ?>
            </select>
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
        <div class="input-field">
            <label for="bayar">Bayar:</label>
            <input type="number" id="bayarInput" name="bayar">
            <button type="button" onclick="bayar()">Bayar</button>
        </div>
    </div>

    <table id="tabelPenjualan">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Penjualan</th>
                <th>Nama Barang</th>
                <th>Harga</th>
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
        var idPenjualan = 1; // ID penjualan akan dimulai dari 1
        var totalAmount = 0; // Total keseluruhan

        function updateHarga() {
            var selectedOption = document.getElementById("nama_produk").options[document.getElementById("nama_produk").selectedIndex];
            var hargaJual = parseInt(selectedOption.getAttribute("data-harga-jual"));
            document.getElementById("harga_jual").value = hargaJual;
        }

        function updateTotal() {
            var qty = parseInt(document.getElementById("qty").value);
            var hargaJual = parseInt(document.getElementById("harga_jual").value);
            document.getElementById("harga_jual").value = hargaJual; // Harga tetap sama, tidak perlu ditambah qty
        }

        // Fungsi untuk menangani perubahan total dan penyimpanan ke localStorage
        function updateTotalAndLocalStorage() {
            var total = 0;
            var tableRows = document.getElementById("tabelPenjualan").getElementsByTagName("tbody")[0].rows;
            for (var i = 0; i < tableRows.length; i++) {
                total += parseFloat(tableRows[i].cells[5].innerHTML);
            }
            totalAmount = total;
            document.getElementById("totalAmount").value = total.toFixed(2);
            localStorage.setItem("totalAmount", total.toFixed(2)); // Simpan total ke localStorage
        }

        function saveData() {
            // Mendapatkan nilai dari semua input
            var namaProduk = document.getElementById("nama_produk").options[document.getElementById("nama_produk").selectedIndex].text;
            var qty = parseInt(document.getElementById("qty").value);
            var hargaJual = parseInt(document.getElementById("harga_jual").value);
            var total = hargaJual * qty; // Menghitung harga jual dikalikan dengan qty

            // Membuat baris baru untuk tabel penjualan
            var table = document.getElementById("tabelPenjualan").getElementsByTagName("tbody")[0];
            var newRow = table.insertRow(-1); // -1 untuk menyisipkan di akhir tabel

            // Mengisi data ke dalam baris baru
            var cellNumber = newRow.insertCell(0);
            var cellIdPenjualan = newRow.insertCell(1);
            var cellNamaBarang = newRow.insertCell(2);
            var cellHargaJual = newRow.insertCell(3);
            var cellQty = newRow.insertCell(4);
            var cellJumlah = newRow.insertCell(5);

            cellNumber.innerHTML = table.rows.length; // Nomor urutan baris dimulai dari 1
            cellIdPenjualan.innerHTML = idPenjualan++; // Menambahkan ID penjualan dan meningkatkan nilai untuk ID penjualan berikutnya
            cellNamaBarang.innerHTML = namaProduk; // Nama produk
            cellHargaJual.innerHTML = hargaJual; // Harga jual
            cellQty.innerHTML = qty; // Qty
            cellJumlah.innerHTML = total; // Total

            // Menambahkan total pada totalAmount
            totalAmount += total;
            document.getElementById("totalAmount").value = totalAmount;

            // Menyimpan data tabel penjualan ke localStorage
            saveToLocalStorage();

            // Memperbarui localStorage setiap kali ada perubahan
            updateTotalAndLocalStorage();
        }

        // Fungsi untuk menangani pembayaran
        function bayar() {
            var total = parseFloat(document.getElementById("totalAmount").value);
            var bayar = parseFloat(document.getElementById("bayarInput").value);

            // Periksa apakah jumlah pembayaran mencukupi
            if (bayar >= total) {
                var sisa = bayar - total;
                document.getElementById("sisa").value = sisa.toFixed(2);
                alert("Pembayaran berhasil. Sisa: " + sisa.toFixed(2));

                // Simpan nilai pembayaran ke dalam localStorage
                localStorage.setItem("bayar", bayar);
            } else {
                alert("Jumlah pembayaran kurang.");
            }

            // Memperbarui localStorage setiap kali ada perubahan
            updateTotalAndLocalStorage();
        }

        function saveToLocalStorage() {
            var tableData = [];
            var tableRows = document.getElementById("tabelPenjualan").rows;
            for (var i = 1; i < tableRows.length; i++) { // Mulai dari 1 untuk melewati baris judul
                var rowData = [];
                for (var j = 0; j < tableRows[i].cells.length; j++) {
                    rowData.push(tableRows[i].cells[j].innerHTML);
                }
                tableData.push(rowData);
            }
            localStorage.setItem("tabelPenjualan", JSON.stringify(tableData));
        }

        document.addEventListener("DOMContentLoaded", function() {
            // Cek apakah ada nilai pembayaran yang tersimpan di localStorage
            var storedBayar = localStorage.getItem("bayar");
            if (storedBayar) {
                document.getElementById("bayarInput").value = storedBayar;
            }
        });

        window.addEventListener("beforeunload", function() {
            // Simpan data tabel penjualan ke localStorage sebelum halaman dimuat ulang
            saveToLocalStorage();
        });
    </script>

</body>

</html>
