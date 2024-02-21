<?php
include 'koneksi.php';

// Mengambil nama pelanggan dari penjualan
$nama_pelanggan = ""; // Variabel untuk menyimpan nama pelanggan
if(isset($_GET['id'])) {
    $penjualan_id = $_GET['id'];
    $sql_pelanggan = "SELECT pelanggan.nama_pelanggan FROM penjualan 
                      INNER JOIN pelanggan ON penjualan.pelanggan = pelanggan.pelanggan_id 
                      WHERE penjualan.penjualan_id = $penjualan_id LIMIT 1";
    $result_pelanggan = $conn->query($sql_pelanggan);

    // Periksa apakah query berhasil dieksekusi
    if ($result_pelanggan) {
        // Periksa apakah hasil query tidak kosong
        if ($result_pelanggan->num_rows > 0) {
            $row_pelanggan = $result_pelanggan->fetch_assoc();
            $nama_pelanggan = $row_pelanggan['nama_pelanggan'];
        } else {
            echo "Data pelanggan tidak ditemukan.";
        }
    } else {
        echo "Error executing query: " . $conn->error;
    }
}

// Mengambil data produk dari database
$sql_produk = "SELECT produk_id, nama_produk, harga_beli, harga_jual FROM produk";
$result_produk = $conn->query($sql_produk);

// Array untuk menyimpan data produk
$products = [];

// Memasukkan data produk ke dalam array
if ($result_produk->num_rows > 0) {
    while ($row = $result_produk->fetch_assoc()) {
        $products[] = $row;
    }
}

// Menutup koneksi database
$conn->close();
?>
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
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .input-field {
            margin-bottom: 20px;
        }

        .input-field label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .input-field input,
        .input-field select {
            width: calc(100% - 22px);
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .input-field button {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 10px;
        }

        .input-field button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
<div class="container">
    <h2>Detail Penjualan</h2>
    <form id="formDetailPenjualan" action="process_detail_penjualan.php" method="POST">
        <!-- Tambahkan input tersembunyi untuk penjualan_id -->
        <input type="hidden" id="penjualan_id" name="penjualan_id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">

        <div class="input-field">
            <label for="nama_pelanggan">Nama Pelanggan</label>
            <input type="text" id="nama_pelanggan" name="nama_pelanggan" value="<?php echo $nama_pelanggan; ?>" readonly>
        </div>
        <div class="input-field">
            <label for="produk">Produk</label>
            <select id="produk" name="produk" onchange="updatePrice()">
                <option>Pilih Produk</option>
                <?php foreach ($products as $product): ?>
                    <option value="<?= $product["produk_id"] ?>" data-harga-beli="<?= $product["harga_beli"] ?>" data-harga-jual="<?= $product["harga_jual"] ?>"><?= $product["nama_produk"] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="input-field">
            <label for="qty">Qty</label>
            <input type="number" id="qty" name="qty" oninput="updateTotal()">
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
            <button type="button" onclick="saveData()">Simpan</button>
            <button type="submit">Submit dan Lihat Detail</button>
        </div>
    </form>
</div>


<script>
    function updatePrice() {
        var select = document.getElementById("produk");
        var selectedOption = select.options[select.selectedIndex];
        document.getElementById("harga_beli").value = selectedOption.getAttribute("data-harga-beli");
        document.getElementById("harga_jual").value = selectedOption.getAttribute("data-harga-jual");
    }

    function updateTotal() {
        var qty = parseInt(document.getElementById("qty").value);
        var selectedOption = document.getElementById("produk").options[document.getElementById("produk").selectedIndex];
        var hargaJual = parseInt(selectedOption.getAttribute("data-harga-jual"));
        document.getElementById("harga_jual").value = hargaJual * qty;
    }

    
    function saveData() {
        // Mendapatkan nilai dari semua input
        var penjualan_id = document.getElementById("penjualan_id").value;
        var nama_pelanggan = document.getElementById("nama_pelanggan").value;
        var produk = document.getElementById("produk").value;
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
    // Function to clear the input fields in the detail penjualan form
    function clearForm() {
        document.getElementById("produk").selectedIndex = 0;
        document.getElementById("qty").value = "";
        document.getElementById("harga_beli").value = "";
        document.getElementById("harga_jual").value = "";
    }
</script>

</body>

</html>
