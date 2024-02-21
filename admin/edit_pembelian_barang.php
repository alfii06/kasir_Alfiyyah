<?php
$pembelianToEdit = [
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
    'created_at' => ''
];

if (isset($_GET['id'])) {
    $pembelian_id = $_GET['id'];
    $pdo = new PDO("mysql:host=localhost;dbname=pos_alfi", "root", "");

    try {
        $stmt = $pdo->prepare("SELECT * FROM pembelian WHERE pembelian_id = :pembelian_id");
        $stmt->bindParam(":pembelian_id", $pembelian_id, PDO::PARAM_INT);
        $stmt->execute();
        $pembelianData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($pembelianData !== false) {
            $pembelianToEdit = $pembelianData;
        } else {
            echo "Data pembelian tidak ditemukan.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pembelianToEdit = [
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pembelian Barang</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 160vh;
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

        input {
            width: 100%;
            margin-bottom: 10px;
            padding: 8px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        #simpanBtn {
            background-color: #4CAF50;
            color: white;
            border: none;
        }

        #batalBtn {
            background-color: #ccc;
            color: black;
            border: none;
        }
    </style>
</head>

<body>

    <div id="formContainer">
        <h2>Edit Pembelian Barang</h2>

        <form id="formEditPembelian" method="post" action="process_edit_pembelian.php">
            <label for="pembelianId">Pembelian ID:</label>
            <input type="text" id="pembelianId" name="pembelianId" value="<?= $pembelianToEdit['pembelian_id'] ?>" readonly>

            <label for="tokoId">Toko ID:</label>
            <input type="text" id="tokoId" name="tokoId" value="<?= $pembelianToEdit['toko_id'] ?>" required>

            <label for="userId">User ID:</label>
            <input type="text" id="userId" name="userId" value="<?= $pembelianToEdit['user_id'] ?>" required>

            <label for="noFaktur">Nomor Faktur:</label>
            <input type="text" id="noFaktur" name="noFaktur" value="<?= $pembelianToEdit['no_faktur'] ?>" required>

            <label for="tanggalPembelian">Tanggal Pembelian:</label>
            <input type="text" id="tanggalPembelian" name="tanggalPembelian" value="<?= $pembelianToEdit['tanggal_pembelian'] ?>" required>

            <label for="suplierId">Supplier ID:</label>
            <input type="text" id="suplierId" name="suplierId" value="<?= $pembelianToEdit['suplier_id'] ?>" required>

            <label for="total">Total:</label>
            <input type="text" id="total" name="total" value="<?= $pembelianToEdit['total'] ?>" required>

            <label for="bayar">Bayar:</label>
            <input type="text" id="bayar" name="bayar" value="<?= $pembelianToEdit['bayar'] ?>" required>

            <label for="sisa">Sisa:</label>
            <input type="text" id="sisa" name="sisa" value="<?= $pembelianToEdit['sisa'] ?>" required>

            <label for="keterangan">Keterangan:</label>
            <input type="text" id="keterangan" name="keterangan" value="<?= $pembelianToEdit['keterangan'] ?>" required>

            <label for="createdAt">Created At:</label>
            <input type="text" id="createdAt" name="createdAt" value="<?= $pembelianToEdit['created_at'] ?>" readonly>

            <a href="../admin/pembelian_barang.php"><button id="simpanBtn" type="submit">Simpan Perubahan</button></a>
            <button id="batalBtn" type="button" onclick="history.back()">Batal</button>
        </form>

    </div>

</body>

</html>
