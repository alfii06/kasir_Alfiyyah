<?php
$supplierToEdit = [
    'suplier_id' => '',
    'toko_id' => '',
    'nama_suplier' => '',
    'tlp_suplier' => '',
    'alamat_suplier' => '',
    'created_at' => ''
];

if (isset($_GET['id'])) {
    $suplier_id = $_GET['id'];
    $pdo = new PDO("mysql:host=localhost;dbname=pos_alfi", "root", "");

    try {
        $stmt = $pdo->prepare("SELECT * FROM suplier WHERE suplier_id = :suplier_id");
        $stmt->bindParam(":suplier_id", $suplier_id, PDO::PARAM_INT);
        $stmt->execute();
        $supplierData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($supplierData !== false) {
            $supplierToEdit = $supplierData;
        } else {
            echo "Data supplier tidak ditemukan.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $supplierToEdit = [
        'suplier_id' => $_POST['suplierId'],
        'toko_id' => $_POST['tokoId'],
        'nama_suplier' => $_POST['namaSuplier'],
        'tlp_suplier' => $_POST['tlpSuplier'],
        'alamat_suplier' => $_POST['alamatSuplier'],
        'created_at' => $_POST['createdAt'],
    ];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Supplier</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
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
        <h2>Edit Data Supplier</h2>

        <form id="formEditSupplier" method="post" action="process_edit_supplier.php">
            <label for="suplierId">Supplier ID:</label>
            <input type="text" id="suplierId" name="suplierId" value="<?= $supplierToEdit['suplier_id'] ?>" readonly>

            <label for="tokoId">Toko ID:</label>
            <input type="text" id="tokoId" name="tokoId" value="<?= $supplierToEdit['toko_id'] ?>" required>

            <label for="namaSuplier">Nama Supplier:</label>
            <input type="text" id="namaSuplier" name="namaSuplier" value="<?= $supplierToEdit['nama_suplier'] ?>" required>

            <label for="tlpSuplier">Telepon/HP:</label>
            <input type="text" id="tlpSuplier" name="tlpSuplier" value="<?= $supplierToEdit['tlp_suplier'] ?>" required>

            <label for="alamatSuplier">Alamat Supplier:</label>
            <input type="text" id="alamatSuplier" name="alamatSuplier" value="<?= $supplierToEdit['alamat_suplier'] ?>" required>

            <label for="createdAt">Created At:</label>
            <input type="text" id="createdAt" name="createdAt" value="<?= $supplierToEdit['created_at'] ?>" readonly>

            <button id="simpanBtn" type="submit">Simpan Perubahan</button>
            <button id="batalBtn" type="button" onclick="history.back()">Batal</button>
        </form>

    </div>

</body>

</html>
