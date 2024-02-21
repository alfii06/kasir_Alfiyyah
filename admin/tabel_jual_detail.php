<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Detail Penjualan</title>
    <link href="../dashboard/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../dashboard/css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        body{
            padding: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            margin-right: 100px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            color: #000;
        }

        th {
            background-color: #f2f2f2;
        }

        button {
            padding: 5px 10px;
            margin-right: 5px;
        }
    </style>
</head>

<body>

    <h2>Data Detail Penjualan</h2>

    <!-- Tombol untuk menampilkan form tambah penjualan -->
    <a href="../admin/detail_penjualan.php"><button onclick="tambahPenjualan()" class='btn btn-primary'>Tambah Penjualan</button></a>

    <table id="tabelDetailPenjualan">
        <tr>
            <th>ID Produk</th>
            <th>Qty</th>
            <th>Harga Beli</th>
            <th>Harga Jual</th>
            <th>Aksi</th>
        </tr>
        <?php
        include 'koneksi.php';

        // Query untuk mengambil data detail penjualan
        $sql = "SELECT * FROM penjualan_detail";
        $result = $conn->query($sql);

        // Tampilkan data dalam tabel
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["produk_id"] . "</td>";
                echo "<td>" . $row["qty"] . "</td>";
                echo "<td>" . $row["harga_beli"] . "</td>";
                echo "<td>" . $row["harga_jual"] . "</td>";
                echo "<td>
                        <a href='edit_penjualan_barang.php?id=" . $row["penjualan_id"] . "' class='btn btn-success btn-sm'>Edit</a>
                        <a href='hapus_penjualan.php?id=" . $row["penjualan_id"] . "' class='btn btn-danger btn-sm' onclick=\"return confirm('Apakah Anda yakin ingin menghapus data ini?')\">Delete</a>
                    </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Tidak ada data detail penjualan.</td></tr>";
        }

        $conn->close();
        ?>
    </table>

    <!-- Total -->
    <div id="total">Total: <span id="totalAmount"></span></div>

    <!-- Form untuk input pembayaran -->
    <div>
        <label for="bayar">Bayar:</label>
        <input type="number" id="bayar" name="bayar">
        <label for="sisa">Sisa:</label>
        <span id="sisa">0.00</span>
    </div>

    <script>
        $(document).ready(function() {
            // Menghitung total dari isi tabel
            var total = 0;
            $("#tabelDetailPenjualan tbody tr").each(function() {
                var hargaJual = parseFloat($(this).find("td:eq(3)").text());
                total += hargaJual;
            });
            $("#totalAmount").text(total.toFixed(2));

            // Menghitung sisa
            $("#bayar").on("keyup", function() {
                var bayar = parseFloat($(this).val());
                var sisa = bayar - total;
                if (sisa >= 0) {
                    $("#sisa").text(sisa.toFixed(2));
                } else {
                    $("#sisa").text("0.00");
                }
            });
        });
    </script>

</body>

</html>
