    <?php
    $tokoToEdit = [
        'toko_id' => '',
        'nama_toko' => '',
        'alamat' => '',
        'tlp_hp' => '',
        'created_at' => ''
    ];

    if (isset($_GET['id'])) {
        $toko_id = $_GET['id'];
        $pdo = new PDO("mysql:host=localhost;dbname=pos_alfi", "root", "");

        try {
            $stmt = $pdo->prepare("SELECT * FROM toko WHERE toko_id = :toko_id");
            $stmt->bindParam(":toko_id", $toko_id, PDO::PARAM_INT);
            $stmt->execute();
            $tokoData = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($tokoData !== false) {
                $tokoToEdit = $tokoData;
            } else {
                echo "Data toko tidak ditemukan.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $tokoToEdit = [
            'toko_id' => $_POST['tokoId'],
            'nama_toko' => $_POST['namaToko'],
            'alamat' => $_POST['alamat'],
            'tlp_hp' => $_POST['tlpHp'],
            'created_at' => $_POST['createdAt'],
        ];
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Toko</title>
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
            <h2>Edit Toko</h2>

            <form id="formEditToko" method="post" action="process_edit_toko.php">
                <label for="tokoId">Toko ID:</label>
                <input type="text" id="tokoId" name="tokoId" value="<?= $tokoToEdit['toko_id'] ?>" readonly>

                <label for="namaToko">Nama Toko:</label>
                <input type="text" id="namaToko" name="namaToko" value="<?= $tokoToEdit['nama_toko'] ?>" required>

                <label for="alamat">Alamat:</label>
                <input type="text" id="alamat" name="alamat" value="<?= $tokoToEdit['alamat'] ?>" required>

                <label for="tlpHp">Telepon/HP:</label>
                <input type="text" id="tlpHp" name="tlpHp" value="<?= $tokoToEdit['tlp_hp'] ?>" required>

                <label for="createdAt">Created At:</label>
                <input type="text" id="createdAt" name="createdAt" value="<?= $tokoToEdit['created_at'] ?>" readonly>

                <button id="simpanBtn" type="submit">Simpan Perubahan</button>
                <button id="batalBtn" type="button" onclick="history.back()">Batal</button>
            </form>

        </div>

    </body>

    </html>
