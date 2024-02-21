<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "pos_alfi");
// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mendapatkan daftar toko
$sql = "SELECT toko_id, nama_toko FROM toko";
$result = $conn->query($sql);

$tokoOptions = '';
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Buat opsi dropdown untuk setiap toko
        $tokoOptions .= "<option value=\"{$row['toko_id']}\">{$row['nama_toko']}</option>";
    }
} else {
    $tokoOptions = "<option value=\"1\">Toko Default</option>";
}

// Tutup koneksi
$conn->close();

// Contoh inisialisasi data user untuk di-edit
$userToEdit = [
    'username' => '',
    'password' => '',
    'email' => '',
    'nama_lengkap' => '',
    'alamat' => '',
    'role' => '',
    'created_at' => date("Y-m-d")
];

// Jika data user sudah ada dalam formulir POST, gunakan data tersebut
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userToEdit = [
        'toko_id' => $_POST['toko_id'],
        'username' => $_POST['username'],
        'password' => password_hash($_POST['password'], PASSWORD_DEFAULT), // Hash password sebelum disimpan
        'email' => $_POST['email'],
        'nama_lengkap' => $_POST['namaLengkap'],
        'alamat' => $_POST['alamat'],
        'role' => $_POST['role'],
        'created_at' => $_POST['createdAt'],
    ];

    // Simpan data ke database
    $conn = new mysqli("localhost", "root", "", "pos_alfi");
    // Periksa koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Buat query untuk menyimpan data ke tabel user
    $sql = "INSERT INTO `user` (toko_id, username, password, email, nama_lengkap, alamat, role, created_at) VALUES ('{$userToEdit['toko_id']}', '{$userToEdit['username']}', '{$userToEdit['password']}', '{$userToEdit['email']}', '{$userToEdit['nama_lengkap']}', '{$userToEdit['alamat']}', '{$userToEdit['role']}', '{$userToEdit['created_at']}')";

    if ($conn->query($sql) === TRUE) {
        echo "Data user berhasil ditambahkan";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data User</title>
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

        h2{
            text-align: center;
        }

        #role{
            width: 100%;
            height: 30px;
        }
        
        #toko_id{
            width: 100%;
            height: 30px;
        }
    </style>
</head>

<body>

    <div id="formContainer">
        <h2>Tambah User</h2>

        <form id="formEditUser" method="post" action="">
            <!-- Dropdown untuk memilih toko -->
            <label for="toko_id">Toko:</label>
            <select id="toko_id" name="toko_id" required>
                <option value="">Pilih Toko</option>
                <?= $tokoOptions ?>
            </select>

            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?= $userToEdit['username'] ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= $userToEdit['email'] ?>" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" value="" required>

            <label for="namaLengkap">Nama Lengkap:</label>
            <input type="text" id="namaLengkap" name="namaLengkap" value="<?= $userToEdit['nama_lengkap'] ?>" required>

            <label for="alamat">Alamat:</label>
            <input type="text" id="alamat" name="alamat" value="<?= $userToEdit['alamat'] ?>" required>

            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="">Pilih User</option>
                <option value="admin">Admin</option>
                <option value="petugas">Petugas</option>
            </select>

            <label for="createdAt">Created At:</label>
            <input type="text" id="createdAt" name="createdAt" value="<?= $userToEdit['created_at'] ?>" readonly>

            <a href="../admin/data_user.php"><button id="simpanBtn" type="submit">Simpan</button></a>
            <button id="batalBtn" type="button" onclick="history.back()">Batal</button>
        </form>
    </div>

</body>

</html>
